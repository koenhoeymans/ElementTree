<?php

namespace ElementTree;

use ElementTree\Specification\ComponentSpecification;

class ElementTreeQuery implements Query
{
    private $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    /**
     * @see \ElementTree\Query::find()
     */
    public function find(ComponentSpecification $specification)
    {
        $matches = array();
        $this->component->getChildren();
        if ($specification->isSatisfiedBy($this->component)) {
            $matches[] = $this->component;
        }

        foreach ($this->component->getChildren() as $child) {
            $childQuery = new self($child);
            $matches = array_merge($matches, $childQuery->find($specification));
        }

        if ($this->component instanceof Element) {
            foreach ($this->component->getAttributes() as $attr) {
                $childQuery = new self($attr);
                $matches = array_merge($matches, $childQuery->find($specification));
            }
        }

        return $matches;
    }

    /**
     * @see \ElementTree\Query::allElements()
     */
    public function allElements(ComponentSpecification $specification = null)
    {
        return new \ElementTree\Specification\AllElements($specification);
    }

    /**
     * @see \ElementTree\Query::withAttribute()
     */
    public function withAttribute(ComponentSpecification $specification = null)
    {
        return new \ElementTree\Specification\WithAttribute($specification);
    }

    /**
     * @see \ElementTree\Query::withName()
     */
    public function withName($name)
    {
        return new \ElementTree\Specification\WithName($name);
    }

    /**
     * @see \ElementTree\Query::allAttributes()
     */
    public function allAttributes(ComponentSpecification $specification = null)
    {
        return new \ElementTree\Specification\AllAttributes($specification);
    }

    /**
     * @see \ElementTree\Query::allText()
     */
    public function allText(ComponentSpecification $specification = null)
    {
        return new \ElementTree\Specification\AllText($specification);
    }

    /**
     * @see \ElementTree\Query::withParentElement()
     */
    public function withParentElement(ComponentSpecification $specification = null)
    {
        return new \ElementTree\Specification\WithParentElement($specification);
    }

    /**
     * @see \ElementTree\Query::lAnd()
     */
    public function lAnd(
        ComponentSpecification $specification1,
        ComponentSpecification $specification2
    ) {
        $args = func_get_args();
        $andSpec = new \ReflectionClass('\\ElementTree\\Specification\\AndSpecification');

        return $andSpec->newInstanceArgs($args);
    }

    /**
     * @see \ElementTree\Query::lOr()
     */
    public function lOr(
        ComponentSpecification $specification1,
        ComponentSpecification $specification2
    ) {
        $args = func_get_args();
        $andSpec = new \ReflectionClass('\\ElementTree\\Specification\\OrSpecification');

        return $andSpec->newInstanceArgs($args);
    }

    /**
     * @see \ElementTree\Query::not()
     */
    public function not(ComponentSpecification $specification)
    {
        return new \ElementTree\Specification\NotSpecification($specification);
    }
}
