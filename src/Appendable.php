<?php

namespace ElementTree;

interface Appendable
{
    /**
     * Append object to a composable object.
     */
    public function appendTo(Composable $composable);
}
