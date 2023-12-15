<?php
Class View
{
    public function __construct()
    {
    }

    public function display($title, $path, $contentBD = null)
    {
        ob_start();
        require $path;
        $content = ob_get_clean();
        start_page($title);
        echo str_replace(['%username%', '%contentBD%'], ['Alex', $contentBD], $content); //todo $_GET['username']
        end_page();
    }
}

