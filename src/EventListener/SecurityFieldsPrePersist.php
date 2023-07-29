<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

#[AsDoctrineListener(event: Events::prePersist)]
class SecurityFieldsPrePersist
{
    public function __construct(
        private Security $security
    )
    {
    }

    public function prePersist(PrePersistEventArgs $args): void
    {
        $entity = $args->getObject();

        /**
         * Not an ideal ... @todo look into refactoring it later on!!!
         *
         * fix-setting the owner of an object, since I am getting some strange error with API platform state processors
         */

        if (\method_exists($entity, 'setOwner')) {
            $user = $this->security->getUser();
            // prePersist happens only once, when object created, so this should be fine for both API and CLI (factory load)
            if ($user) {
                $entity->setOwner($user);
            }
        }

        if (\method_exists($entity, 'setCreatedAt')) {
            $entity->setCreatedAt(new \DateTime('now'));
        }

        if (\method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new \DateTime('now'));
        }
    }
}
