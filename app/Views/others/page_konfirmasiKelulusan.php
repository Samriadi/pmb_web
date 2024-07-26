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
            <h6 class="m-0 font-weight-bold text-primary">DATA KELULUSAN TES</h6>
          </div>
          <div class="card-body">
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
                    $isLulus = $dt->kelulusan === "Yes";
                    $buttonClass = $isLulus ? 'btn-success' : 'btn-danger';
                    $buttonText = $isLulus ? 'Lulus' : 'Tidak Lulus';
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $dt->no_ujian ?></td>
                      <td><?= $dt->NamaLengkap ?></td>
                      <td>
                        <button class="btn btn-sm <?= $buttonClass ?>" onclick="KonfirmasiKelulusan(<?= $dt->id ?>)">
                          <?= $buttonText ?>
                        </button>
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
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
        </body>

        <?php include __DIR__ . '/layouts/footer.php'; ?>


        <script>
          function KonfirmasiKelulusan(id) {
            $.ajax({
              url: '/admin/kelulusan/prodi',
              type: 'POST',
              dataType: 'json',
              data: {
                id: id
              },
              success: function(response) {
                if (response.error) {
                  Swal.fire('Error', response.error, 'error');
                } else {
                  Swal.fire({
                    icon: 'question',
                    text: 'Pilih Program Studi!',
                    input: 'select',
                    showCancelButton: true,
                    inputOptions: {
                      prodi1: response.PilihanPertama,
                      prodi2: response.PilihanKedua,
                      prodi3: response.PilihanKetiga
                    },
                    customClass: {
                      input: 'inline-flex',
                    }
                  }).then((result) => {
                    if (result.isConfirmed) {
                      // Ambil nilai pilihan dari dropdown
                      const selectedKey = result.value;
                      const inputOptions = {
                        prodi1: response.PilihanPertama,
                        prodi2: response.PilihanKedua,
                        prodi3: response.PilihanKetiga
                      };
                      const selectedLabel = inputOptions[selectedKey];

                      // Tampilkan dialog konfirmasi
                      Swal.fire({
                        text: 'Konfirmasi, apakah Anda yakin ingin mengubah status kelulusan?',
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonText: 'Ya',
                        cancelButtonText: 'Batal'
                      }).then((confirmResult) => {
                        if (confirmResult.isConfirmed) {
                          console.log('Prodi pilihan:', selectedLabel);
                          console.log('id tagihan:', id);
                          const prodiLulus = selectedLabel;
                          const idTagihan = id;
                          const data = [{
                            prodiLulus: prodiLulus,
                            idTagihan: idTagihan,
                          }];
                          $.ajax({
                            url: '/admin/kelulusan/add',
                            method: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify({
                              data: data
                            }),
                            success: function(response) {
                              console.log('Success:', response);
                              Swal.fire({
                                text: 'Kelulusan berhasil diperbarui.',
                                icon: 'success',
                                timer: 1200,
                                showConfirmButton: false
                              }).then(() => {
                                window.location.reload();
                              });
                            },
                            error: function(error) {
                              console.error('Error:', error);
                            }
                          });
                        }
                      });
                    }
                  });
                }
              },

              error: function(xhr, status, error) {
                Swal.fire('Error', 'Something went wrong. Please try again.', 'error');
              }
            });
          }
        </script>