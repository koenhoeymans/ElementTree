<?php

namespace ElementTree;

class ElementTreeComment extends ElementTreeComponent implements Comment, Appendable
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
     * @see \ElementTree\Comment::getValue()
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * @see \ElementTree\Comment::setValue()
     */
    public function setValue(string $value) : void
    {
        $this->value = $value;
    }

    /**
     * `<!-- comment -->`
     *
     * @see ElementTree\Component::toString()
     */
    public function toString()
    {
        return '<!--'.$this->value.'-->';
    }
}
