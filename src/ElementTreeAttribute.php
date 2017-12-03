<?php

namespace ElementTree;

class ElementTreeAttribute extends ElementTreeComponent implements Attribute
{
    const NO_QUOTES = '';

    const SINGLE_QUOTES = "'";

    const DOUBLE_QUOTES = '"';

    private $name;

    private $value;

    private $quoteStyle = self::DOUBLE_QUOTES;

    public function __construct($name, $value)
    {
        $this->name = (string) $name;
        $this->value = (string) $value;
    }

    /**
     * @see \ElementTree\Attribute::getName()
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @see \ElementTree\Attribute::getValue()
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * @see \ElementTree\Attribute::setValue()
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * @see \ElementTree\Attribute::noQuotes()
     */
    public function noQuotes() : void
    {
        $this->quoteStyle = self::NO_QUOTES;
    }

    public function singleQuotes()
    {
        $this->quoteStyle = self::SINGLE_QUOTES;
    }

    public function doubleQuotes()
    {
        $this->quoteStyle = self::DOUBLE_QUOTES;
    }

    /**
     * `name="value"`
     *
     * @see ElementTree\Component::toString()
     */
    public function toString()
    {
        return $this->name.'='.$this->quoteStyle.$this->value.$this->quoteStyle;
    }
}
