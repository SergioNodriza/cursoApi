<?php


namespace App\Security\Authorization\voter;


use App\Entity\Group;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class GroupVoter
{
    public const GROUP_READ = 'GROUP_READ';
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
        if(\in_array($attribute, $this->supportedAttributes(), true)) {
            return $subject->isOwnBy($token->getUser());
        }

        return false;
    }

    private function supportedAttributes(): array
    {
        return [
            self::GROUP_READ,
            self::GROUP_UPDATE,
            self::GROUP_DELETE,
        ];
    }
}