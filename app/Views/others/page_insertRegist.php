<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran D3</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 100vh;
        }
        .header, .footer {
            background-color: #800020;
            color: white;
            padding: 20px;
            font-size: 24px;
            text-align: center;
        }
        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border: 1px solid #800020;
            border-radius: 10px;
            max-width: 600px;
            width: 100%;
            text-align: left;
        }
        .form-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }
        .input-group {
            display: flex;
            width: 100%; /* Full width for the input group */
        }
        p {
            margin: 0 0 5px; /* Space between paragraph and input */
        }
        input[type="text"], select {
            width: 85%; /* Each input/select takes up half of the row */
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 4%; /* Space between inputs */
        }
        input[type="text"]:last-child, select:last-child {
            margin-right: 0; /* Remove right margin from the last input */
        }
        input[type="submit"] {
            background-color: #5a6268;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px; /* Margin to separate from other inputs */
        }
        input[type="submit"]:hover {
            background-color: #343a40;
        }
        .note {
            font-size: 12px;
            margin-top: 10px;
        }
        .login-link {
            font-size: 14px;
        }
        .login-link a {
            color: #007bff;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php
if (isset($_GET['nik'])) {
    $nik = $_GET['nik'];
} else {
    echo "NIK tidak ditemukan di URL.";
}
?>


    <div class="header">
        Universitas Almarisah Madani
    </div>

    <div class="container">
        <div class="form-container">
            <h3>Pendaftaran D3 - Periode 2025*</h3>
            <p>NIK/KTP : <?= $nik ?></p>
            <form method="POST" id="registrationForm" action="">

                <!-- Nama Lengkap -->
                <div class="form-row">
                    <div style="width: 100%;">
                        <p>Nama Lengkap:</p>
                        <input type="text" id="name" name="name" required>
                    </div>
                </div>

                <!-- Pilihan -->
                <div class="form-row">
                    <div class="form-group" style="width: 100%;">
                        <label for="choice1">Pilihan Pertama:</label>
                        <select id="choice1" name="choice1" class="form-control" required>
                            <option value="">Pilih Prodi</option>
                            <?php foreach ($dataProdi as $prodi): ?>
                                <option value="<?= $prodi['recid']; ?>"><?= $prodi['var_value']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <div class="form-group" style="width: 48%;">
                            <label for="choice2">Pilihan Kedua</label>
                            <select id="choice2" name="choice2" class="form-control">
                                <option value="">Tidak Ada Pilihan Kedua</option>
                                <?php foreach ($dataProdi as $prodi): ?>
                                    <option value="<?= $prodi['recid']; ?>"><?= $prodi['var_value']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group" style="width: 48%;">
                            <label for="choice3">Pilihan Ketiga</label>
                            <select id="choice3" name="choice3" class="form-control">
                                <option value="">Tidak Ada Pilihan Ketiga</option>
                                <?php foreach ($dataProdi as $prodi): ?>
                                <option value="<?= $prodi['recid']; ?>"><?= $prodi['var_value']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                                

                <!-- Jenis Pendaftaran dan Agama -->
                <div class="form-row">
                    <div class="input-group">
                        <div style="width: 48%;">
                            <p>Jenis Pendaftaran:</p>
                            <select id="registrationType" name="registrationType" required>
                                <option value="">Pilih Jenis Pendaftaran</option>
                                <option value="Mahasiswa baru">Mahasiswa Baru</option>
                                <option value="Others">Lainnya</option>
                            </select>
                        </div>
                        <div style="width: 48%;">
                            <p>Agama:</p>
                            <input type="text" id="religion" name="religion" required>
                        </div>
                    </div>
                </div>

                <!-- NIS/NISN dan Asal Sekolah -->
                <div class="form-row">
                    <div class="input-group">
                        <div style="width: 48%;">
                            <p>NIS/NISN/NIM/STAMBUK:</p>
                            <input type="text" id="nis" name="nis" required>
                        </div>
                        <div style="width: 48%;">
                            <p>Asal Sekolah/Perguruan Tinggi:</p>
                            <input type="text" id="schoolOrigin" name="schoolOrigin" required>
                        </div>
                    </div>
                </div>

                <!-- Tahun Lulus dan Jenis Kelamin -->
                <div class="form-row">
                    <div class="input-group">
                        <div style="width: 48%;">
                            <p>Tahun Lulus:</p>
                            <input type="text" id="graduationYear" name="graduationYear" required>
                        </div>
                        <div style="width: 48%;">
                            <p>Jenis Kelamin:</p>
                            <select id="gender" name="gender" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="pria">Laki-laki</option>
                                <option value="wanita">Perempuan</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Email dan Phone -->
                <div class="form-row">
                    <div class="input-group">
                        <div style="width: 48%;">
                            <p>Email:</p>
                            <input type="text" id="email" name="email" required>
                        </div>
                        <div style="width: 48%;">
                            <p>Phone/WA Number:</p>
                            <input type="text" id="phone" name="phone" required>
                        </div>
                    </div>
                </div>

                <!-- Asal Daerah dan Sumber Referensi -->
                <div class="form-row">
                    <div class="input-group">
                        <div style="width: 48%;">
                            <p>Asal Daerah:</p>
                            <input type="text" id="region" name="region" required>
                        </div>
                        <div style="width: 48%;">
                            <p>Sumber Referensi:</p>
                            <input type="text" id="referenceSource" name="referenceSource" required>
                        </div>
                    </div>
                </div>

                <!-- Referral ID dan Password -->
                <div class="form-row">
                    <div class="input-group">
                        <div style="width: 48%;">
                            <p>Referral ID:</p>
                            <input type="text" id="referralId" name="referralId">
                        </div>
                        <div style="width: 48%;">
                            <p>Password:</p>
                            <input type="text" id="password" name="password" required>
                        </div>
                    </div>
                </div>

                <input type="submit" value="Submit">
            </form>

            <p class="note">* Biaya Registrasi = Rp 153,000</p>
            <p class="login-link">
                Sudah mendaftar? <a href="#">Login di sini</a>
            </p>
        </div>
    </div>

    <div class="footer">
    @2024 HEWI
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault(); // Prevent form submission

                // Gather form data
                var formData = {
                    nik : <?php echo $nik; ?>,
                    name: $('#name').val(),
                    choice1: $('#choice1').val(),
                    choice2: $('#choice2').val(),
                    choice3: $('#choice3').val(),
                    registrationType: $('#registrationType').val(),
                    religion: $('#religion').val(),
                    nis: $('#nis').val(),
                    schoolOrigin: $('#schoolOrigin').val(),
                    graduationYear: $('#graduationYear').val(),
                    gender: $('#gender').val(),
                    email: $('#email').val(),
                    phone: $('#phone').val(),
                    region: $('#region').val(),
                    referenceSource: $('#referenceSource').val(),
                    referralId: $('#referralId').val(),
                    password: $('#password').val()
                };

                $.ajax({
                    url: '/admin/pendaftaran/save',
                    type: 'POST',
                    data: JSON.stringify(formData), // Send form data as JSON
                    contentType: 'application/json', // Ensure correct content type
                    success: function(response) {
                        // jQuery should automatically parse JSON response, but check if needed
                        if (typeof response === 'string') {
                            response = JSON.parse(response); // Parse if returned as string
                        }

                        console.log(response); // Check the response structure in console

                        // Display success or error message
                        alert('Pendaftaran : ' + response.status + ' - ' + response.message);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Pendaftaran : ' + textStatus);
                    }
                });

            });
        });
    </script>

</body>
</html>
