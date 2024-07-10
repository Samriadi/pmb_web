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
                        <h6 class="m-0 font-weight-bold text-primary">PENDAFTAR TERVERIFIKASI</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Check</th>
                        <th>Nama Lengkap</th>
                        <th>Nomor Ujian</th>
                        <th>Jenis</th>
                        <th>Jenjang</th>
                        <th>Prodi 1</th>
                        <th>Prodi 2</th>
                        <th>Prodi 3</th>
                        <th>Periode</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    foreach ($PendaftarVerified as $dt) :
                        $isVerified = $dt->verified === "Verified";
                        $checkboxId = $dt->member_id;
                    ?>
                        <tr>
                        <td>
                            <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="<?= $checkboxId ?>" name="checkboxes[]" value="<?= $dt->member_id ?>">
                            <label class="form-check-label" for="<?= $checkboxId ?>"></label>
                            </div>
                        </td>
                        <td><?= $dt->NamaLengkap ?></td>
                        <td><?= $dt->no_ujian ?></td>
                        <td><?= $dt->jenis ?></td>
                        <td><?= $dt->jenjang ?></td>
                        <td><?= $dt->Prodi1 ?></td>
                        <td><?= $dt->Prodi2 ?></td>
                        <td><?= $dt->Prodi3 ?></td>
                        <td><?= $dt->Periode ?></td>
                        </tr>
                    <?php endforeach ?>
                    </tbody>

                  </table>
                  <button id="addTest" data-bs-target="#exampleModal" data-bs-toggle="modal" class="btn btn-primary mt-3" style="margin-bottom: 10px;">BUAT JADWAL TES</button>

                        </div>

                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">JADWAL TES PENDAFTAR</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTablePendaftar" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Lokasi</th>
                        <th>Pendaftar</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $no = 1;
                    foreach ($mergedDataTestPendaftar as $dt) :
                    ?>
                        <tr>
                            <td><?php echo htmlspecialchars($dt->test_tanggal); ?></td>
                            <td><?php echo htmlspecialchars($dt->test_mulai); ?></td>
                            <td><?php echo htmlspecialchars($dt->test_selesai); ?></td>
                            <td><?php echo htmlspecialchars($dt->test_lokasi); ?></td>
                            <td><?php echo implode(', ', $dt->test_memberid); ?></td>

                        </tr>
                    <?php endforeach ?>
                    </tbody>
                  </table>
                        </div>
                    </div>
                </div>


                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="max-width: 50%;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Buat Jadwal Test</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                <div id="liveAlertPlaceholder"></div>
                                        <div class="input-group mb-4">
                                        <span class="input-group-text">Pendaftar</span>
                                        <textarea class="form-control" id="pendaftar" name="pendaftar" rows="1"></textarea>
                                        <input type="hidden" name="member_id" id="member_id"></input>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                    <span class="input-group-text">Tanggal</span>
                                    <input type="date" class="form-control" id="test_tanggal" name="test_tanggal">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">Waktu Mulai dan Selesai</span>
                                        <input type="time" class="form-control" id="test_mulai" name="test_mulai">
                                        <input type="time" class="form-control" id="test_selesai" name="test_selesai">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group mb-4">
                                        <span class="input-group-text">Lokasi</span>
                                        <textarea class="form-control" id="test_lokasi" name="test_lokasi"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="save">Save changes</button>
                            </div>
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

            var pendaftar =<?php echo json_encode($JadwalTestPendaftar); ?>;
            console.log("🚀 ~ pendaftar:", pendaftar)

            
                document.getElementById('addTest').addEventListener('click', function(event) {
                    event.preventDefault();

                    const data = <?php echo json_encode($PendaftarVerified); ?>;
                    console.log("🚀 ~ document.getElementById ~ data:", data)
                    const checkboxes = document.querySelectorAll('input[name="checkboxes[]"]:checked');
                    const checked = Array.from(checkboxes).map(checkbox => parseInt(checkbox.value));   

                    const filterData = checked.map(member_id => {
                        const found = data.find(d => parseInt(d.member_id) === member_id); 
                        return found;
                    });

                    const formatData = filterData.map((item, index) => `${index + 1}. ${item.no_ujian} - ${item.NamaLengkap}`);
                    const selectedData = formatData.join('\n');

                    document.getElementById('member_id').value = checked;
                    
                    if (checked.length > 0) {
                        document.getElementById('pendaftar').value = selectedData;

                        var numRows = Math.min(selectedData.split('\n').length, 10);
                        
                        document.getElementById('pendaftar').rows = numRows;
                    } else {
                        appendAlert('Tidak ada pendaftar yang dipilih', 'danger');
                    }



                    var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'));
                    exampleModal.show();
                    
                })

                document.getElementById('save').addEventListener('click', function() {
                    var member_ids_raw = document.getElementById('member_id').value.trim();
                    var member_ids = member_ids_raw ? member_ids_raw.split(',') : null;

                    var test_tanggal = document.getElementById('test_tanggal').value;
                    var test_mulai = document.getElementById('test_mulai').value;
                    var test_selesai = document.getElementById('test_selesai').value;
                    var test_lokasi = document.getElementById('test_lokasi').value;

                    test_selesai = test_selesai ? test_selesai : 'Sampai selesai';


                    var xhr = new XMLHttpRequest();
                    xhr.open('POST', '/admin/test-pendaftar/add', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState == 4) {
                            if (xhr.status == 200) {
                                console.log(xhr.responseText);

                                var response = JSON.parse(xhr.responseText);
                                console.log("🚀 ~ document.getElementById ~ response:", response)
                                if (response.status='success') {
                                    var modal = document.getElementById('exampleModal');
                                    var modalInstance = bootstrap.Modal.getInstance(modal);

                                    Swal.fire({
                                        title: 'Success!',
                                        text: 'Data Berhasil Ditambahkan',
                                        icon: 'success',
                                        confirmButtonText: 'OK',
                                        showCancelButton: false
                                    }).then((result) => {
                                        if (modalInstance) {
                                            modalInstance.hide();
                                            window.location.reload();
                                        }
                                    });
                                } else {
                                    Swal.fire({
                                        title: 'Failed!',
                                        text: 'Gagal menambahkan data',
                                        icon: 'error',
                                        confirmButtonText: 'OK',
                                        showCancelButton: false
                                    });
                                }
                            } else {
                                console.error('Request failed with status:', xhr.status);
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Terjadi kesalahan saat menambahkan data',
                                    icon: 'error',
                                    confirmButtonText: 'OK',
                                    showCancelButton: false
                                });
                            }
                        }
                    };

                    if (member_ids===null) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Pastikan telah memilih pendaftar',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            showCancelButton: false
                        });
                    }
                    else if (test_tanggal && test_mulai && test_selesai && test_lokasi) {
                        var data = '';
                        member_ids.forEach(function(member_id) {
                            data += "member_id[]=" + encodeURIComponent(member_id) + "&";
                        });
                        data += "test_tanggal=" + encodeURIComponent(test_tanggal) +
                                "&test_mulai=" + encodeURIComponent(test_mulai) +
                                "&test_selesai=" + encodeURIComponent(test_selesai) +
                                "&test_lokasi=" + encodeURIComponent(test_lokasi);

                        xhr.send(data);
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Pastikan semua kolom telah diisi',
                            icon: 'error',
                            confirmButtonText: 'OK',
                            showCancelButton: false
                        });
                    }


                });
            </script>

            <script>
                const alertPlaceholder = document.getElementById('liveAlertPlaceholder')
                const appendAlert = (message, type) => {
                const wrapper = document.createElement('div')
                wrapper.innerHTML = [
                    `<div class="alert alert-${type} alert-dismissible" role="alert">`,
                    `   <div>${message}</div>`,
                    '</div>'
                ].join('')

                alertPlaceholder.append(wrapper)
                }
            </script>

            <script>
            $('#dataTablePendaftar').DataTable({
                language: {
                    emptyTable: "No data available in table"
                }
            });

            $('#dataTable').DataTable({
                language: {
                    emptyTable: "No data available in table"
                }
            });

            $(document).ready(function() {
                $('input[type="checkbox"]').change(function() {
                    if($(this).is(':checked')) {
                        $(this).closest('tr').addClass('table-info');
                    } else {
                        $(this).closest('tr').removeClass('table-info');
                    }
                });
            });
             </script>

       

