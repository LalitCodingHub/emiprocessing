<?php 

// LoanDetailsRepository.php
namespace App\Repositories;

use App\Models\LoanDetail;
use Illuminate\Support\Facades\DB;

class LoanDetailsRepository implements LoanDetailsRepositoryInterface
{
    public function getAll()
    {
        return LoanDetail::all();
    }

    public function getMinMaxDates()
    {
        return DB::table('loan_details')
            ->selectRaw('MIN(first_payment_date) as min_date, MAX(last_payment_date) as max_date')
            ->first();
    }
}