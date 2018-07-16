<?php

namespace ElementTree;

class Attribute extends Component
{
    private const NO_QUOTES = '';

    private const SINGLE_QUOTES = "'";

    private const DOUBLE_QUOTES = '"';

    private $name;

    private $value;

    private $quoteStyle = self::DOUBLE_QUOTES;

    public function __construct(string $name, string $value)
    {
        $this->name = $name;
        $this->value = $value;
    }

    /**
     * Returns the name by which the attribute is set.
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Returns the value of the attribute.
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * Set a new value for the attribute.
     */
    public function setValue(string $value)
    {
        $this->value = $value;
    }

    /**
     * The `Attribute::noQuotes`, `Attribute::singleQuotes` and
     * `Attribute::doubleQuotes` methods set how the value of the attribute
     * will be represented as a string. The value is either not quoted,
     * contained withing single or double quotes.
     * 
     * The quote style needs to be set for every attribute.
     * 
     * Double quotes is the default.
     * 
     * E.g. `id="top-menu"`
     */
    public function noQuotes() : void
    {
        $this->quoteStyle = self::NO_QUOTES;
    }

    /**
     * The `Attribute::noQuotes`, `Attribute::singleQuotes` and
     * `Attribute::doubleQuotes` methods set how the value of the attribute
     * will be represented as a string. The value is either not quoted,
     * contained withing single or double quotes.
     * 
     * The quote style needs to be set for every attribute.
     * 
     * Double quotes is the default.
     * 
     * E.g. `id="top-menu"`
     */
    public function singleQuotes() : void
    {
        $this->quoteStyle = self::SINGLE_QUOTES;
    }

    /**
     * The `Attribute::noQuotes`, `Attribute::singleQuotes` and
     * `Attribute::doubleQuotes` methods set how the value of the attribute
     * will be represented as a string. The value is either not quoted,
     * contained withing single or double quotes.
     * 
     * The quote style needs to be set for every attribute.
     * 
     * Double quotes is the default.
     * 
     * E.g. `id="top-menu"`
     */
    public function doubleQuotes() : void
    {
        $this->quoteStyle = self::DOUBLE_QUOTES;
    }

    /**
     * The string representation depends on the value of the methods that set
     * the quote style. By default the value is written within double quotes.
     * 
     * Example:
     * 
     *     class="footer"
     */
    public function toString() : string
    {
        return $this->name . '=' . $this->quoteStyle . $this->value . $this->quoteStyle;
    }
}
