<?php
$home = '/home/'.get_current_user();

$f3 = require($home.'/AboveWebRoot/fatfree-master/lib/base.php');

// autoload Controller class(es) and anything hidden above web root, e.g. DB stuff
$f3->set('AUTOLOAD','autoload/;'.$home.'/AboveWebRoot/autoload/');

$db = DatabaseConnection::connect(); // defined as autoloaded class in AboveWebRoot/autoload/
$f3->set('DB', $db);

$f3->set('DEBUG',3);		// set maximum debug level
//=======================================================================
// URL

$f3->route('GET /',
    function($f3)
    {
        $str = array(
            'message'=>'Get data!'
        );
        echo json_encode($str);
    }
);

$f3->route('GET /volcano/@type',
    function($f3, $params)
    {
        $controller = new Controller('volcano');
        $data = $controller->getVolcanoByType($params['type']);
        echo json_encode($data);
    }
);

$f3->route('PUT /volcano/like/@v_id',
    function($f3, $params)
    {
        $controller = new Controller('volcano');
        $data = $controller->likeVolcano($params['v_id']);
        echo json_encode($data);
    }
);

$f3->route('PUT /volcano/dislike/@v_id',
    function($f3, $params)
    {
        $controller = new Controller('volcano');
        $data = $controller->dislikeVolcano($params['v_id']);
        echo json_encode($data);
    }
);

$f3->route('GET /volcano/learnmore',
    function($f3)
    {
        $controller = new Controller('learnmore');
        $data = $controller->getGraphs();
        echo json_encode($data);
    }
);

//====================================================================
// Run the FFF engine //
$f3->run();