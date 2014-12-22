<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Specification;

use ElementTree\Component;

/**
 * @package ElementTree
 */
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
