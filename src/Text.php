<?php

namespace ElementTree;

class Text extends Component implements Appendable
{
    private $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    public function appendTo(Composable $composable) : void
    {
        $composable->append($this);
    }

    /**
     * @see \ElementTree\Text::getValue()
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * @see \ElementTree\Text::setValue()
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
