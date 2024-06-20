<?php
require_once __DIR__ . '/../Core/Database.php';

class ujianModel
{
    public function getUjian()
    {
        $db = Database::getInstance();
        $query = "SELECT a.no_ujian, a.member_id, a.kelulusan, b.ID, b.NamaLengkap FROM pmb_tagihan a JOIN pmb_mahasiswa b ON a.member_id = b.ID WHERE a.no_ujian IS NOT NULL AND a.no_ujian <> ''";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    
    public function deleteByNoUjian($no_ujian)
    {
        $db = Database::getInstance();
        $stmt = $db->prepare("DELETE FROM pmb_pembayaran WHERE no_ujian = ?");
        $stmt->execute([$no_ujian]);

    }

    public function uploadCSV($no_ujian, $kelulusan)
    {
        $db = Database::getInstance();
		
		$stmt = $db->prepare("SELECT member_id, ifnull(listTagihan.tagihan,0) AS biaya_registrasi FROM pmb_tagihan LEFT JOIN 
		(SELECT var_value AS jenjang, catatan AS kategori, var_others AS tagihan FROM varoption WHERE var_name ='daftar ulang') AS listTagihan 
		ON pmb_tagihan.jenjang = listTagihan.jenjang AND pmb_tagihan.kategori = listTagihan.kategori WHERE no_ujian = ?");
		
		$stmt->execute([$no_ujian]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);		
		
		if ($result) {
           $memberID = $result['member_id'];
		   $tagihanRp = $result['biaya_registrasi'];
		   $transDate = date("Y-m-d H:i:s");
		   $Catatan = "";
		   
	      /** Ambil VA ID Random dan buatkan tagihan  ***/
	      do {
		    $secureRandomID = generateSecureRandomID(9);
	      } while (checkIDExists($secureRandomID));

	      $VAid = $secureRandomID;

           $stmt = $db->prepare("UPDATE pmb_tagihan SET kelulusan = ? WHERE no_ujian = ?");
           $stmt->execute([$kelulusan, $no_ujian]);
		   
           $stmt = $db->prepare("INSERT INTO pmb_pembayaran (member_id, no_ujian, va_number, trans_date, tagihan, catatan) VALUES(?,?,?,?,?,?)");
           $stmt->execute([$memberID, $no_ujian, $VAid, $transDate, $tagihanRp, $Catatan]);		   
		}
    }

    public function downloadCSV()
    {
        $db = Database::getInstance();
        $query = "SELECT a.no_ujian, a.member_id, a.kelulusan, b.ID, b.NamaLengkap FROM pmb_tagihan a JOIN pmb_mahasiswa b ON a.member_id = b.ID WHERE a.no_ujian IS NOT NULL AND a.no_ujian <> ''";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
