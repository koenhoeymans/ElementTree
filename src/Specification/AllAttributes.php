<?php

namespace ElementTree\Specification;

use ElementTree\Component;

class AllAttributes implements ComponentSpecification
{
    private $specification;

    public function __construct(ComponentSpecification $specification = null)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(Component $component)
    {
        if (!($component instanceof \ElementTree\Attribute)) {
            return false;
        }

        if ($this->specification) {
            return $this->specification->isSatisfiedBy($component);
        }

        return true;
    }
}
