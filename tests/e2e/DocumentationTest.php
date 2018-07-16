<?php

namespace ElementTree;

class DocumentationTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @test
     */
    public function elementTreeUsage()
    {
        /**
         * ## The components
         * 
         * There are five different components:
         * 
         *   * `Attribute`
         *   * `Comment`
         *   * `Element`
         *   * `ElementTree`
         *   * `Text`
         * 
         * The `ElementTree` is the base component:
         */ 

        $elementTree = new \ElementTree\ElementTree();

        /**
         * An `Element` is created through the `ElementTree`:
         */
        $element = $elementTree->createElement('div');

        /**
         * An `Element` can have `Attribute`s:
         */
        $attribute = $element->setAttribute('name', 'value');

        /**
         * `Comment`s and `Text` are also created through the `ElementTree`:
         */
        $comment = $elementTree->createComment('this is a comment');
        $text = $elementTree->createText('some text content');


        /**
         * One can append or insert (after or before) an `Attribute`, `Comment`,
         * `Element` or `Text` to The `ElementTree` and `Element`component.
         * An `ElementTree` cannot be appended or inserted.
         */
        $element->append($text);
        $element->insertAfter($comment, $text);
        $elementTree->append($element);

        /**
         * They can also be removed from its parent.
         */
        $element->remove($text);
        $element->remove($comment);
        $elementTree->remove($element);

        /** 
         * ## Component methods
         * 
         * Every component has the following methods: `getOwnerTree`,
         * `getParent`, `hasParent`, `hasChildren`, `getChildren`,
         * `getNextSibling`, `getPreviousSibling`, `toString`.
         */
        $h1 = $elementTree->createElement('h1');
        $elementTree->append($h1);
        $text = $elementTree->createText('this is a header');
        $h1->append($text);
        $div = $elementTree->createElement('div');
        $elementTree->append($div);

        $this->assertSame($elementTree, $h1->getOwnerTree());
        $this->assertSame($h1, $text->getParent());
        $this->assertTrue($text->hasParent());
        $this->assertTrue($h1->hasChildren());
        $this->assertFalse($text->hasChildren());
        $this->assertEquals(array($text), $h1->getChildren());
        $this->assertSame($div, $h1->getNextSibling());
        $this->assertSame($h1, $div->getPreviousSibling());

        /**
         * For each component you can get back to the `ElementTree` you
         * appended it to with `getOwnerTree`.
         */
        $elementTree = new \ElementTree\ElementTree();
        $div = $elementTree->createElement('div');
        $elementTree->append($div);

        $this->assertSame($elementTree, $div->getOwnerTree());

        /**
         * The whole tree can be xmlified to string with `toString`.
         * Empty tags will be closed.
         */
        $elementTree = new \ElementTree\ElementTree();
        $h1 = $elementTree->createElement('h1');
        $text = $elementTree->createText('a header');
        $elementTree->append($h1);
        $h1->append($text);
        $elementTree->append($elementTree->createElement('div'));

        $this->assertEquals('<h1>a header</h1><div />', $elementTree->toString());

        /**
         * ## Misc
         * 
         * If a comment, element, or text component is appended to another tree,
         * it is removed from the original tree.
         */
        $elementTree = new \ElementTree\ElementTree();
        $div = $elementTree->createElement('div');
        $elementTree->append($div);
        $header = $elementTree->createElement('h1');
        $elementTree->append($header);
        $otherTree = new \ElementTree\ElementTree();
        $otherTree->append($header);

        $this->assertEquals(array($header), $otherTree->getChildren());
        $this->assertEquals(array($div), $elementTree->getChildren());

       /**
         * Attribute values are quoted in double quotes by default. You can change
         * this on the attribute by using one of the following methods:
         * `noQuotes`, `singleQuotes` or `doubleQuotes`.
         */
        $div = $elementTree->createElement('div');
        $id = $div->setAttribute('id', 'foo');
        $id->singleQuotes();

        $this->assertEquals("<div id='foo' />", $div->toString());

        /**
         * Attributes can be removed from elements with `removeAttribute`.
         */
        $div->removeAttribute('id');

        $this->assertEquals(array(), $div->getAttributes());

        /**
         * The value of an attribute can be found with `getAttributeValue`.
         */
        $element = $elementTree->createElement('div');
        $element->setAttribute('class', 'sidebar');
        $this->assertEquals('sidebar', $element->getAttributeValue('class'));

        /**
         * The name of elements can be found with `getName()`.
         */
        $this->assertEquals('div', $element->getName());

        /**
         * Asking whether an element has a certain attribute is done with
         * `hasAttribute`.
         */
        $this->assertTrue($element->hasAttribute('class'));
        $this->assertFalse($element->hasAttribute('style'));

        /**
         * ## Queries
         */

        $elementTree = new \ElementTree\ElementTree();
        $div = $elementTree->createElement('div');
        $span = $elementTree->createElement('span');
        $elementTree->append($div);
        $elementTree->append($span);

        /**
         * A query object can be created by using the `createQuery` method
         * on the `ElementTree`. The component that will be queried using
         * the query object is passed as an argument. This can be an
         * `ElementTree` but may also be eg an `Element`.
         */
        $query = $elementTree->createQuery($elementTree);

        /**
         * Finding all elements in the tree with `allElements`.
         */
        $entries = $query->find($query->allElements());
        $this->assertEquals(array($div, $span), $entries);

        /**
         * Elements can be further specified by name with `withName`.
         */
        $query = new \ElementTree\Query($elementTree);
        $entries = $query->find($query->allElements($query->withName('span')));
        $this->assertEquals(array($span), $entries);

        /**
         * Another specification for elements is `withAttribute`.
         */
        $id = $div->setAttribute('id', 'footer');
        $query = new \ElementTree\Query($elementTree);
        $entries = $query->find($query->allElements($query->withAttribute()));
        $this->assertEquals(array($div), $entries);

        /**
         * Finding all attributes.
         */
        $entries = $query->find($query->allAttributes());
        $this->assertEquals(array($id), $entries);

        /**
         * Attributes can also be further specified by name.
         */
        $class = $div->setAttribute('class', 'static');
        $entries = $query->find($query->allAttributes($query->withName('class')));
        $this->assertEquals(array($class), $entries);

        /**
         * Using `withParentElement` allows to query for attributes (and other
         * components) that have a parent element.
         */
        $entries = $query->find($query->allAttributes($query->withParentElement()));
        $this->assertEquals(array($id, $class), $entries);

        $highlight = $span->setAttribute('highlight', 'true');
        $entries = $query->find($query->allAttributes(
            $query->withParentElement($query->withName('span'))
        ));
        $this->assertEquals(array($highlight), $entries);

        /**
         * Finding all text components.
         */
        $text = $elementTree->createText('some text');
        $div->append($text);
        $entries = $query->find($query->allText());
        $this->assertEquals(array($text), $entries);

        /**
         * Also text queries can contain further specifications.
         */
        $spanText = $elementTree->createText('other text');
        $span->append($spanText);
        $entries = $query->find($query->allText(
            $query->withParentElement($query->withName('span'))
        ));
        $this->assertEquals(array($spanText), $entries);

        /**
         * Queries can be combined with `lAnd`, the logical and, so that components
         * need to satisfy all criteria.
         */
        $entries = $query->find($query->lAnd(
            $query->allAttributes(),
            $query->withName('class')
        ));
        $this->assertEquals(array($class), $entries);

        /**
         * Another combinations is with `lOr`, the logical or. A component satisfies
         * the conditions if one of the conditions is satisfied.
         */
        $entries = $query->find($query->lOr(
            $query->withName('div'),
            $query->withName('class')
        ));
        $this->assertEquals(array($div, $class), $entries);

        /**
         * There's also the possibility to have the denial of a specification
         * with `not`. The following query searches for all elements that do not
         * have the name 'div'.
         */
        $entries = $query->find($query->allElements($query->not($query->withName('div'))));
        $this->assertEquals(array($span), $entries);
    }
}
