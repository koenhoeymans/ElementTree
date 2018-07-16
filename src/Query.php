<?php

namespace ElementTree;

use ElementTree\Specification\ComponentSpecification;

/**
 * Example use, finds all `Element` components that are added to a`Component`:
 * 
 *     $query = $elementTree->createQuery($component);
 *     $query->find($query->allElements());
 * 
 * Arguments can be given to further refine a selection.
 * 
 *     $query->find($query->allElements($query->withName('foo')));
 */
class Query
{
    private $component;

    public function __construct(Component $component)
    {
        $this->component = $component;
    }

    /**
     * Find components according to a specific specification.
     * 
     * Example use:
     * 
     *     $query->find($query->allText());
     */
    public function find(ComponentSpecification $specification) : array
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
     * To find all `Element` components of a given `Component`. A further
     * specification can be given as an argument.
     * 
     * Example uses:
     * 
     *     $query->find($query->allElements());
     * 
     *     $query->find($query->allElements($query->withName('div')));
     */
    public function allElements(ComponentSpecification $specification = null) : Specification\AllElements
    {
        return new \ElementTree\Specification\AllElements($specification);
    }

    /**
     * This can be used as a specification to find `allElements` with an
     * attribute or a specific attribute if the `withName` specification is
     * given as an argument.
     * 
     * Example use:
     * 
     *     $query->find($query->allElements($query->withAttribute($query->withName('id')));
     */
    public function withAttribute(ComponentSpecification $specification = null) : Specification\WithAttribute
    {
        return new \ElementTree\Specification\WithAttribute($specification);
    }

    /**
     * This can be used as a further specification of the `allElements` or
     * `allAttributes` options to get only those with a given `$name`.
     * 
     * Example use:
     * 
     *     $query->find($query->allElements($query->withName('div')));
     */
    public function withName($name) : Specification\WithName
    {
        return new \ElementTree\Specification\WithName($name);
    }

    /**
     * Finds all `Attribute` components. A further specification can be given
     * as an argument.
     * 
     * Example uses:
     * 
     *     $query->find($query->allAttributes());
     * 
     *     $query->find($query->allAttributes($query->withName('id')));
     */
    public function allAttributes(ComponentSpecification $specification = null) : Specification\AllAttributes
    {
        return new \ElementTree\Specification\AllAttributes($specification);
    }

    /**
     * Finds all `Text` components.
     */
    public function allText(ComponentSpecification $specification = null) : Specification\AllText
    {
        return new \ElementTree\Specification\AllText($specification);
    }

    /**
     * Sets limitations on the parent `Element` the `Components` that are
     * searched for need to have.
     * 
     * Example use:
     * 
     *     $query->find($query->allText($query->withParentElement($query->withName('div'))));
     */
    public function withParentElement(ComponentSpecification $specification = null) : Specification\WithParentElement
    {
        return new \ElementTree\Specification\WithParentElement($specification);
    }

    /**
     * Combines specifications with a logical `and`.
     * 
     * Example use:
     * 
     *      $entries = $query->find($query->lAnd(
     *          $query->allAttributes(),
     *          $query->withName('class')
     *      ));
     */
    public function lAnd(
        ComponentSpecification $specification1,
        ComponentSpecification $specification2
    ) : Specification\AndSpecification {
        $args = func_get_args();
        $andSpec = new \ReflectionClass('\\ElementTree\\Specification\\AndSpecification');

        return $andSpec->newInstanceArgs($args);
    }

    /**
     * Combines specifications with a logical `or`.
     * 
     * Example use:
     * 
     *     $query->find($query->lOr(
     *          $query->withName('div'),
     *          $query->withName('class')
     *     ));
     */
    public function lOr(
        ComponentSpecification $specification1,
        ComponentSpecification $specification2
    ) : Specification\OrSpecification {
        $args = func_get_args();
        $andSpec = new \ReflectionClass('\\ElementTree\\Specification\\OrSpecification');

        return $andSpec->newInstanceArgs($args);
    }

    /**
     * Filters those `Components` that do not have the specification given as
     * an argument.
     * 
     * Example use:
     * 
     *     $query->find($query->allElements($query->not($query->withName('div'))));
     */
    public function not(ComponentSpecification $specification) : Specification\NotSpecification
    {
        return new \ElementTree\Specification\NotSpecification($specification);
    }
}
