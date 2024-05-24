<?php include '../views/layouts/header.php'; ?>

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
              <h6 class="m-0 font-weight-bold text-primary">DATA PERIODE</h6>
         </div>
            <div class="card-body">
            <a class="btn btn-success btn-icon-split" href="#" onclick="add()" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-bottom: 15px;"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Add Data</span></a>
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Jenjang</th>
                        <th>Periode</th>
                        <th>From Date</th>
                        <th>To Date</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
		                <?php 
                        $no = 1;
                        foreach ($data as $dt): 
                        ?>
                        <tr>
                            <td><?=$no++?></td>
                            <td><?=$dt->Jenjang?></td>
                            <td><?=$dt->Periode?></td>
                            <td><?=$dt->fromDate?></td>
                            <td><?=$dt->toDate?></td>
                            <td><?=$dt->Keterangan?></td>
                            <td><?=$dt->status?></td>
                            <td><a class="btn btn-info" href="#" onclick="edit(<?= $dt->id; ?>)" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-info-circle"></i></a>
                            <a class="btn btn-danger" href="/hewi/public/test/delete/<?= $dt->id; ?>" onclick="return confirm('yakin ingin hapus data?')"><i class="fas fa-trash"></i></a>
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


  <!-- Modal Add -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x
                    </button>
                </div>
                <div class="modal-body">
                 <div class="form-group">
                    <label for="jenjang">Jenjang</label>
                        <select class="form-control" id="jenjang" name="jenjang" required>
                            <option value="S1">S1</option>
                            <option value="D3">D3</option>
                        </select>
                </div>
                <div class="form-group">
                    <label for="periode">Periode</label>
                    <input type="number" class="form-control" id="periode" name="periode" required>
                </div>
                <div class="form-group">
                    <label for="fromDate">From Date</label>
                    <input type="date" class="form-control" id="fromDate" name="fromDate" required>
                </div>
                <div class="form-group">
                    <label for="toDate">To Date</label>
                    <input type="date" class="form-control" id="toDate" name="toDate" required>
               </div>
               <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
               </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                            <option value="Open">Open</option>
                            <option value="Close">Close</option>
                    </select>
               </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
                </div>
            </div>
            </div>
  
<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data</h5>
               <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x
                </button>
            </div>
            <div class="modal-body">
            <input type="hidden" name="id" id="id">
                <div class="form-group">
                <label for="editGelombang">Gelombang</label>
                    <select class="form-control" id="editGelombang" name="gelombang" required>
                        <!-- Options will be filled dynamically -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="editRuang">Ruang</label>
                    <select class="form-control" id="editRuang" name="ruang" required>
                        <!-- Options will be filled dynamically -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="editJenisUjian">Jenis Ujian</label>
                    <select class="form-control" id="editJenisUjian" name="jenis_ujian" required>
                        <!-- Options will be filled dynamically -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="editTglUjian">Tanggal Ujian</label>
                    <input type="date" class="form-control" id="editTglUjian" name="tgl_ujian" required>
                </div>
                <div class="form-group">
                    <label for="editJamMulai">Jam Mulai</label>
                    <input type="time" class="form-control" id="editJamMulai" name="jam_mulai" required>
                </div>
                <div class="form-group">
                    <label for="editJamSelesai">Jam Selesai</label>
                    <input type="text" class="form-control" id="editJamSelesai" name="jam_selesai" required>
                </div>
                <div class="form-group">
                    <label for="editKeterangan">Keterangan</label>
                    <input type="text" class="form-control" id="editKeterangan" name="keterangan" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update">Save</button>
            </div>
        </div>
    </div>
</div>



<?php include '../views/layouts/footer.php'; ?>



<script>
function add() {
     document.getElementById('save').addEventListener('click', function() {
        var jenjang = document.getElementById('jenjang').value;
        var periode = document.getElementById('periode').value;
        var fromDate = document.getElementById('fromDate').value;
        var toDate = document.getElementById('toDate').value;
        var keterangan = document.getElementById('keterangan').value;
        var status = document.getElementById('status').value;

        console.log(jenjang);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/hewi/public/periode/add', true);        
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                // Lakukan sesuatu setelah data berhasil dikirim, seperti menutup modal
                var modal = document.getElementById('exampleModal');
                var modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
                    
                Swal.fire({
                        title: 'Success!',
                        text: xhr.responseText,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Refresh halaman
                        window.location.reload();
                    });
            }
        };

        // Kirim data yang ingin Anda kirimkan
         var data = 
         "jenjang=" + encodeURIComponent(jenjang) + 
         "&periode=" + encodeURIComponent(periode) + 
         "&fromDate=" + encodeURIComponent(fromDate) + 
         "&toDate=" + encodeURIComponent(toDate) + 
         "&keterangan=" + encodeURIComponent(keterangan) + 
         "&status=" + encodeURIComponent(status);
        xhr.send(data);
    });
    }
</script>

<script>
    // Fungsi untuk menampilkan data di modal edit
    function edit(id) {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/hewi/public/test/edit/'+id, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText.trim());

            document.getElementById('id').value = response.id;
            document.getElementById('editTglUjian').value = response.tgl_ujian;
            document.getElementById('editJamMulai').value = response.jam_mulai;
            document.getElementById('editJamSelesai').value = response.jam_selesai;
            document.getElementById('editKeterangan').value = response.keterangan;

            // Mengisi opsi select untuk gelombang
            var gelombangSelect = document.getElementById('editGelombang');
            response.gelombangValues.forEach(function(item) {
                var option = document.createElement('option');
                option.value = item.recid;
                option.text = item.jenjang_keterangan;
                if (!Array.from(gelombangSelect.options).some(opt => opt.value == item.recid)) {
                    gelombangSelect.appendChild(option);
                }
            });
            gelombangSelect.value = response.gelombang;

            // Mengisi opsi select untuk ruang
            var ruangSelect = document.getElementById('editRuang');
            response.ruangValues.forEach(function(item) {
                var option = document.createElement('option');
                option.value = item.recid;
                option.text = item.ruangan;
                if (!Array.from(ruangSelect.options).some(opt => opt.value == item.recid)) {
                    ruangSelect.appendChild(option);
                }
            });
            ruangSelect.value = response.ruang;

            // Mengisi opsi select untuk jenis ujian
            var jenisUjianSelect = document.getElementById('editJenisUjian');
            response.ujianValues.forEach(function(item) {
                var option = document.createElement('option');
                option.value = item.recid;
                option.text = item.jenis_ujian;
                if (!Array.from(jenisUjianSelect.options).some(opt => opt.value == item.recid)) {
                    jenisUjianSelect.appendChild(option);
                }
            });
            jenisUjianSelect.value = response.jenis_ujian;

            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }
    };
    xhr.send();
}

    document.getElementById('update').addEventListener('click', function() {
    var id = document.getElementById('id').value;
    var gelombang = document.getElementById('editGelombang').value;
    var ruang = document.getElementById('editRuang').value;
    var jenis_ujian = document.getElementById('editJenisUjian').value;
    var tgl_ujian = document.getElementById('editTglUjian').value;
    var jam_mulai = document.getElementById('editJamMulai').value;
    var jam_selesai = document.getElementById('editJamSelesai').value;
    var keterangan = document.getElementById('editKeterangan').value;

    console.log(gelombang);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/hewi/public/test/update', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            // Lakukan sesuatu setelah data berhasil dikirim, seperti menutup modal
            var modal = document.getElementById('editModal');
            var modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();

            Swal.fire({
            title: 'Success!',
            text: xhr.responseText,
            icon: 'success',
            confirmButtonText: 'OK',
            showCancelButton: false // Hide the cancel button
        }).then((result) => {
            // Check if the "OK" button was clicked
            if (result.isConfirmed) {
                // Add a delay before refreshing the page
                setTimeout(() => {
                    // Refresh the page
                    window.location.reload();
                }, 2000); // Adjust the delay time (in milliseconds) as needed
            }
        });

        }
    };

    // Kirim data yang ingin Anda kirimkan
    var data = 
        "id=" + encodeURIComponent(id) + 
        "&gelombang=" + encodeURIComponent(gelombang) + 
        "&ruang=" + encodeURIComponent(ruang) + 
        "&jenis_ujian=" + encodeURIComponent(jenis_ujian) + 
        "&tgl_ujian=" + encodeURIComponent(tgl_ujian) + 
        "&jam_mulai=" + encodeURIComponent(jam_mulai) + 
        "&jam_selesai=" + encodeURIComponent(jam_selesai) + 
        "&keterangan=" + encodeURIComponent(keterangan);
        
    xhr.send(data);
});


    var modalElement = document.getElementById('editModal');
    modalElement.addEventListener('hidden.bs.modal', function () {
        window.location.reload();
    });
</script>

