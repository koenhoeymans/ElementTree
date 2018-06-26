<?php

namespace ElementTree\Specification;

class AllElementsTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function isSatisfiedWhenGivenElementComponent()
    {
        $allText = new \ElementTree\Specification\AllElements();
        $this->assertTrue(
            $allText->isSatisfiedBy(new \ElementTree\Element('a'))
        );
    }

    /**
     * @test
     */
    public function isNotSatisfiedWhenGivenElementComponent()
    {
        $allText = new \ElementTree\Specification\AllElements();
        $this->assertFalse(
            $allText->isSatisfiedBy(new \ElementTree\Text('a'))
        );
    }
}
