<?php
require_once '../vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-6/assets/css/login-6.css">
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #8e44ad, #3498db);
            /* Latar belakang gradien */
            animation: fadeIn 1s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .full-height {
            height: 100%;
            width: 90%;
            align-items: center;
            justify-content: center;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateY(-50px);
                opacity: 0;
            }

            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .card {
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
            transition: transform 0.4s ease, box-shadow 0.4s ease;
            color: #333;
            padding: 20px;
        }

        .card:hover {
            transform: translateY(-15px) scale(1.05);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            /* Increased shadow on hover */
        }

        .btn-custom {
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .btn-custom:hover {
            background-color: #0056b3;
            transform: translateY(-3px);
        }

        .bg-danger {
            width: 100%;
            height: auto;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="full-height p-3 p-md-4 p-xl-5 mt-5">
        <section class="p-3 p-md-4 p-xl-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
                        <div class="card border-0 shadow-lg">
                            <div class="card-body p-3 p-md-4 p-xl-5">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-5 text-center">
                                            <h3>Log in</h3>
                                        </div>
                                    </div>
                                </div>
                                <form id="loginForm">
                                    <div class="row gy-3 overflow-hidden">
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="username" id="username" placeholder="Username" required>
                                                <label for="username" class="form-label">Username</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-floating mb-3">
                                                <input type="password" class="form-control" name="userpass" id="userpass" placeholder="Userpass" required>
                                                <label for="userpass" class="form-label">Userpass</label>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button class="btn btn-custom btn-primary" type="submit">Log in now</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                event.preventDefault();
                var username = $('#username').val();
                var userpass = $('#userpass').val();

                $.ajax({
                    url: '/admin/login/authLogin',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        username: username,
                        userpass: userpass
                    }),
                    success: function(response) {
                        let responseObject = JSON.parse(response);
                        if (responseObject.success === true) {
                            Swal.fire({
                                title: 'Success!',
                                text: 'You have been logged in',
                                icon: 'success',
                                timer: 1000,
                                showConfirmButton: false
                            }).then((result) => {
                                window.location.href = '/admin/siakad/select-dash';
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Periksa kembali username dan password anda',
                                icon: 'error',
                                timer: 1000,
                                showConfirmButton: false
                            });
                        }
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        $('#message').html('<p>Terjadi kesalahan saat menghubungi server. (' + errorMessage + ')</p>');
                    }
                });
            });
        });
    </script>
</body>

</html>