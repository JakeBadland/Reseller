<?php

class libRenderer {

    public function render($view, $data)
    {
        $view = str_replace('\\', DS, $view);

        $viewsDir = Config::get('settings', 'views');

        $viewFile = ROOT . DS . $viewsDir . DS . $view . '.php';
        $layoutFile = ROOT . DS . $viewsDir . DS .  'Layouts' .DS. 'main.php';

        if (!is_file($viewFile)){
            die("View file: $viewFile not found!");
        }

        extract($data);

        ob_start();
        include $viewFile;
        $content = ob_get_clean();

        if (!is_file($layoutFile)){
            echo $content;
        } else {
            ob_start();
            include $layoutFile;
            $layout = ob_get_clean();
            echo $layout;
        }

        die;
    }

}