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
              <h6 class="m-0 font-weight-bold text-primary">DATA MAIN</h6>
         </div>
            <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>Nama Lengkap Kampus</th>
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
                        foreach ($data as $dt): 
                        ?>
                        <tr>
                            <td><?=$dt->nama_lengkap_kampus?></td>
                            <td><?=$dt->nama_singkat?></td>
                            <td><?=$dt->jalan?></td>
                            <td><?=$dt->kota?></td>
                            <td><?=$dt->provinsi?></td>
                            <td><?=$dt->negara?></td>
                            <td><?=$dt->kode_warna_utama?></td>
                          
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

<?php include '../views/layouts/footer.php'; ?>


