<?php

namespace ElementTree;

interface Appendable
{
    /**
     * Append object to a composable object.
     *
     * @param Composable $composable
     */
    public function appendTo(Composable $composable);
}
