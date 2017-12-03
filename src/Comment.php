<?php

namespace ElementTree;

interface Comment extends Component
{
    /**
     * The text of the comment.
     */
    public function getValue() : string;

    /**
     * Sets the text of the comment.
     */
    public function setValue(string $value) : void;
}
