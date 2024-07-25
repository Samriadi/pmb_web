<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

  <style>
    body {
      padding: 20px;
    }

    .header {
      position: relative;
      background-image: url('https://via.placeholder.com/1200x300');
      background-size: cover;
      background-position: center;
      height: 300px;
      padding: 20px 15px 0;
    }

    .profile-picture {
      position: absolute;
      bottom: -120px;
      left: 50%;
      transform: translateX(-50%);
      border: 5px solid white;
      border-radius: 50%;
      width: 220px;
      height: 220px;
      background-color: white;
      overflow: hidden;
    }

    .profile-picture img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    @media (max-width: 767px) {
      .header {
        height: 200px;
        padding: 15px 10px 0;
      }

      .profile-picture {
        width: 100px;
        height: 100px;
        bottom: -50px;
      }
    }
  </style>
</head>

<body>
  <header class="header d-flex justify-content-center align-items-center">
    <div class="profile-picture">
      <img src="https://via.placeholder.com/100" class="img-fluid">
    </div>
  </header>
</body>

</html>