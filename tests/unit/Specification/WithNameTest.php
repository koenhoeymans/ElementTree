<?php

namespace ElementTree\Specification;

class WithNameTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function isSatisfiedWhenElementHasName()
    {
        $withName = new \ElementTree\Specification\WithName('foo');
        $this->assertTrue(
            $withName->isSatisfiedBy(new \ElementTree\ElementTreeElement('foo', 'bar'))
        );
    }

    /**
     * @test
     */
    public function isSatisfiedWhenAttributeHasName()
    {
        $withName = new \ElementTree\Specification\WithName('foo');
        $this->assertTrue(
            $withName->isSatisfiedBy(new \ElementTree\ElementTreeAttribute('foo', 'bar'))
        );
    }
}
