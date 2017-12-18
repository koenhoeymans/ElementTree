<?php

namespace ElementTree;

interface Composable
{
    /**
     * Appends an appendable component as a (last) child.
     */
    public function append(Appendable $component) : void;

    /**
     * Inserts an appendable component as a child after another component.
     */
    public function insertAfter(Appendable $component, Appendable $after) : void;

    /**
     * Inserts an appendable component as a child before another component.
     */
    public function insertBefore(Appendable $component, Appendable $before) : void;

    /**
     * Removes a subcomponent.
     */
    public function remove(Appendable $component) : void;

    /**
     * Replaces a subcomponent by another one.
     */
    public function replace(Appendable $newComponent, Appendable $oldComponent) : void;
}
