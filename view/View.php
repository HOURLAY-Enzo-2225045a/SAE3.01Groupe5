<?php


Class View
{
    public function __construct()
    {
    }

    public function display($title, $path)
    {
        start_page($title);
        $page = file_get_contents($path);
        echo str_replace(['%username%', "%content%"], ['Alex', $presenter->show("joueurs")], $page); //$_GET['username']
        end_page();

    }
}
