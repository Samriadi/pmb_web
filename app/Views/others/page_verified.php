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
                    <h5 class="m-0 font-weight-bold text-primary">DATA VERIFIED</h5>
                    <h6 id="filterSubtitle" class="m-0 font-weight-bold text-primary"></h6>
                </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Lengkap</th>
                                        <th>No Ujian</th>
                                        <th>Pay Status</th>
                                        <th>Periode</th>
                                        <th>Keterangan</th>
                                        <th>Verified</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($data as $dt) :
                                        $isVerified = $dt->verified === "Verified";
                                        $buttonClass = $isVerified ? 'btn-success' : 'btn-danger';
                                        $buttonText = $isVerified ? 'Verified' : 'Unverified';
                                    ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $dt->NamaLengkap ?></td>
                                            <td><?= $dt->no_ujian ?></td>
                                            <td><?= $dt->pay_status ?></td>
                                            <td><?= $dt->Periode ?></td>
                                            <td><?= $dt->Keterangan ?></td>
                                            <td>
                                                <button class="btn btn-sm <?= $buttonClass ?>" onclick="toggleVerified(<?= $dt->id ?>)">
                                                    <?= $buttonText ?>
                                                </button>
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

                <script>
                    function toggleVerified(id) {
                        fetch('/admin/getVerificationStatus/' + id)
                        .then(response => response.json())
                        .then(data => {
                            const currentStatus = data.verified;
                            const confirmationText = currentStatus === 'Verified'
                                ? 'Do you want to mark this record as Unverified?'
                                : 'Do you want to mark this record as Verified?';

                            Swal.fire({
                                title: 'Are you sure?',
                                text: confirmationText,
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    fetch('/admin/verified/action', {
                                        method: 'POST',
                                        headers: {
                                            'Content-Type': 'application/json',
                                        },
                                        body: JSON.stringify({ id: id })
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (data.success) {
                                            const button = document.querySelector(`button[onclick="toggleVerified(${id})"]`);
                                            button.textContent = data.verified === 'Verified' ? 'Verified' : 'Unverified';
                                            button.className = 'btn btn-sm ' + (data.verified === 'Verified' ? 'btn-success' : 'btn-danger');
                                            Swal.fire('Updated!', 'The verification status has been updated.', 'success')
                                                .then(() => {
                                                    window.location.reload();
                                                });
                                        } else {
                                            Swal.fire('Error', 'Failed to update verification status.', 'error');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire('Error', 'Failed to update verification status.', 'error');
                                    });
                                }
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching verification status:', error);
                            Swal.fire('Error', 'Failed to fetch verification status.', 'error');
                        });
                    }
                </script>

                <?php include '../app/Views/others/layouts/footer.php'; ?>
            </body>
        </html> 