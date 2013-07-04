<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
interface Queryable
{
	/**
	 * @return \ElementTree\Query
	 */
	public function createQuery();
}