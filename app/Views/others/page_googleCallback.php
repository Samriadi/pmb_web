<?php

$client_id = '203970939775-gsku8lo8f2cf2q148m5nas8an9mlahqj.apps.googleusercontent.com';
$client_secret = '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';
$redirect_uri = 'http://localhost/admin/callback';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    $token_url = 'https://oauth2.googleapis.com/token';
    $post_fields = http_build_query([
        'code' => $code,
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'grant_type' => 'authorization_code',
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($response, true);
    $access_token = $response_data['access_token'];

    $user_info_url = 'https://www.googleapis.com/oauth2/v2/userinfo';
    $headers = ['Authorization: Bearer ' . $access_token];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $user_info_url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $user_info = curl_exec($ch);
    curl_close($ch);

    $user_data = json_decode($user_info, true);
    $email = $user_data['email'];

    // echo json_encode($user_data);
}
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
        <?php if(isset($email)): ?>
            var email = <?php echo json_encode($email); ?>;
            console.log("Email: " + email);

            $(document).ready(function() {
                $.ajax({
                    url: '/admin/login/authGoogleLogin',
                    method: 'POST',
                    contentType: 'application/json',
                    data: JSON.stringify({
                        email: email,
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
                                    window.location.href = '/admin';
                                });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Email belum terdaftar!',
                            icon: 'error',
                            timer: 1000,
                            showConfirmButton: false
                            }).then((result) => {
                                window.location.href = '/admin/login';
                            });
                        }
                    }
                });
            })    
            

            <?php endif; ?>
    </script>