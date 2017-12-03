<?php

namespace ElementTree\Specification;

use ElementTree\Component;

/**
 * Details specifics about a component that must be true in order
 * for the specification to be satisfied by the component. This
 * follows the specification pattern. A specification is satisfied
 * by an implementation or is not satisfied by it. The specification
 * itself can determine this. Eg. a `SecretParagraphSpecification`
 * could check wheter an `ElementTree\Element` has a name `p`
 * and an attribute `class` with value of `hidden`. If that is the
 * case the specification is satisfied by this component.
 */
interface ComponentSpecification
{
    /**
     * Returns whether the class specification is satisfied by
     * the given component. Eg. a specification can test for elements
     * to have a certain name. If the component is an `Element` with
     * the given name it will return true.
     */
    public function isSatisfiedBy(Component $component) : bool;
}
