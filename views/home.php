<?php
require __DIR__ . '/../config.php';
require __DIR__ . '/../common.php';
require __DIR__ . '/../vendor/autoload.php';

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

if (!isset($_SESSION['user'])) {
    // Jika variabel sesi tidak diatur, pengguna belum login
    // Redirect pengguna ke halaman login
    header('Location: /');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="/resources/css/output.css">
</head>

<body>
    <div class="container mx-auto my-auto w-full h-screen flex flex-col items-center justify-center">
        <?php if (isset($_SESSION['user'])) { ?>
        <div class="textContent">
            <h1 class="w-auto h-auto text-center font-bold text-xl">Hello, Welcome to Home</h1>

            <p class="mt-1 text-center">You are logged in</p>
        </div>

        <div class="menuContent flex flex-row mt-8 justify-between space-x-8">
            <div
                class="webExcel container flex flex-col px-6 py-4 w-fit h-auto bg-blue-200 border-2 rounded-md border-blue-500 items-center">
                <img src="/resources/img/xls-img.png" alt="excelImg" class="w-14 h-auto">
                <h2 class="font-medium text-lg mt-6">Redirect to Web Excel</h2>
            </div>

            <div
                class="webDVWA container flex flex-col px-6 py-4 w-fit h-auto bg-blue-200 border-2 rounded-md border-blue-500 items-center">
                <img src="/resources/img/dvwaLogo.svg" alt="excelImg" class="w-16 h-auto">
                <h2 class="font-medium text-lg mt-4">Redirect to Web DVWA</h2>
            </div>
        </div>

        <form action="/logout.php" method="post" class="w-auto h-auto py-4 px-8 mt-8 bg-sky-200 rounded-md">
            <input type="submit" value="Log out" />
        </form>
        <?php } ?>
    </div>
</body>

</html>