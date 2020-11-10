<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Exceptions\Password\PasswordException;
use App\Repository\UserRepository;
use App\Service\Password\EncoderService;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

class ChangePasswordService
{
    private UserRepository $userRepository;
    private EncoderService $encoderService;

    public function __construct(UserRepository $userRepository, EncoderService $encoderService)
    {
        $this->userRepository = $userRepository;
        $this->encoderService = $encoderService;
    }

    /**
     * @param string $userId
     * @param string $oldPassword
     * @param string $newPassword
     * @return User
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function changePassword(string $userId, string $oldPassword, string $newPassword): User
    {
        $user = $this->userRepository->findOneById($userId);

        if (!$this->encoderService->isValidPassword($user, $oldPassword)) {
            throw PasswordException::oldPAsswordDoesNotMatch();
        }

        $user->setPassword($this->encoderService->generateEncodedPassword($user, $newPassword));

        $this->userRepository->save($user);

        return $user;
    }
}
