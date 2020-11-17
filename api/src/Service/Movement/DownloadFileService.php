<?php

declare(strict_types=1);

namespace App\Service\Movement;

use App\Entity\User;
use App\Exceptions\Movement\CannotCreateMovementToAnotherUserException;
use App\Exceptions\Movement\MovementDoesNotBelongToGroupException;
use App\Repository\MovementRepository;
use App\Service\File\FileService;

class DownloadFileService
{
    private MovementRepository $movementRepository;
    private FileService $fileService;

    public function __construct(MovementRepository $movementRepository, FileService $fileService)
    {

        $this->movementRepository = $movementRepository;
        $this->fileService = $fileService;
    }

    public function downloadFile(User $user, string $filePath): ?string
    {
        $movement = $this->movementRepository->findObeByFilePathOrFail($filePath);

        if (null !== $group = $movement->getGroup()) {
            if (!$user->isMemberOfGroup($group)) {
                throw new MovementDoesNotBelongToGroupException();
            }
        }

        if (!$movement->isOwnedBy($user)) {
            throw new CannotCreateMovementToAnotherUserException();
        }

        return $this->fileService->downloadFile($filePath);
    }
}