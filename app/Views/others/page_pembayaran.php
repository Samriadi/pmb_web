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
                <!-- <div class="card shadow mb-5">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DATA PEMBAYARAN</h6>
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
                              
                            </tbody>
                            </table>
                        <a id="addTest" data-bs-target="#exampleModal" data-bs-toggle="modal" class="btn btn-success btn-icon-split mb-3 mt-3"><span class="icon text-white-50"><i class="fas fa-plus-circle"></i> </span><span class="text">JADWAL TES</span></a></a>
                    </div>
                </div>
            </div> -->

                <!-- <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DATA NIM</h6>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-bordered" id="dataTablePendaftar" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Action</th>
                        <th>Tanggal</th>
                        <th>Mulai</th>
                        <th>Selesai</th>
                        <th>Lokasi</th>
                        <th>Pendaftar</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                  <a id="dropJadwal" class="btn btn-primary btn-icon-split mb-3 mt-3"><span class="icon text-white-50"><i class="fas fa-minus-circle"></i> </span><span class="text">DROP</span></a></a>
                    </div>
                    </div>
                </div> -->

                
              
            </div>
            <!-- Option 1: Bootstrap Bundle with Popper -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    

            </body>


            <?php include '../app/Views/others/layouts/footer.php'; ?>

            <script>

            var NimS1FarmasiTransfer = <?php echo json_encode($NimS1FarmasiTransfer); ?>;
            console.log("🚀 ~ NimS1FarmasiTransfer:", NimS1FarmasiTransfer);
            var NimS1FarmasiRegular = <?php echo json_encode($NimS1FarmasiRegular); ?>;
            console.log("🚀 ~ NimS1FarmasiRegular:", NimS1FarmasiRegular);



            </script>

       

