<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
interface ComponentFactory
{
    /**
     * @return \ElementTree\Element
     */
    public function createElement($name);

    /**
     * @return \ElementTree\Text
     */
    public function createText($value);

    /**
     * @return \ElementTree\Comment
     */
    public function createComment($value);
}
