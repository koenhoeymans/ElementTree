<?php

namespace ElementTree;

interface Comment extends Component
{
    /**
     * The text of the comment.
     *
     * @return string
     */
    public function getValue() : string;

    /**
     * Sets the text of the comment.
     *
     * @param string $value
     */
    public function setValue(string $value) : void;
}
