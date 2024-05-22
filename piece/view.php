<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title></title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
	
</head>
<body>

<div class="content">
<div class="main-content" id="mainContent">
  <?php require "listData.php"; ?>
</div>

</div>

<script>
$(document).ready(function() {
    // Inisialisasi DataTables
    $('#hewiBrowse').DataTable({
        responsive: true
    });

    // Menggunakan event delegation untuk menangani klik pada elemen `.status-toggle`
    // yang mungkin belum ada di DOM saat kode ini dijalankan
    $('#hewiBrowse').on("click", ".status-toggle", function(){
        var $this = $(this);
        var id = $this.data("id");
        var currentStatus = $this.data("status");
        var newStatus = currentStatus === "Verified" ? "Unverified" : "Verified";

        $.ajax({
            url: "updateStatus.php",
            type: "POST",
            data: { id: id, status: newStatus },
            success: function(response) {
                // Setelah berhasil, ubah data-status dan teks tombol
                $this.data("status", newStatus);
                $this.text(newStatus === "Verified" ? "Unverified" : "Verified");
                alert("Status berhasil diubah menjadi " + newStatus);
            },
            error: function() {
                alert("Terjadi kesalahan saat mengubah status.");
            }
        });
    });
});
</script>


	
</body>
</html>
