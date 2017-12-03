<?php

namespace ElementTree\Specification;

use ElementTree\Component;

class WithParentElement implements ComponentSpecification
{
    private $specification;

    public function __construct(ComponentSpecification $specification = null)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(Component $component)
    {
        if (!$component->hasParent()) {
            return false;
        }

        if (!($component->getParent() instanceof \ElementTree\Element)) {
            return false;
        }

        if ($this->specification) {
            return $this->specification->isSatisfiedBy($component->getParent());
        }

        return true;
    }
}
