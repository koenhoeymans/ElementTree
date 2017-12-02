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
         * The components
         * --------------
         */

        /**
         * The ElementTree package contains a tree of components that resemble
         * a very basis XML layout.
         */
        $elementTree = new \ElementTree\ElementTree();

        $element = $elementTree->createElement('div');
        $text = $elementTree->createText('the text content');
        $comment = $elementTree->createComment('a comment');

        /**
         * Elements and comments can be added to the tree and to eachother.
         * As this is not a pure XML implementation there does not need
         * to be only one root element.
         */
        $elementTree->append($element);
        $elementTree->append($comment);
        $h1 = $elementTree->createElement('h1');
        $elementTree->append($h1);
        $h1->append($text);

        $this->assertSame($comment, $element->getNextSibling());
        $this->assertSame($element, $comment->getPreviousSibling());

        /**
         * Components can also be removed from its parent.
         */
        $element->remove($comment);
        $element->remove($h1);

        $this->assertFalse($element->hasChildren());

        /**
         * Elements and comments can be inserted after others.
         */
        $elementTree = new \ElementTree\ElementTree();
        $h1 = $elementTree->createElement('h1');
        $h2 = $elementTree->createElement('h2');
        $h3 = $elementTree->createElement('h3');
        $elementTree->append($h1);
        $elementTree->append($h3);
        $elementTree->insertAfter($h2, $h1);

        $this->assertSame($h2, $h1->getNextSibling());

        /**
         * Or they can be inserted before another component.
         */
        $elementTree = new \ElementTree\ElementTree();
        $h1 = $elementTree->createElement('h1');
        $h2 = $elementTree->createElement('h2');
        $h3 = $elementTree->createElement('h3');
        $elementTree->append($h1);
        $elementTree->append($h3);
        $elementTree->insertBefore($h2, $h3);

        $this->assertSame($h2, $h3->getPreviousSibling());

        /**
         * For each component you can get back to the `ElementTree` that
         * created it:
         */
        $elementTree = new \ElementTree\ElementTree();
        $div = $elementTree->createElement('div');
        $elementTree->append($div);

        $this->assertSame($elementTree, $div->getOwnerTree());

        /**
         * `Text` can be appended to `Elements`.
         */
        $element->append($text);
        $this->assertTrue($element->hasChildren());

        /**
         * An `Element` can also have attributes.
         */
        $element->setAttribute('class', 'sidebar');

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
         * The name of elements can be found with `getName()`.
         */
        $this->assertEquals('div', $element->getName());

        /**
         * The value of an attribute can be found with `getAttributeValue`.
         */
        $this->assertEquals('sidebar', $element->getAttributeValue('class'));

        /**
         * Asking whether an element has a certain attribute is done with
         * `hasAttribute`.
         */
        $this->assertTrue($element->hasAttribute('class'));
        $this->assertFalse($element->hasAttribute('style'));

        /**
         * An `Element` can be composed of others.
         */
        $p = $elementTree->createElement('p');
        $element->append($p);

        /**
         * The paragraph is now a child component of the div.
         */
        $this->assertSame($element, $p->getParent());
        $this->assertTrue($element->hasChildren());

        /**
         * Comments and Text components have the `getValue` and `setValue`
         * methods to manipulate them.
         */
        $comment->setValue('comment changed');
        $this->assertEquals('comment changed', $comment->getValue());

        $text->setValue('new content');
        $this->assertEquals('new content', $text->getValue());

        /**
         * The whole tree can be xmlified to string. Empty tags will be closed.
         */
        $elementTree = new \ElementTree\ElementTree();
        $h1 = $elementTree->createElement('h1');
        $text = $elementTree->createText('a header');
        $elementTree->append($h1);
        $h1->append($text);
        $elementTree->append($elementTree->createElement('div'));

        $this->assertEquals('<h1>a header</h1><div />', $elementTree->toString());

        /**
         * Queries
         * -------
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
        $query = new \ElementTree\ElementTreeQuery($elementTree);
        $entries = $query->find($query->allElements($query->withName('span')));
        $this->assertEquals(array($span), $entries);

        /**
         * Another specification for elements is `withAttribute`.
         */
        $id = $div->setAttribute('id', 'footer');
        $query = new \ElementTree\ElementTreeQuery($elementTree);
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
