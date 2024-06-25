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

                <!-- Option 1: Bootstrap Bundle with Popper -->
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
                <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

                <?php include '../app/Views/others/layouts/footer.php'; ?>

                <script>
                    var data = <?php echo json_encode($data); ?>;
                    var table;
                    var originalContent;
                    var originalContainer;
                    var formValues = {}; // Variabel untuk menyimpan nilai form

                    // Inisialisasi semua yang diperlukan saat dokumen siap
                    $(document).ready(function() {
                        setValueFilter(); // Set nilai awal filter
                        initEventListeners(); // Inisialisasi event listeners
                    });

                    // Set nilai awal filter
                    function setValueFilter() {
                        populateFilterColumns();
                        populateFilterValue(document.getElementById('filterColumn').value);

                        table = $('#dataTable').DataTable({
                            data: data,
                            columns: [
                                {
                                    data: null,
                                    render: function(data, type, row, meta) {
                                        return meta.row + 1;
                                    }
                                },
                                {
                                    data: 'NamaLengkap'
                                },
                                {
                                    data: 'PilihanPertama'
                                },
                                {
                                    data: 'PilihanKedua'
                                },
                                {
                                    data: 'PilihanKetiga'
                                },
                                {
                                    data: 'jenjang'
                                },
                                {
                                    data: 'periode'
                                },
                                {
                                    data: 'keterangan'
                                },
                                {
                                    data: null,
                                    render: function(data, type, row) {
                                        return '<a class="btn btn-info" href="#" onclick="detail(' + data.member_id + ')"><i class="fas fa-info-circle"></i></a>';
                                    }
                                }
                            ],
                            "bDestroy": true
                        });

                        // Menambahkan fungsi filter tambahan
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

                    // Inisialisasi event listeners
                    function reinitEventListeners() {
                        // Hapus event listener yang sudah ada sebelum menambah yang baru
                        document.getElementById('filterColumn').removeEventListener('change', handleFilterColumnChange);
                        document.getElementById('filterButton').removeEventListener('click', handleFilterButtonClick);

                        // Tambahkan kembali event listener dengan fungsi handler yang sudah ada
                        document.getElementById('filterColumn').addEventListener('change', handleFilterColumnChange);
                        document.getElementById('filterButton').addEventListener('click', handleFilterButtonClick);
                    }

                    function initEventListeners() {
                        document.getElementById('filterColumn').addEventListener('change', function() {
                            var selectedColumn = this.value;
                            populateFilterValue(selectedColumn);
                        });

                        document.getElementById('filterButton').addEventListener('click', function() {
                            table.draw(); // Menggambar ulang tabel setelah diterapkan filter
                            addSubtitle(); // Menambahkan subtitle berdasarkan filter yang diterapkan
                        });
                    }

                    // Fungsi untuk mengisi pilihan kolom filter
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

                    // Fungsi untuk mengisi nilai filter berdasarkan kolom yang dipilih
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

                    // Fungsi untuk menambahkan subtitle filter
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

                    // Fungsi untuk menampilkan detail data
                    function detail(id) {
                        var container = document.querySelector('.container-fluid');

                        if (!container) {
                            console.error('Container element not found.');
                            return;
                        }

                        // Menyimpan konten asli jika belum disimpan
                        if (!originalContent) {
                            originalContent = container.innerHTML;
                            originalContainer = container;
                            saveFormValues(); // Simpan nilai form saat pertama kali menampilkan detail
                        }

                        // Mengambil data detail menggunakan XMLHttpRequest
                        var xhr = new XMLHttpRequest();
                        xhr.open('GET', '/admin/pendaftar/detail?id=' + id, true);
                        xhr.onreadystatechange = function() {
                            if (xhr.readyState == 4 && xhr.status == 200) {
                                var response = JSON.parse(xhr.responseText.trim());
                                // Mengubah konten dengan detail data
                                container.innerHTML = `
                                    <div class="card shadow mb-4">
                                        <div class="card-header py-3">
                                            <h5 class="m-0 font-weight-bold text-primary">Detail Data</h5>
                                        </div>
                                        <div class="card-body">
                                            <p>${response.member_id}</p>
                                        </div>
                                        <div class="card-footer">
                                            <button onclick="goBack()" class="btn btn-secondary">Kembali</button>
                                        </div>
                                    </div>
                                `;
                                history.pushState({ html: container.innerHTML }, null, null); // Menyimpan state untuk navigasi mundur
                                initEventListeners(); // Inisialisasi kembali event listeners setelah konten berubah
                            }
                        };
                        xhr.send();
                    }


                    // Fungsi untuk kembali ke konten asli
                    function goBack() {
                        if (originalContainer && originalContent) {
                            originalContainer.innerHTML = originalContent;
                            restoreFormValues(); // Memulihkan nilai form setelah kembali
                            table.draw(); // Menggambar ulang tabel setelah kembali
                            initEventListeners(); // Inisialisasi kembali event listeners setelah konten berubah
                        }
                    }

                    // Event listener untuk popstate (navigasi mundur)
                    // window.addEventListener('popstate', function(event) {
                    //     if (event.state && event.state.html) {
                    //         originalContainer.innerHTML = event.state.html;
                    //         restoreFormValues(); // Memulihkan nilai form setelah kembali
                    //         table.draw(); // Menggambar ulang tabel setelah kembali
                    //         initEventListeners(); // Inisialisasi kembali event listeners setelah konten berubah
                    //     }
                    // });

                    // Fungsi untuk menyimpan nilai form saat ini
                    function saveFormValues() {
                        formValues.filterColumn = document.getElementById('filterColumn').value;
                        formValues.filterValue = document.getElementById('filterValue').value;
                        // Tambahkan field lainnya sesuai kebutuhan
                    }

                    // Fungsi untuk memulihkan nilai form setelah kembali ke konten asli
                    function restoreFormValues() {
                        if (formValues.filterColumn) {
                            document.getElementById('filterColumn').value = formValues.filterColumn;
                            populateFilterValue(formValues.filterColumn); // Perbarui nilai filterValue berdasarkan filterColumn yang dipulihkan
                        }
                        if (formValues.filterValue) {
                            document.getElementById('filterValue').value = formValues.filterValue;
                        }
                        // Tambahkan pengaturan kembali nilai field lainnya sesuai kebutuhan
                    }
                </script>

            </body>
        </html> 