<?php

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Bundle\SecurityBundle\Security;

final readonly class ExpenseCategoryProcessor implements ProcessorInterface
{
    public function __construct(
        private ProcessorInterface $innerProcessor,
        private Security           $security
    )
    {
    }

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): void
    {
        if ($data->getOwner() === null && $this->security->getUser()) {
            $data->setOwner($this->security->getUser());
        }

        $this->innerProcessor->process($data, $operation, $uriVariables, $context);
    }
}
