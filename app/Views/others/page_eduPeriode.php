<?php include __DIR__ .'/layouts/header.php'; ?>

    <!-- Page Wrapper -->
    <div id="wrapper">

<?php include __DIR__ .'/layouts/sidebar.php'; ?>
       
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
<?php include __DIR__ .'/layouts/topbar.php'; ?>
                <!-- End of Topbar -->
    <div class="container-fluid">
            <!-- Button trigger modal -->
        <div class="card shadow mb-4">
        <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">DATA PERIODE</h6>
         </div>
            <div class="card-body">
            <a class="btn btn-primary btn-icon-split" href="#" onclick="add()" data-bs-toggle="modal" data-bs-target="#exampleModal" style="margin-bottom: 15px;"><span class="icon text-white-50"><i class="fas fa-plus"></i></span><span class="text">Add Data</span></a>
            <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                        <th>No</th>
                        <th>Periode</th>
                        <th>Jenjang</th>
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
						   $sts = strtolower($dt->status);
						   if ($sts == "open") { ?>
                           <tr class="table-secondary">
                            <?php } else { ?>
                           <tr>
                            <?php } ?>
                            <td><?=$no++?></td>
                            <td><?=$dt->Periode?></td>
                            <td><?=$dt->Jenjang?></td>
                            <td><?=$dt->fromDate?></td>
                            <td><?=$dt->toDate?></td>
                            <td><?=$dt->Keterangan?></td>
                            <td><?=$dt->status?></td>
                            <td><a class="btn btn-info" href="#" onclick="edit(<?= $dt->recid ?>)" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fas fa-info-circle"></i></a>
                            <?php 
                            if($dt->isInTagihan == "true"){ ?>
                               <a class="btn btn-danger disabled"><i class="fas fa-trash"></i></a>
                            <?php } 
                            else { ?>
                                 <a class="btn btn-danger" href="#" onclick="deleteRecord(<?= $dt->recid; ?>)"><i class="fas fa-trash"></i></a>
                           <?php } 
                           ?>
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
                        <label for="periode">Periode</label>
                        <select id="periode" name="periode" class="form-control">
                            <!-- Opsi tahun akan diisi menggunakan JavaScript -->
                        </select>
                </div>
                 <div class="form-group">
                    <label for="jenjang">Jenjang</label>
                        <select class="form-control" id="jenjang" name="Jenjang" required>
                            
                        </select>
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
            <input type="hidden" name="recid" id="recid">
               <div class="form-group">
                    <label for="editPeriode">Periode</label>
                        <select id="editPeriode" name="periode" class="form-control">
                            <!-- Opsi tahun akan diisi menggunakan JavaScript -->
                        </select>					
                </div>
                <div class="form-group">
                <label for="editJenjang">Jenjang</label>
                    <select class="form-control" id="editJenjang" name="Jenjang" required>
                    </select>
                </div>
                <div class="form-group">
                    <label for="editFromDate">From Date</label>
                    <input type="date" class="form-control" id="editFromDate" name="fromDate" required>
                </div>
                <div class="form-group">
                    <label for="editToDate">To Date</label>
                    <input type="date" class="form-control" id="editToDate" name="toDate" required>
                </div>
                <div class="form-group">
                    <label for="editKeterangan">Keterangan</label>
                    <input type="text" class="form-control" id="editKeterangan" name="keterangan" required>
                </div>
                <label for="editStatus">Status</label>
                    <select class="form-control" id="editStatus" name="status" required>
                         <option value="Open">Open</option>
                        <option value="Close">Close</option>
                    </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="update">Save</button>
            </div>
        </div>
    </div>
</div>



<?php include __DIR__ .'/layouts/footer.php'; ?>



<script>
function add() {

    var varNameJenjang = document.getElementById('jenjang').name;

    var xhr = new XMLHttpRequest();
    xhr.open('GET', '/admin/periode/add?jenjang='+varNameJenjang, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var response = JSON.parse(xhr.responseText);
            console.log("🚀 ~ add ~ response:", response)

            
            // Mengisi opsi select untuk jenjang
            var jenjangSelect = document.getElementById('jenjang');
            response.jenjangValues.forEach(function(item) {
                var option = document.createElement('option');
                option.value = item.var_value;
                option.text = item.var_value;
                if (!Array.from(jenjangSelect.options).some(opt => opt.value == item.var_value)) {
                    jenjangSelect.appendChild(option);
                }
            });
            jenjangSelect.value = response.jenjang;

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
</script>

<script>
	document.getElementById('save').addEventListener('click', function() {
		var jenjang = document.getElementById('jenjang').value;
		var periode = document.getElementById('periode').value;
		var fromDate = document.getElementById('fromDate').value;
		var toDate = document.getElementById('toDate').value;
		var keterangan = document.getElementById('keterangan').value;
		var status = document.getElementById('status').value;

        

		if(!jenjang || !periode || !status){
			Swal.fire({
				title : 'Error!',
				text : 'please fill in all fields',
				icon : 'error',
				confirmButtonText : 'OK'
			});
			return;
		}

		var xhr = new XMLHttpRequest();
            xhr.open('POST', '/admin/periode/save', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        try {
                            console.log("Raw response:", xhr.responseText.trim());
                            var response = JSON.parse(xhr.responseText.trim());
                            console.log("Parsed response:", response);
                            Swal.fire({
                                title: 'Success!',
                                text: response.message,
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                window.location.reload();
                            });
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Error: "' + xhr.responseText.trim() + '" is not valid JSON.',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to save data. Server returned status: ' + xhr.status,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                }
            };

            xhr.onerror = function() {
                Swal.fire({
                    title: 'Network Error!',
                    text: 'A network error occurred. Please check your internet connection.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            };

            var data = 
                "jenjang=" + encodeURIComponent(jenjang) + 
                "&periode=" + encodeURIComponent(periode) + 
                "&fromDate=" + encodeURIComponent(fromDate) + 
                "&toDate=" + encodeURIComponent(toDate) + 
                "&keterangan=" + encodeURIComponent(keterangan) + 
                "&status=" + encodeURIComponent(status);
            xhr.send(data);

	});

</script>

<script>
    function edit(recid) {
        var varNameJenjang = document.getElementById('jenjang').name;
        var xhr = new XMLHttpRequest();
        xhr.open('GET', '/admin/periode/edit?id=' + recid + '&jenjang=' + varNameJenjang, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                console.log("Raw response:", xhr.responseText.trim());
                if (xhr.status == 200) {
                    try {
                        var response = JSON.parse(xhr.responseText.trim());

                        document.getElementById('recid').value = response.recid;
                        document.getElementById('editPeriode').value = response.periode;
                        document.getElementById('editFromDate').value = response.fromDate;
                        document.getElementById('editToDate').value = response.toDate;
                        document.getElementById('editKeterangan').value = response.keterangan;
                        document.getElementById('editStatus').value = response.status;

                        if (response && response.jenjangValues) {
                            var jenjangSelect = document.getElementById('editJenjang');
                            response.jenjangValues.forEach(function(item) {
                                var option = document.createElement('option');
                                option.value = item.var_value;
                                option.text = item.var_value;
                                if (!Array.from(jenjangSelect.options).some(opt => opt.value == item.var_value)) {
                                    jenjangSelect.appendChild(option);
                                }
                            });
                            jenjangSelect.value = response.jenjang;
                        } else {
                            console.error("Property jenjangValues not found in response or response is undefined.");
                        }

                        var editModal = new bootstrap.Modal(document.getElementById('editModal'));
                        editModal.show();
                    } catch (e) {
                        console.error('Error parsing JSON response:', e);
                    }
                } else {
                    console.error('Failed to fetch data. Server returned status:', xhr.status);
                }
            }
        };
        xhr.send();
    }


    document.getElementById('update').addEventListener('click', function() {
    var recid = document.getElementById('recid').value;
    var jenjang = document.getElementById('editJenjang').value;
    var periode = document.getElementById('editPeriode').value;
    var fromDate = document.getElementById('editFromDate').value;
    var toDate = document.getElementById('editToDate').value;
    var keterangan = document.getElementById('editKeterangan').value;
    var status = document.getElementById('editStatus').value;

    console.log(recid);
    console.log(status);
    
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/admin/periode/update', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
          
            var modal = document.getElementById('editModal');
            var modalInstance = bootstrap.Modal.getInstance(modal);
            modalInstance.hide();

            Swal.fire({
            title: 'Success!',
            text: 'Record Updated',
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

    var data = 
        "&recid=" + encodeURIComponent(recid) + 
        "&jenjang=" + encodeURIComponent(jenjang) + 
        "&periode=" + encodeURIComponent(periode) + 
        "&fromDate=" + encodeURIComponent(fromDate) + 
        "&toDate=" + encodeURIComponent(toDate) + 
        "&keterangan=" + encodeURIComponent(keterangan)+
        "&status=" + encodeURIComponent(status);
        
    xhr.send(data);
});

    var modalElement = document.getElementById('editModal');
    modalElement.addEventListener('hidden.bs.modal', function () {
        window.location.reload();
    });
</script>

<script>
    function deleteRecord(recid) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'No'
        }).then((result) => {
            if (result.isConfirmed) {
                var xhr = new XMLHttpRequest();
                xhr.open('GET', '/admin/periode/delete?id=' + recid, true);
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4) {
                        var response;
                        try {
                            response = JSON.parse(xhr.responseText.trim());
                        } catch (e) {
                            console.error('Error parsing JSON response:', e);
                            Swal.fire({
                                title: 'Error!',
                                text: 'Unexpected server response',
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                            return;
                        }

                        if (xhr.status === 200 && response.status === 'success') {
                                Swal.fire({
                                    title: 'Deleted!',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 1000,  
                                    showConfirmButton: false
                                }).then(() => {
                                        window.location.reload();
                                    });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    }
                };
                xhr.send();
            }
        });
    }
</script>

<script>
    function yearOption() {
        const currentYear = new Date().getFullYear(); 
        const startYear = currentYear - 2; 
        const endYear = currentYear + 3; 

        const selectAdd = document.getElementById('periode');
        const selectEdit = document.getElementById('editPeriode');

        if(selectAdd){

            selectAdd.innerHTML = '';

            for (let year = startYear; year <= endYear; year++) {
                let option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                selectAdd.appendChild(option);
            }

            selectAdd.value = currentYear;
        }

        if(selectEdit){
            selectEdit.innerHTML = '';

            for (let year = startYear; year <= endYear; year++) {
                let option = document.createElement('option');
                option.value = year;
                option.textContent = year;
                selectEdit.appendChild(option);
            }

            selectEdit.value = currentYear;
        }
    }

    $('#yearModal').on('show.bs.modal', function () {
        yearOption();
    });

    $(document).ready(function() {
        yearOption();
    });
</script>
