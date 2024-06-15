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
                        <h6 class="m-0 font-weight-bold text-primary">DATA PENDAFTAR</h6>
                    </div>
                    <div class="card-body">
                        <form id="filterForm" method="GET" action="">
                            <div class="row g-3 align-items-center mb-3">
                                <div class="col-auto">
                                    <label for="filterColumn" class="col-form-label">Kolom</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control" id="filterColumn" name="filterColumn">
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <label for="filterValue" class="col-form-label">Nilai</label>
                                </div>
                                <div class="col-auto">
                                    <select class="form-control" id="filterValue" name="filterValue">
                                        <!-- Options will be populated by JavaScript -->
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <button class="btn btn-primary" type="button" id="filterButton">Tampilkan</button>
                                </div>
                            </div>
                        </form>

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

                <?php include '../app/Views/others/layouts/footer.php'; ?>

                <script>
                    var data = <?php echo json_encode($data); ?>;

                    console.log(data)
                    var table; // Deklarasi global

                    $(document).ready(function() {
                        populateFilterColumns();
                        populateFilterValue(document.getElementById('filterColumn').value);

                        table = $('#dataTable').DataTable({
                            data: data,
                            columns: [{
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
                                }
                            ],
                            "bDestroy": true
                        });

                        $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                            var selectedColumn = document.getElementById('filterColumn').value;
                            var selectedValue = document.getElementById('filterValue').value;
                            if (selectedValue === '') {
                                return true;
                            }
                            var columnValue = table.row(dataIndex).data()[selectedColumn];
                            return columnValue == selectedValue;
                        });
                    });

                    function populateFilterColumns() {
                        var filterColumnSelect = document.getElementById('filterColumn');
                        filterColumnSelect.innerHTML = '';

                        function pilihProperti(data, properti) {
                            return data.map(function(obj) {
                                var hasil = {};
                                properti.forEach(function(kunci) {
                                    if (obj.hasOwnProperty(kunci)) {
                                        hasil[kunci] = obj[kunci];
                                    }
                                });
                                return hasil;
                            });
                        }

                        var propertiDipilih = pilihProperti(data, ['periode', 'jenjang', 'status']);

                        var columns = Object.keys(propertiDipilih[0]);

                        columns.forEach(function(column) {
                            var option = document.createElement('option');
                            option.value = column;
                            option.text = column.charAt(0).toUpperCase() + column.slice(1);
                            filterColumnSelect.appendChild(option);
                        });
                    }

                    function populateFilterValue(column) {
                        var filterValueSelect = document.getElementById('filterValue');
                        filterValueSelect.innerHTML = '';

                        var uniqueValues = [...new Set(data.map(item => item[column]))];
                        uniqueValues.forEach(function(value) {
                            var option = document.createElement('option');
                            option.value = value;
                            option.text = value;
                            filterValueSelect.appendChild(option);
                        });
                    }

                    document.getElementById('filterColumn').addEventListener('change', function() {
                        var selectedColumn = this.value;
                        populateFilterValue(selectedColumn);
                    });


                    document.addEventListener('DOMContentLoaded', function() {
                        const filterButton = document.getElementById('filterButton');
                        filterButton.addEventListener('click', function() {
                            table.draw();
                        });
                    });
                </script>
                </body>

                </html>