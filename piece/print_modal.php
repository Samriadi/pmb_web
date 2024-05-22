<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Content from Modal</title>
    <style>
        /* CSS untuk modal */
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
    <p>Ini adalah konten modal.</p>
    <p><?php echo "Ini adalah cetakan dari PHP."; ?></p>
    <!-- Tombol untuk mencetak -->
    <button onclick="printContent()">Cetak Konten</button>
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

// Saat pengguna mengklik tombol cetak, cetak konten modal
function printContent() {
    var content = document.getElementsByClassName("modal-content")[0].innerHTML;
    var originalDocument = document.body.innerHTML;
    document.body.innerHTML = content;
    window.print();
    document.body.innerHTML = originalDocument;
}
</script>

</body>
</html>
