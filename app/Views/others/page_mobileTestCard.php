<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Convert HTML to Image and Download</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .container {
            width: 100%;
            min-height: 200px;
        }
        .card {
            margin-top: 20px;
            border: 2px dashed rgba(0, 0, 0, 0.5);
            padding: 20px;
            width: 85%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 6px;
        }
        .header table {
            border-collapse: collapse;
            width: 100%;
        }
        .details table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
            padding: 20px;
        }
        .details table td {
            border: none;
        }
        .prodi table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
        }
        .prodi .pilihan {
            padding-left: 25px;
        }
        .footer table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer .qr-code {
            text-align: center;
        }
     
    </style>
</head>
<body>
    <div id="content">
    <div class="container">
        <div class="card">
            <div class="header">
                <table border="1">
                    <tr style="height: min-content">
                        <td rowspan="2" style="width: 30%">
                         <p><img src="public/uploads/photo/max.jpg" style="width:100%;"/></p>

                        </td>
                        <td style="width: 15%">
                        <p><img src="public/uploads/photo/max.jpg" style="width:100%;"/></p>

                        </td>
                        <td>
                            <h1>Nama Kampus Dan Alamat</h1>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <h1>
                                Kartu Tanda Peserta Ujian <br />
                                Tahun 2024
                            </h1>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="details">
                <table border="1">
                    <tr>
                        <td>Nomor Peserta</td>
                        <td>:</td>
                        <td>24-7101-110274</td>
                    </tr>
                    <tr>
                        <td>Nama Peserta</td>
                        <td>:</td>
                        <td>Muh. Siswandi Budiarto Danisah</td>
                    </tr>
                    <tr>
                        <td>Tanggal Lahir</td>
                        <td>:</td>
                        <td>20-02-2006</td>
                    </tr>
                    <tr>
                        <td>NISN</td>
                        <td>:</td>
                        <td>0062996193</td>
                    </tr>
                </table>
            </div>
            <div class="prodi">
                <table border="1">
                    <td>
                        <h3>PILIHAN PRODI</h3>
                        <div class="pilihan">
                            <p>Pilihan 1: Universitas Gadjah Mada - 361063 - S1 - Teknik Mesin</p>
                            <p>Pilihan 2: Universitas Hasanuddin - 711016 - S1 - Teknik Perkapalan</p>
                            <p>Pilihan 3: -</p>
                            <p>Pilihan 4: -</p>
                        </div>
                    </td>
                </table>
            </div>
            <div class="footer">
                <table border="1">
                    <tr>
                        <td>
                            <div class="instructions">
                                <h5>1. PERLENGKAPAN YANG HARUS DIBAWA PADA SAAT UJIAN :</h5>
                                <ul>
                                    <li>Kartu Tanda Peserta SNBT 2024</li>
                                    <li>Fotokopi Kartu Status Siswa Aktif</li>
                                    <li>Surat Keterangan Kelas 12 dari Kepala Sekolah</li>
                                    <li>Fotokopi Ijazah atau Surat Keterangan Lulus</li>
                                    <li>Pas foto berwarna 3x4 sebanyak 2 lembar</li>
                                    <li>Kartu Identitas: KTP/SIM/Identitas Lain</li>
                                    <li>Alat Tulis: Pensil 2B, Karet Penghapus, dan Rautan</li>
                                </ul>
                                <h5>2. LOKASI UTBK HARUS DILIHAT SATU HARI SEBELUM PELAKSANAAN UJIAN</h5>
                                <h5>3. MENGENAKAN MASKER PADA SAAT BERADA DI LOKASI UJIAN</h5>
                                <h5>4. PESERTA HARUS DALAM KONDISI SEHAT</h5>
                            </div>
                        </td>
                        <td style="width: 30%">
                            <div class="qr-code">
                                <p><img src="public/uploads/photo/max.jpg" style="width:100%;"/></p>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    </div>
    
    <script>
        $(document).ready(function() {
            html2canvas($("#content")[0]).then(function(canvas) {
                // Convert the canvas to a data URL
                const dataURL = canvas.toDataURL('image/png');
                
                // Create a link element
                const link = document.createElement('a');
                link.href = dataURL;
                link.download = 'content.png';

                // Append the link to the body
                $("body").append(link);

                // Programmatically click the link to trigger the download
                link.click();

                // Remove the link from the document
                $(link).remove();
            });
        });
    </script>
</body>
</html>
