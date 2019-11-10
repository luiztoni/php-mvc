<?php

namespace Demo\PhpMvc\Controllers;

abstract class Controller
{
    private $pathToView;
    private $pathToImage;

    public function __construct()
    {
        $this->pathToView = $_SERVER['DOCUMENT_ROOT'].'/src/Demo/PhpMvc/views';
        $this->pathToImage = $_SERVER['DOCUMENT_ROOT'].'/resources/images';
    }

    protected function getViewPath(string $view)
    {
        return $this->pathToView.'/'.$view;
    }

    protected function getImagePath(string $image)
    {
        return $this->pathToImage.'/'.$image;
    }
}
