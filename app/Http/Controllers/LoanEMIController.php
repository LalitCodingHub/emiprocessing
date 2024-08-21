<?php

namespace App\Http\Controllers;

use App\Models\EmiDetail;
use App\Services\LoanEMIServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class LoanEMIController extends Controller
{
    protected $loanEMIService;

    public function __construct(LoanEMIServiceInterface $loanEMIService)
    {
        $this->loanEMIService = $loanEMIService;
    }

    public function showForm()
    {
        if (Schema::hasTable('emi_details')) {
            $emiDetails = EmiDetail::all();
        } else {
            $emiDetails = collect();
        }
        return view('loan_emi.process_data', compact('emiDetails'));
    }

    public function processData(Request $request)
    {
        $result = $this->loanEMIService->processEMIData();
        return redirect()->route('process.data.page')->with('success', $result);
    }
}
