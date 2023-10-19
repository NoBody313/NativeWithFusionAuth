<?php
require __DIR__. '/config.php';
require __DIR__. '/common.php';
require __DIR__ . '/vendor/autoload.php';

unset($_SESSION['user']);

header("Location: $fa_url/oauth2/logout?client_id=$client_id&tenantId=$tenant_id"); 
?>
