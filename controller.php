<?php
require_once 'models.php';

class mainController {

	public function index() {		
        $models = new dataModel();
        $data = $models->getPeriode("S1");
		
		foreach ($data as $dt): 
			$jenjang = $dt->Jenjang;
			$periode = $dt->Periode;
		endforeach;
	
		include __DIR__ . "/page.php";
		// echo "tes";
    }

	public function hotNews() {
		$models = new dataModel();   
        $jurusan = $models->getJurusan();
		include __DIR__ . "page_jurusan.php";
    }

    public function invoice() {		
        $models = new dataModel();
        $data = $models->getInvoice(56);
		foreach ($data as $dt): 
			$nama_lengkap = $dt->NamaLengkap;
			$user_name = $dt->UserName;
			$nomor_va = $dt->nomor_va;
			$tagihan = $dt->jumlah_tagihan;
		endforeach;
	
		include __DIR__ . "/page_invoice.php";
		

    }
	public function testCard() {		
        $models = new dataModel();
        $data = $models->getSchedule(56);
		foreach ($data as $dt): 
			$nama_lengkap = $dt->NamaLengkap;
			$no_ujian = $dt->no_ujian;
			$jenjang = $dt->jenjang;
			$kategori = $dt->kategori;
			$foto_peserta = $dt->photo;
		
			//get data using array
			$nama_tes[] = $dt->nama_tes;
			$time = $dt->waktu;
			$waktu[] = date("H:i", strtotime($time)) . " WITA";
			$tempat[] = $dt->tempat;
			$keterangan[] = $dt->keterangan;
		
			//get hari dan tanggal tes
			$test_date = $dt->tanggal;
			$timestamp = strtotime($test_date);
			$dayOfWeekNumber = date("N", $timestamp);
			$daysInIndonesian = array(
				1 => "Senin",
				2 => "Selasa",
				3 => "Rabu",
				4 => "Kamis",
				5 => "Jumat",
				6 => "Sabtu",
				7 => "Minggu"
			);
			$dayOfWeekIndonesian = $daysInIndonesian[$dayOfWeekNumber];
		
			$formattedDate = date("d F Y", $timestamp);
			$monthsInEnglish = array(
				"January", 
				"February", 
				"March", 
				"April", 
				"May", 
				"June", 
				"July", 
				"August", 
				"September", 
				"October", 
				"November", 
				"December"
			);
			$monthsInIndonesian = array(
				"Januari", 
				"Februari", 
				"Maret", 
				"April", 
				"Mei", 
				"Juni", 
				"Juli", 
				"Agustus", 
				"September", 
				"Oktober", 
				"November", 
				"Desember"
			);
		
			$formattedDate = str_replace($monthsInEnglish, $monthsInIndonesian, $formattedDate);
		
			$hari_tes[] = $dayOfWeekIndonesian;
			$tanggal_tes[] = $formattedDate;
			
			//get pilihan prodi
			$varoption = $models->getVaroption($dt->PilihanPertama);
			foreach ($varoption as $var): 
				$pilihan_1 = $var->var_value;
				$parent = $var->parent;
			endforeach;
		
			$varoption = $models->getVaroption($dt->PilihanKedua);
			foreach ($varoption as $var): 
				$pilihan_2 = $var->var_value;
			endforeach;
		
			$varoption = $models->getVaroption($dt->PilihanKetiga);
			foreach ($varoption as $var): 
				$pilihan_3 = $var->var_value;
			endforeach;
		
			//get fakultas
			$varoption = $models->getVaroption($parent);
			foreach ($varoption as $var): 
				$fakultas = $var->var_value;
			endforeach;
		
		endforeach;
		
		$jadwal = array();
		for ($i = 0; $i < count($nama_tes); $i++) {
			$jadwal[] = array(
				"nama_tes" => $nama_tes[$i],
				"hari_tes" => $hari_tes[$i],
				"tanggal_tes" => $tanggal_tes[$i],
				"waktu_tes" => $waktu[$i],
				"tempat_tes" => $tempat[$i],
				"keterangan" => $keterangan[$i],
			);
		}
	
		include __DIR__ . "/page_kartu_ujian.php";
		
    }
}
    


?>