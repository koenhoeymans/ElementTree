<?php

namespace ElementTree;

class Text extends Component implements Appendable
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * @see \ElementTree\Appendable::appendTo();
     */
    public function appendTo(Composable $composable) : void
    {
        $composable->append($this);
    }

    /**
     * Get the text of the `Text` component.
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * Set the textual value.
     */
    public function setValue(string $value) : void
    {
        $this->value = $value;
    }

    /**
     * @see \ElementTree\Component::toString()
     */
    public function toString() : string
    {
        return $this->value;
    }
}
