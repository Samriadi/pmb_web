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
              <h6 class="m-0 font-weight-bold text-primary">DATA UJIAN</h6>
         </div>
            <div class="card-body">


            <button style="margin-bottom: 5px;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal">Upload CSV</button>

            <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="uploadModalLabel">Upload CSV File</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="uploadForm" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="file" name="csv_file" id="csv_file" class="form-control-file" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" form="uploadForm" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </div>
            </div>
            <div id="response"></div>



            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Nomor Ujian</th>
                        <th>Nama Lengkap</th>
                        <th>Kelulusan</th>
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
                            <td><?=$dt->no_ujian?></td>
                            <td><?=$dt->NamaLengkap?></td>
                            <td><?=$dt->kelulusan?></td>
                            <td>
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

<?php include '../views/layouts/footer.php'; ?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#uploadForm').submit(function(e){
                e.preventDefault();
                var formData = new FormData(this);

                $.ajax({
                    url: '/hewi/public/logs',
                    type: 'POST',
                    data: formData,
                    success: function(response){
                        $('#response').html(response);
                        $('#uploadModal').modal('hide');
                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });
    </script>
