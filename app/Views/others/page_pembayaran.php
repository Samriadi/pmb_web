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
                <div class="card shadow mb-5">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DATA PENDAFTAR LULUS</h6>
                    </div>
                    <div class="card-body">
                    <button id="generateNIM" class="btn btn-success btn-icon-split mb-3"><span class="icon text-white-50"><i class="fas fa-plus-circle"></i> </span><span class="text">NIM</span></button>
                    <div id="loading" class="mb-3" style="display: none;">Memproses...</div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" name="checkAll">
                                            </div>
                                        </th>
                                        <th>Nama Lengkap</th>
                                        <th>Prodi</th>
                                        <th>Kategori</th>
                                        <th>Jenjang</th>
                                        <th>Periode</th>
                                        <th>Jenis</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $dt) :
                                        $isHaveNim = $dt['isHaveNim'] === 1;
                                        $checkboxId = $dt['member_id']; ?>
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="<?= $checkboxId ?>" name="checkboxes[]" value="<?= $dt['member_id'] ?>">
                                                    <label class="form-check-label" for="<?= $checkboxId ?>"></label>
                                                </div>
                                            </td>
                                            <td><?= $dt['NamaLengkap'] ?></td>
                                            <td><?= $dt['prodi'] ?></td>
                                            <td><?= $dt['kategori'] ?></td>
                                            <td><?= $dt['jenjang'] ?></td>
                                            <td><?= $dt['periode'] ?></td>
                                            <td><?= $dt['jenis'] ?></td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                          
                        </div>
                    </div>
                </div>

            </div>
            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">


            </body>


            <?php include '../app/Views/others/layouts/footer.php'; ?>

            <script>
                var data = <?php echo json_encode($data); ?>;

                $(document).ready(function() {


                    $('#generateNIM').click(function() {
                        const checkboxes = document.querySelectorAll('input[name="checkboxes[]"]:checked');

                        if (checkboxes.length === 0) {
                            Swal.fire({
                                text: 'Pilih data yang ingin dibuat NIM.',
                                icon: 'warning',
                                timer: 1000,
                                showConfirmButton: false
                            });
                            return;
                        }

                        Swal.fire({
                            text: 'Konfirmasi pembuatan NIM, apakah anda yakin?',
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Batal'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                const checked = Array.from(checkboxes).map(checkbox => parseInt(checkbox.value));
                                const filteredData = data.filter(item => checked.includes(item.member_id));
                                $('#generateNIM').prop('disabled', true);
                                $('#loading').show();

                                const loadingAlert = Swal.fire({
                                    text: 'Proses pembuatan NIM...',
                                    icon: 'info',
                                    showConfirmButton: false,
                                    didOpen: () => {
                                        Swal.showLoading();
                                    }
                                });

                                $.ajax({
                                    url: '/admin/pembayaran/add-nim',
                                    method: 'POST',
                                    contentType: 'application/json',
                                    data: JSON.stringify({
                                        filteredData: filteredData
                                    }),
                                    success: function(response) {
                                        console.log('Success:', response);
                                        
                                        setTimeout(function() {
                                            Swal.close();
                                            Swal.fire({
                                                text: 'NIM berhasil Dibuat.',
                                                icon: 'success',
                                                timer: 1200,
                                                showConfirmButton: false
                                            }).then(() => {
                                                $('#saveButton').prop('disabled', false);
                                                $('#loading').hide();
                                                window.location.reload();
                                            });
                                        }, 1500);
                                    },

                                    error: function(error) {
                                        console.error('Error:', error);
                                        Swal.close();
                                        Swal.fire({
                                            text: 'NIM gagal Dibuat',
                                            icon: 'error',
                                            timer: 1200,
                                            showConfirmButton: false
                                        }).then(() => {
                                            $('#saveButton').prop('disabled', false);
                                            $('#loading').hide();
                                            window.location.reload();
                                        });
                                    }
                                });



                            } else if (result.dismiss === Swal.DismissReason.cancel) {
                                Swal.fire({
                                    text: 'Pembuatan NIM dibatalkan',
                                    icon: 'info',
                                    timer: 1200,
                                    showConfirmButton: false
                                });
                            }
                        });
                    });


                    $('#dataTable').on('change', 'input[type="checkbox"]:not([name="checkAll"])', function() {
                        if ($(this).is(':checked')) {
                            $(this).closest('tr').addClass('table-info');
                        } else {
                            $(this).closest('tr').removeClass('table-info');
                        }
                    });

                    $('#dataTable').on('change', 'input[name="checkboxes[]"]', function() {
                        if ($(this).is(':checked')) {
                            $(this).closest('tr').addClass('table-info');
                        } else {
                            $(this).closest('tr').removeClass('table-info');
                        }

                        var allChecked = $('input[name="checkboxes[]"]').length === $('input[name="checkboxes[]"]:checked').length;
                        $('input[name="checkAll"]').prop('checked', allChecked);
                    });

                    $('input[name="checkAll"]').change(function() {
                        var isChecked = $(this).is(':checked');
                        $('input[name="checkboxes[]"]').prop('checked', isChecked).change();
                    });



                });
            </script>