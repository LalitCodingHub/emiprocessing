<?php 

namespace App\Http\Controllers;

use App\Services\LoanDetailsService;

class LoanDetailsController extends Controller
{
    protected $loanDetailsService;

    public function __construct(LoanDetailsService $loanDetailsService)
    {
        $this->loanDetailsService = $loanDetailsService;
    }

    public function index()
    {
        $loans = $this->loanDetailsService->getAllLoans();
        return view('loan_details.index', compact('loans'));
    }
}
