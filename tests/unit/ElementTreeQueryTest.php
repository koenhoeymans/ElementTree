<?php

namespace ElementTree;

class ElementTreeQueryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function queriesComponentsAgainstSpecification()
    {
        $elementTree = $this->getMock('\\ElementTree\\Component');
        $elementTree
            ->expects($this->atLeastOnce())
            ->method('getChildren')
            ->will($this->returnValue(array()));

        $specification = $this->getMock('\\ElementTree\\Specification\\ComponentSpecification');
        $specification
            ->expects($this->atLeastOnce())
            ->method('isSatisfiedBy')
            ->with($elementTree)
            ->will($this->returnValue(true));

        $query = new \ElementTree\ElementTreeQuery($elementTree);
        $query->find($specification);
    }

    /**
     * @test
     */
    public function queriesElementsAlsoForAttributes()
    {
        $elementTree = $this->getMock('\\ElementTree\\Element');
        $elementTree
            ->expects($this->atLeastOnce())
            ->method('getChildren')
            ->will($this->returnValue(array()));
        $elementTree
            ->expects($this->atLeastOnce())
            ->method('getAttributes')
            ->will($this->returnValue(array()));

        $specification = $this->getMock('\\ElementTree\\Specification\\ComponentSpecification');
        $specification
            ->expects($this->atLeastOnce())
            ->method('isSatisfiedBy')
            ->with($elementTree)
            ->will($this->returnValue(true));

        $query = new \ElementTree\ElementTreeQuery($elementTree);
        $query->find($specification);
    }
}
