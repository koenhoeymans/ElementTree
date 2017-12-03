<?php

namespace ElementTree;

class ElementTreeComment extends ElementTreeComponent implements Comment, Appendable
{
    private $value;

    public function __construct($value)
    {
        $this->value = (string) $value;
    }

    public function appendTo(Composable $composable)
    {
        $composable->append($this);
    }

    /**
     * @see \ElementTree\Comment::getValue()
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @see \ElementTree\Comment::setValue()
     */
    public function setValue($value)
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
