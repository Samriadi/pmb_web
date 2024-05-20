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
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add Data
            </button>
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
                                 <a class="btn btn-danger" href="action_delvar.php?id=<?= $dt->id; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a></td>
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
  <?php
  require_once 'models.php';
  $models = new dataModel();  
  $gelombang = $models->getGelombang(); 
  $ruang = $models->getRuang(); 
  $jenis_ujian = $models->getUjian(); 
  ?>
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 <div class="form-group">
                 <label for="gelombang">Gelombang</label>
                 <select  class="form-control" id="gelombang" name="gelombang">
                 <?php foreach ($gelombang as $dt): ?>
                    <option value="<?=$dt->recid?>"><?= $dt->Jenjang?> - <?= $dt->Keterangan?></option>
                <?php endforeach; ?>
                </select>
                </div>
                <div class="form-group">
                <label for="ruang">Ruang</label>
                 <select  class="form-control" id="ruang" name="ruang">
                 <?php foreach ($ruang as $dt): ?>
                    <option value="<?=$dt->recid?>"><?= $dt->var_value?></option>
                <?php endforeach; ?>
                </select>
                </div>
                <div class="form-group">
                <label for="jenis_ujian">Jenis Ujian</label>
                 <select  class="form-control" id="jenis_ujian" name="jenis_ujian">
                 <?php foreach ($jenis_ujian as $dt): ?>
                    <option value="<?=$dt->recid?>"><?= $dt->var_value?></option>
                <?php endforeach; ?>
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
                <div class="form-group">
                    <label for="editRecid">RecID</label>
                    <input type="text" class="form-control" id="editRecid" name="recid" required>
                </div>
                <div class="form-group">
                    <label for="editVarname">Var Name</label>
                    <input type="text" class="form-control" id="editVarname" name="varname" required>
                </div>
                <div class="form-group">
                    <label for="editVarvalue">Var Value</label>
                    <input type="text" class="form-control" id="editVarvalue" name="varvalue" required>
                </div>
                <div class="form-group">
                    <label for="editVarothers">Var Others</label>
                    <input type="text" class="form-control" id="editVarothers" name="varothers" required>
                </div>
                <div class="form-group">
                    <label for="editCatatan">Catatan</label>
                    <input type="text" class="form-control" id="editCatatan" name="catatan" required>
                </div>
                <div class="form-group">
                    <label for="editParent">Parent</label>
                    <input type="number" class="form-control" id="editParent" name="parent" required>
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
        xhr.open('POST', 'action_addtest.php', true);
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
        "&gelombang=" + encodeURIComponent(gelombang) + "&ruang=" + encodeURIComponent(ruang) + "&jenis_ujian=" + encodeURIComponent(jenis_ujian) + "&tgl_ujian=" + encodeURIComponent(tgl_ujian) + "&jam_mulai=" + encodeURIComponent(jam_mulai) + "&jam_selesai=" + encodeURIComponent(jam_selesai)+ "&keterangan=" + encodeURIComponent(keterangan);
        xhr.send(data);

    });
</script>

<script>
    // Fungsi untuk menampilkan data di modal edit
    function edit(recid) {
        // Lakukan request AJAX untuk mengambil data berdasarkan recid
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'action_getvar.php?recid=' + recid, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);

                document.getElementById('editRecid').value = response.recid;
                document.getElementById('editVarname').value = response.var_name;
                document.getElementById('editVarvalue').value = response.var_value;
                document.getElementById('editVarothers').value = response.var_others;
                document.getElementById('editCatatan').value = response.catatan;
                document.getElementById('editParent').value = response.parent;

                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                editModal.show();
            }
        };
        xhr.send();
    }

    document.getElementById('update').addEventListener('click', function() {
        var recid = document.getElementById('editRecid').value;
        var varname = document.getElementById('editVarname').value;
        var varvalue = document.getElementById('editVarvalue').value;
        var varothers = document.getElementById('editVarothers').value;
        var catatan = document.getElementById('editCatatan').value;
        var parent = document.getElementById('editParent').value;

        console.log(recid);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_editvar.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
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
        var data = "recid=" + encodeURIComponent(recid) + "&varname=" + encodeURIComponent(varname) + "&varvalue=" + encodeURIComponent(varvalue) + "&varothers=" + encodeURIComponent(varothers) + "&catatan=" + encodeURIComponent(catatan) + "&parent=" + encodeURIComponent(parent);
        xhr.send(data);
    });

    var modalElement = document.getElementById('editModal');
    modalElement.addEventListener('hidden.bs.modal', function () {
        window.location.reload();
    });
</script>

