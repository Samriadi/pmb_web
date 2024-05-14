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
	<?php include 'page_kartu_ujian.php' ?>

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
