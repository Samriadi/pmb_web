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

    public function uploadBukti($file, $member_id) {
        $targetDir = "asset/";
        $uniqueName = uniqid() . '_' . basename($file["name"]);
        $targetFile = $targetDir . $uniqueName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        if ($file["size"] > 500000) {
            echo "Maaf, file terlalu besar.";
            $uploadOk = 0;
        }

        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            echo "Maaf, file Anda tidak dapat diupload.";
        } else {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $db = Database::getInstance();

                $query = "SELECT file_path FROM upload WHERE member_id = ?";
                $stmt = $db->prepare($query);
                $stmt->execute([$member_id]);
                $existingFile = $stmt->fetch(PDO::FETCH_OBJ);

                if ($existingFile) {
                    if (file_exists($existingFile->file_path)) {
                        unlink($existingFile->file_path);
                    }

                    $query = "UPDATE upload SET file_path = ? WHERE member_id = ?";
                    $stmt = $db->prepare($query);
                    if ($stmt->execute([$targetFile, $member_id])) {
                        echo "File ". basename($file["name"]). " telah diupload dan informasi diperbarui di database.";
                        return $targetFile; 
                    } else {
                        echo "Maaf, terjadi kesalahan saat memperbarui informasi file di database.";
                    }
                } else {
                    
                    $query = "INSERT INTO upload (member_id, file_path) VALUES (?, ?)";
                    $stmt = $db->prepare($query);
                    if ($stmt->execute([$member_id, $targetFile])) {
                        echo "File ". basename($file["name"]). " telah diupload dan informasi disimpan di database.";
                        return $targetFile;
                    } else {
                        echo "Maaf, terjadi kesalahan saat menyimpan informasi file ke database.";
                    }
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengupload file Anda.";
            }
        }

        return false;
    }
    
    public function getVar() {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

   public function addVar($recid, $varname, $varvalue, $varothers, $catatan, $parent) {
		$db = Database::getInstance();

        $query = "INSERT INTO var_option (recid, var_name, var_value, var_others, catatan, parent) VALUES (?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$recid, $varname, $varvalue, $varothers, $catatan, $parent]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteVar($recid) {
        $db = Database::getInstance();

        $query = "DELETE FROM var_option WHERE recid = ?";

        try {
        $stmt = $db->prepare($query);
        $stmt->execute([$recid]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

     public function getVarById($recid) {
        $db = Database::getInstance();
        $stmt = $db->prepare("SELECT * FROM var_option WHERE recid = ?");
        $stmt->execute([$recid]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updateVar($recid, $varname, $varvalue, $varothers, $catatan, $parent) {
        $db = Database::getInstance();

        $stmt = $db->prepare("UPDATE var_option SET var_name = ?, var_value = ?, var_others = ?, catatan = ?, parent = ? WHERE recid = ?");
        $stmt->execute([$varname, $varvalue, $varothers, $catatan, $parent, $recid]);
    }

    //jadwal test	
    public function getTest() {
		$db = Database::getInstance();
        $query = "SELECT * FROM edu_test";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function addTest($gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangn) {
		$db = Database::getInstance();

        $query = "INSERT INTO edu_test (gelombang, ruang, jenis_ujian, tgl_ujian, jam_mulai, jam_selesai, keterangan) VALUES (?, ?, ?, ?, ?, ?, ?)";

        try {
            $stmt = $db->prepare($query);
            $stmt->execute([$gelombang, $ruang, $jenis_ujian, $tgl_ujian, $jam_mulai, $jam_selesai, $keterangn]);
        } 
        catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //get gelombang
    public function getGelombang() {
		$db = Database::getInstance();
        $query = "SELECT * FROM edu_periode WHERE status='Open'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    //get ruang
    public function getRuang() {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option where var_name='Ruang'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

     //get jenis ujian
     public function getUjian() {
		$db = Database::getInstance();
        $query = "SELECT * FROM var_option where var_name='Ujian'";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function showGelombang($recid){
		$db = Database::getInstance();
        $query = "SELECT Jenjang, Keterangan FROM edu_periode where recid = :recid";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':recid', $recid);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function showRuang($recid){
		$db = Database::getInstance();
        $query = "SELECT var_value FROM var_option where var_name='Ruang' AND  recid = :recid";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':recid', $recid);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function showUjian($recid){
		$db = Database::getInstance();
        $query = "SELECT var_value FROM var_option where var_name='Ujian' AND  recid = :recid";

        $stmt = $db->prepare($query);
        $stmt->bindParam(':recid', $recid);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}

?>