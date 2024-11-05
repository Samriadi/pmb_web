<?php include '../app/Views/others/layouts/header.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Page Wrapper -->
<div id="wrapper">

    <?php include '../app/Views/others/layouts/sidebar.php'; ?>

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include '../app/Views/others/layouts/topbar.php'; ?>

            <!-- End of Topbar -->
            <div class="container-fluid">
                <!-- Button trigger modal -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DATA MAIN</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Lengkap Kampuss</th>
                                        <th>Nama Singkat</th>
                                        <th>Jalan</th>
                                        <th>Kota</th>
                                        <th>Provinsi</th>
                                        <th>Negara</th>
                                        <th>Kode Warna Utama</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $dt) :
                                    ?>
                                        <tr>
                                            <td><?= $dt->nama_lengkap_kampus ?></td>
                                            <td><?= $dt->nama_singkat ?></td>
                                            <td><?= $dt->jalan ?></td>
                                            <td><?= $dt->kota ?></td>
                                            <td><?= $dt->provinsi ?></td>
                                            <td><?= $dt->negara ?></td>
                                            <td><?= $dt->kode_warna_utama ?></td>

                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Option 1: Bootstrap Bundle with Popper -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
                </body>


                <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <input type="hidden" id="id" name="id">
                                </div>
                                <div class="form-group">
                                    <label for="editNamaLengkapKampus">Nama Lengkap Kampus</label>
                                    <input type="text" class="form-control" id="editNamaLengkapKampus" name="nama_lengkap_kampus" required>
                                </div>
                                <div class="form-group">
                                    <label for="editNamaSingkat">Nama Singkat</label>
                                    <input type="text" class="form-control" id="editNamaSingkat" name="nama_singkat" required>
                                </div>
                                <div class="form-group">
                                    <label for="editJalan">Jalan</label>
                                    <input type="text" class="form-control" id="editJalan" name="jalan" required>
                                </div>
                                <div class="form-group">
                                    <label for="editKota">Kota</label>
                                    <input type="text" class="form-control" id="editKota" name="kota" required>
                                </div>
                                <div class="form-group">
                                    <label for="editProvinsi">User Pass</label>
                                    <input type="text" class="form-control" id="editProvinsi" name="provinsi" required>
                                </div>
                                <div class="form-group">
                                    <label for="editKodeWarna">Kode Warna Utama</label>
                                    <input type="text" class="form-control" id="editKodeWarna" name="kode_warna_utama" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="update">Save</button>
                            </div>
                        </div>
                    </div>
                </div>


                <?php include '../app/Views/others/layouts/footer.php'; ?>

                <script>
                    // Fungsi untuk menampilkan data di modal edit
                    function edit(id) {

                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', '/hewi/public/install/edit/' + id, true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                var response = JSON.parse(xhr.responseText.trim());

                                document.getElementById('id').value = response.id;
                                document.getElementById('editNamaLengkapKampus').value = response.nama_lengkap_kampus;
                                document.getElementById('editNamaSingkat').value = response.nama_singkat;
                                document.getElementById('editJalan').value = response.jalan;
                                document.getElementById('editKota').value = response.kota;
                                document.getElementById('editProvinsi').value = response.provinsi;
                                document.getElementById('editKodeWarna').value = response.kode_warna_utama;

                                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                                editModal.show();
                            }
                        };
                        xhr.send();
                    }

                    document.getElementById('update').addEventListener('click', function() {
                        var id = document.getElementById('id').value;
                        var nama_lengkap_kampus = document.getElementById('editNamaLengkapKampus').value;
                        var nama_singkat = document.getElementById('editNamaSingkat').value;
                        var jalan = document.getElementById('editJalan').value;
                        var kota = document.getElementById('editKota').value;
                        var provinsi = document.getElementById('ieditProvins').value;
                        var kode_warna_utama = document.getElementById('editKodeWarna').value;



                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '/hewi/public/install/update', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                console.log(xhr.responseText);
                                // Lakukan sesuatu setelah data berhasil dikirim, seperti menutup modal
                                var modal = document.getElementById('editModal');
                                var modalInstance = bootstrap.Modal.getInstance(modal);
                                modalInstance.hide();

                                Swal.fire({
                                    title: 'Success!',
                                    text: xhr.responseText,
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    showCancelButton: false // Hide the cancel button
                                }).then((result) => {
                                    // Check if the "OK" button was clicked
                                    if (result.isConfirmed) {
                                        // Add a delay before refreshing the page
                                        setTimeout(() => {
                                            // Refresh the page
                                            window.location.reload();
                                        }, 2000); // Adjust the delay time (in milliseconds) as needed
                                    }
                                });

                            }
                        };

                        var data = "&id=" + encodeURIComponent(id) + "&nama_lengkap_kampus=" + encodeURIComponent(nama_lengkap_kampus) + "&nama_singkat=" + encodeURIComponent(nama_singkat) + "&jalan=" + encodeURIComponent(jalan) + "&kota=" + encodeURIComponent(kota) + "&provinsi=" + encodeURIComponent(provinsi) + "&kode_warna_utama=" + encodeURIComponent(kode_warna_utama);

                        xhr.send(data);
                    });

                    var modalElement = document.getElementById('editModal');
                    modalElement.addEventListener('hidden.bs.modal', function() {
                        window.location.reload();
                    });
                </script>