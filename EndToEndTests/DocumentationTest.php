<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_DocumentationTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function elementTreeUsage()
	{
		/**
		 * The ElementTree package contains a tree of components that resemble
		 * a very basis XML layout. 
		 */
		$elementTree = new \ElementTree\ElementTree();

		$element = $elementTree->createElement('div');
		$text = $elementTree->createText('the text content');
		$comment = $elementTree->createComment('a comment');

		/**
		 * Elements and comments can be added to the tree. As this is not a pure XML
		 * implementation there does not need to be only one root element.
		 */
		$elementTree->append($element);
		$elementTree->append($comment);
		$h1 = $elementTree->createElement('h1');
		$elementTree->append($h1);

		/**
		 * For each component you can get back to the `ElementTree` that
		 * created it:
		 */
		$this->assertSame($elementTree, $element->getOwnerTree());

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
		 * The name of elements can be found with `getName()`.
		 */
		$this->assertEquals('div', $element->getName());

		/**
		 * The value of an attribute can be found with `getAttributeValue`.
		 */
		$this->assertEquals('sidebar', $element->getAttributeValue('class'));

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
		 * Components can also be removed from its parent.
		 */
		$element->remove($text);
		$element->remove($p);
		$this->assertFalse($element->hasChildren());

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
		$h1->append($elementTree->createText('a header'));
		$this->assertEquals(
			'<div class="sidebar" /><!--comment changed--><h1>a header</h1>',
			$elementTree->toString()
		);

		/**
		 * Searching the tree can be done with a callback and `ElementTree::query()`.
		 * It will pass all components to your callback.
		 */
		$output = '';
		$callback = function(\ElementTree\Component $component) use (&$output)
		{
			if ($component instanceof \ElementTree\Text)
			{
				$output .= $component->toString();
			}
		};
		$elementTree->query($callback);
		$this->assertEquals('a header', $output);

		/**
		 * The `instanceof` in the previous example looks rather ugly. We can
		 * do away with it by using the inbuild filtering system. This creates
		 * a callback taking your callback as an argument, and filters the
		 * elements so you get only the one you actually need.
		 */
		$output = '';
		$callback = function(\ElementTree\Text $text) use (&$output)
		{
			$output .= $text->toString();
		};
		$filter = $elementTree->createFilter($callback);
		$elementTree->query($filter->allText());
		$this->assertEquals('a header', $output);

		/**
		 * There are a variety of filters available. You can also combine
		 * them. In the next example the filter combines two other filters
		 * (all text components and all components that have a parent element
		 * with the name 'h2').
		 */
		$h2 = $elementTree->createElement('h2');
		$h2->append($elementTree->createText('another header'));
		$elementTree->append($h2);

		$output = '';
		$callback = function(\ElementTree\Text $text) use (&$output)
		{
			$output .= $text->toString();
		};
		$filter = $elementTree->createFilter($callback);
		$elementTree->query(
			$filter->lAnd(
				$filter->allText(),
				$filter->hasParentElement('h2')
			)
		);
		$this->assertEquals('another header', $output);
	}
}