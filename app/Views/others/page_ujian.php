<?php include __DIR__ . '/layouts/header.php'; ?>


<!-- Page Wrapper -->
<div id="wrapper">
    <?php include __DIR__ . '/layouts/sidebar.php'; ?>


    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include __DIR__ . '/layouts/topbar.php'; ?>
            <!-- End of Topbar -->
            <div class="container-fluid">
                <!-- Button trigger modal -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DATA UJIAN</h6>
                    </div>
                    <div class="card-body">


                        <!-- Button trigger modal -->
                        <button style="margin-bottom: 10px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">
                            Upload File CSV
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="uploadModalLabel">Upload File CSV</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="uploadForm" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="file">Pilih File CSV:</label>
                                                <input type="file" class="form-control-file" id="file" name="file" accept=".csv" required>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Upload</button>

                                    </div>
                                    </form>

                                </div>
                            </div>
                        </div>

                        <!-- Tambahkan Script AJAX seperti sebelumnya -->



                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nomor Ujian</th>
                                        <th>Nama Lengkap</th>
                                        <th>Kelulusan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $dt) :
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $dt->no_ujian ?></td>
                                            <td><?= $dt->NamaLengkap ?></td>
                                            <?php if ($dt->kelulusan) { ?>
                                                <td><?= $dt->kelulusan ?></td>
                                            <?php } else { ?>
                                                <td>NULL</td>
                                            <?php } ?>
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

                <?php include __DIR__ . '/layouts/footer.php'; ?>

                <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

                <script>
                    $(document).ready(function() {
                        $('#uploadForm').submit(function(e) {
                            e.preventDefault();
                            var formData = new FormData(this);
                            $.ajax({
                                url: '/hewi/public/ujian/upload',
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    console.log('Respons dari server:', response);
                                    // Menampilkan SweetAlert ketika upload berhasil
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Data Berhasil diperbaharui',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        showCancelButton: false
                                    }).then((result) => {
                                        window.location.reload(); // Me-refresh halaman
                                    });
                                },

                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    });
                </script>