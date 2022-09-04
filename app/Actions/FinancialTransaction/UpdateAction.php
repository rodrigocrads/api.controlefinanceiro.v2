<?php

namespace App\Actions\FinancialTransaction;

use App\Actions\AbstractAction;
use App\Models\FinancialTransaction;
use App\Exceptions\NotFoundException;
use App\Repositories\Interfaces\IFinancialTransactionRepository;

class UpdateAction extends AbstractAction
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
        /** @var FinancialTransaction */
        $financialTransaction = $this->repository->update(
            $this->get('update_data'),
            $this->get('id')
        );

        if (empty($financialTransaction)) {
           throw new NotFoundException(); 
        }

        return $financialTransaction->getDTO()->toArray();
    }
}