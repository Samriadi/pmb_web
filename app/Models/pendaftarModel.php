<?php
class pendaftarModel
{
    

    public function getPendaftar()
    {
        $db = Database::getInstance();
        $query = "SELECT 
                        a.*,
                        a.ID, 
                        a.NamaLengkap,
                        b.*,
                        b.id,
                        COALESCE(d1.var_value, '') AS PilihanPertama,
                        COALESCE(d2.var_value, '') AS PilihanKedua,
                        COALESCE(d3.var_value, '') AS PilihanKetiga,
                        b.member_id,
                        b.jenjang,
                        b.kelulusan,
                        c.*,
                        c.recid,
                        c.periode,
                        c.keterangan,
                        c.status
                    FROM 
                        pmb_mahasiswa a
                    LEFT JOIN 
                        pmb_tagihan b ON b.member_id = a.ID
                    LEFT JOIN 
                        pmb_periode c ON c.recid = b.periode
                    LEFT JOIN 
                        varoption d1 ON d1.recid = b.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = b.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = b.PilihanKetiga;
                    ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getVerified()
    {
        $db = Database::getInstance();
        $query = "SELECT 
                        a.id,
                        a.pay_status,
                        a.verified,
                        a.no_ujian,
                        a.jumlah_tagihan,
                        a.nomor_va,
                        a.registration_date,
                        a.jenis,
                        a.invoice_id,
                        a.jenjang,
                        a.bukti_transfer,
                        b.ID,
                        b.NamaLengkap,
                        b.berkas,
                        b.WANumber,
                        b.photo,
                        c.Periode,
                        COALESCE(d1.var_value, '') AS Prodi1,
                        COALESCE(d2.var_value, '') AS Prodi2,
                        COALESCE(d3.var_value, '') AS Prodi3
                    FROM 
                        pmb_tagihan a
                    LEFT JOIN 
                        pmb_mahasiswa b ON b.ID = a.member_id
                    LEFT JOIN 
                        pmb_periode c ON c.recid = a.periode
                    LEFT JOIN 
                        varoption d1 ON d1.recid = a.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = a.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = a.PilihanKetiga;
                    ";
        $stmt = $db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getVerificationStatus($id) {
        $db = Database::getInstance();

        $query = "SELECT verified FROM pmb_tagihan WHERE id = ?";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetchColumn();
    }

    public function updateVerificationStatus($id, $status, $no_ujian, $pay_status) {
        $db = Database::getInstance();

       

        $query = "UPDATE pmb_tagihan SET verified = ?, no_ujian = ?, pay_status = ? WHERE id = ?";
        $stmt = $db->prepare($query);
        return $stmt->execute([$status, $no_ujian, $pay_status, $id]);
    }

    public function getDetail($id)
    {
        $db = Database::getInstance();
        $query = "SELECT 
                        a.*,
                        b.*,
                        c.*,
                        COALESCE(d1.var_value, '') AS Prodi1,
                        COALESCE(d2.var_value, '') AS Prodi2,
                        COALESCE(d3.var_value, '') AS Prodi3
                    FROM 
                        pmb_tagihan a
                    LEFT JOIN 
                        pmb_mahasiswa b ON b.ID = a.member_id
                    LEFT JOIN 
                        pmb_periode c ON c.recid = a.periode
                    LEFT JOIN 
                        varoption d1 ON d1.recid = a.PilihanPertama
                    LEFT JOIN 
                        varoption d2 ON d2.recid = a.PilihanKedua
                    LEFT JOIN 
                        varoption d3 ON d3.recid = a.PilihanKetiga
                    WHERE 
                        a.member_id = ?;
                    ";
        $stmt = $db->prepare($query);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function search($search){
        $db = Database::getInstance();

        $query = "SELECT * FROM table_name WHERE column_name LIKE '%$search%'";

    }
}
