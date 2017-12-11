ElementTree
===========

ElementTree is a PHP library for handling a tree of components which can be
manipulated, searched and represented as a string. It resembles working with
XML. However, this library was developed to solve a particular need I couldn't
solve with the standard XML solutions in PHP. Therefore it does some things
different from what one should and would expect from such a thing:

* Not nearly as feature-rich.
* Does not interfere with entities.
* No single root element necessary.
* Output attribute values between single or double quotes.
* No security checks.
* ...


Documentation can be found in the form of [this](https://github.com/koenhoeymans/ElementTree/blob/master/tests/e2e/DocumentationTest.php)
end-to-end test.

Installation can be done with [composer](http://getcomposer.org/). 