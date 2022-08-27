<?php

namespace App\Actions\User;

use App\Actions\AbstractAction;
use App\Repositories\UserRepository;

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
