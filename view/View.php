<?php
Class View
{
    public function __construct()
    {
    }

    public function display($title, $path)
    {
        ob_start();
        include $path;
        $content = ob_get_clean();

        start_page($title);
        echo str_replace(['%username%'], ['Alex'], $content); //$_GET['username']
        end_page();
    }
}

