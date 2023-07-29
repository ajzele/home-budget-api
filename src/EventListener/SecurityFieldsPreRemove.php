<?php

namespace App\EventListener;

use App\Entity\Product;
use Doctrine\ORM\Event\PreRemoveEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Events;
use Symfony\Bundle\SecurityBundle\Security;

#[AsDoctrineListener(event: Events::preRemove)]
class SecurityFieldsPreRemove
{
    public function __construct(
        private Security $security
    )
    {
    }

    /**
     * @throws \Exception
     */
    public function preRemove(PreRemoveEventArgs $args): void
    {
        $entity = $args->getObject();

        if (\method_exists($entity, 'getOwner')) {
            if ($entity->getOwner()->getId() != $this->security->getUser()->getId()) {
                throw new \Exception('Only owner can remove its own objects');
            }
        }
    }
}
