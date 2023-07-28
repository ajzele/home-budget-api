<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Bundle\SecurityBundle\Security;

readonly class ExpenseCategoryProcessor implements ProcessorInterface
{
        public function __construct(
            private Security $security
        )
        {
        }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        if ($operation instanceof Post || $operation instanceof Put) {
            $data->setOwner($this->security->getUser());
        }
    }
}
