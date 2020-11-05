<?php

declare(strict_types=1);

namespace App\Service\User;

use App\Entity\User;
use App\Exceptions\User\UserAlreadyExistsException;
use App\Repository\UserRepository;
use App\Service\Password\EncoderService;
use App\Service\Request\RequestService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class UserRegisterService
{
    private UserRepository $userRepository;
    private EncoderService $encoderService;
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    public function __construct(UserRepository $userRepository, EncoderService $encoderService, EntityManagerInterface $em)
    {
        $this->userRepository = $userRepository;
        $this->encoderService = $encoderService;
        $this->em = $em;
    }

    public function create(Request $request): User
    {
        $name = RequestService::getField($request, 'name');
        $email = RequestService::getField($request, 'email');
        $password = RequestService::getField($request, 'password');

        $user = new User($name, $email);


        $user->setPassword($this->encoderService->generateEncodedPassword($user, $password));

        $this->em->persist($user);
        $this->em->flush();

        try {
            $this->userRepository->save($user);
        } catch (\Exception $exception) {
            //throw UserAlreadyExistsException::fromEmail($email);
        }

        return $user;
    }
}