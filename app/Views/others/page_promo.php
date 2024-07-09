<?php include '../app/Views/others/layouts/header.php'; ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                        <h6 class="m-0 font-weight-bold text-primary">FORM PROMO</h6>
                    </div>
                    <div class="card-body">

                    <form id="formPromo">
                        <div class="row mb-3">
                            <div class="col">
                                <label for="periode" class="form-label">Periode</label>
                                <select class="form-select" id="periode" name="periode">
                                    <option selected>Pilih Periode</option>
                                    <?php
                                    $seenPeriodes = array(); 

                                    foreach ($periodes as $periode) {
                                        if (!in_array($periode['Periode'], $seenPeriodes)) { 
                                            $seenPeriodes[] = $periode['Periode']; 
                                            ?>
                                            <option value="<?= $periode['Periode'] ?>"><?= $periode['Periode'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="gelombang" class="form-label">Gelombang</label>
                                <select class="form-select" id="gelombang" name="gelombang">
                                    <option selected>Pilih Gelombang</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col">
                                <label for="fakultas" class="form-label">Fakultas</label>
                                <select class="form-select" id="fakultas" name="fakultas">
                                    <option selected>Pilih Fakultas</option>
                                    <?php
                                    $seenFakultas = array(); 

                                    foreach ($fakultass as $fakultas) {
                                        if (!in_array($fakultas['fakultas'], $seenFakultas)) { 
                                            $seenFakultas[] = $fakultas['fakultas']; 
                                            ?>
                                            <option value="<?= $fakultas['id_fakultas'] ?>"><?= $fakultas['fakultas'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col">
                                <label for="prodi" class="form-label">Prodi</label>
                                <div id="prodi">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1" disabled>
                                        <label class="form-check-label" for="defaultCheck1">
                                            Pilih Prodi
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck2" disabled>
                                        <label class="form-check-label" for="defaultCheck2">
                                            Pilih Prodi
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col">
                                <label for="promo" class="form-label">Promo</label>
                                <input type="number" class="form-control" id="promo" name="promo" placeholder="Input Promo">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-auto me-0">
                                <div class="btn-group" role="group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                    <button type="button" id="removeChecked" class="btn btn-secondary">Delete</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    </div>
                </div>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">DATA PROMO</h6>
                    </div>
                    <div class="card-body">

                    <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Pro_Periode</th>
                                        <th>Pro_Gelombang</th>
                                        <th>Pro_Prodi</th>
                                        <th>Pro_Name</th>
                                        <th>Pro_Value</th>
                                        </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($promo as $dt) :
                                    ?>
                                        <tr>
                                            <td><?= $dt['pro_periode'] ?></td>
                                            <td><?= $dt['pro_gelombang'] ?></td>
                                            <td><?= $dt['JenjangProdi'].' - '.$dt['NamaProdi'] ?></td>
                                            <td><?= $dt['pro_name'] ?></td>
                                            <td><?= $dt['pro_value'].'%' ?></td>
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
            </body>


            <?php include '../app/Views/others/layouts/footer.php'; ?>

            <script>
                dataPeriode = <?php echo json_encode($periodes); ?>;
                dataFakultas = <?php echo json_encode($fakultass); ?>;

                $('#periode').on('change', function() {
                    var selectedPeriode = $(this).val();
                    var gelombang = dataPeriode.filter(selected => selected.Periode == selectedPeriode);
                    $('#gelombang').empty();
                    $('#gelombang').append('<option selected>Pilih Gelombang</option>');
                    gelombang.forEach(result => {
                        $('#gelombang').append(new Option(result.Gelombang, result.Gelombang));
                    });
                });

                $('#fakultas').on('change', function() {
                    var selectedFakultas = $(this).val();
                    var prodi = dataFakultas.filter(selected => selected.id_fakultas == selectedFakultas);
                    $('#prodi').empty();
                    prodi.forEach(function(result) {
                        $('#prodi').append(
                            `<div class="form-check">
                                <input class="form-check-input" type="checkbox" value="${result.id_prodi}" id="prodi${result.id_prodi}" name="prodi[]">
                                <label class="form-check-label" for="prodi${result.id_prodi}">
                                    ${result.jenjang_prodi} - ${result.prodi}
                                </label>
                            </div>`
                        );
                    });
                });

                $(document).ready(function() {
                    $('#removeChecked').click(function() {
                        $('.form-check-input').prop('checked', false);
                    });
                });

                $(document).ready(function() {
                    $('#formPromo').submit(function(event) {
                        event.preventDefault(); 
                        var periode = $('#periode').val();
                        var gelombang = $('#gelombang').val();

                        var prodiSelected = [];
                        $('input[name="prodi[]"]:checked').each(function() {
                            prodiSelected.push($(this).val());
                        });
                        var promo = $('#promo').val();

                        $.ajax({
                            url: '/admin/promo/save',
                            method: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify({
                                periode: periode,
                                gelombang: gelombang,
                                prodiSelected: prodiSelected,
                                promo: promo,
                            }),
                            success: function(response) {
                                console.log('Response from server:', response);
                                Swal.fire({
                                    title: 'Success!',
                                    text: 'Data berhasil ditambahkan.',
                                    icon: 'success',
                                    timer: 2000, 
                                    showConfirmButton: false
                                });
                            },
                            error: function(error) {
                                console.error('Error:', error);
                                // Tambahkan SweetAlert untuk error jika diperlukan
                                Swal.fire({
                                    title: 'Error!',
                                    text: 'Data gagal ditambahkan',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                            }
                        });
                    });
                });

            </script>

