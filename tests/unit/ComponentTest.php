<?php

namespace ElementTree;

class ComponentTest extends \PHPUnit\Framework\TestCase
{
    public function setup()
    {
        $this->component = new ComponentImp();
    }

    /**
     * @test
     */
    public function hasNoParentElementIfNotAppended()
    {
        $this->assertEquals(null, $this->component->getParent());
        $this->assertEquals(false, $this->component->hasParent());
    }

    /**
     * @test
     */
    public function hasNoOwnerTreeByDefault()
    {
        $this->assertNull($this->component->getOwnerTree());
    }

    /**
     * @test
     */
    public function hasNoNextSiblingByDefault()
    {
        $this->assertNull($this->component->getNextSibling());
    }

    /**
     * @test
     */
    public function hasNoPreviousSiblingByDefault()
    {
        $this->assertNull($this->component->getPreviousSibling());
    }
}
