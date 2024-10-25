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
        font-size: 1rem; /* Base font size for scaling */
    }
    .header, .footer {
        background-color: #800020;
        color: white;
        padding: 1.25rem;
        font-size: 1.5rem;
        text-align: center;
    }
    .container {
        flex: 1;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }
    .form-container {
        background-color: white;
        padding: 2rem;
        border: 1px solid #800020;
        border-radius: 10px;
        max-width: 600px;
        width: 100%;
        text-align: left;
        font-size: 1rem;
    }
    .form-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    .input-group {
        display: flex;
        width: 100%;
    }
    p, label {
        margin: 0 0 0.25rem;
        font-size: 0.9rem;
    }
    input[type="text"], select {
        width: 85%;
        padding: 0.75rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 4%;
        font-size: 1rem;
    }
    input[type="submit"] {
        background-color: #5a6268;
        color: white;
        padding: 0.75rem 1.5rem;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        margin-top: 1rem;
        font-size: 1rem;
    }
    input[type="submit"]:hover {
        background-color: #343a40;
    }
    .note, .login-link {
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }
    .login-link a {
        color: #007bff;
        text-decoration: none;
    }
    .login-link a:hover {
        text-decoration: underline;
    }

    p {
        font-size: 14px;
    }

    /* Untuk layar lebih kecil, seperti smartphone */
    @media (max-width: 600px) {
        body {
            font-size: 14px;
        }
        .header, .footer {
            font-size: 20px;
        }
        .form-container h3 {
            font-size: 20px;
        }
        p {
            font-size: 14px;
        }
    }

    /* Untuk layar sedang, seperti tablet */
    @media (min-width: 601px) and (max-width: 900px) {
        body {
            font-size: 15px;
        }
        .header, .footer {
            font-size: 22px;
        }
        .form-container h3 {
            font-size: 22px;
        }
        p {
            font-size: 15px;
        }
    }

    /* Untuk layar besar, seperti desktop */
    @media (min-width: 901px) {
        body {
            font-size: 16px;
        }
        .header, .footer {
            font-size: 24px;
        }
        .form-container h3 {
            font-size: 24px;
        }
        p {
            font-size: 16px;
        }
    }

    /* Media Queries for smaller devices */
    @media (max-width: 600px) {
        body {
            font-size: 0.9rem;
        }
        .header, .footer {
            font-size: 1.25rem;
            padding: 1rem;
        }
        .form-container {
            padding: 1.5rem;
            font-size: 0.9rem;
        }
        input[type="text"], select {
            width: 100%;
            font-size: 0.9rem;
        }
        input[type="submit"] {
            font-size: 0.9rem;
        }
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
                            <option value="0" disabled selected>Pilih Prodi</option>
                            <?php foreach ($dataProdi as $prodi): ?>
                                <option value="<?= $prodi['recid']; ?>"><?= $prodi['var_others']; ?> - <?= $prodi['var_value']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="input-group">
                        <div class="form-group" style="width: 48%;">
                            <label for="choice2">Pilihan Kedua</label>
                            <select id="choice2" name="choice2" class="form-control">
                                <option value="0">Tidak Ada Pilihan Kedua</option>
                                <?php foreach ($dataProdi as $prodi): ?>
                                    <option value="<?= $prodi['recid']; ?>"><?= $prodi['var_others']; ?> - <?= $prodi['var_value']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="form-group" style="width: 48%;">
                            <label for="choice3">Pilihan Ketiga</label>
                            <select id="choice3" name="choice3" class="form-control">
                                <option value="0">Tidak Ada Pilihan Ketiga</option>
                                <?php foreach ($dataProdi as $prodi): ?>
                                <option value="<?= $prodi['recid']; ?>"><?= $prodi['var_others']; ?> - <?= $prodi['var_value']; ?></option>
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
                                <option value="Mahasiswa pindahan">Mahasiswa Pindahan</option>
                                <option value="Mahasiswa transfer">Mahasiswa Transfer</option>
                            </select>
                        </div>
                        <div style="width: 48%;">
                            <label for="religion">Agama:</label>
                            <select id="religion" name="religion" required>
                                <option value="" disabled selected>Pilih Agama</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Konghucu">Konghucu</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function() {
        $('#registrationForm').on('submit', function(e) {
            e.preventDefault(); // Prevent form submission

            // Gather form data
            var formData = {
                nik: <?php echo json_encode($nik); ?>, // Use json_encode for safety
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
                    if (typeof response === 'string') {
                        response = JSON.parse(response); // Parse if returned as string
                    }

                    sessionStorage.setItem('formData', JSON.stringify(formData));     
                    var paramsProdi = new URLSearchParams({
                        x: formData.choice1,
                        y: formData.choice2,
                        z: formData.choice3
                    });
                                // Display success or error message
                    alert('Pendaftaran : ' + response.status + ' - ' + response.message);

                    window.location.href = '/admin/pendaftaran/info?' + paramsProdi.toString();

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
