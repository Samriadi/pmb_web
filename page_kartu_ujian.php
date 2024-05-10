<!DOCTYPE html>
<html>
<head>
	<style>
		.container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            height: 200px;
			padding-top: 20px;
			padding-bottom: 20px;
        }
		tr, td, th{
			padding: 1px;
			margin: auto;
			border: none;
		}
		p {
			margin: 5px;
		}
		img {
			width: 70%;
			display: block;
			margin: auto;
		}
		.prodi {
			text-align: center;
		}
		.data {
			text-align: center;
			font-weight: bold;
		}
		.keterangan {
			text-align: center;
		}
		.tentang{
			font-weight: bold;
			
		}
		@media print {
            @page {
                size: auto; 
				margin: 0mm;
			}
        }
    </style>
</head>
<body>
	<div class="container">
	<table border =2; align="center">
		<tr style="height: 25%;">
			<td style="width:30%;">
				<img src="Picture1.png">
			</td>
			<td>
				<div class="tentang">
				<p style="font-size : 25px;">HEWI UNIVERSITY</p>
				<p style="font-size : 20px;">Fakultas <?=$fakultas?></p>
				<p>jl. Pendalaman II Kec. Bustamani Sudiang 90121, Telp : 0411-637276767</p>
				<p>Email : pmbhewi@gmail.co.id</p>
				<p>Website : Https://hewi.co.id/campus</p><br>
				</div>
			</td>
		</tr>
		<tr style="height: 25%;">
			<td style="width:30%;">
                <img src="http://hewi.co.id/app/edu/images/<?= $foto_peserta ?>" style="width:45%">
			</td>
			<td>
				<div class="data">
				<P>KARTU PESERTA UJIAN SARINGAN MASUK </P>
				<P><?= $nama_lengkap?></P>
				<P>Nomer peserta ujian : <?= $no_ujian?></P>
				<P>Program Kuliah <?= $jenjang?></P><br>
				</div>
			</td>
		</tr>
		<tr style="height: 25%;">
			<td style="width:30%;">
				<div class="prodi">
				<p>Program Studi :</p>
				<p><?=$pilihan_1?></p>
				<p><?=$pilihan_2?></p>
				<p><?=$pilihan_3?></p>
				</div>
			</td>
			<td>
				<div class="keterangan">
				<p>Gelombang 2</p>
				<p><?= $hari_tes?>. <?= $tanggal_tes?>. (08:30 - 10:00) WIB</p>
				<p>Tempat : Kampus II Ruang 101</p>
				</div>
			</td>
		</tr>
	</table>
	</div>
	<script>
		window.print();
	</script>
 
</body>
</html>