<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Specification;

use ElementTree\Component;

/**
 * @package ElementTree
 */
class AllElements implements ComponentSpecification
{
    private $specification;

    public function __construct(ComponentSpecification $specification = null)
    {
        $this->specification = $specification;
    }

    public function isSatisfiedBy(Component $component)
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
