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
                        <h6 class="m-0 font-weight-bold text-primary">DATA VAR OPTION</h6>
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
                                        <th>Rec Id</th>
                                        <th>Var Name</th>
                                        <th>Var Value</th>
                                        <th>Var Others</th>
                                        <th>Catatan</th>
                                        <th>Parent</th>
                                        <th style="width: 100px;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $dt) :
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $dt->recid ?></td>
                                            <td><?= $dt->var_name ?></td>
                                            <td><?= $dt->var_value ?></td>
                                            <td><?= $dt->var_others ?></td>
                                            <td><?= $dt->catatan ?></td>
                                            <td><?= $dt->parent ?></td>
                                            <td><a class="btn btn-info" href="#" onclick="edit(<?= $dt->recid; ?>)" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-info-circle"></i></a>
                                                <?php if ($dt->disabled == true) { ?>
                                                    <a class="btn btn-danger disabled"><i class="fas fa-trash"></i></a>
                                                <?php } else { ?>
                                                    <a class="btn btn-danger" href="/var/delete?id=<?= $dt->recid; ?>" onclick="return confirm('yakin ingin hapus data?')"><i class="fas fa-trash"></i></a>
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
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="varname">Var Name</label>
                                    <input type="text" class="form-control" id="varname" name="varname" required>
                                </div>
                                <div class="form-group">
                                    <label for="varvalue">Var Value</label>
                                    <input type="text" class="form-control" id="varvalue" name="varvalue" required>
                                </div>
                                <div class="form-group">
                                    <label for="varothers">Var Others</label>
                                    <input type="text" class="form-control" id="varothers" name="varothers" required>
                                </div>
                                <div class="form-group">
                                    <label for="catatan">Catatan</label>
                                    <input type="text" class="form-control" id="catatan" name="catatan" required>
                                </div>
                                <div class="form-group">
                                    <label for="parent">Parent</label>
                                    <input type="number" class="form-control" id="parent" name="parent" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="recid" name="recid">
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



                <?php include __DIR__ . '/layouts/footer.php'; ?>



                <script>
                    function add() {

                        document.getElementById('save').addEventListener('click', function() {
                            var recid = document.getElementById('recid').value;
                            var varname = document.getElementById('varname').value;
                            var varvalue = document.getElementById('varvalue').value;
                            var varothers = document.getElementById('varothers').value;
                            var catatan = document.getElementById('catatan').value;
                            var parent = document.getElementById('parent').value;

                            console.log(recid);
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '/pmb_web/var/add', true);
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
                                "recid=" + encodeURIComponent(recid) +
                                "&varname=" + encodeURIComponent(varname) +
                                "&varvalue=" + encodeURIComponent(varvalue) +
                                "&varothers=" + encodeURIComponent(varothers) +
                                "&catatan=" + encodeURIComponent(catatan) +
                                "&parent=" + encodeURIComponent(parent);
                            xhr.send(data);
                        });
                    }
                </script>

                <script>
                    // Fungsi untuk menampilkan data di modal edit
                    function edit(id) {
                        console.log(id)
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', '/pmb_web/var/edit?recid=' + id, true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {


                                var response = JSON.parse(xhr.responseText.trim());

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
                        xhr.open('POST', '/pmb_web/var/update', true);
                        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState === 4 && xhr.status === 200) {
                                console.log(xhr.responseText);
                                var modal = document.getElementById('editModal');
                                var modalInstance = bootstrap.Modal.getInstance(modal);
                                modalInstance.hide();

                                Swal.fire({
                                    title: 'Success!',
                                    text: xhr.responseText,
                                    icon: 'success',
                                    confirmButtonText: 'OK',
                                    showCancelButton: false
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        setTimeout(() => {
                                            window.location.reload();
                                        }, 2000);
                                    }
                                });

                            }
                        };

                        // Kirim data yang ingin Anda kirimkan  // Kirim data yang ingin Anda kirimkan
                        var data = "recid=" + encodeURIComponent(recid) + "&varname=" + encodeURIComponent(varname) + "&varvalue=" + encodeURIComponent(varvalue) + "&varothers=" + encodeURIComponent(varothers) + "&catatan=" + encodeURIComponent(catatan) + "&parent=" + encodeURIComponent(parent);
                        xhr.send(data);
                    });


                    var modalElement = document.getElementById('editModal');
                    modalElement.addEventListener('hidden.bs.modal', function() {
                        window.location.reload();
                    });
                </script>