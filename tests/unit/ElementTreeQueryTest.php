<?php

namespace ElementTree;

class ElementTreeQueryTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function queriesComponentsAgainstSpecification()
    {
        $elementTree = $this->createMock('\\ElementTree\\Component');
        $elementTree
            ->expects($this->atLeastOnce())
            ->method('getChildren')
            ->will($this->returnValue(array()));

        $specification = $this->createMock('\\ElementTree\\Specification\\ComponentSpecification');
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
        $elementTree = $this->createMock('\\ElementTree\\Element');
        $elementTree
            ->expects($this->atLeastOnce())
            ->method('getChildren')
            ->will($this->returnValue(array()));
        $elementTree
            ->expects($this->atLeastOnce())
            ->method('getAttributes')
            ->will($this->returnValue(array()));

        $specification = $this->createMock('\\ElementTree\\Specification\\ComponentSpecification');
        $specification
            ->expects($this->atLeastOnce())
            ->method('isSatisfiedBy')
            ->with($elementTree)
            ->will($this->returnValue(true));

        $query = new \ElementTree\ElementTreeQuery($elementTree);
        $query->find($specification);
    }
}
