<?php 

    class Included
    {
        public function Database()
        {
            require_once 'database.php';
        }
    
        public function Core()
        {
            require_once __DIR__.'/../controllers/core_controller.php';
            require_once __DIR__.'/../models/core_model.php';
            require_once __DIR__.'/../views/core_view.php';
        }
        public function Variable()
        {
            include_once __DIR__.'/../attribs/variable.php';
        }
        public function Noticer()
        {
            require_once 'noticer.php';
        }
    }
?>