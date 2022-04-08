<?php

namespace FinancialControl\Actions\User;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\UserRepository;
use FinancialControl\User;

class UpdateAction extends AbstractAction
{
    /** @var UserRepository */
    private $userRepository;

    public function __construct(
        array $data = [],
        UserRepository $userRepository
    ) {
        parent::__construct($data);
        $this->userRepository = $userRepository;
    }

    public function run()
    {
        /** @var User */
        $user = $this->userRepository->update(
            $this->get('data'),
            $this->get('id')
        );

        return $user->getDTO()->toArray();
    }
}
