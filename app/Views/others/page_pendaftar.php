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
                    <h5 class="m-0 font-weight-bold text-primary">DATA PENDAFTAR</h5>
                    <h6 id="filterSubtitle" class="m-0 font-weight-bold text-primary"></h6>
                </div>
                    <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <form id="filterForm" method="GET" action="">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="filterColumn" class="col-form-label">Kolom :</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control" id="filterColumn" name="filterColumn">
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label for="filterValue" class="col-form-label">Nilai :</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control" id="filterValue" name="filterValue">
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" type="button" id="filterButton"><i class=" fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <form id="filterSpesificForn" method="GET" action="">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="filterSpesific" class="col-form-label">Get :</label>
                                </div>
                                <div class="col-auto">
                                    <input type="text" class="form-control" id="filterSpesific" name="filterSpesific" placeholder="Kolom=Nilai">
                                    </input>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" type="button" id="filterSpesificButton"><i class=" fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>Pilihan Pertama</th>
                                        <th>Pilihan Kedua</th>
                                        <th>Pilihan Ketiga</th>
                                        <th>Jenjang</th>
                                        <th>Periode</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $dt) :
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $dt->NamaLengkap ?></td>
                                            <td><?= $dt->PilihanPertama ?></td>
                                            <td><?= $dt->PilihanKedua ?></td>
                                            <td><?= $dt->PilihanKetiga ?></td>
                                            <td><?= $dt->jenjang ?></td>
                                            <td><?= $dt->periode ?></td>
                                            <td><?= $dt->keterangan ?></td>
                                            <td><a class="btn btn-info" href="#" onclick="detail(<?= $dt->member_id; ?>)"><i class="fas fa-info-circle"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

                <?php include '../app/Views/others/layouts/footer.php'; ?>

                <script>
                    var data = <?php echo json_encode($data); ?>;

                    var originalContent;
                    var originalContainer;
                    var table;

                    var formValues = {}; 

                    document.addEventListener('DOMContentLoaded', function() {
                        setValueFilter(); 
                        initEventListeners(); 
                    });

                    function setValueFilter() {
                            populateFilterColumns();
                            populateFilterValue(document.getElementById('filterColumn').value);

                            if ($.fn.DataTable.isDataTable('#dataTable')) {
                                $('#dataTable').DataTable().destroy();
                            }

                            table = $('#dataTable').DataTable({
                                data: data, 
                                columns: [
                                    {
                                        data: null,
                                        render: function(data, type, row, meta) {
                                            return meta.row + 1;
                                        }
                                    },
                                    { data: 'NamaLengkap' },
                                    { data: 'PilihanPertama' },
                                    { data: 'PilihanKedua' },
                                    { data: 'PilihanKetiga' },
                                    { data: 'jenjang' },
                                    { data: 'periode' },
                                    { data: 'keterangan' },
                                    {
                                        data: null,
                                        render: function(data, type, row) {
                                            return '<a class="btn btn-info" href="#" onclick="detail(' + data.member_id + ')"><i class="fas fa-info-circle"></i></a>';
                                        }
                                    }
                                ],
                                "bDestroy": true
                            });

                            $.fn.dataTable.ext.search.pop();

                            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                                var selectedColumn = document.getElementById('filterColumn').value;
                                var selectedValue = document.getElementById('filterValue').value;
 
                                if (selectedColumn === 'all' || selectedValue === '') {
                                    return true;
                                }

                                var columnValue = table.row(dataIndex).data()[selectedColumn];
                                return columnValue == selectedValue;
                            });
                        }
                    
                        function populateFilterColumns() {
                            var filterColumnSelect = document.getElementById('filterColumn');
                            filterColumnSelect.innerHTML = '';

                            var allOption = document.createElement('option');
                            allOption.value = 'all';
                            allOption.text = 'All';
                            filterColumnSelect.appendChild(allOption);

                            function pickProperties(data, properties) {
                                return data.map(function(obj) {
                                    var result = {};
                                    properties.forEach(function(key) {
                                        if (obj.hasOwnProperty(key)) {
                                            result[key] = obj[key];
                                        }
                                    });
                                    return result;
                                });
                            }

                            var pickedProperties = pickProperties(data, ['periode', 'jenjang', 'kelulusan']);
                            var columns = Object.keys(pickedProperties[0]);

                            columns.forEach(function(column) {
                                var option = document.createElement('option');
                                option.value = column;
                                if (column === 'kelulusan') {
                                    option.text = 'Status';
                                } else {
                                    option.text = column.charAt(0).toUpperCase() + column.slice(1);
                                }
                                filterColumnSelect.appendChild(option);
                            });
                        }

                        function detail(id) {
                            var container = document.querySelector('.container-fluid');

                            if (!container) {
                                console.error('Container element not found.');
                                return;
                            }

                            if (!originalContent) {
                                originalContent = container.innerHTML;
                                originalContainer = container;
                                saveFormValues();
                            }

                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', '/admin/pendaftar/detail?id=' + id, true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    var response = JSON.parse(xhr.responseText.trim());
                                    container.innerHTML = `
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h5 class="m-0 font-weight-bold text-primary">Detail Pendaftar</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <label>Nama Lengkap</label>
                                                <input type="text" class="form-control" value="${response.NamaLengkap}" disabled>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Wa Number</label>
                                                    <input class="form-control" value="${response.WANumber}" disabled>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Email</label>
                                                    <input class="form-control" value="${response.Email}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Nama Asal Sekolah</label>
                                                    <input class="form-control" value="${response.NamaAsalSekolah}" disabled>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Tahun Lulus</label>
                                                    <input class="form-control" value="${response.TahunLulus}" disabled>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Asal Kampus</label>
                                                    <input class="form-control" value="${response.AsalKampus}" disabled>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Asal Provinsi</label>
                                                    <input class="form-control" value="${response.AsalProvinsi}" disabled>
                                                </div>
                                            </div>
                                             <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Jenjang</label>
                                                    <input class="form-control" value="${response.Jenjang}" disabled>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Periode</label>
                                                    <input class="form-control" value="${response.Periode}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label>Jenis</label>
                                                    <input class="form-control" value="${response.jenis}" disabled>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kategori</label>
                                                    <input class="form-control" value="${response.kategori}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label>Prodi 1</label>
                                                    <input type="text" class="form-control" value="${response.Prodi1}" disabled>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Prodi 2</label>
                                                    <input type="text" class="form-control" value="${response.Prodi2}" disabled>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label>Prodi 3</label>
                                                    <input type="text" class="form-control" value="${response.Prodi3}" disabled>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Keterangan</label>
                                                <input type="text" class="form-control" value="${response.Keterangan}" disabled>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button onclick="goBack()" class="btn btn-secondary">Kembali</button>
                                        </div>
                                    </div>
                                `;
                                }
                            };
                            xhr.send();
                        }

                        function populateFilterValue(column) {
                            var filterValueSelect = document.getElementById('filterValue');
                            filterValueSelect.innerHTML = '';

                            if (column === 'all') {
                                var allOption = document.createElement('option');
                                allOption.value = '';
                                allOption.text = 'All';
                                filterValueSelect.appendChild(allOption);
                            } else if (column === 'kelulusan') {
                                var uniqueValues = [...new Set(data.map(item => item[column]))];
                                uniqueValues.forEach(function(value) {
                                    if (value === 'Lulus') {
                                        var option = document.createElement('option');
                                        option.value = value;
                                        option.text = value;
                                        filterValueSelect.appendChild(option);
                                    } else if (value !== 'Lulus' && value !== null) {
                                        var option = document.createElement('option');
                                        option.value = '';
                                        option.text = 'All';
                                        filterValueSelect.appendChild(option);
                                    }
                                });
                            } else {
                                var uniqueValues = [...new Set(data.map(item => item[column]))];
                                uniqueValues.forEach(function(value) {
                                    if (value !== null) {
                                        var option = document.createElement('option');
                                        option.value = value;
                                        option.text = value;
                                        filterValueSelect.appendChild(option);
                                    }
                                });
                            }
                        }

                        function addSubtitle() {
                            const filterColumnSelect = document.getElementById('filterColumn');
                            const filterValueSelect = document.getElementById('filterValue');
                            const filterSubtitle = document.getElementById('filterSubtitle');

                            function updateSubtitle() {
                                const selectedColumnText = filterColumnSelect.options[filterColumnSelect.selectedIndex].text;
                                const selectedValueText = filterValueSelect.options[filterValueSelect.selectedIndex].text;
                                if (selectedColumnText != 'All')
                                    filterSubtitle.textContent = `${selectedColumnText}  ${selectedValueText}`;
                                else
                                    filterSubtitle.textContent = ``;
                            }

                            updateSubtitle();
                        }

                        function goBack() {
                            if (originalContainer && originalContent) {
                                originalContainer.innerHTML = originalContent;
                                restoreFormValues(); 
                               
};
                                initEventListeners();

                                location.reload();
                                window.onload = function() {
                                
                                window.scrollTo(0, savedState.scrollPosition);
                                document.getElementById(savedState.selectedTab).click(); 

                            }
                        }

                        function restoreFormValues() {

                            if (formValues.filterColumn) {
                                document.getElementById('filterColumn').value = formValues.filterColumn;
                                populateFilterValue(formValues.filterColumn); 
                            }
                            if (formValues.filterValue) {
                                document.getElementById('filterValue').value = formValues.filterValue;
                            }
                        }

                        function saveFormValues() {
                            formValues.filterColumn = document.getElementById('filterColumn').value;
                            formValues.filterValue = document.getElementById('filterValue').value;

                        }

                        function initEventListeners() {

                            

                            var filterColumn = document.getElementById('filterColumn');
                            var filterButton = document.getElementById('filterButton');


                            if (filterColumn) {
                                filterColumn.addEventListener('change', function() {
                                    var selectedColumn = this.value;
                                    populateFilterValue(selectedColumn);
                                });
                            } else {
                                console.error('filterColumn element not found');
                            }

                            if (filterButton) {
                                filterButton.addEventListener('click', function() {
                                   
                                    
                                    if (typeof table !== 'undefined' && table !== null) {
                                        if (typeof table.draw === 'function') {
                                            table.draw();
                                            console.log('Table redraw called');
                                        } else {
                                            console.error('table.draw is not a function');
                                        }
                                    } else {
                                        console.error('table is not defined');
                                    }
                                    addSubtitle();
                                });
                            } else {
                                console.error('filterButton element not found');
                            }
                        }

                    </script>
            </body>
        </html> 