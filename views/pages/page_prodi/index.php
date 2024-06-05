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
              <h6 class="m-0 font-weight-bold text-primary">DATA PRODI</h6>
         </div>
            <div class="card-body">
            <a class="btn btn-success btn-icon-split" href="#" onclick="add()" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-bottom: 15px;"><span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                        <span class="text">Add Data</span></a>

            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Program Studi</th>
                        <th>Jenjang</th>
                        <th>Fakultas</th>
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
                            <td><?=$dt->var_value?></td>
                            <td><?=$dt->var_others?></td>

                            <?php 
                            if (isset($varData[$dt->recid])):
                            foreach ($varData[$dt->recid] as $var): ?>
                            <td><?=htmlspecialchars($var->var_value);?></td>
                            <?php 
                            endforeach;
	                        endif;
                            ?>
                            <td><a class="btn btn-info" href="#" onclick="edit(<?= $dt->recid; ?>)" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-info-circle"></i></a>
                           <?php if($dt->disabled == true){ ?>
                            <a class="btn btn-danger disabled"><i class="fas fa-trash"></i></a>
                            <?php } else { ?>
                            <a class="btn btn-danger" href="/hewi/public/var/delete/<?= $dt->recid; ?>" onclick="return confirm('yakin ingin hapus data?')"><i class="fas fa-trash"></i></a>
                            <?php } ?>
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
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Prodi</h5>
                     <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x
                </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" class="form-control" id="varname" name="varname" value="Prodi">
               <div class="form-group">
                    <label for="varvalue">Nama Prodi</label>
                    <input type="text" class="form-control" id="varvalue" name="varvalue" required>
                </div>
                <div class="form-group">
                    <label for="varothers">Jenjang</label>
                    <select class="form-control" id="varothers" name="varothers" required>
                   
                    </select>
                </div>
                <div class="form-group">
                    <label for="parent">Fakultas</label>
                    <select class="form-control" id="parent" name="parent" required>
                            
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
                    <input type="hidden" class="form-control" id="recid" name="recid" required>
                <div class="form-group">
                    <label for="editVarvalue">Nama Fakultas</label>
                    <input type="text" class="form-control" id="editVarvalue" name="varvalue" required>
                </div>
                <div class="form-group">
                    <label for="editVarothers">Kode Fakultas</label>
                    <input type="text" class="form-control" id="editVarothers" name="varothers" required>
                </div>
                <div class="form-group">
                    <label for="editParent">Nama Kampus</label>
                    <select class="form-control" id="editParent" name="Kampus" required>
                       
                    </select>
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
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/hewi/public/prodi/add', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);

            // Mengisi opsi select
            var jenjangValues = document.getElementById('varothers');
            response.jenjangValues.forEach(function(item) {
                var option = document.createElement('option');
                option.value = item.var_value;
                option.text = item.var_value;
                if (!Array.from(jenjangValues.options).some(opt => opt.value == item.var_value)) {
                    jenjangValues.appendChild(option);
                }
            });
            jenjangValues.value = response.jenjang;

            var fakultasValues = document.getElementById('parent');
            response.fakultasValues.forEach(function(item) {
                var option = document.createElement('option');
                option.value = item.recid;
                option.text = item.var_value;
                if (!Array.from(fakultasValues.options).some(opt => opt.value == item.var_value)) {
                    fakultasValues.appendChild(option);
                }
            });
            fakultasValues.value = response.fakultas;

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
        var varname = document.getElementById('varname').value;
        var varvalue = document.getElementById('varvalue').value;
        var varothers = document.getElementById('varothers').value;
        var parent = document.getElementById('parent').value;
        
        console.log(parent);
        if (!varname || !varvalue || !varothers || !parent) {
        Swal.fire({
            title: 'Error!',
            text: 'Please fill in all fields.',
            icon: 'error',
            confirmButtonText: 'OK'
        });
        return; 
        }
           
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/hewi/public/prodi/save', true);        
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                // Lakukan sesuatu setelah data berhasil dikirim, seperti menutup modal
                var modal = document.getElementById('exampleModal');
                var modalInstance = bootstrap.Modal.getInstance(modal);
                    
                Swal.fire({
                    title: 'Success!',
                    text: 'Data Berhasil Ditambahkan',
                    icon: 'success',
                    confirmButtonText: 'OK',

                    showCancelButton: false 
                }).then((result) => {
                    modalInstance.hide();
                    });
            }
        };

        // Kirim data yang ingin Anda kirimkan
         var data = 
         "&varname=" + encodeURIComponent(varname) + 
         "&varvalue=" + encodeURIComponent(varvalue) + 
         "&varothers=" + encodeURIComponent(varothers) + 
         "&parent=" + encodeURIComponent(parent);
        xhr.send(data);
    });
</script>

<script>
    // Fungsi untuk menampilkan data di modal edit
    function edit(id) {


    var kampus = document.getElementById('editParent').name;
    
    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/hewi/public/fakultas/edit/'+id + '/include/' + kampus, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText.trim());

            document.getElementById('recid').value = response.recid;
            document.getElementById('editVarvalue').value = response.var_value;
            document.getElementById('editVarothers').value = response.var_others;

            if (response && response.kampusValues) {
                var kampusSelect = document.getElementById('editParent');
                kampusSelect.innerHTML = ''; // Bersihkan opsi sebelumnya

                response.kampusValues.forEach(function(item) {
                    var option = document.createElement('option');
                    option.value = item.recid;
                    option.text = item.var_value;

                    // Tambahkan opsi ke elemen select
                    kampusSelect.appendChild(option);
                });

                // Set nilai default pada elemen select
                kampusSelect.value = response.parent; // Mengatur nilai default dari response.parent

                // Jika nilai default tidak ada dalam opsi, tambahkan opsi default
                if (!Array.from(kampusSelect.options).some(opt => opt.value == response.parent)) {
                    var defaultOption = document.createElement('option');
                    defaultOption.value = response.parent;
                    defaultOption.text = response.var_value; // Teks yang sesuai
                    defaultOption.selected = true;
                    kampusSelect.appendChild(defaultOption);
                }
            } else {
                console.error("Properti kampusValues tidak ditemukan dalam respons atau respons tidak terdefinisi.");
            }

            var editModal = new bootstrap.Modal(document.getElementById('editModal'));
            editModal.show();
        }
    };
    xhr.send();
    }

    document.getElementById('update').addEventListener('click', function() {
        var recid = document.getElementById('recid').value;
        var varvalue = document.getElementById('editVarvalue').value;
        var varothers = document.getElementById('editVarothers').value;
        var parent = document.getElementById('editParent').value;

    console.log(recid);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/hewi/public/fakultas/update', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
            // Lakukan sesuatu setelah data berhasil dikirim, seperti menutup modal
            var modal = document.getElementById('editModal');
            var modalInstance = bootstrap.Modal.getInstance(modal);

            Swal.fire({
                title: 'Success!',
                text: 'Data Berhasil Diubah',
                icon: 'success',
                confirmButtonText: 'OK',

                showCancelButton: false 
            }).then((result) => {
                    modalInstance.hide();
                });
        }
    };

    // Kirim data yang ingin Anda kirimkan  // Kirim data yang ingin Anda kirimkan
        var data = 
        "&recid=" + encodeURIComponent(recid) + 
        "&varvalue=" + encodeURIComponent(varvalue) + 
        "&varothers=" + encodeURIComponent(varothers) + 
        "&parent=" + encodeURIComponent(parent);
        xhr.send(data);
    });


    var modalElement = document.getElementById('editModal');
    modalElement.addEventListener('hidden.bs.modal', function () {
        window.location.reload();
    });
</script>

