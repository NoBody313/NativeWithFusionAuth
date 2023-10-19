<?php
require __DIR__. '/config.php';
require __DIR__. '/common.php';
require __DIR__ . '/vendor/autoload.php';

$provider = new \League\OAuth2\Client\Provider\GenericProvider([
    'clientId'                => $client_id, 
    'clientSecret'            => $client_secret,
    'redirectUri'             => $redirect_uri,
    'urlAuthorize'            => $fa_url.'/oauth2/authorize',
    'urlAccessToken'          => $fa_url.'/oauth2/token',
    'urlResourceOwnerDetails' => $fa_url.'/oauth2/userinfo' 
]);

if (empty($_GET['state']) || (isset($_SESSION['oauth2state']) && $_GET['state'] !== $_SESSION['oauth2state'])) {

  if (isset($_SESSION['oauth2state'])) {
    unset($_SESSION['oauth2state']);
  }
    
  exit('Invalid state');
}

try {

  // Try to get an access token using the authorization code grant.
  $accessToken = $provider->getAccessToken('authorization_code', [
    'code' => $_GET['code']
  ]);

  // Using the access token, we may look up details about the
  // resource owner.
  $resourceOwner = $provider->getResourceOwner($accessToken);
  $_SESSION['user'] = $resourceOwner;
  // Kondisi Kalau udah login akan diarahkan kesini
  header("Location: /views/home.php"); 

} catch (\League\OAuth2\Client\Provider\Exception\IdentityProviderException $e) {

  // Failed to get the access token or user details.
  exit($e->getMessage());

}

