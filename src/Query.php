<?php

namespace ElementTree;

use ElementTree\Specification\ComponentSpecification;

interface Query
{
    /**
     * Find all components that satisfy a given specification.
     */
    public function find(ComponentSpecification $specification) : array;

    /**
     * Matches all `Element` components.
     */
    public function allElements(ComponentSpecification $specification = null) : Specification\AllElements;

    /**
     * Matches an element when it has an attribute (with given specification).
     */
    public function withAttribute(ComponentSpecification $specification = null) : Specification\WithAttribute;

    /**
     * Matches when the name of the element or attribute is the same.
     */
    public function withName(string $name) : \ElementTree\Specification\WithName;

    /**
     * Matches all `Attribute` components.
     */
    public function allAttributes(ComponentSpecification $specification = null) : Specification\AllAttributes;

    /**
     * Selects all text components.
     */
    public function allText(ComponentSpecification $specification = null) : Specification\AllText;

    /**
     * Selects components that have a parent element.
     */
    public function withParentElement(ComponentSpecification $specification = null) : Specification\WithParentElement;

    /**
     * Combines specifications. All must succeed for the component to be
     * selected.
     */
    public function lAnd(
        ComponentSpecification $specification1,
        ComponentSpecification $specification2
    ) : Specification\AndSpecification;

    /**
     * Combines specifications. At least one must succeed for the component to be
     * selected.
     */
    public function lOr(
        ComponentSpecification $specification1,
        ComponentSpecification $specification2
    ) : Specification\OrSpecification;

    /**
     * The negation another specification. Selects a component if a specification
     * does not apply.
     */
    public function not(ComponentSpecification $specification) : Specification\NotSpecification;
}
