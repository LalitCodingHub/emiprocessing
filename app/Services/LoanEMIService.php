<?php 
namespace App\Services;

use App\Repositories\LoanDetailsRepositoryInterface;
use Illuminate\Support\Facades\DB;
use App\Models\EmiDetail;

class LoanEMIService implements LoanEMIServiceInterface
{
    protected $loanDetailsRepository;

    public function __construct(LoanDetailsRepositoryInterface $loanDetailsRepository)
    {
        $this->loanDetailsRepository = $loanDetailsRepository;
    }

    public function processEMIData()
    {
        $dates = $this->loanDetailsRepository->getMinMaxDates();

        if (!$dates->min_date || !$dates->max_date) {
            return 'No data found in loan_details table.';
        }

        $startDate = new \DateTime($dates->min_date);
        $endDate = new \DateTime($dates->max_date);

        $columns = [];
        while ($startDate <= $endDate) {
            $columns[] = $startDate->format('Y_M');
            $startDate->modify('+1 month');
        }

        // Drop the table if it exists
        DB::statement('DROP TABLE IF EXISTS emi_details');

        // Create the emi_details table with dynamic columns
        $query = 'CREATE TABLE emi_details (clientid INT, ';
        foreach ($columns as $column) {
            $query .= "`$column` DECIMAL(10, 2) DEFAULT 0.00, ";
        }
        $query = rtrim($query, ', ') . ')';
        DB::statement($query);

        // Process each row in loan_details and insert into emi_details
        $loanDetails = $this->loanDetailsRepository->getAll();
        foreach ($loanDetails as $loan) {
            $emi = $loan->loan_amount / $loan->num_of_payment;
            $start = new \DateTime($loan->first_payment_date);

            $emiData = [
                'clientid' => $loan->clientid,
            ];

            for ($i = 1; $i <= $loan->num_of_payment; $i++) {
                $currentMonth = $start->format('Y_M');
                if ($i == $loan->num_of_payment) {
                    $emi = $loan->loan_amount - ($emi * ($loan->num_of_payment - 1));
                }
                $emiData[$currentMonth] = round($emi, 2);
                $start->modify('+1 month');
            }

            DB::table('emi_details')->insert($emiData);
        }

        return 'Data processed and emi_details table created successfully!';
    }
}
