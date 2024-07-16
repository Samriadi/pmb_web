<?php
require_once __DIR__ . '/../models/mainModel.php';


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
   
    public function logs()
    {

        $models = new mainModel();
        $data = $models->getLogs();

        include __DIR__ . '/../Views/others/page_activity.php';
    }

    public function help()
    {

        $page = isset($_GET['page']) ? $_GET['page'] : null;

        if ($page == null) {
            include __DIR__ . '/../Views/others/page_helps.php';
        } else {
            try {
                $models = new mainModel();
                $data = $models->getHelp($page);

                if ($data) {
                    $response = [
                        'recid' => $data->recid,
                        'page' => $data->page,
                        'konten' => $data->konten

                    ];
                } else {
                    $response = [
                        'recid' => null,
                        'page' => null,
                        'konten' => null,
                    ];
                }
                echo json_encode($response);
                exit;
            } catch (Exception $e) {
                echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
            }
        }
    }
    public function saveOrUpdateHelp()
    {
        $models = new mainModel();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $recid = $_POST['recid'];
            $page = $_POST['page'];
            $konten = $_POST['konten'];

            $models->saveOrUpdateHelp($recid, $page, $konten);

            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
        }
    }
    public function deleteHelp()
    {

        $id = isset($_GET['recid']) ? $_GET['recid'] : null;

        $models = new mainModel();

        $id = filter_var($id, FILTER_VALIDATE_INT);
        if ($id === false) {
            echo "Invalid ID";
            return;
        }

        $models->deleteHelp($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);

        exit();
    }

    public function showHelp()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : null;
        $models = new mainModel();
        $data = $models->showHelp($page);

        include __DIR__ . '/../Views/others/page_panduan.php';
    }

    public function testcard()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : null;

        if($page === 'web') {
            include __DIR__ . '/../Views/others/page_testCard.php';
        }
        else if($page === 'mobile') {
            include __DIR__. '/../Views/others/page_mobileTestCard.php';
        }
    }
}
