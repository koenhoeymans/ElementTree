<?php

/**
 * @package ElementTree
 */
namespace ElementTree\Specification;

use ElementTree\Component;

/**
 * @package ElementTree
 */
class WithAttribute implements ComponentSpecification
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

        $attributes = $component->getAttributes();
        if (empty($attributes)) {
            return false;
        }

        if (!$this->specification) {
            return true;
        }

        foreach ($component->getAttributes() as $attr) {
            if ($this->specification->isSatisfiedBy($attr)) {
                return true;
            }
        }

        return false;
    }
}
