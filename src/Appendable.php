<?php

namespace ElementTree;

interface Appendable
{
    /**
     * Append object to a `Composable` `Component`. The appended `Component`
     * will become a child of the parent `Component`.
     */
    public function appendTo(Composable $composable): void;
}
