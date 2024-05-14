<?php
require_once 'database.php';

class dataModel {
    public function getPeriode() {
		$db = Database::getInstance();
		
        $query = "SELECT * FROM edu_periode";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getTagihan() {
		$db = Database::getInstance();
		
        $query = "SELECT * FROM tagihan";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }	
    public function getJurusan() {
		$db = Database::getInstance();
		
        $query = "SELECT * FROM TabelJurusan";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getPendaftaran() {
		$db = Database::getInstance();
		
        $query = "SELECT * FROM pendaftaranmahasiswa";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getInvoice($id_pendaftaran) {
		$db = Database::getInstance();
		
        $query = "SELECT 
        PendaftaranMahasiswa.*, tagihan.jenjang, tagihan.periode, tagihan.nomor_va, 
        tagihan.jumlah_tagihan, tagihan.invoice_id, tagihan.pay_status, tagihan.pay_date, 
        tagihan.kategori, tagihan.jenis, tagihan.test_date, tagihan.kelulusan, 
        CAST(tagihan.registration_date AS DATE) 
        AS registration_date, tagihan.verified, 
        tagihan.no_ujian, tagihan.PilihanPertama, tagihan.PilihanKedua, tagihan.PilihanKetiga 
        FROM 
        PendaftaranMahasiswa 
        JOIN 
        tagihan ON PendaftaranMahasiswa.ID = tagihan.member_id 
        WHERE 
        PendaftaranMahasiswa.ID = ?
        ORDER BY 
        tagihan.ID 
        DESC LIMIT 1";
    ;
        $stmt = $db->prepare($query);
        $stmt->execute([$id_pendaftaran]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getVaroption($recid) {
		$db = Database::getInstance();
		
        $query = "SELECT * FROM varoption WHERE recid = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$recid]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getCard($member_id) {
        $db = Database::getInstance();

        $query = "SELECT tagihan.*, varoption.*, pendaftaranmahasiswa.ID, pendaftaranmahasiswa.NamaLengkap, pendaftaranmahasiswa.photo 
        FROM tagihan 
        JOIN pendaftaranmahasiswa 
        ON tagihan.member_id = pendaftaranmahasiswa.ID 
        JOIN varoption 
        WHERE tagihan.member_id = ? 
        ORDER BY tagihan.member_id DESC LIMIT 1";

        $stmt = $db->prepare($query);
        $stmt->execute([$member_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getSchedule($member_id){
        $db = Database::getInstance();

        $query = "SELECT 
        jadwal_tes.*, tagihan.*, pendaftaranmahasiswa.ID, pendaftaranmahasiswa.NamaLengkap, pendaftaranmahasiswa.photo 
        FROM jadwal_tes 
        JOIN tagihan
        ON jadwal_tes.member_id = tagihan.member_id
        JOIN pendaftaranmahasiswa
        ON jadwal_tes.member_id= pendaftaranmahasiswa.ID
        WHERE jadwal_tes.member_id = ?
        ORDER BY jadwal_tes.tanggal";

        $stmt = $db->prepare($query);
        $stmt->execute([$member_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);

    }

    public function getBukti($member_id) {
		$db = Database::getInstance();
		
        $query = "SELECT * FROM upload WHERE member_id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$member_id]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }	
}

 

?>