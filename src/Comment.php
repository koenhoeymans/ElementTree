<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
interface Comment extends Component
{
    /**
     * The text of the comment.
     *
     * @return string
     */
    public function getValue();

    /**
     * Sets the text of the comment.
     *
     * @param string $value
     */
    public function setValue($value);
}
