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
                        <div class="d-flex justify-content-between">
                            <div class="d-inline-flex">
                                <button style="margin-bottom: 15px;" type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#uploadModal">
                                    <i class="fas fa-file-csv"></i>
                                </button>

                                <form method="post" action="/admin/ujian/download">
                                    <button style="margin-bottom: 10px;" type="submit" class="btn btn-primary">
                                        <i class=" fas fa-download"></i>
                                    </button>
                                </form>
                            </div>

                            <div class="justify-content-end">
                                <a class="btn btn-success btn-icon-split" href="#" onclick="loadHelpModal()" style="margin-bottom: 15px;"><span class="icon text-white-50">
                                        <i class="fas fa-info-circle"></i>
                                    </span>
                                    <span class="text">Help</span></a>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class=" modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
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


                <!-- Modal Help -->
                <div class="modal fade" id="helpModal" tabindex="-1" aria-labelledby="helpModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="helpModalLabel">Help</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x
                                </button>
                            </div>
                            <div class="modal-body">
                                <!-- Konten modal akan dimuat di sini -->
                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-secondary" id="deleteHelp">Delete</button>
                                <div>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="saveOrUpdateHelp">Save Or Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end modal help  -->

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
                                url: '/admin/ujian/upload',
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    console.log('Respons dari server:', response);
                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Data Berhasil diperbaharui',
                                        icon: 'success',
                                        showConfirmButton: false,
                                        timer: 1000
                                    });

                                    setTimeout(function() {
                                        Swal.close();
                                        window.location.reload();
                                    }, 1000);
                                },
                                error: function(xhr, status, error) {
                                    console.error(xhr.responseText);
                                }
                            });
                        });
                    });
                </script>



                <!-- handle help -->
                <script>
                    function loadHelpModal() {
                        fetch('/admin/help')
                            .then(response => response.text())
                            .then(data => {

                                document.querySelector('#helpModal .modal-body').innerHTML = data;
                                new bootstrap.Modal(document.getElementById('helpModal')).show();

                                var currentURL = window.location.href;
                                var startIndex = currentURL.lastIndexOf('/');
                                var endIndex = currentURL.indexOf('#');
                                var pages = currentURL.substring(startIndex + 1, endIndex);

                                console.log(pages)
                                var xhr = new XMLHttpRequest();
                                xhr.open('GET', '/admin/help?page=' + pages, true);
                                xhr.onreadystatechange = function() {
                                    if (xhr.readyState == 4 && xhr.status == 200) {
                                        var response = JSON.parse(xhr.responseText.trim());

                                        console.log(response)
                                        document.getElementById('recid').value = response.recid;
                                        document.getElementById('editPage').value = pages;
                                        document.getElementById('editKonten').value = response.konten;

                                    }
                                };
                                xhr.send();

                            })
                            .catch(error => console.error('Error fetching the modal content:', error));

                        document.getElementById('saveOrUpdateHelp').addEventListener('click', function() {
                            var recid = document.getElementById('recid').value;
                            var page = document.getElementById('editPage').value;
                            var konten = document.getElementById('editKonten').value;

                            console.log(recid);
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '/admin/help/save', true);
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    console.log(xhr.responseText);
                                    var modal = document.getElementById('helpModal');
                                    var modalInstance = bootstrap.Modal.getInstance(modal);
                                    modalInstance.hide();
                                    Swal.fire({
                                        title: 'Success!',
                                        text: xhr.responseText,
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        showCancelButton: false
                                    }).then((result) => {
                                        modalInstance.hide();
                                    });
                                }
                            };

                            var data =
                                "&recid=" + encodeURIComponent(recid) +
                                "&page=" + encodeURIComponent(page) +
                                "&konten=" + encodeURIComponent(konten);

                            xhr.send(data);
                        });

                        document.getElementById('deleteHelp').addEventListener('click', function() {
                            var recid = document.getElementById('recid').value;

                            console.log(recid);
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '/admin/help/delete?recid=' + recid, true);
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    Swal.fire({
                                        text: 'Data Berhasil Dihapus',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        showCancelButton: false
                                    }).then((result) => {
                                        window.location.reload();
                                    });
                                }
                            };

                            var data =
                                "&recid=" + encodeURIComponent(recid) +
                                xhr.send(data);
                        });
                    }
                </script>
                <!-- end handle help -->