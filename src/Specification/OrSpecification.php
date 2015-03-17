<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Specification;

use ElementTree\Component;

/**
 * @package ElementTree
 */
class OrSpecification implements ComponentSpecification
{
    private $specifications;

    public function __construct(ComponentSpecification $a, ComponentSpecification $b)
    {
        $this->specifications = func_get_args();
    }

    public function isSatisfiedBy(Component $component)
    {
        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($component)) {
                return true;
            }
        }

        return false;
    }
}