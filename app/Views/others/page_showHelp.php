<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php if (!empty($data)) { ?>
    <?php foreach ($data as $key => $konten) : ?>
      <?= $konten ?>
    <?php endforeach; ?>
  <?php } else {
    echo "<p>Tidak ada data </p>";
  } ?>
</body>

</html>