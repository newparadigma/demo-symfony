<?php

namespace App\Service;

use App\Entity\Account;
use App\Repository\AccountRepository;

class AccountService
{
    private $accountRepository;

    public function __construct(AccountRepository $accountRepository)
    {
        $this->accountRepository = $accountRepository;
    }

    public function getFakeAccountForResult(): ?Account
    {
        return $this->accountRepository->getLast();
    }
}
