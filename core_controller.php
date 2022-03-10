<?php
    class CoController
    {
        private $model;
        function __construct($model)
        {
            $db            = new Connect();
            $conn          = $db->DBConnect();

            $this->model   = $model;
            $this->CoModel = new CoModel($conn);
        }
        public function readFrom($table,$field,$id)
        {
            return $this->CoModel->readWhere($table,$field,$id,null)->fetch(\PDO::FETCH_ASSOC);
        }
        public function readWhere($table,$field,$id,$data)
        {
            $fields = $this->CoModel->field("$table")->fetchAll();
            foreach($fields as $rowss)
            {
                $rows[] = $rowss['Field'];
            }

            $results = $this->CoModel->readWhere($table,$field,$id,$data)->fetchAll();
            foreach($results as $row)
            {
                for ($i = 0; $i < count($rows); $i++)
                {
                    $show[] = $row[$rows[$i]] . "\n";
                }
                //$show[] = $row['HpTitle']."|".$row['HpContent'];
            }
            return $show;
        }

    }

    class ToController
    {
        private $model;
        function __construct($model)
        {
            $db            = new Connect();
            $conn          = $db->DBConnect();

            $this->model   = $model;
            $this->CoModel = new CoModel($conn);
        }
        public function pagination($table,$pageno)
        {

            $no_of_records_per_page = 6;
            $offset                 = ($pageno-1) * $no_of_records_per_page;
            $total_pages_sql        = $this->CoModel->count("$table")->fetchColumn();
            $total_pages            = ceil($total_pages_sql / $no_of_records_per_page);
            $data                   = $offset."@|@".$no_of_records_per_page."@|@".$total_pages."@|@".$total_pages_sql;
            return $data;
        }
    }


    // hash
    
    class CoControllers
    {
        private $model;
        function __construct($model)
        {
            $this->model    = $model;
        }

        public function Core($id)
        {
            $db     = new Connect();
            $conn   = $db->DBConnect();

            $crud = new CoModel($conn);

            $field = $crud->FieldTable("$id")->fetchAll();
            foreach($field as $rowss)
            {
                $rows[] = $rowss['Field'];
            }

            $results = $crud->selectWhole("$id")->fetchAll();
            foreach($results as $row)
            {
                for ($i = 0; $i < count($rows); $i++)
                {
                    $show[] = $row[$rows[$i]] . "\n";
                }
                //$show[] = $row['HpTitle']."|".$row['HpContent'];
            }
            return $show;
        }
    }
    class IndexController
    {
        private $model;

        function __construct($model)
        {
            $this->model    = $model;
        }
        
        public function sayWelcome()
        {
            $db     = new Connect();
            $conn   = $db->DBConnect();
            
            $crud = new IndexModel($conn);
            $results = $crud->selectAll('HomepageMn')->fetchAll();
            foreach($results as $row)
            {
                $show[] = $row['HpTitle']."|".$row['HpContent'];
            }
            return $show;

        }
        public function takeAction()
        {
            return $this->model->contentData();
        }
    }
    class AboutController
    {
        private $model;

        function __construct($model)
        {
            $this->model = $model;
        }

        public function nowADays()
        {
            return $this->model->nows();
        }

        public function currentDays()
        {
            return $this->model->today();
        }
     }
?>