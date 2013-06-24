<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestHelper.php';

class ElementTree_ElementTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @test
	 */
	public function elementsHaveName()
	{
		$element = new \ElementTree\ElementTreeElement('a');

		$this->assertEquals('a', $element->getName());
	}

	/**
	 * @test
	 */
	public function elementsCanHaveAttributes()
	{
		$element = new \ElementTree\ElementTreeElement('a');
		$attr = $element->setAttribute('name', 'value');

		$this->assertEquals('value', $element->getAttributeValue('name'));
		$this->assertTrue($attr instanceof \ElementTree\Attribute);		
	}

	/**
	 * @test
	 */
	public function elementsCanHaveElements()
	{
		$a = new \ElementTree\ElementTreeElement('a');
		$b = new \ElementTree\ElementTreeElement('b');
		$a->append($b);

		$this->assertEquals(array($b), $a->getChildren());
	}

	/**
	 * @test
	 */
	public function elementsCanHaveText()
	{
		$a = new \ElementTree\ElementTreeElement('a');
		$text = new \ElementTree\ElementTreeText('text');
		$a->append($text);

		$this->assertEquals(array($text), $a->getChildren());
	}

	/**
	 * @test
	 */
	public function isParentOfAppendedElement()
	{
		$parent = new \ElementTree\ElementTreeElement('parent');
		$child = new \ElementTree\ElementTreeElement('child');
		$parent->append($child);

		$this->assertEquals($parent, $child->getParent());
	}

	/**
	 * @test
	 */
	public function isParentOfAttribute()
	{
		$parent = new \ElementTree\ElementTreeElement('parent');
		$attr = $parent->setAttribute('child', 'true');

		$this->assertEquals($parent, $attr->getParent());
	}

	/**
	 * @test
	 */
	public function setsOwnerTreeOfAttribute()
	{
		$parent = new \ElementTree\ElementTreeElement('parent');
		$attr = $parent->setAttribute('child', 'true');

		$this->assertEquals($parent, $attr->getOwnerTree());
		
	}

	/**
	 * @test
	 */
	public function canAppendAfterComponent()
	{
		$a = new \ElementTree\ElementTreeElement('a');
		$b = new \ElementTree\ElementTreeElement('b');
		$c = new \ElementTree\ElementTreeElement('c');
		$d = new \ElementTree\ElementTreeElement('d');
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
		$parent = new \ElementTree\ElementTreeElement('parent');
		$child = new \ElementTree\ElementTreeElement('child');
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
		$a = new \ElementTree\ElementTreeElement('a');
		$b = new \ElementTree\ElementTreeElement('b');
		$c = new \ElementTree\ElementTreeElement('c');
		$a->append($b);
		$a->replace($c, $b);

		$this->assertEquals(array($c), $a->getChildren());
	}

	/**
	 * @test
	 */
	public function wrapsChildXmlInOwnTags()
	{
		$a = new \ElementTree\ElementTreeElement('a');
		$b = new \ElementTree\ElementTreeElement('b');
		$a->append($b);

		$this->assertEquals('<a><b /></a>', $a->toString());
	}

	/**
	 * @test
	 */
	public function attributesAreInXmlStyleOutput()
	{
		$a = new \ElementTree\ElementTreeElement('a');
		$a->setAttribute('name', 'value');

		$this->assertEquals('<a name="value" />', $a->toString());
	}
}