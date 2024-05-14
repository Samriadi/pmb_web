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
        }
		tr, td, th{
			padding: 1px;
			margin: auto;
			/* border: none; */
			border: 1px solid black;
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
			<td style="width:25%;">
                <img src="./asset/logo-univeral.png" style="width:65%">

			</td>
			<td style="width:75%;">
				<div class="tentang">
				<p style="font-size : 25px;">UNIVERSITAS ALMARISAH MADANI</p>
				<p style="font-size : 20px;">ILMU KESEHATAN</p>
				<p>Paccerakkang, Kec. Biringkanaya, Kota Makassar, Sulawesi Selatan 90245, Telp : 62882019436805</p>
				<p>Email : pmb@univeral.ac.id</p>
				<p>Website : univeral.ac.id</p><br>
				</div>
			</td>
		</tr>
		<tr style="height: 25%;">
			<td style="width:25%;">
				<img src="./asset/user.jpg" style="width:65%">
                <!-- <img src="http://hewi.co.id/app/edu/images/<?= $foto_peserta ?>" style="width:45%"> -->
			</td>
			<td>
				<div class="data">
				<P>KARTU PESERTA UJIAN SARINGAN MASUK </P>
				<P><?= $nama_lengkap?></P>
				<P>Nomer peserta ujian : <?= $no_ujian?></P>
				<P>Program Kuliah <?= $kategori?></P><br>
				</div>
			</td>
		</tr>
		<tr style="height: 25%;">
			<td style="width:25%;">
				<div class="prodi">
				<p>Program Studi :</p>
				<p><?=$pilihan_1?></p>
				<p><?=$pilihan_2?></p>
				<p><?=$pilihan_3?></p>
				</div>
			</td>
			<td>
				<?php foreach ($jadwal as $data) : ?>
					<div class="keterangan">
					<p><?= $data["nama_tes"] ?></p>
					<p><?= $data["hari_tes"] ?>. <?= $data["tanggal_tes"]?>. (<?= $data["waktu_tes"]?> - Selesai)</p>
					<p>Tempat : <?= $data["tempat_tes"] ?></p>
					<p><?= $data["keterangan"] ?></p>
					</div><br>
				<?php endforeach ?>

			</td>
		</tr>
	</table>
	</div>
	<script>
		window.print();
	</script>
 
</body>
</html>