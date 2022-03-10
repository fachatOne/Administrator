<?php 
    class Noticer
    {
        function __construct()
        {
        }

        public function note404()
        {
            header('HTTP/1.1 404 Not Found');
            die('404 - The address <b>'.$_SERVER['PATH_INFO'].'</b> you request is not found');
        }
    }
?>