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
                        <h6 class="m-0 font-weight-bold text-primary">JADWAL TES PENDAFTAR</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTablePendaftar" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>
                        Check
                        </th>
                        <th>Tanggal</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Lokasi</th>
                        <th>Pendaftar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($JadwalTestPendaftar as $dt) :
                        $checkboxIdTest = $dt->test_tagihanid;?>

                        <tr>
                            <td>
                                <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="<?= $checkboxIdTest ?>" name="checkboxJadwal[]" value="<?= $dt->test_tagihanid ?>">
                                <label class="form-check-label" for="<?= $checkboxIdTest ?>"></label>
                                </div>
                            </td>
                            <td><?php echo date('d-M-Y', strtotime($dt->test_tanggal)); ?></td>
                            <td><?php echo date('H:i', strtotime($dt->test_mulai)); ?></td>
                            <td><?php echo htmlspecialchars($dt->test_selesai); ?></td>
                            <td><?php echo htmlspecialchars($dt->test_lokasi); ?></td>
                            <td><?php echo htmlspecialchars($dt->DetailPendaftar); ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
                  <a id="dropJadwal" class="btn btn-primary btn-icon-split mb-3 mt-3"><span class="icon text-white-50"><i class="fas fa-minus-circle"></i> </span><span class="text">DROP</span></a></a>
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
                let checkedValues = [];

                const checkboxes = document.querySelectorAll('input[name="checkboxJadwal[]"]');
                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        if (this.checked) {
                            const value = parseInt(this.value);
                            checkedValues.push(value);
                            console.log("Array checkedValues saat ini:", checkedValues);

                        } 
                        else 
                        {
                            const index = checkedValues.indexOf(parseInt(this.value));
                            if (index !== -1) {
                                checkedValues.splice(index, 1);
                            }
                            console.log("Array checkedValues saat ini:", checkedValues);
                        }
                    });
                });

                $(document).ready(function() {
                $('#dropJadwal').on('click', function() {
                    if (checkedValues.length === 0) {
                        Swal.fire({
                            title: 'Peringatan!',
                            text: 'Tidak ada data yang dipilih untuk dihapus.',
                            icon: 'warning',
                            confirmButtonText: 'OK'
                        });
                    } else {
                        Swal.fire({
                            title: 'Apakah Anda yakin?',
                            text: "Data yang dipilih akan dihapus dan tidak bisa dikembalikan!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Ya, hapus!',
                            cancelButtonText: 'Tidak, batalkan'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $.ajax({
                                    url: '/admin/test-pendaftar/drop', 
                                    type: 'POST', 
                                    data: { checkedValues: checkedValues }, 
                                    success: function(response) {
                                        console.log('Success:', response);
                                        Swal.fire({
                                            title: 'Success!',
                                            text: 'Data berhasil dihapus.',
                                            icon: 'success',
                                            confirmButtonText: 'OK'
                                        }).then((result) => {
                                            window.location.reload();
                                        });
                                    },
                                    error: function(xhr, status, error) {
                                        console.log('Error:', error);
                                        Swal.fire({
                                            title: 'Error!',
                                            text: 'Terjadi kesalahan saat mencoba menghapus data.',
                                            icon: 'error',
                                            confirmButtonText: 'OK'
                                        });
                                    }
                                });
                            }
                        });
                    }
                });
            });
            </script>

            <script>
            $('#dataTablePendaftar').DataTable({
                language: {
                    emptyTable: "No data available in table"
                }
            });

        

            $(document).ready(function() {
                $('input[type="checkbox"]:not([name="checkAll"])').change(function() {
                    if($(this).is(':checked')) {
                        $(this).closest('tr').addClass('table-info');
                    } else {
                        $(this).closest('tr').removeClass('table-info');
                    }
                });

                $('input[name="checkAll"]').change(function() {
                    var isChecked = $(this).is(':checked');
                    $('input[name="checkboxJadwal[]"]').prop('checked', isChecked).change();
                });

                $('input[name="checkboxJadwal[]"]').change(function() {
                    if ($(this).is(':checked')) {
                        $(this).closest('tr').addClass('table-info');
                    } else {
                        $(this).closest('tr').removeClass('table-info');
                    }

                    var allChecked = $('input[name="checkboxJadwal[]"]').length === $('input[name="checkboxJadwal[]"]:checked').length;
                    $('input[name="checkAll"]').prop('checked', allChecked);
                });
            });
             </script>

       

