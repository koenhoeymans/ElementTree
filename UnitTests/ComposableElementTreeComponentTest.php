<?php

require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'TestHelper.php';

class ComposableImp extends \ElementTree\ComposableElementTreeComponent
{
	public function toString() {}
}

class ElementTree_ComposableElementTreeComponentTest extends PHPUnit_Framework_TestCase
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

		$this->assertSame($div, $h1->getPreviousSibling());
	}
}