<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_ElementTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function elementsHaveName()
	{
		$element = new \ElementTree\Element('a');

		$this->assertEquals('a', $element->getName());
	}

	/**
	 * @test
	 */
	public function elementsHaveAttributes()
	{
		$element = new \ElementTree\Element('a');
		$element->setAttribute('name', 'value');

		$this->assertEquals('value', $element->getAttributeValue('name'));		
	}

	/**
	 * @test
	 */
	public function elementsCanHaveElements()
	{
		$a = new \ElementTree\Element('a');
		$b = new \ElementTree\Element('b');
		$a->append($b);

		$this->assertEquals(array($b), $a->getChildren());
	}

	/**
	 * @test
	 */
	public function elementsCanHaveText()
	{
		$a = new \ElementTree\Element('a');
		$text = new \ElementTree\Text('text');
		$a->append($text);

		$this->assertEquals(array($text), $a->getChildren());
	}

	/**
	 * @test
	 */
	public function isParentOfAppended()
	{
		$parent = new \ElementTree\Element('parent');
		$child = new \ElementTree\Element('child');
		$parent->append($child);

		$this->assertEquals($parent, $child->getParent());
	}

	/**
	 * @test
	 */
	public function canAppendAfterComponent()
	{
		$a = new \ElementTree\Element('a');
		$b = new \ElementTree\Element('b');
		$c = new \ElementTree\Element('c');
		$d = new \ElementTree\Element('d');
		$a->append($b);
		$a->append($c);
		$a->append($d, $b);
		
		$this->assertEquals(array($b, $d, $c), $a->getChildren());
	}

	/**
	 * @test
	 */
	public function canRemoveChild()
	{
		$parent = new \ElementTree\Element('parent');
		$child = new \ElementTree\Element('child');
		$parent->append($child);
		$parent->remove($child);

		$this->assertEquals(array(), $parent->getChildren());
		$this->assertEquals(null, $child->getParent());
	}

	/**
	 * @test
	 */
	public function canReplaceChild()
	{
		$a = new \ElementTree\Element('a');
		$b = new \ElementTree\Element('b');
		$c = new \ElementTree\Element('c');
		$a->append($b);
		$a->replace($c, $b);

		$this->assertEquals(array($c), $a->getChildren());
	}

	/**
	 * @test
	 */
	public function wrapsChildXmlInOwnTags()
	{
		$a = new \ElementTree\Element('a');
		$b = new \ElementTree\Element('b');
		$a->append($b);

		$this->assertEquals('<a><b /></a>', $a->saveXmlStyle());
	}

	/**
	 * @test
	 */
	public function attributesAreInXmlStyleOutput()
	{
		$a = new \ElementTree\Element('a');
		$a->setAttribute('name', 'value');

		$this->assertEquals('<a name="value" />', $a->saveXmlStyle());
	}
}