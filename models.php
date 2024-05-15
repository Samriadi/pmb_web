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
        // Folder tujuan untuk menyimpan gambar yang diunggah
        $targetDir = "asset/";
        $uniqueName = uniqid() . '_' . basename($file["name"]);
        $targetFile = $targetDir . $uniqueName;
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Memeriksa apakah file adalah gambar asli
        $check = getimagesize($file["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File bukan gambar.";
            $uploadOk = 0;
        }

        // Memeriksa ukuran file
        if ($file["size"] > 500000) {
            echo "Maaf, file terlalu besar.";
            $uploadOk = 0;
        }

        // Memeriksa format file
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {
            echo "Maaf, hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.";
            $uploadOk = 0;
        }

        // Memeriksa apakah $uploadOk di set ke 0 oleh error
        if ($uploadOk == 0) {
            echo "Maaf, file Anda tidak dapat diupload.";
        } else {
            // Jika semua pemeriksaan lulus, coba untuk mengupload file
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                $db = Database::getInstance();

                // Cek apakah ada file yang sudah diupload untuk member_id ini
                $query = "SELECT file_path FROM upload WHERE member_id = ?";
                $stmt = $db->prepare($query);
                $stmt->execute([$member_id]);
                $existingFile = $stmt->fetch(PDO::FETCH_OBJ);

                if ($existingFile) {
                    // Hapus file yang lama
                    if (file_exists($existingFile->file_path)) {
                        unlink($existingFile->file_path);
                    }

                    // Update informasi file di database
                    $query = "UPDATE upload SET file_path = ? WHERE member_id = ?";
                    $stmt = $db->prepare($query);
                    if ($stmt->execute([$targetFile, $member_id])) {
                        echo "File ". basename($file["name"]). " telah diupload dan informasi diperbarui di database.";
                        return $targetFile; // Kembalikan path file yang diupload
                    } else {
                        echo "Maaf, terjadi kesalahan saat memperbarui informasi file di database.";
                    }
                } else {
                    // Simpan informasi file baru di database
                    $query = "INSERT INTO upload (member_id, file_path) VALUES (?, ?)";
                    $stmt = $db->prepare($query);
                    if ($stmt->execute([$member_id, $targetFile])) {
                        echo "File ". basename($file["name"]). " telah diupload dan informasi disimpan di database.";
                        return $targetFile; // Kembalikan path file yang diupload
                    } else {
                        echo "Maaf, terjadi kesalahan saat menyimpan informasi file ke database.";
                    }
                }
            } else {
                echo "Maaf, terjadi kesalahan saat mengupload file Anda.";
            }
        }

        return false; // Kembalikan false jika upload gagal
    }
    public function getAllMaba() {
		$db = Database::getInstance();
        $query = "SELECT vw_maba.*, jur1.var_value AS Prodi1, jur2.var_value AS Prodi2, jur3.var_value AS Prodi3 
		FROM vw_maba INNER JOIN varoption AS jur1 ON PilihanPertama=jur1.recid 
		LEFT JOIN varoption AS jur2 ON PilihanKedua=jur2.recid LEFT JOIN varoption AS jur3 ON PilihanKetiga=jur3.recid 
		";
        $stmt = $db->prepare($query);
        $stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}

 

?>