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

                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-body">
                            <!-- Tempatkan konten detail di sini -->
                            <div class="container-xl px-4 mt-4">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <!-- Profile picture card-->
                                                <div class="card mb-4 mb-xl-0">
                                                    <div class="card-header">Profile Picture</div>
                                                    <div class="card-body text-center">
                                                        <div id="imageContainer">
                                                            <img id="imageFrame" src="" class="rounded" width="100%" height="auto">
                                                        </div>
                                                        <iframe id="photoFileFrame" src="" width="100%" height="400px"></iframe>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8">
                                                <!-- Account details card-->
                                                <div class="card mb-4">
                                                    <div class="card-header">Profile Details</div>
                                                    <div class="card-body">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="">Nama Lengkap</label>
                                                                <input class="form-control" type="text" id="NamaLengkap">
                                                            </div>
                                                            <!-- Form Row-->
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Username</label>
                                                                    <input class="form-control" type="text" id="UserName">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Nomor WA</label>
                                                                    <input class="form-control" type="text" id="WANumber">
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Asal Sekolah</label>
                                                                    <input class="form-control" type="text" id="NamaAsalSekolah">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Asal Kampus</label>
                                                                    <input class="form-control" type="text" id="AsalKampus">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="">Asal Provinsi</label>
                                                                <input class="form-control" type="text" id="AsalProvinsi">
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Tahun Lulus</label>
                                                                    <input class="form-control" type=text" id="TahunLulus">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">NIS</label>
                                                                    <input class="form-control" type="text" id="NIS">
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Jenis</label>
                                                                    <input class="form-control" type=text" id="jenis">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Kategori</label>
                                                                    <input class="form-control" type="text" id="Kategori">
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Jenjang</label>
                                                                    <input class="form-control" type=text" id="Jenjang">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Periode</label>
                                                                    <input class="form-control" type="text" id="Periode">
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-4">
                                                                    <label class="small mb-1" for="">Pilihan Pertama</label>
                                                                    <input class="form-control" type="text" id="Prodi1">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="small mb-1" for="">Pilihan Kedua</label>
                                                                    <input class="form-control" type="text" id="Prodi2">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="small mb-1" for="">Pilihan Ketiga</label>
                                                                    <input class="form-control" type="text" id="Prodi3">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="">Keterangan</label>
                                                                <input class="form-control" type="text" id="Keterangan">
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
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
                    console.log("🚀 ~ data:", data)

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
                            populateFilterValue(populateFilterColumns());

                            if ($.fn.DataTable.isDataTable('#dataTable')) {
                                $('#dataTable').DataTable().destroy();
                            }

                            table = $('#dataTable').DataTable({
                                data: data, 
                                columns: [
                                    {
                                        data: null,
                                        title: 'No',
                                        render: function(data, type, row, meta) {
                                            return meta.row + 1;
                                        }
                                    },
                                    { data: 'NamaLengkap', title: 'Nama Lengkap' },
                                    { data: 'PilihanPertama', title: 'Pilihan Pertama' },
                                    { data: 'PilihanKedua', title: 'Pilihan Kedua' },
                                    { data: 'PilihanKetiga', title: 'Pilihan Ketiga' },
                                    { data: 'jenjang', title: 'Jenjang' },
                                    { data: 'periode', title: 'Periode' },
                                    {
                                        data: null,
                                        title: 'Aksi',
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
                    
                        const populateFilterColumns = () => {
                            var filterColumnSelect = document.getElementById('filterColumn');
                            filterColumnSelect.innerHTML = '';

                            var allOption = document.createElement('option');
                            allOption.value = 'all';
                            allOption.text = 'All';
                            filterColumnSelect.appendChild(allOption);

                            const pickProperties = (data, properties) =>
                                data.map(obj =>
                                    properties.reduce((result, key) =>
                                        (obj.hasOwnProperty(key) ? { ...result, [key]: obj[key] } : result), {})
                                );

                            var pickedProperties = pickProperties(data, ['periode', 'jenjang', 'kelulusan', 'jenis', 'kategori', 'Keterangan']);
                            var columns = Object.keys(pickedProperties[0]);

                            columns.forEach(column => {
                                var option = document.createElement('option');
                                option.value = column;
                                option.text = column === 'kelulusan' ? 'Status' : column.charAt(0).toUpperCase() + column.slice(1);
                                filterColumnSelect.appendChild(option);
                            });

                            return filterColumnSelect.value;
                        };

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
                                    filterSubtitle.textContent = `${selectedValueText}`;
                                else
                                    filterSubtitle.textContent = ``;
                            }

                            updateSubtitle();
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

                        function detail(id) {
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', '/admin/pendaftar/detail?id=' + id, true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState == 4 && xhr.status == 200) {
                                    var response = JSON.parse(xhr.responseText.trim());
                                    var photoFileName = response.photo;
                                    var photoFilePath = 'public/uploads/photo/';
                                    var photoUrl = photoFilePath + photoFileName;
                                    var fileExtension = photoFileName.split('.').pop().toLowerCase();
                                    var photoFileFrame = document.getElementById('photoFileFrame');
                                    var imageContainer = document.getElementById('imageContainer');

                                    if (photoFileName) {
                                        if(fileExtension == 'pdf') {
                                        photoFileFrame.src = photoUrl;
                                        imageContainer.style.display = 'none';
                                        photoFileFrame.style.display = 'block';
                                        }
                                        else {
                                        imageFrame.src = photoUrl;
                                        imageContainer.style.display = 'block';
                                        photoFileFrame.style.display = 'none';
                                        }
                                    }
                                    else {
                                        photoFileFrame.style.display = 'none';
                                        imageContainer.style.display = 'block';
                                        document.getElementById('imageFrame').src = ''; 
                                    }
                                    
                                    document.getElementById('NamaLengkap').value = response.NamaLengkap;
                                    document.getElementById('UserName').value = response.UserName;
                                    document.getElementById('WANumber').value = response.WANumber;
                                    document.getElementById('NamaAsalSekolah').value = response.NamaAsalSekolah;
                                    document.getElementById('AsalKampus').value = response.AsalKampus;
                                    document.getElementById('AsalProvinsi').value = response.AsalProvinsi;
                                    document.getElementById('TahunLulus').value = response.TahunLulus;
                                    document.getElementById('NIS').value = response.NIS;
                                    document.getElementById('jenis').value = response.jenis;
                                    document.getElementById('Kategori').value = response.kategori;
                                    document.getElementById('Jenjang').value = response.Jenjang;
                                    document.getElementById('Periode').value = response.Periode;
                                    document.getElementById('Prodi1').value = response.Prodi1;
                                    document.getElementById('Prodi2').value = response.Prodi2;
                                    document.getElementById('Prodi3').value = response.Prodi3;
                                    document.getElementById('Keterangan').value = response.Keterangan;

                                    var detailModal = new bootstrap.Modal(document.getElementById('detailModal'));
                                    detailModal.show();
                                }
                            };
                            xhr.send();
                        }
                    </script>
            </body>
        </html> 