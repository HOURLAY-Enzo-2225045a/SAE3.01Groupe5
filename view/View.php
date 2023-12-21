<?php
Class View
{
    public function __construct()
    {
    }

    public function display($title, $path, $contentBD = null)
    {
        if(!file_exists($path))
            $path = 'view/404.php';
        ob_start();
        require $path;
        $content = ob_get_clean();
        $content = str_replace(['%username%','%contentBD'], ['alex',$contentBD], $content);//todo $_GET['username']

        echo str_replace(['%title%', '%content%','%contentBD%'], [$title, $content ,$contentBD], file_get_contents('view/layout.php'));
    }
}

