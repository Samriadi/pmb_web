<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  </head>

  <body>
    <div class="container">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            ADD
            </button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                 <div class="form-group">
                    <label for="recid">RecID</label>
                    <input type="text" class="form-control" id="recid" name="recid" required>
                </div>
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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="save">Save changes</button>
                </div>
                </div>
            </div>
            </div>
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">No</th>
                        <th scope="col">Rec Id</th>
                        <th scope="col">Var Name</th>
                        <th scope="col">Var Value</th>
                        <th scope="col">Var Others</th>
                        <th scope="col">Catatan</th>
                        <th scope="col">Parent</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
		                <?php 
                        $no = 1;
                        foreach ($data as $dt): 
                        ?>
                        <tr>
                            <th scope="row"><?=$no++?></th>
                            <td><?=$dt->recid?></td>
                            <td><?=$dt->var_name?></td>
                            <td><?=$dt->var_value?></td>
                            <td><?=$dt->var_others?></td>
                            <td><?=$dt->catatan?></td>
                            <td><?=$dt->parent?></td>
                            <td>
                                 <a class="btn btn-danger" href="action_var.php?recid=<?= $dt->recid; ?>" onclick="return confirm('yakin ingin hapus data?')">hapus</a></td>
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
</html>

<script>
    document.getElementById('save').addEventListener('click', function() {
        var recid = document.getElementById('recid').value;
        var varname = document.getElementById('varname').value;
        var varvalue = document.getElementById('varvalue').value;
        var varothers = document.getElementById('varothers').value;
        var catatan = document.getElementById('catatan').value;
        var parent = document.getElementById('parent').value;

        console.log(recid);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'action_var.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                // Lakukan sesuatu setelah data berhasil dikirim, seperti menutup modal
                var modal = document.getElementById('exampleModal');
                var modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            }
        };

        // Kirim data yang ingin Anda kirimkan
        var data = "recid=" + encodeURIComponent(recid) + "&varname=" + encodeURIComponent(varname) + "&varvalue=" + encodeURIComponent(varvalue) + "&varothers=" + encodeURIComponent(varothers) + "&catatan=" + encodeURIComponent(catatan) + "&parent=" + encodeURIComponent(parent);
        xhr.send(data);

    });
</script>
