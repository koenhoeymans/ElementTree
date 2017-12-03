<?php

namespace ElementTree;

class ElementTreeText extends ElementTreeComponent implements Text, Appendable
{
    private $value;

    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    public function appendTo(Composable $composable) : void
    {
        $composable->append($this);
    }

    /**
     * @see \ElementTree\Text::getValue()
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @see \ElementTree\Text::setValue()
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @see \ElementTree\Component::toString()
     */
    public function toString()
    {
        return $this->value;
    }
}
