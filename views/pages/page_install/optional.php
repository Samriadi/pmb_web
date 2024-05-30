<?php include '../views/layouts/header.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
              <h6 class="m-0 font-weight-bold text-primary">FORM OPTIONAL</h6>
         </div>
            <div class="card-body">
           
            <form id="campusForm">
                <input type="hidden" class="form-control" id="var_name" name="var_name" value="Optional">
                <div id="optionalInputs" class="container">
                    <!-- Input opsional akan ditambahkan di sini -->
                </div>
                <div class="d-flex justify-content-between mt-2">
                    <div>
                        <button type="button" class="btn btn-secondary" onclick="addOptionalField()">Tambah</button>
                        <button type="button" class="btn btn-secondary" onclick="resetOptionalFields()">Reset</button>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </form>

            </div>
        </div>
    </div>  
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
  </body>

<?php include '../views/layouts/footer.php'; ?>


<script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById("campusForm");
            form.addEventListener("submit", function(event) {
                event.preventDefault();

                var formData = new FormData(form);
                var optionalInputs = document.querySelectorAll("#optionalInputs .optional-field-group");
                optionalInputs.forEach(function(group) {
                    var inputName = group.querySelector("input[name$='Name']");
                    var inputValue = group.querySelector("[name$='Value']");
                    formData.append(inputName.value, inputValue.value);
                });

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/hewi/public/optional/add', true);

                xhr.onload = function() {
                    if (xhr.readyState === 4) {
                        if (xhr.status === 200) {

                            console.log(xhr.responseText);

                            Swal.fire({
                                title: 'Success!',
                                text:  'Data successfully saved!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            }).then(() => {
                                form.reset();
                                document.getElementById('optionalInputs').innerHTML = '';
                            });
                                
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
                xhr.send(formData);
            });
            addOptionalField();
        });

        function addOptionalField() {
            var optionalInputsDiv = document.getElementById('optionalInputs');
            var fieldId = `optionalField${optionalInputsDiv.children.length}`;

            var div = document.createElement('div');
            div.className = 'form-group optional-field-group';
            div.id = fieldId;
            div.innerHTML = `
                <div class="row mb-2">
                    <div class="col-md-3">
                        <input type="text" class="form-control" id="${fieldId}Name" name="${fieldId}Name" placeholder="Nama Field">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" id="${fieldId}Type" name="${fieldId}Type" onchange="updateFieldType('${fieldId}')">
                            <option value="text">Teks</option>
                            <option value="date">Tanggal</option>
                            <option value="time">Jam</option>
                            <option value="number">Angka</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="${fieldId}Value" name="${fieldId}Value" placeholder="Nilai Field">
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-center">
                        <button type="button" class="btn btn-danger" onclick="removeOptionalField('${fieldId}')"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            `;

            optionalInputsDiv.appendChild(div);
        }

        function updateFieldType(fieldId) {
            var typeSelect = document.getElementById(`${fieldId}Type`);
            var valueInput = document.getElementById(`${fieldId}Value`);
            valueInput.type = typeSelect.value;
            valueInput.value = ''; 
        }

        function removeOptionalField(fieldId) {
            var fieldGroup = document.getElementById(fieldId);
            fieldGroup.parentNode.removeChild(fieldGroup);
        }

        function resetOptionalFields() {
            var optionalInputsDiv = document.getElementById('optionalInputs');
            var optionalFields = optionalInputsDiv.getElementsByClassName('form-group');
            
            optionalInputsDiv.innerHTML = '';

            if (optionalFields.length === 0) {
                addOptionalField();
            }
        }

    </script>
