<?php

namespace ElementTree\Specification;

use ElementTree\Component;

class AllElements implements ComponentSpecification
{
    private $specification;

    public function __construct(ComponentSpecification $specification = null)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(Component $component) : bool
    {
        if (!($component instanceof \ElementTree\Element)) {
            return false;
        }

        if ($this->specification) {
            return $this->specification->isSatisfiedBy($component);
        }

        return true;
    }
}
