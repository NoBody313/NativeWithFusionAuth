<?php
require __DIR__ . '/config.php';
require __DIR__ . '/common.php';
require __DIR__ . '/vendor/autoload.php';

use League\OAuth2\Client\Provider\GenericProvider;

$provider = new GenericProvider([
    'clientId'                => $client_id, 
    'clientSecret'            => $client_secret,
    'redirectUri'             => $redirect_uri,
    'urlAuthorize'            => $fa_url . '/oauth2/authorize',
    'urlAccessToken'          => $fa_url . '/oauth2/token',
    'urlResourceOwnerDetails' => $fa_url . '/oauth2/userinfo',
]);

// Inisialisasi sesi jika belum ada
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Simpan state yang dihasilkan untuk sesi.
if (!isset($_SESSION['oauth2state'])) {
    $_SESSION['oauth2state'] = $provider->getState();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome Page</title>
  <link rel="stylesheet" href="/resources/css/output.css">
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

  <div class="container mx-auto my-auto w-full h-screen flex flex-col items-center justify-center">
    <h1 class="welcomeText w-auto h-auto text-center font-bold text-xl">Welcome to our App<h1>
        <h2 class="mt-1">Please log in before continue</h2>
        <?php if (!isset($_SESSION['user'])) { ?>
        <br />

        <a href='<?php echo $provider->getAuthorizationUrl() . '&redirect=/views/home.php'; ?>'
          class="loginBtn w-auto h-auto py-4 px-8 bg-sky-200 rounded-md">Login</a>
        <?php } ?>
  </div>
  
</body>

</html>