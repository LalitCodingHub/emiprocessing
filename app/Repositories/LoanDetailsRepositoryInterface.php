<?php

// LoanDetailsRepositoryInterface.php
namespace App\Repositories;

interface LoanDetailsRepositoryInterface
{
    public function getAll();
    public function getMinMaxDates();

}

