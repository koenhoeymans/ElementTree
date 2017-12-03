<?php

namespace ElementTree\Specification;

use ElementTree\Component;

class WithName implements ComponentSpecification
{
    private $name;

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function isSatisfiedBy(Component $component)
    {
        if ($component instanceof \ElementTree\Element
            || $component instanceof \ElementTree\Attribute) {
            return $component->getName() == $this->name;
        }

        return false;
    }
}
