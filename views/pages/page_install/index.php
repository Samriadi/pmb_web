<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Informasi Kampus</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <style>
        .form-group-inline {
            display: flex;
            align-items: center;
        }
        .form-group-inline label {
            margin-right: 10px;
            white-space: nowrap;
        }
        .form-group-inline input {
            flex: 1;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Formulir Informasi Kampus</h2>
            <div class="form-group">
                <label for="namaLengkapKampus">Nama Lengkap Kampus</label>
                <input type="text" class="form-control" id="namaLengkapKampus" name="namaLengkapKampus" required>
            </div>
            <div class="form-group">
                <label for="namaSingkat">Nama Singkat</label>
                <input type="text" class="form-control" id="namaSingkat" name="namaSingkat" required>
            </div>
            <div class="form-group">
                <label for="jalan">Jalan</label>
                <input type="text" class="form-control" id="jalan" name="jalan" required>
            </div>
            <div class="form-group">
                <label for="kota">Kota</label>
                <input type="text" class="form-control" id="kota" name="kota" required>
            </div>
            <div class="form-group">
                <label for="provinsi">Provinsi</label>
                <input type="text" class="form-control" id="provinsi" name="provinsi" required>
            </div>
            <div class="form-group">
                <label for="negara">Negara</label>
                <input type="text" class="form-control" id="negara" name="negara" required>
            </div>
            <div class="form-group">
                <label for="tingkatan">Tingkatan</label>
                <select class="form-control" id="tingkatan" name="tingkatan" required>
                    <option value="S1">S1</option>
                    <option value="D3">D3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="kodeWarnaUtama">Kode Warna Utama</label>
                <input type="text" class="form-control" id="kodeWarnaUtama" name="kodeWarnaUtama" required>
            </div>
            
            <h3>Input Opsional</h3>
            <div id="optionalInputs">
                <!-- Input opsional akan ditambahkan di sini -->
            </div>
            <button type="button" class="btn btn-secondary" onclick="addOptionalField()">Tambah Input Opsional</button>
            <br>
            <button type="button" class="btn btn-primary mt-3" id="save">Kirim</button>
    </div>

    <script>
        function addOptionalField() {
            const optionalInputsDiv = document.getElementById('optionalInputs');
            const fieldId = `optionalField${optionalInputsDiv.children.length}`;

            const div = document.createElement('div');
            div.className = 'form-group form-group-inline';
            div.innerHTML = `
                <label for="${fieldId}Name">Nama Field</label>
                <input type="text" class="form-control" id="${fieldId}Name" name="${fieldId}Name" placeholder="Nama Field">
                <label for="${fieldId}Value">Nilai Field</label>
                <input type="text" class="form-control" id="${fieldId}Value" name="${fieldId}Value" placeholder="Nilai Field">
            `;

            optionalInputsDiv.appendChild(div);
        }

        document.getElementById('save').addEventListener('click', function() {
        var namaLengkapKampus = document.getElementById('namaLengkapKampus').value;
        var namaSingkat = document.getElementById('namaSingkat').value;
        var jalan = document.getElementById('jalan').value;
        var varothers = document.getElementById('varothers').value;
        var catatan = document.getElementById('catatan').value;
        var parent = document.getElementById('parent').value;

        console.log(recid);
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/hewi/public/var/add', true);        
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                // Lakukan sesuatu setelah data berhasil dikirim, seperti menutup modal
                var modal = document.getElementById('exampleModal');
                var modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
                    
                Swal.fire({
                        title: 'Success!',
                        text: xhr.responseText,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        // Refresh halaman
                        window.location.reload();
                    });
            }
        };

        // Kirim data yang ingin Anda kirimkan
         var data = 
         "recid=" + encodeURIComponent(recid) + 
         "&varname=" + encodeURIComponent(varname) + 
         "&varvalue=" + encodeURIComponent(varvalue) + 
         "&varothers=" + encodeURIComponent(varothers) + 
         "&catatan=" + encodeURIComponent(catatan) + 
         "&parent=" + encodeURIComponent(parent);
        xhr.send(data);
    });
    </script>
</body>
</html>
