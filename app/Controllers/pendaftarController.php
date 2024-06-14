<?php
require_once __DIR__ . '/../models/pendaftarModel.php';


class pendaftarController
{
	public function index()
	{
		$models = new pendaftarModel();
		$data = $models->getPendaftar();

		include __DIR__ . '/../views/others/page_pendaftar.php';
	}


}
