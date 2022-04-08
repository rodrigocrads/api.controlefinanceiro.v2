<?php

namespace FinancialControl\Actions\User;

use FinancialControl\Actions\AbstractAction;
use FinancialControl\Repositories\UserRepository;

class ChangePasswordAction extends AbstractAction
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
        $data = [
            'password' => bcrypt($this->get('data')['new_password'])
        ];

        $this->userRepository->update(
            $data,
            $this->get('id')
        );
    }
}
