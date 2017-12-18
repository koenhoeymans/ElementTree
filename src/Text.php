<?php

namespace ElementTree;

interface Text extends Component
{
    /**
     * Returns the value, e.i. the content.
     */
    public function getValue() : string;

    /**
     * Sets the value, e.i. the content.
     */
    public function setValue(string $value) : void;
}
