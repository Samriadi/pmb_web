<?php include '../views/layouts/header.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php include '../views/layouts/sidebar.php'; ?>
       
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
<?php include '../views/layouts/topbar.php'; ?>
                <!-- End of Topbar -->
    <div class="container-fluid">
            <!-- Button trigger modal -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">FORM INSTALL</h6>
         </div>
            <div class="card-body">
           
            <form id="campusForm">
                <div class="form-group">
                    <label for="namaLengkapKampus">Nama Lengkap Kampus</label>
                    <input type="text" class="form-control" id="namaLengkapKampus" name="namaLengkapKampus" placeholder="Masukkan nama lengkap kampus" required>
                </div>
                <div class="form-group">
                    <label for="namaSingkat">Nama Singkat</label>
                    <input type="text" class="form-control" id="namaSingkat" name="namaSingkat" placeholder="Masukkan nama singkat kampus" required>
                </div>
                <div class="form-group">
                    <label for="jalan">Jalan</label>
                    <input type="text" class="form-control" id="jalan" name="jalan" placeholder="Masukkan alamat jalan" required>
                </div>
                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota" placeholder="Masukkan kota" required>
                </div>
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Masukkan provinsi" required>
                </div>
                <div class="form-group">
                    <label for="negara">Negara</label>
                    <input type="text" class="form-control" id="negara" name="negara" placeholder="Masukkan negara" required>
                </div>
                <div class="form-group">
                    <label for="kodeWarnaUtama">Kode Warna Utama</label>
                    <input type="text" class="form-control" id="kodeWarnaUtama" name="kodeWarnaUtama" placeholder="Masukkan kode warna utama" required>
                </div>
                <div class="d-flex justify-content-between mt-2">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>

            </div>
        </div>
    </div>  
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  </body>

<?php include '../views/layouts/footer.php'; ?>


<script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById("campusForm");
            form.addEventListener("submit", function(event) {
                event.preventDefault();

                var formData = new FormData(form);
               
                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/hewi/public/install/save', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        console.log(xhr.responseText);

                        var response = JSON.parse(xhr.responseText);
                        if (response.status === "success") {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                            // Reset formulir
                            form.reset();

                         
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan: ' + response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan: ' + xhr.statusText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                };
                xhr.onerror = function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Permintaan gagal',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                };
                xhr.send(formData);
            });
        });


     

    </script>
