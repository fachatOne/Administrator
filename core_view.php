<?php
    // *app* //
    class RoView
    {
        private $model;
        private $controller;

        function __construct($controller, $model)
        {
            $this->controller = $controller;
            $this->model = $model;
        }

        public function template($tmpfor)
        {
            return $this->controller->readFrom('TemplateMn','TmpFor',$tmpfor);
        }
        public function company()
        {
            return $this->controller->readFrom('CompanyMn','StsPq','1');
        }
        public function socmed(){
            return $this->controller->readWhere('SocmedMn','StsPq','1',null);
        }
        public function menuTop(){
            return $this->controller->readWhere('MenuMn','StsPq','1',null);
        }
    }
    class CnView
    {
        private $model;
        private $controller;

        function __construct($controller, $model)
        {
            $this->controller = $controller;
            $this->model = $model;
        }

        public function contentFrom($table,$field,$id)
        {
            return $this->controller->readFrom($table,$field,$id);
        }
        public function contentWhere($table,$field,$id,$data){
            return $this->controller->readWhere($table,$field,$id,$data);
        }
    }
    class PgView
    {
        private $model;
        private $controller;

        function __construct($controller, $model)
        {
            $this->controller = $controller;
            $this->model = $model;
        }

        public function pageFrom($table,$field,$id,$data){
            return $this->controller->readFrom($table,$field,$id,$data);
        }
    }
?>