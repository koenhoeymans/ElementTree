<?php

namespace ElementTree;

class ComposableElementTreeComponentTest extends \PHPUnit_Framework_TestCase
{
    public function setup()
    {
        $this->composable = new ComposableImp();
    }

    /**
     * @test
     */
    public function addsNextSiblingToAppendable()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $this->composable->append($div);
        $this->composable->append($h1);

        $this->assertSame($h1, $div->getNextSibling());
        $this->assertNull($h1->getNextSibling());
    }

    /**
     * @test
     */
    public function removesNextSiblingAfterRemoveLastChild()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $this->composable->append($div);
        $this->composable->append($h1);
        $this->composable->remove($h1);

        $this->assertNull($div->getNextSibling());
    }

    /**
     * @test
     */
    public function adjustsNextSiblingAfterRemovingNotLastChild()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $this->composable->append($div);
        $this->composable->append($h1);
        $this->composable->append($h2);
        $this->composable->remove($h1);

        $this->assertSame($h2, $div->getNextSibling());
    }

    /**
     * @test
     */
    public function addsPreviousSiblingToAppendable()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $this->composable->append($div);
        $this->composable->append($h1);

        $this->assertSame($div, $h1->getPreviousSibling());
    }

    /**
     * @test
     */
    public function previousSiblingIsNullWhenThereIsNone()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $this->composable->append($div);

        $this->assertNull($div->getPreviousSibling());
    }

    /**
     * @test
     */
    public function removesPreviousSiblingAfterRemoveFirstChild()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $this->composable->append($div);
        $this->composable->append($h1);
        $this->composable->remove($div);

        $this->assertNull($h1->getNextSibling());
    }

    /**
     * @test
     */
    public function adjustsPreviousSiblingAfterRemovingNotFirstChild()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $this->composable->append($div);
        $this->composable->append($h1);
        $this->composable->append($h2);
        $this->composable->remove($h1);

        $this->assertSame($div, $h2->getPreviousSibling());
    }

    /**
     * @test
     */
    public function insertsComponentAfterOtherComponent()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $this->composable->append($div);
        $this->composable->append($h1);
        $this->composable->insertAfter($h2, $div);

        $this->assertEquals(array($div, $h2, $h1), $this->composable->getChildren());
    }

    /**
     * @test
     */
    public function addsInsertedComponentAsPreviousSibling()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $this->composable->append($div);
        $this->composable->append($h1);
        $this->composable->insertAfter($h2, $div);

        $this->assertEquals($h2, $h1->getPreviousSibling());
    }

    /**
     * @test
     */
    public function insertsComponentBeforeOtherComponent()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $this->composable->append($div);
        $this->composable->append($h1);
        $this->composable->insertBefore($h2, $h1);

        $this->assertEquals(array($div, $h2, $h1), $this->composable->getChildren());
    }

    /**
     * @test
     */
    public function removesSiblingsFromRemovedComponent()
    {
        $div = new \ElementTree\ElementTreeElement('div');
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $this->composable->append($div);
        $this->composable->append($h1);
        $this->composable->append($h2);
        $this->composable->remove($h1);

        $this->assertNull($h1->getPreviousSibling());
        $this->assertNull($h1->getNextSibling());
    }

    /**
     * @test
     */
    public function removesComponentFromPreviousPositionBeforeAppending()
    {
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $this->composable->append($h1);
        $this->composable->append($h2);
        $this->composable->append($h1);

        $this->assertEquals(array($h2, $h1), $this->composable->getChildren());
    }

    /**
     * @test
     */
    public function removesComponentFromPreviousPositionBeforeInserting()
    {
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $this->composable->append($h1);
        $this->composable->append($h2);
        $this->composable->insertAfter($h1, $h2);

        $this->assertEquals(array($h2, $h1), $this->composable->getChildren());
    }

    /**
     * @test
     */
    public function replacesComponents()
    {
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $h3 = new \ElementTree\ElementTreeElement('h3');
        $h4 = new \ElementTree\ElementTreeElement('h4');
        $this->composable->append($h1);
        $this->composable->append($h4);
        $this->composable->append($h3);
        $this->composable->replace($h2, $h4);

        $this->assertEquals(array($h1, $h2, $h3), $this->composable->getChildren());
    }

    /**
     * @test
     */
    public function replaceUpdatesPreviousSibling()
    {
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $h3 = new \ElementTree\ElementTreeElement('h3');
        $this->composable->append($h1);
        $this->composable->append($h2);
        $this->composable->replace($h3, $h2);

        $this->assertSame($h1, $h3->getPreviousSibling());
        $this->assertNull($h2->getPreviousSibling());
    }

    /**
     * @test
     */
    public function replaceUpdatesNextSibling()
    {
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $h3 = new \ElementTree\ElementTreeElement('h3');
        $this->composable->append($h1);
        $this->composable->append($h2);
        $this->composable->replace($h3, $h1);

        $this->assertSame($h2, $h3->getNextSibling());
        $this->assertNull($h2->getNextSibling());
    }

    /**
     * @test
     */
    public function replacesWithinSubChildren()
    {
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $h3 = new \ElementTree\ElementTreeElement('h3');
        $this->composable->append($h1);
        $h1->append($h2);
        $this->composable->replace($h3, $h2);

        $this->assertEquals(array($h3), $h1->getChildren());
    }

    /**
     * @test
     */
    public function replacingComponentIsRemovedFromOldParent()
    {
        $tree = new \ElementTree\ElementTree();
        $h1 = new \ElementTree\ElementTreeElement('h1');
        $tree->append($h1);
        $h2 = new \ElementTree\ElementTreeElement('h2');
        $this->composable->append($h2);
        $this->composable->replace($h1, $h2);

        $this->assertEquals(array(), $tree->getChildren());
    }
}
