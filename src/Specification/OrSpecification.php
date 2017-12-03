<?php

namespace ElementTree\Specification;

use ElementTree\Component;

class OrSpecification implements ComponentSpecification
{
    private $specifications;

    public function __construct(ComponentSpecification $a, ComponentSpecification $b)
    {
        $this->specifications = func_get_args();
    }

    public function isSatisfiedBy(Component $component) : bool
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($component)) {
                return true;
            }
        }

        return false;
    }
}
