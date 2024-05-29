<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Install</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            margin-top: 20px;
            margin-bottom: 20px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .form-header {
            background-color: #007bff;
            color: white;
            padding: 10px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
        .form-group.row {
            margin-bottom: 1rem;
            animation: fadeIn 0.5s ease-in-out;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="form-header">
                <h2>Form Install</h2>
            </div>
            <div id="message" class="alert" style="display:none;"></div><br>
            <form id="campusForm">
                <div class="form-group">
                    <label for="namaLengkapKampus">Nama Lengkap Kampus</label>
                    <input type="text" class="form-control" id="namaLengkapKampus" name="namaLengkapKampus" placeholder="Masukkan nama lengkap kampus" required>
                </div>
                <div class="form-group">
                    <label for="namaSingkat">Nama Singkat</label>
                    <input type="text" class="form-control" id="namaSingkat" name="namaSingkat" placeholder="Masukkan nama singkat" required>
                </div>
                <div class="form-group">
                    <label for="jalan">Jalan</label>
                    <input type="text" class="form-control" id="jalan" name="jalan" placeholder="Masukkan alamat jalan" required>
                </div>
                <div class="form-group">
                    <label for="kota">Kota</label>
                    <input type="text" class="form-control" id="kota" name="kota" placeholder="Masukkan nama kota" required>
                </div>
                <div class="form-group">
                    <label for="provinsi">Provinsi</label>
                    <input type="text" class="form-control" id="provinsi" name="provinsi" placeholder="Masukkan nama provinsi" required>
                </div>
                <div class="form-group">
                    <label for="negara">Negara</label>
                    <input type="text" class="form-control" id="negara" name="negara" placeholder="Masukkan nama negara" required>
                </div>
                <div class="form-group">
                    <label for="tingkatan">Tingkatan</label>
                    <select class="form-control" id="tingkatan" name="tingkatan" required>
                        <option value="">Pilih Tingkatan</option>
                        <option value="S1">S1</option>
                        <option value="D3">D3</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="kodeWarnaUtama">Kode Warna Utama</label>
                    <input type="text" class="form-control" id="kodeWarnaUtama" name="kodeWarnaUtama" placeholder="Masukkan kode warna utama" required>
                </div>
                
                <h3 class="mt-4">Input Opsional</h3>
                <div id="optionalInputs" class="container">
                    <!-- Input opsional akan ditambahkan di sini -->
                </div>
                <div class="d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-secondary mt-2" onclick="addOptionalField()">Tambah</button>
                        <button type="button" class="btn btn-secondary mt-2" onclick="resetOptionalFields()">Reset</button>
                    </div>
                   <div>
                      <button type="submit" class="btn btn-primary mt-2">Simpan</button>
                   </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.getElementById("campusForm");
            form.addEventListener("submit", function(event) {
                event.preventDefault();

                var formData = new FormData(form);
                var optionalInputs = document.querySelectorAll("#optionalInputs input");
                optionalInputs.forEach(function(input) {
                    formData.append(input.name, input.value);
                });

                var xhr = new XMLHttpRequest();
                xhr.open('POST', '/hewi/public/install/save', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === "success") {
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Data berhasil disimpan!',
                                icon: 'success',
                                confirmButtonText: 'OK'
                            });

                            // Reset formulir
                            form.reset();

                            // Hapus input opsional
                            document.getElementById('optionalInputs').innerHTML = '';
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Terjadi kesalahan: ' + response.message,
                                icon: 'error',
                                confirmButtonText: 'OK'
                            });
                        }
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan: ' + xhr.statusText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                };
                xhr.onerror = function() {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Permintaan gagal',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                };
                xhr.send(formData);
            });
        });

        function addOptionalField() {
            var optionalInputsDiv = document.getElementById('optionalInputs');
            var fieldId = `optionalField${optionalInputsDiv.children.length}`;

            var div = document.createElement('div');
            div.className = 'form-group row';
            div.innerHTML = `
                <div class="col-md-6">
                    <label for="${fieldId}Name">Nama Field</label>
                    <input type="text" class="form-control" id="${fieldId}Name" name="${fieldId}Name" placeholder="Nama Field">
                </div>
                <div class="col-md-6">
                    <label for="${fieldId}Value">Nilai Field</label>
                    <input type="text" class="form-control" id="${fieldId}Value" name="${fieldId}Value" placeholder="Nilai Field">
                </div>
            `;

            optionalInputsDiv.appendChild(div);
        }

        function resetOptionalFields() {
            var optionalInputsDiv = document.getElementById('optionalInputs');
            optionalInputsDiv.innerHTML = ''; // Menghapus semua elemen input opsional dari div
        }
    </script>
</body>
</html>
`