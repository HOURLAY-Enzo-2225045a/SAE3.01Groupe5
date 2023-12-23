<?php
Class View
{
    public function __construct()
    {
    }

    public function display($title, $path, $data = null)
    {
        if(!file_exists($path))
            $path = 'view/404.php';
        extract(array('data' => $data));
        ob_start();
        require $path;
        $content = ob_get_clean();
        $content = str_replace(['%username%'], ['alex'], $content);//todo $_GET['username']

        echo str_replace(['%title%', '%content%'], [$title, $content], file_get_contents('view/layout.php'));
    }
}

