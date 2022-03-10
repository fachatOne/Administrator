<?php


    require_once 'include.php'; 
    $included = New Included();
   
    print $included->Database();
    print $included->Core();
    print $included->Noticer();

    // *source* //
    $db             = new Connect();
    $conn           = $db->DBConnect();  
    $CoModel        = New CoModel($conn);
    $CoController   = New CoController($CoModel);
    $RoView         = New RoView($CoController, $CoModel);
    $CnView         = New CnView($CoController, $CoModel);

    // *url* //
    $url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';
    if($url == '/' or $_SERVER['PATH_INFO'] == '/index' or $_SERVER['PATH_INFO'] == '/index.php')
    {
        $route = 'index';
    }else{
        $route = isset($_SERVER['PATH_INFO']) ? trim($_SERVER['PATH_INFO'],'/') : '/';
    }

    // *page* //
    if($url[0] == "admin"){
        $page = 'admin';
        $tmpfor = 'ad';
    }else{
        $page = 'publish';
        $tmpfor = 'pb';
    }


    // *route* //
    $RouterPage   = $CnView->contentFrom('RouterMn','RtrPath',$route)['RtrName'] ??= 'null';
    if($RouterPage == 'null'){
        $routes = "404";
        $RouterPage   = $CnView->contentFrom('RouterMn','RtrPath',$routes)['RtrName'];
    }

    $ContPage   = $CnView->contentWhere($RouterPage,'StsPq','1',null);
    $RoPage     = $CnView->contentFrom('RouterMn','RtrPath',$routes);
    $RoTemplate = $RoView->template($tmpfor)['TmpPath'];

    echo $route;

    $PtTopBar = __DIR__."/../views/_templates/$page/$RoTemplate/_partials/topbar.php";
    $PtHeader = __DIR__."/../views/_templates/$page/$RoTemplate/_partials/header.php";
    $PtFooter = __DIR__."/../views/_templates/$page/$RoTemplate/_partials/footer.php";
    $PtContent = __DIR__."/../views/_templates/$page/$RoTemplate/_pages/$route.php";
    include __DIR__.'/../views/_templates/'.$page.'/'.$RoTemplate.'/index.php';

?>