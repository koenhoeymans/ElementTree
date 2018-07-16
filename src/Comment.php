<?php

namespace ElementTree;

class Comment extends Component implements Appendable
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Append this `Comment` to a `Composable` object.
     */
    public function appendTo(Composable $composable) : void
    {
        $composable->append($this);
    }

    /**
     * Get content value of the `Comment`.
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * Set the content value of the `Comment`.
     */
    public function setValue(string $value) : void
    {
        $this->value = $value;
    }

    /**
     * Produces a string representation of the `Comment`.
     * 
     * Example:
     * 
     *     <!-- comment -->
     */
    public function toString() : string
    {
        return '<!--' . $this->value . '-->';
    }
}
