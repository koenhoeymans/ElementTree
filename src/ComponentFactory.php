<?php

namespace ElementTree;

interface ComponentFactory
{
    public function createElement($name) : Element;

    public function createText($value) : Text;

    public function createComment($value) : Comment;
}
