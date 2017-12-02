<?php

namespace ElementTree\Specification;

class AndSpecificationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function isSatisfiedWhenAllSubspecificationsAreSatisfied()
    {
        $andSpec = new \ElementTree\Specification\AndSpecification(
            new \ElementTree\Specification\AllElements(),
            new \ElementTree\Specification\WithName('a')
        );

        $this->assertTrue($andSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
    }

    /**
     * @test
     */
    public function isNotSatisfiedWhenNotAllSubspecificationsAreSatisfied()
    {
        $andSpec = new \ElementTree\Specification\AndSpecification(
            new \ElementTree\Specification\AllElements(),
            new \ElementTree\Specification\WithName('b')
        );

        $this->assertFalse($andSpec->isSatisfiedBy(new \ElementTree\ElementTreeElement('a')));
    }
}
