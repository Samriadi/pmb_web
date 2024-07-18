<?php
require_once __DIR__ . '/../Core/Database.php';

class ujianModel
{
    private $pmb_tagihan;
    private $pmb_mahasiswa;
    private $pmb_pembayaran;
    private $varoption;
    private $db;
    public function __construct()
    {
        global $pmb_tagihan;
        global $pmb_mahasiswa;
        global $pmb_pembayaran;
        global $varoption;
        $this->pmb_tagihan = $pmb_tagihan;
        $this->pmb_mahasiswa = $pmb_mahasiswa;
        $this->pmb_pembayaran = $pmb_pembayaran;
        $this->varoption = $varoption;
        $this->db = Database::getInstance();
    }
    public function getUjian()
    {
        $query = "SELECT a.no_ujian, a.member_id, a.kelulusan, b.ID, b.NamaLengkap FROM $this->pmb_tagihan a JOIN $this->pmb_mahasiswa b ON a.member_id = b.ID WHERE a.no_ujian IS NOT NULL AND a.no_ujian <> ''";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function deleteByNoUjian($no_ujian)
    {
        $stmt = $this->db->prepare("DELETE FROM $this->pmb_pembayaran WHERE no_ujian = ?");
        $stmt->execute([$no_ujian]);
    }

    public function uploadCSV($no_ujian, $kelulusan)
    {
		$stmt = $this->db->prepare("SELECT member_id, ifnull(listTagihan.tagihan,0) AS biaya_registrasi FROM $this->pmb_tagihan LEFT JOIN 
		(SELECT var_value AS jenjang, catatan AS kategori, var_others AS tagihan FROM $this->varoption WHERE var_name ='daftar ulang') AS listTagihan 
		ON $this->pmb_tagihan.jenjang = listTagihan.jenjang AND $this->pmb_tagihan.kategori = listTagihan.kategori WHERE no_ujian = ?");
		
		$stmt->execute([$no_ujian]);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);		
		
		if ($result) {
           $memberID = $result['member_id'];
		   $tagihanRp = $result['biaya_registrasi'];
		   $transDate = date("Y-m-d H:i:s");
		   $Catatan = "";
		   
	      do {
		    $secureRandomID = generateSecureRandomID(9);
	      } while (checkIDExists($secureRandomID));

	      $VAid = $secureRandomID;

           $stmt = $this->db->prepare("UPDATE $this->pmb_tagihan SET kelulusan = ? WHERE no_ujian = ?");
           $stmt->execute([$kelulusan, $no_ujian]);
		   
           $stmt = $this->db->prepare("INSERT INTO $this->pmb_pembayaran (member_id, no_ujian, va_number, trans_date, tagihan, catatan) VALUES(?,?,?,?,?,?)");
           $stmt->execute([$memberID, $no_ujian, $VAid, $transDate, $tagihanRp, $Catatan]);		   
		}
    }

    public function downloadCSV()
    {
        $query = "SELECT a.no_ujian, a.member_id, a.kelulusan, b.ID, b.NamaLengkap FROM $this->pmb_tagihan a JOIN $this->pmb_mahasiswa b ON a.member_id = b.ID WHERE a.no_ujian IS NOT NULL AND a.no_ujian <> ''";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
