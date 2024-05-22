<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  </head>

  <body>
    <div class="container-fluid" style="padding: 50px;">
            <!-- Button trigger modal -->
        <div class="card">
            <div class="card-body">
            <td><a class="btn btn-primary" href="#" onclick="add()" data-bs-toggle="modal" data-bs-target="#exampleModal">Add</a>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Gelombang</th>
                        <th scope="col">Ruang</th>
                        <th scope="col">Jenis Ujian</th>
                        <th scope="col">Tanggal Ujian</th>
                        <th scope="col">Jam Mulai</th>
                        <th scope="col">Jam Selesai</th>
                        <th scope="col">Keterangan</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
		                <?php 
                        $no = 1;
                        foreach ($data as $dt): 
                        error_reporting(0);
                            $periodes = $models->showGelombang($dt->gelombang);
                            foreach ($periodes as $periode) {
                                $d_jenjang=$periode->Jenjang;
                                $d_keterangan=$periode->Keterangan;
                            }

                            $ruangs = $models->showRuang($dt->ruang);
                            foreach ($ruangs as $periode) {
                                $d_ruang=$periode->var_value;
                            }

                            $ujians = $models->showUjian($dt->jenis_ujian);
                            foreach ($ujians as $ujian) {
                                $d_ujian=$ujian->var_value;
                            }

                        ?>
                        <tr>
                            <th scope="row"><?=$no++?></th>
                            <td><?=$d_jenjang?> - <?=$d_keterangan?></td>
                            <td><?=$d_ruang?></td>
                            <td><?=$d_ujian?></td>
                            <td><?=$dt->tgl_ujian?></td>
                            <td><?=$dt->jam_mulai?></td>
                            <td><?=$dt->jam_selesai?></td>
                            <td><?=$dt->keterangan?></td>
                            <td><a class="btn btn-warning" href="#" onclick="edit(<?= $dt->id; ?>)" data-bs-toggle="modal" data-bs-target="#editModal">Edit</a>
                            <a class="btn btn-danger" href="/hewi/public/test/delete/<?= $dt->id; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a>
                            </td>
                        </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>  
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>


  <!-- Modal Add -->

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 <div class="form-group">
                 <div class="form-group">
                    <label for="gelombang">Gelombang</label>
                        <select class="form-control" id="gelombang" name="gelombang">
                            <!-- Options will be filled dynamically -->
                        </select>
                </div>
                </div>
                <div class="form-group">
                <label for="ruang">Ruang</label>
                        <select class="form-control" id="ruang" name="ruang">
                            <!-- Options will be filled dynamically -->
                        </select>
                </div>
                <div class="form-group">
                <label for="jenis_ujian">Jenis Ujian</label>
                        <select class="form-control" id="jenis_ujian" name="jenis_ujian">
                            <!-- Options will be filled dynamically -->
                        </select>
                </div>
                <div class="form-group">
                    <label for="tgl_ujian">Tanggal Ujian</label>
                    <input type="date" class="form-control" id="tgl_ujian" name="tgl_ujian" required>
                </div>
                <div class="form-group">
                    <label for="jam_mulai">Jam Mulai</label>
                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" required>
                </div>
                <div class="form-group">
                    <label for="jam_selesai">Jam Selesai</label>
                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" required>
               </div>
               <div class="form-group">
                    <label for="keterangan">Keterangan</label>
                    <input type="text" class="form-control" id="keterangan" name="keterangan" required>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
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


</html>

<script>
function add() {
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/hewi/public/test/add', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);

            // Mengisi opsi select untuk gelombang
            var gelombangSelect = document.getElementById('gelombang');
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
            var ruangSelect = document.getElementById('ruang');
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
            var jenisUjianSelect = document.getElementById('jenis_ujian');
            response.ujianValues.forEach(function(item) {
                var option = document.createElement('option');
                option.value = item.recid;
                option.text = item.jenis_ujian;
                if (!Array.from(jenisUjianSelect.options).some(opt => opt.value == item.recid)) {
                    jenisUjianSelect.appendChild(option);
                }
            });
            jenisUjianSelect.value = response.jenis_ujian;

            // Tampilkan modal
            var exampleModal = new bootstrap.Modal(document.getElementById('exampleModal'));
            exampleModal.show();
        }
    };
    xhr.send();

    var exampleModal = document.getElementById('exampleModal');
    exampleModal.addEventListener('hidden.bs.modal', function () {
        window.location.reload();
    });
}

    document.getElementById('save').addEventListener('click', function() {
        var gelombang = document.getElementById('gelombang').value;
        var ruang = document.getElementById('ruang').value;
        var jenis_ujian = document.getElementById('jenis_ujian').value;
        var tgl_ujian = document.getElementById('tgl_ujian').value;
        var jam_mulai = document.getElementById('jam_mulai').value;
        var jam_selesai = document.getElementById('jam_selesai').value;
        var keterangan = document.getElementById('keterangan').value;

        console.log(gelombang);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/hewi/public/test/save', true); // Ubah URL di sini
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
        "gelombang=" + encodeURIComponent(gelombang) + 
        "&ruang=" + encodeURIComponent(ruang) + 
        "&jenis_ujian=" + encodeURIComponent(jenis_ujian) + 
        "&tgl_ujian=" + encodeURIComponent(tgl_ujian) + 
        "&jam_mulai=" + encodeURIComponent(jam_mulai) + 
        "&jam_selesai=" + encodeURIComponent(jam_selesai) + 
        "&keterangan=" + encodeURIComponent(keterangan);
        xhr.send(data);
    });

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
                confirmButtonText: 'OK'
            }).then(() => {
                // Refresh halaman
                window.location.reload();
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

