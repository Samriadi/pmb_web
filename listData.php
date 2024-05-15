<div id="listData">
<h1>Daftar Calon Mahasiswa Baru</h1>

    <table id="example" class="display responsive nowrap" style="width:100%">
        <thead>
            <tr>
                <th>Virtual Account</th>
				<th>Verifikasi</th>
                <th>Nama</th>
				<th>Upload</th>
				<th>Pembayaran</th>
				<th>Registrasi</th>
				<th>Jenis</th>
                <th>Kategori</th>
                <th>Gelombang</th>
                <th>Pilihan #1</th>
				<th>Pilihan #2</th>
				<th>Pilihan #3</th>								
				<th>Agama</th>
				<th>Nomor HP/WA</th>
				<th>Asal Sekolah</th>				
				<th>Call WA</th>
            </tr>
        </thead>
        <tbody>
	<?php
	foreach ($daftarMaba as $dt){ 
	  if ($dt->berkas<>"" and $dt->photo<>""){
	     $berkas = '<a href="https://hewi.co.id/app/edu/docu.php?id='.encrypt($dt->berkas,encKey()).'">Berkas</a>';
		 $berkas .= ' | <a href="https://hewi.co.id/app/edu/docu.php?id='.encrypt($dt->photo,encKey()).'">Photo</a>';
	  } else {
		 if ($dt->berkas<>"" or $dt->photo<>"")
		 $berkas = 'Belum Lengkap';
		 else
	     $berkas = 'Belum Ada';
	  }
  
	  $BuktiTransfer = $dt->bukti_transfer;
      if ($BuktiTransfer<>""){
		 if (strtolower($BuktiTransfer)=="auto confirmed!")
		 $pembayaran = $BuktiTransfer;
		 else
	     $pembayaran = '<a href="https://hewi.co.id/app/edu/docu.php?id='.encrypt($dt->bukti_transfer,encKey()).'">Bukti Transfer</a>';
	  } else {
         $pembayaran = "Belum";
	  }
  
	  if ($dt->WANumber){
	     $WA = ltrim($dt->WANumber, "0");
		 $waNumber = "<a href='https://wa.me/62".$WA."'><i class='fa-brands fa-whatsapp'></i></a>";;
      } else {
	     $waNumber = "";
      }
	  
	  if ($berkas == 'Belum Ada' or $berkas == 'Belum Lengkap' or $pembayaran == "Belum"){
	     $aktivasi = "Disabled";
		 $actClass = "";
	  } else {
	     $aktivasi = "";
		 $actClass = "mabaActivasi";
	  }
	  
      echo "<tr>
        <td>".$dt->nomor_va."</td>
		<td>";
		if ($dt->verified == "Closed"){
			echo "<center>Processed</center>";
		} else {
		?>
            <center>
			<button class="status-toggle <?=$actClass?>" data-id="<?= htmlspecialchars($dt->tagihan_id); ?>" 
			data-status="<?= htmlspecialchars($dt->verified); ?>" <?=$aktivasi?>>
               <?= htmlspecialchars($dt->verified) === 'Verified' ? 'Unverified' : 'Verified'; ?>
            </button>
			</center>
		<?php
		}
		echo "</td>	             
		<td>".$dt->NamaLengkap."</td>
		<td>$berkas</td>
		<td>$pembayaran</td>
		<td>".$dt->registration_date."</td> 
		<td>".$dt->jenis."</td>
        <td>".$dt->kategori."</td>
        <td>".romawi($dt->periode)."</td>
        <td>".$dt->Prodi1."</td>
		<td>".$dt->Prodi2."</td>
		<td>".$dt->Prodi3."</td>		
		<td>".$dt->Agama."</td>
		<td>".$dt->WANumber."</td>
		<td>".$dt->NamaAsalSekolah."</td>
		<td id='WAnumber'>$waNumber</td>	
      </tr>";
	}
	?>
        </tbody>
    </table>

</div>