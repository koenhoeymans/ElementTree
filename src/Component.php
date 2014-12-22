<?php

/**
 * @package ElementTree
 */
namespace ElementTree;

/**
 * @package ElementTree
 */
interface Component
{
    /**
     * Returns the ElemenTree that created the component. If there
     * is no such ElementTree, e.i. the component was created by
     * other ways, this will return `null`.
     *
     * @return \ElementTree\ElementTree|null
     */
    public function getOwnerTree();

    /**
     * Returns the parent component of this component. Eg. when an element
     * was appended to another element the first element is the parent
     * of the other one. Or if a text component was added to an element
     * this element is the parent of the text component. If there is no
     * parent element this will return `null`.
     *
     * @return \ElementTree\Component|null
     */
    public function getParent();

    /**
     * Will return `true` or `false` depending on whether the component
     * has a parent or not.
     *
     * @return boolean
     */
    public function hasParent();

    /**
     * Will return `true` or `false` depending on whether the component
     * has children or not (components added to it).
     *
     * @return boolean
     */
    public function hasChildren();

    /**
     * An array of the child components that were appended to the current
     * component.
     *
     * @return array
     */
    public function getChildren();

    /**
     * Will return the next child of the parent component or null if there
     * is none.
     *
     * @return \ElementTree\Component|null
     */
    public function getNextSibling();

    /**
     * Will return the previous child of the parent component or null if there
     * is none.
     *
     * @return \ElementTree\Component|null
     */
    public function getPreviousSibling();

    /**
     * Creates an XML-style string representation of the component
     * and its child components. Eg. if an ElementTree contains two
     * Elements named 'div' and 'hr', with the 'div' element containing
     * a text component, the  `toString` might return:
     *
     *     <div>div content</div><hr />
     *
     * Support for other output formats might be added later.
     */
    public function toString();
}
