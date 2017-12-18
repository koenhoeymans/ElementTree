<?php

namespace ElementTree;

interface Component
{
    /**
     * Returns the ElemenTree that created the component. If there
     * is no such ElementTree, e.i. the component was created by
     * other ways, this will return `null`.
     */
    public function getOwnerTree() : ?ElementTree;

    /**
     * Returns the parent component of this component. Eg. when an element
     * was appended to another element the first element is the parent
     * of the other one. Or if a text component was added to an element
     * this element is the parent of the text component. If there is no
     * parent element this will return `null`.
     */
    public function getParent() : ?Component;

    /**
     * Will return `true` or `false` depending on whether the component
     * has a parent or not.
     */
    public function hasParent() : bool;

    /**
     * Will return `true` or `false` depending on whether the component
     * has children or not (components added to it).
     */
    public function hasChildren() : bool;

    /**
     * An array of the child components that were appended to the current
     * component.
     */
    public function getChildren() : array;

    /**
     * Will return the next child of the parent component or null if there
     * is none.
     */
    public function getNextSibling() : ?Component;

    /**
     * Will return the previous child of the parent component or null if there
     * is none.
     */
    public function getPreviousSibling() : ?Component;

    /**
     * Creates an XML-style string representation of the component
     * and its child components. Eg. if an ElementTree contains two
     * Elements named 'div' and 'hr', with the 'div' element containing
     * a text component, the  `toString` might return:
     *
     *     <div>div content</div><hr />
     */
    public function toString() : string;
}
