<?php

namespace ElementTree\Specification;

class AllAttributesTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function isSatisfiedWhenGivenAttributeComponent()
    {
        $allText = new \ElementTree\Specification\AllAttributes();
        $this->assertTrue(
            $allText->isSatisfiedBy(new \ElementTree\Attribute('foo', 'bar'))
        );
    }

    /**
     * @test
     */
    public function isNotSatisfiedWhenGivenElementComponent()
    {
        $allText = new \ElementTree\Specification\AllAttributes();
        $this->assertFalse(
            $allText->isSatisfiedBy(new \ElementTree\Text('a'))
        );
    }
}
