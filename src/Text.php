<?php

namespace ElementTree;

interface Text extends Component
{
    /**
     * Returns the value, e.i. the content.
     *
     * @return string
     */
    public function getValue();

    /**
     * Sets the value, e.i. the content.
     *
     * @param string $value
     */
    public function setValue($value);
}
