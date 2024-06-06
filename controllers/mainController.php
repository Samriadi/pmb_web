<?php
require_once __DIR__ . '/../models/mainModel.php';

session_start();
$_SESSION['user_id'] = 4;

class mainController {

	public function dashboard() {
        $models = new mainModel();   
        $test = $models->getCountTest();
        $var = $models->getCountVar();
        $users = $models->getCountUser();
        $periode = $models->getCountPeriod();
	include __DIR__ . '/../views/pages/page_dashboard/index.php';

  }
  
  public function testCard() {
   
  include __DIR__ . '/../views/pages/page_item/testCard.php';

  }

  public function logs() {
   
    $models = new mainModel();
    $data = $models->getLogs();

    include __DIR__ . '/../views/pages/page_activity/index.php';
  
    }

    
}
   
	
	