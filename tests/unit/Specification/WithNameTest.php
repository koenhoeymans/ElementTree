<?php

namespace ElementTree\Specification;

class WithNameTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function isSatisfiedWhenElementHasName()
    {
        $withName = new \ElementTree\Specification\WithName('foo');
        $this->assertTrue(
            $withName->isSatisfiedBy(new \ElementTree\Element('foo', 'bar'))
        );
    }

    /**
     * @test
     */
    public function isSatisfiedWhenAttributeHasName()
    {
        $withName = new \ElementTree\Specification\WithName('foo');
        $this->assertTrue(
            $withName->isSatisfiedBy(new \ElementTree\Attribute('foo', 'bar'))
        );
    }
}
