<?php

namespace ElementTree\Specification;

use ElementTree\Component;

class NotSpecification implements ComponentSpecification
{
    private $specification;

    public function __construct(ComponentSpecification $specification)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(Component $component)
    {
        return !$this->specification->isSatisfiedBy($component);
    }
}
