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
                        <h6 class="m-0 font-weight-bold text-primary">DATA USER</h6>
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
                                        <th>User Name</th>
                                        <th>User Level</th>
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
                                            <td><?= $dt->username ?></td>
                                            <td><?= $dt->user_level ?></td>
                                            <td><a class="btn btn-info" href="#" onclick="edit(<?= $dt->userid; ?>)" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-info-circle"></i></a>
                                                <a class="btn btn-danger" href="/hewi/public/user/delete/<?= $dt->userid; ?>" onclick="return confirm('yakin ingin hapus data?')"><i class="fas fa-trash"></i></a>
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
                                <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
                                <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">x
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_pass">User Pass</label>
                                    <input type="text" class="form-control" id="user_pass" name="user_pass" required>
                                </div>
                                <div class="form-group">
                                    <label for="user_level">User Level</label>
                                    <select class="form-control" id="user_level" name="user_level" required>
                                        <option value="superadmin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="user">User</option>
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
                                <div class="form-group">
                                    <input type="hidden" id="userid" name="userid">
                                </div>
                                <div class="form-group">
                                    <label for="editUsername">Username</label>
                                    <input type="text" class="form-control" id="editUsername" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="editUserpass">User Pass</label>
                                    <input type="text" class="form-control" id="editUserpass" name="user_pass" required>
                                </div>
                                <div class="form-group">
                                    <label for="editUserlevel">User Level</label>
                                    <select class="form-control" id="editUserlevel" name="user_level" required>
                                        <option value="superadmin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                        <option value="supervisor">Supervisor</option>
                                        <option value="user">User</option>
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



                <?php include '../app/Views/others/layouts/footer.php'; ?>




                <script>
                    function add() {

                        document.getElementById('save').addEventListener('click', function() {
                            var username = document.getElementById('username').value;
                            var user_pass = document.getElementById('user_pass').value;
                            var user_level = document.getElementById('user_level').value;

                            if (!username || !user_pass || !user_level) {
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Please fill in all fields.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                                return; // Menghentikan eksekusi jika ada input yang kosong
                            }

                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', '/hewi/public/user/add', true);
                            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    console.log(xhr.responseText);
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
                                "username=" + encodeURIComponent(username) +
                                "&user_pass=" + encodeURIComponent(user_pass) +
                                "&user_level=" + encodeURIComponent(user_level);
                            xhr.send(data);
                        });
                    }
                </script>

                <script>
                    // Fungsi untuk menampilkan data di modal edit
                    function edit(userid) {

                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', '/hewi/public/user/edit/' + userid, true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                var response = JSON.parse(xhr.responseText.trim());

                                document.getElementById('userid').value = response.userid;
                                document.getElementById('editUsername').value = response.username;
                                document.getElementById('editUserpass').value = response.user_pass;
                                document.getElementById('editUserlevel').value = response.user_level;

                                var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                                editModal.show();
                            }
                        };
                        xhr.send();
                    }

                    document.getElementById('update').addEventListener('click', function() {
                        var userid = document.getElementById('userid').value;
                        var username = document.getElementById('editUsername').value;
                        var user_pass = document.getElementById('editUserpass').value;
                        var user_level = document.getElementById('editUserlevel').value;


                        var xhr = new XMLHttpRequest();
                        xhr.open('POST', '/hewi/public/user/update', true);
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

                        var data =
                            "&userid=" + encodeURIComponent(userid) +
                            "&username=" + encodeURIComponent(username) +
                            "&user_pass=" + encodeURIComponent(user_pass) +
                            "&user_level=" + encodeURIComponent(user_level);

                        xhr.send(data);
                    });

                    var modalElement = document.getElementById('editModal');
                    modalElement.addEventListener('hidden.bs.modal', function() {
                        window.location.reload();
                    });
                </script>