<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Modal Content</title>
    <style>
        /* Gaya untuk modal */
        .modal {
            display: none; /* Sembunyikan modal secara default */
            position: fixed; /* Posisi tetap untuk tumpuan */
            z-index: 1; /* Lokasi modal */
            left: 0;
            top: 0;
            width: 100%; /* Lebar modal */
            height: 100%; /* Tinggi modal */
            overflow: auto; /* Aktifkan gulir */
            background-color: rgba(0,0,0,0.4); /* Warna latar belakang dengan transparansi */
        }

        /* Konten modal */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto; /* Posisikan jendela modal ke tengah */
            padding: 20px;
            border: 1px solid #888;
            width: 80%; /* Lebar konten modal */
        }
        @media print {
            @page {
                size: auto; 
				margin: 0mm;
			}
        }
    </style>
</head>
<body>

<!-- Tombol untuk membuka modal -->
<button onclick="openModal()">Buka Modal</button>

<!-- Modal -->
<div id="myModal" class="modal">
  <!-- Konten modal -->
  <div class="modal-content">
    <span onclick="closeModal()" style="float: right; cursor: pointer;">&times;</span>
	<table border =2; align="center">
    <tr style="height: 25%;">
			<td style="width:30%;">
				<img src="Picture1.png">
			</td>
			<td>
				<div class="tentang">
				<p style="font-size : 25px;">HEWI UNIVERSITY</p>
				<p>jl. Pendalaman II Kec. Bustamani Sudiang 90121, Telp : 0411-637276767</p>
				<p>Email : pmbhewi@gmail.co.id</p>
				<p>Website : Https://hewi.co.id/campus</p><br>
				</div>
			</td>
		</tr>
        <tr style="height: 25%;">
			<td style="width:30%;">
                <img src="http://hewi.co.id/app/edu/images/<?= $foto_peserta ?>" style="width:45%">
			</td>
			<td>
				<div class="data">
				<P>KARTU PESERTA UJIAN SARINGAN MASUK </P>
				<P><?= $nama_lengkap?></P>
				<P>Nomer peserta ujian : <?= $no_ujian?></P>
				<P>Program Kuliah <?= $jenjang?></P><br>
				</div>
			</td>
		</tr>
        <tr style="height: 25%;">
			<td style="width:30%;">
				<div class="prodi">
				<p>Program Studi :</p>
				<p><?=$pilihan_1?></p>
				<p><?=$pilihan_2?></p>
				<p><?=$pilihan_3?></p>
				</div>
			</td>
			<td>
				<div class="keterangan">
				<p>Gelombang 2</p>
				<p><?= $hari_tes?>. <?= $tanggal_tes?>. (08:30 - 10:00) WIB</p>
				<p>Tempat : Kampus II Ruang 101</p>
				</div>
			</td>
		</tr>
    </table>

    <!-- Tombol untuk mencetak -->
    <button onclick="printModal()">Cetak Modal</button>
  </div>
</div>

<script>
// Ambil modal
var modal = document.getElementById('myModal');

// Saat pengguna mengklik tombol, buka modal
function openModal() {
    modal.style.display = "block";
}

// Saat pengguna mengklik ikon "x", tutup modal
function closeModal() {
    modal.style.display = "none";
}

// Saat pengguna mengklik tombol cetak modal
function printModal() {
    // Simpan isi modal
    var modalContent = document.querySelector('.modal-content').innerHTML;
    // Buka jendela baru
    var printWindow = window.open('', '', 'height=400,width=600');
    // Tulis konten modal ke jendela baru
    printWindow.document.write('<html><head><title>Cetak Modal</title>');
    printWindow.document.write('</head><body>');
    printWindow.document.write('<h1>Isi Modal</h1>');
    printWindow.document.write(modalContent);
    printWindow.document.write('</body></html>');
    // Cetak
    printWindow.print();
    printWindow.close();
}
</script>

</body>
</html>

<style>
        table {
            height: 200px;
			padding-top: 20px;
			padding-bottom: 20px;
            width: 800px;
        }
		tr, td, th{
			padding: 1px;
			margin: auto;
			border: none;
		}
		p {
			margin: 5px;
		}
		img {
			width: 70%;
			display: block;
			margin: auto;
		}
		.prodi {
			text-align: center;
		}
		.data {
			text-align: center;
			font-weight: bold;
		}
		.keterangan {
			text-align: center;
		}
		.tentang{
			font-weight: bold;
			
		}
		@media print {
            @page {
                size: auto; 
				margin: 0mm;
			}
        }
    </style>
