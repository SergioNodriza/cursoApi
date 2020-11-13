<?php


namespace App\Security\Authorization\voter;

use App\Entity\Group;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class GroupVoter extends Voter
{
    public const GROUP_READ = 'GROUP_READ';
    public const GROUP_CREATE = 'GROUP_CREATE';
    public const GROUP_UPDATE = 'GROUP_UPDATE';
    public const GROUP_DELETE = 'GROUP_DELETE';

    protected function supports(string $attribute, $subject): bool
    {
        return \in_array($attribute, $this->supportedAttributes(), true);
    }

    /**
     * @param string $attribute
     * @param Group|null $subject
     * @param TokenInterface $token
     * @return bool|void
     */
    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        if(self::GROUP_CREATE === $attribute) {
            return true;
        }

        if(\in_array($attribute, [self::GROUP_READ, self::GROUP_UPDATE, self::GROUP_DELETE], true)) {
            return $subject->isOwnedBy($token->getUser());
        }

        return false;
    }

    private function supportedAttributes(): array
    {
        return [
            self::GROUP_READ,
            self::GROUP_CREATE,
            self::GROUP_UPDATE,
            self::GROUP_DELETE,
        ];
    }
}