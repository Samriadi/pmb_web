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
            <h6 class="m-0 font-weight-bold text-primary">DATA NIM</h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Nama Lengkap</th>
                    <th>Prodi</th>
                    <th>Angkatan</th>
                    <th>Jenjang</th>
                    <th>Kategori</th>
                    <th>Jenis</th>
                    <th>NIM</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($data as $dt) :
                  ?>
                    <tr>
                      <td><?= $dt['NamaLengkap'] ?></td>
                      <td><?= $dt['prodi'] ?></td>
                      <td><?= $dt['angkatan'] ?></td>
                      <td><?= $dt['jenjang'] ?></td>
                      <td><?= $dt['kategori'] ?></td>
                      <td><?= $dt['jenis'] ?></td>
                      <td><?= $dt['nim'] ?></td>
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