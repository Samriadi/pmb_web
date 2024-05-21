<?php
require_once __DIR__ . '/../models/eduTestModel.php';


class eduTestController {
	public function index() {
		$models = new eduTestModel();   
        $data = $models->getTest();

		foreach ($data as $dt): 
			$id = $dt->id;
			$gelombang = $dt->gelombang;
			$ruang = $dt->ruang;
			$jenis_ujian = $dt->jenis_ujian;
			$tgl_ujian = $dt->tgl_ujian;
			$jam_mulai = $dt->jam_mulai;
			$jam_selesai = $dt->jam_selesai;
			$keterangan = $dt->keterangan;
		endforeach;

		include __DIR__ . '/../views/page_jadwalTest/index.php';
    }
}
