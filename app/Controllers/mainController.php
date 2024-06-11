<?php
require_once __DIR__ . '/../models/mainModel.php';

$_SESSION['user_id'] = 4;

class mainController
{

    public function dashboard()
    {
        $models = new mainModel();
        $test = $models->getCountTest();
        $var = $models->getCountVar();
        $users = $models->getCountUser();
        $periode = $models->getCountPeriod();
        include __DIR__ . '/../Views/others/page_dashboard.php';
    }
    public function logs() {

        $models = new mainModel();
        $data = $models->getLogs();
    
        include __DIR__ . '/../views/others/page_activity.php';
    
        }
}
