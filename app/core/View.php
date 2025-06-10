<?php

namespace App\Core;

class View
{
    
    public $data;
    //public string $content;
    public function render($page_name = '', $data = [], $layout_name = 'default')
    {
        $this->data = extract($data);
        $page = PAGES . "/$page_name.page.php";
        if (file_exists($page)) {
            ob_start();
            require $page;
            $content = ob_get_clean();
        }

        $layout = VIEWS . "/$layout_name.layout.php";
        if (file_exists($layout)) {
            require_once $layout;
        } else {
            $layout = VIEWS ."/default.layout.php";
            require_once $layout;
        }
    }
}