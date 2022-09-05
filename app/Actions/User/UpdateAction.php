<?php

namespace App\Actions\User;

use App\Actions\AbstractAction;
use App\Repositories\Interfaces\IUserRepository;
use App\User;

class UpdateAction extends AbstractAction
{
    /** @var IUserRepository */
    private $userRepository;

    public function __construct(
        array $data = [],
        IUserRepository $userRepository
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
