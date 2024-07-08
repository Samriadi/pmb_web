<?php include '../app/Views/others/layouts/header.php'; ?>

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
                        <h5 class="m-0 font-weight-bold text-primary">DATA VERIFIED</h5>
                        <h6 id="filterSubtitle" class="m-0 font-weight-bold text-primary"></h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Verified</th>
                                        <th>Nama Lengkap</th>
                                        <th>File</th>
                                        <th>Pembayaran</th>
                                        <th>Jumlah Tagihan</th>
                                        <th>Bank Transfer</th>
                                        <th>Tanggal Registrasi</th>
                                        <th>Gelombang</th>
                                        <th>Prodi 1</th>
                                        <th>Prodi 2</th>
                                        <th>Prodi 3</th>
                                        <th>Jenjang</th>
                                        <th>Nomor WA</th>
                                        <th>Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $dt) :
                                        $isVerified = $dt->verified === "Verified";
                                        $buttonClass = $isVerified ? 'btn-success' : 'btn-danger';
                                        $buttonText = $isVerified ? 'Verified' : 'Unverified';
                                        $checkboxId = $dt->member_id;
                                    ?>
                                        <tr>
                                            <td>
                                                <button class="btn btn-sm <?= $buttonClass ?>" onclick="toggleVerified(<?= $dt->id ?>)">
                                                    <?= $buttonText ?>
                                                </button>
                                            </td>
                                            <td><?= $dt->NamaLengkap ?></td>
                                            <td>
                                                <?php if ($dt->berkas) { ?>
                                                    <a href="#" data-toggle="modal" data-target="#docuFileModal" data-file="<?= $dt->berkas ?>">Dokumen</a>
                                                <?php } ?>
                                                <?php if ($dt->photo) { ?>
                                                    <a href="#" data-toggle="modal" data-target="#photoFileModal" data-file="<?= $dt->photo ?>">Photo</a>
                                                <?php } ?>
                                                <?php if ($dt->bukti_transfer) { ?>
                                                    <a href="#" data-toggle="modal" data-target="#buktiFileModal" data-file="<?= $dt->bukti_transfer ?>">Bukti Transfer</a>
                                                <?php } ?>
                                            </td>
                                            <td><?= $dt->invoice_id ?></td>
                                            <td>Rp. <?= number_format($dt->jumlah_tagihan, 0, ',', '.') ?></td>
                                            <td><?= $dt->nomor_va ?></td>
                                            <td><?= $dt->registration_date ?></td>
                                            <td><?= $dt->Periode ?></td>
                                            <td><?= $dt->Prodi1 ?></td>
                                            <td><?= $dt->Prodi2 ?></td>
                                            <td><?= $dt->Prodi3 ?></td>
                                            <td><?= $dt->jenjang ?></td>
                                            <td id="WAnumber">
                                                <a href="https://wa.me/<?= '62' . substr($dt->WANumber, 1) ?>" target="_blank"><?= $dt->WANumber ?></a>
                                            </td>
                                            <td><?= $dt->jenis ?></td>

                                        </tr>
                                    <?php endforeach ?>
                                </tbody>

                            </table>


                            <!-- Modal -->
                            <div class="modal fade" id="docuFileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fileModalLabel">BERKAS</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="imageContainer" style="display:none;">
                                                <img id="imageFrame" src="" width="100%" height="400px">
                                            </div>
                                            <iframe id="docuFileFrame" src="" width="100%" height="400px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="photoFileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fileModalLabel">PHOTO</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="imageContainer" style="display:none;">
                                                <img id="imageFrame" src="" width="100%" height="400px">
                                            </div>
                                            <iframe id="photoFileFrame" src="" width="100%" height="400px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="modal fade" id="buktiFileModal" tabindex="-1" role="dialog" aria-labelledby="fileModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="fileModalLabel">BUKTI TRANSFER</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="imageContainer" style="display:none;">
                                                <img id="imageFrame" src="" width="100%" height="400px">
                                            </div>
                                            <iframe id="buktiFileFrame" src="" width="100%" height="400px"></iframe>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
                <!-- Option 1: Bootstrap Bundle with Popper -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

                <script>
                    $(document).ready(function() {
                        function setupModal(modalId, filePath, iframeId) {
                            $(modalId).on('show.bs.modal', function(event) {
                                var button = $(event.relatedTarget); // Button that triggered the modal
                                var fileName = button.data('file'); // Extract info from data-* attributes
                                var fileUrl = filePath + fileName;
                                var fileExtension = fileName.split('.').pop().toLowerCase();

                                var modal = $(this);
                                if (['jpg', 'jpeg', 'png', 'gif', 'bmp'].includes(fileExtension)) {
                                    // If the file is an image
                                    modal.find('.modal-body #imageContainer').show();
                                    modal.find('.modal-body #' + iframeId).hide();
                                    modal.find('.modal-body #imageFrame').attr('src', fileUrl);
                                } else {
                                    // If the file is not an image (e.g., PDF)
                                    modal.find('.modal-body #imageContainer').hide();
                                    modal.find('.modal-body #' + iframeId).show();
                                    modal.find('.modal-body #' + iframeId).attr('src', fileUrl);
                                }
                            });

                            $(modalId).on('hidden.bs.modal', function() {
                                var modal = $(this);
                                modal.find('.modal-body #imageFrame').attr('src', '');
                                modal.find('.modal-body #' + iframeId).attr('src', '');
                            });
                        }

                        setupModal('#docuFileModal', 'public/uploads/docu/', 'docuFileFrame');
                        setupModal('#photoFileModal', 'public/uploads/photo/', 'photoFileFrame');
                        setupModal('#buktiFileModal', 'public/uploads/payment/', 'buktiFileFrame');
                    });
                </script>

                <script>
                    function toggleVerified(id) {
                        Swal.fire({
                            title: 'Konfirmasi',
                            text: 'Anda yakin ingin mengubah status verifikasi?',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch('/admin/verified/action', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({
                                            id: id
                                        })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            const button = document.querySelector(`button[onclick="toggleVerified(${id})"]`);
                                            button.textContent = data.verified === 'Verified' ? 'Verified' : 'Unverified';
                                            button.className = 'btn btn-sm ' + (data.verified === 'Verified' ? 'btn-success' : 'btn-danger');
                                            Swal.fire({
                                                title: 'Updated!',
                                                text: 'The verification status has been updated.',
                                                icon: 'success',
                                                timer: 1000, //
                                                showConfirmButton: false
                                            });
                                            setTimeout(() => {
                                                window.location.reload();
                                            }, 1000);
                                        } else {
                                            Swal.fire('Error', 'Failed to update verification status.', 'error');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire('Error', 'Failed to update verification status.', 'error');
                                    });
                            }
                        });
                    }
                </script>

                <script>
                    document.getElementById('verifySelected').addEventListener('click', function(event) {
                        event.preventDefault();

                        const checkboxes = document.querySelectorAll('input[name="checkboxes[]"]:checked');
                        const ids = Array.from(checkboxes).map(checkbox => checkbox.value);

                        console.log(ids);
                        if (ids.length > 0) {
                            fetch('/admin/verified/selected', {
                                    method: 'POST',
                                    headers: {
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        ids
                                    })
                                })
                                .then(response => response.json())
                                .then(data => {
                                    console.log(data);
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    alert('Terjadi kesalahan pada server.');
                                });
                        } else {
                            alert('Tidak ada data yang dipilih.');
                        }
                    });
                </script>


                <?php include '../app/Views/others/layouts/footer.php'; ?>
                </body>

                </html>