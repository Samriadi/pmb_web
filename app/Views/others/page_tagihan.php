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
            <h5 class="m-0 font-weight-bold text-primary">DATA TAGIHAN</h5>
            <h6 id="filterSubtitle" class="m-0 font-weight-bold text-primary"></h6>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Action</th>
                    <th>Nama Lengkap</th>
                    <th>Nomor Ujian</th>
                    <th>Status Pembayaran</th>
                    <th>Status Verifikasi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  foreach ($data as $dt) :
                    $isVerified = $dt->verified === "Verified";
                    $checkboxId = $dt->id;
                  ?>
                    <tr>
                      <td>
                        <div class="form-check">
                          <input type="checkbox" class="form-check-input" id="<?= $checkboxId ?>" name="checkboxes[]" value="<?= $dt->id ?>">
                          <label class="form-check-label" for="<?= $checkboxId ?>"></label>
                        </div>
                      </td>
                      <td><?= $dt->NamaLengkap ?></td>
                      <td><?= $dt->no_ujian ?></td>
                      <td><?= $dt->pay_status ?></td>
                      <td><?= $dt->verified ?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>

              </table>
              <button id="verifySelected" class="btn btn-primary" style="margin-bottom: 10px;">Verifikasi</button>


            </div>
          </div>
        </div>
        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <script>
          document.getElementById('verifySelected').addEventListener('click', function(event) {


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

                event.preventDefault();
                const checkboxes = document.querySelectorAll('input[name="checkboxes[]"]:checked');
                const ids = Array.from(checkboxes).map(checkbox => checkbox.value);

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
                      if (data) {
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
                      alert('Terjadi kesalahan pada server.');
                    });
                } else {
                  alert('Tidak ada data yang dipilih.');
                }
              }
            })
          });
        </script>


        <?php include '../app/Views/others/layouts/footer.php'; ?>
        </body>

        </html>