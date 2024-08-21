<?php 

namespace App\Services;

use App\Repositories\LoanDetailsRepositoryInterface;

class LoanDetailsService
{
    protected $loanDetailsRepository;

    public function __construct(LoanDetailsRepositoryInterface $loanDetailsRepository)
    {
        $this->loanDetailsRepository = $loanDetailsRepository;
    }

    public function getAllLoans()
    {
        return $this->loanDetailsRepository->getAll();
    }
}
