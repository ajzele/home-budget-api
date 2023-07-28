<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Events;

#[AsDoctrineListener(event: Events::preUpdate)]
readonly class SecurityFieldsPreUpdate
{
    public function preUpdate(PreUpdateEventArgs $args): void
    {
        $entity = $args->getObject();

        /**
         * Not an ideal ... @todo look into refactoring it later on!!!
         *
         * fix-setting the owner of an object, since I am getting some strange error with API platform state processors
         */

        if (\method_exists($entity, 'setOwner')) {
            $entity->setOwner($args->getOldValue('owner'));
        }

        if (\method_exists($entity, 'setCreatedAt')) {
            $entity->setCreatedAt($args->getOldValue('createdAt'));
        }

        if (\method_exists($entity, 'setUpdatedAt')) {
            $entity->setUpdatedAt(new \DateTime('now'));
        }
    }
}
