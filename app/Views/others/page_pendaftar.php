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
                        <h6 class="m-0 font-weight-bold text-primary">DATA PENDAFTAR</h6>
                    </div>
                    <div class="card-body">
                    <form id="filterForm" method="GET" action="">
                        <div class="row g-3 align-items-center mb-3">
                            <div class="col-auto">
                                <label for="filterColumn" class="col-form-label">Kolom</label>
                            </div>
                            <div class="col-auto">
                                <select class="form-control"  id="filterColumn" name="filterColumn">
                                    <option value="NamaLengkap">Nama Lengkap</option>
                                    <option value="Agama">Agama</option>
                                    <option value="jenkel">Jenis Kelamin</option>
                                    <option value="NamaAsalSekolah">Asal Sekolah</option>
                                    <option value="AsalProvinsi">Asal Provinsi</option>
                                </select>
                            </div>
                            <div class="col-auto">
                                <label for="filterValue" class="col-form-label">Nilai</label>
                            </div>
                            <div class="col-auto">
                                <input type="text" class="form-control" id="filterValue" name="filterValue" placeholder="Nilai Filter">
                            </div>
                            <div class="col-auto">
                                <button class="btn btn-primary" type="submit">Tampilkan</button>
                            </div>
                        </div>
                    </form>
                      

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Pilihan Pertama</th>
                                        <th>Pilihan Kedua</th>
                                        <th>Pilihan Ketiga</th>
                                        <th>Jenjang</th>
                                        <th>Periode</th>
                                        <th>Keterangan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $dt) :
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $dt->NamaLengkap ?></td>
                                            <td><?= $dt->PilihanPertama ?></td>
                                            <td><?= $dt->PilihanKedua ?></td>
                                            <td><?= $dt->PilihanKetiga ?></td>
                                            <td><?= $dt->jenjang ?></td>
                                            <td><?= $dt->periode ?></td>
                                            <td><?= $dt->keterangan ?></td>
                                            <td><a class="btn btn-secondary" href="#" onclick="edit(<?= $dt->userid; ?>)" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-info-circle"></i></a>
                                            </td>
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


                <?php include '../app/Views/others/layouts/footer.php'; ?>

