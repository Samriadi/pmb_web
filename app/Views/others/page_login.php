<!DOCTYPE html>
<html lang="en">


<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Log In</title>
  <link rel="stylesheet" href="https://unpkg.com/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://unpkg.com/bs-brain@2.0.4/components/logins/login-6/assets/css/login-6.css">
</head>
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
  }

  .bg-primary {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .full-height {
    height: 100%;
    width: 90%;
    align-items: center;
    justify-content: center;
  }
</style>

<body class="bg-primary">
  <!-- Login 6 - Bootstrap Brain Component -->
  <div class="full-height p-3 p-md-4 p-xl-5 mt-5">
    <section class="bg-primary p-3 p-md-4 p-xl-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-12 col-md-9 col-lg-7 col-xl-6 col-xxl-5">
            <div class="card border-0 shadow-sm rounded-4">
              <div class="card-body p-3 p-md-4 p-xl-5">
                <div class="row">
                  <div class="col-12">
                    <div class="mb-5">
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
                        <input type="password" class="form-control" name="userpass" id="userpass" value="" placeholder="Userpass" required>
                        <label for="userpass" class="form-label">Userpass</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="d-grid">
                        <button class="btn bsb-btn-2xl btn-primary" type="submit">Log in now</button>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="row">
                  <div class="col-12">
                    <p class="mt-4 mb-4">Or continue with</p>
                    <div class="d-flex gap-3 flex-column">
                      <a href="#!" class="btn bsb-btn-xl btn-danger">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-google" viewBox="0 0 16 16">
                          <path d="M15.545 6.558a9.42 9.42 0 0 1 .139 1.626c0 2.434-.87 4.492-2.384 5.885h.002C11.978 15.292 10.158 16 8 16A8 8 0 1 1 8 0a7.689 7.689 0 0 1 5.352 2.082l-2.284 2.284A4.347 4.347 0 0 0 8 3.166c-2.087 0-3.86 1.408-4.492 3.304a4.792 4.792 0 0 0 0 3.063h.003c.635 1.893 2.405 3.301 4.492 3.301 1.078 0 2.004-.276 2.722-.764h-.003a3.702 3.702 0 0 0 1.599-2.431H8v-3.08h7.545z" />
                        </svg>
                        <span class="ms-2 fs-6 text-uppercase">Sign in With Google</span>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
              timer: 800,
              showConfirmButton: false
            }).then((result) => {
              window.location.href = '/admin';
            });
          } else {
            Swal.fire({
              title: 'Error!',
              text: 'Periksa kembali username dan password anda',
              icon: 'error',
              timer: 800,
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


</html>