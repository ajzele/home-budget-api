<?php

namespace App\OptionsResolver;

use Symfony\Component\OptionsResolver\OptionsResolver;

class DummyOptionsResolver extends OptionsResolver
{
    public function configureTitle(bool $isRequired = true): self
    {
        $this->setDefined('title')->setAllowedTypes('title', 'string');

        if ($isRequired) {
            $this->setRequired('title');
        }

        return $this;
    }

    public function configureEnabled(bool $isRequired = true): self
    {
        $this->setDefined('enabled')->setAllowedTypes('enabled', 'bool');

        if ($isRequired) {
            $this->setRequired('enabled');
        }

        return $this;
    }
}
