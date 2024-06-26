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
            <div class="container-xl px-4 mt-4">
                                        <div class="row">
                                            <div class="col-xl-4">
                                                <!-- Profile picture card-->
                                                <div class="card mb-4 mb-xl-0">
                                                    <div class="card-header">Profile Picture</div>
                                                    <div class="card-body text-center">
                                                        <!-- Profile picture image-->
                                                        <img class="img-account-profile rounded mb-2" src="https://www.gravatar.com/avatar/2c7d99fe281ecd3bcd65ab915bac6dd5?s=250" alt="">
                                                        <!-- Profile picture help block-->
                                                        <!-- Profile picture upload button-->
                                                    </div>
                                                    <div id="pdf-viewer" style="width: 100%; height: 600px;"></div>
                                                </div>
                                            </div>
                                            <div class="col-xl-8">
                                                <!-- Account details card-->
                                                <div class="card mb-4">
                                                    <div class="card-header">Details</div>
                                                    <div class="card-body">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="">Nama Lengkap</label>
                                                                <input class="form-control" id="" type="text" value="${response.NamaLengkap}">
                                                            </div>
                                                            <!-- Form Row-->
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Username</label>
                                                                    <input class="form-control" id="" type="text" value="${response.UserName}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Nomor WA</label>
                                                                    <input class="form-control" id="" type="text" value="${response.WANumber}">
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Asal Sekolah</label>
                                                                    <input class="form-control" id="" type="text" value="${response.NamaAsalSekolah}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Asal Kampus</label>
                                                                    <input class="form-control" id="" type="text" value="${response.AsalKampus}">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="">Asal Provinsi</label>
                                                                <input class="form-control" id="" type="text" value="${response.AsalProvinsi}">
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Tahun Lulus</label>
                                                                    <input class="form-control" id="" type=text" value="${response.TahunLulus}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">NIS</label>
                                                                    <input class="form-control" id="" type="text" value="${response.NIS}">
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Jenis</label>
                                                                    <input class="form-control" id="" type=text" value="${response.jenis}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Kategori</label>
                                                                    <input class="form-control" id="" type="text" value="${response.Kategori}">
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Jenjang</label>
                                                                    <input class="form-control" id="" type=text" value="${response.Jenjang}">
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <label class="small mb-1" for="">Periode</label>
                                                                    <input class="form-control" id="" type="text" value="${response.Periode}">
                                                                </div>
                                                            </div>
                                                            <div class="row gx-3 mb-3">
                                                                <div class="col-md-4">
                                                                    <label class="small mb-1" for="">Pilihan Pertama</label>
                                                                    <input class="form-control" id="" type="text" value="${response.Prodi1}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="small mb-1" for="">Pilihan Kedua</label>
                                                                    <input class="form-control" id="" type="text" value="${response.Prodi2}">
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <label class="small mb-1" for="">Pilihan Ketiga</label>
                                                                    <input class="form-control" id="" type="text" value="${response.Prodi3}">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="small mb-1" for="">Keterangan</label>
                                                                <input class="form-control" id="" type="text" value="${response.Keterangan}">
                                                            </div>
                                                            <!-- Save changes button-->
                                                            <!-- <button class="btn btn-primary" onclick="goBack()" type="button">Back</button> -->
                                                        </form>
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

              
            </body>
        </html> 