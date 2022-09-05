<?php

namespace App\Actions\FinancialTransaction;

use App\Actions\AbstractAction;
use App\Repositories\Interfaces\IFinancialTransactionRepository;

class DeleteAction extends AbstractAction
{
    /**
     * @var IFinancialTransactionRepository
     */
    private $repository;

    public function __construct(array $data = [], IFinancialTransactionRepository $repository)
    {
        parent::__construct($data);

        $this->repository = $repository;
    }

    public function run()
    {
        $this->repository->delete($this->data['id']);
    }
}