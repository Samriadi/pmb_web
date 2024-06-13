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

        include __DIR__ . '/../views/others/page_activity.php';
    }

    public function help()
    {
        include __DIR__ . '/../views/others/page_helps.php';
    }

    public function getHelp()
    {
        $page = isset($_GET['page']) ? $_GET['page'] : null;

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
                    'error' => 'Data not found'
                ];
            }
            echo json_encode($response);
            exit;
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
