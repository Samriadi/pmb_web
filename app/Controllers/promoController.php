<?php
class promoController
{
	public function index()
	{
        $models = new promoModel();
		$periodes = $models->getPeriode();
		$fakultass = $models->getFakultas();
		$promo = $models->getPromo();

		include __DIR__ . '/../Views/others/page_promo.php';
	}

    public function save(){

        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true); 

        if ($input) {
            $periode = $input['periode'];
            $gelombang = $input['gelombang'];
            $prodis = $input['prodiSelected']; 
            $promo = $input['promo'];
            $name = 'diskon';
        
            $models = new promoModel();

            foreach ($prodis as $prodi) {
                $models->insertOrUpdatePromo($periode, $gelombang, $prodi, $name, $promo);
               
            }
        
            http_response_code(200); // OK
            echo json_encode(array("message" => "Data berhasil disimpan."));
        } else {
            http_response_code(405); 
            echo json_encode(array("message" => "Metode yang diperbolehkan hanya POST."));
        }
    }

    public function delete(){

        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true); 

        if ($input) {
            $checkedValues = $input['checkedValues'];
        
            $models = new promoModel();

            foreach ($checkedValues as $xx) {
                $models->deletePromo($xx);
               
            }
        
            http_response_code(200); 
            echo json_encode(array("message" => "Data berhasil dihapus."));
        } else {
            http_response_code(405); 
        }
    }

}
