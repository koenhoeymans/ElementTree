<?php

namespace ElementTree\Specification;

class AllAttributesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function isSatisfiedWhenGivenAttributeComponent()
    {
        $allText = new \ElementTree\Specification\AllAttributes();
        $this->assertTrue(
            $allText->isSatisfiedBy(new \ElementTree\ElementTreeAttribute('foo', 'bar'))
        );
    }

    /**
     * @test
     */
    public function isNotSatisfiedWhenGivenElementComponent()
    {
        $allText = new \ElementTree\Specification\AllAttributes();
        $this->assertFalse(
            $allText->isSatisfiedBy(new \ElementTree\ElementTreeText('a'))
        );
    }
}
