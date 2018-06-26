<?php

namespace ElementTree\Specification;

class AllTextTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function isSatisfiedWhenGivenTextComponent()
    {
        $allText = new \ElementTree\Specification\AllText();
        $this->assertTrue(
            $allText->isSatisfiedBy(new \ElementTree\Text('a'))
        );
    }

    /**
     * @test
     */
    public function isNotSatisfiedWhenGivenElementComponent()
    {
        $allText = new \ElementTree\Specification\AllText();
        $this->assertFalse(
            $allText->isSatisfiedBy(new \ElementTree\Element('a'))
        );
    }
}
