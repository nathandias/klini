<?php

require_once __DIR__ . '/vendor/autoload.php';

# $development = false : read environment settings from the server environment
# (which will be set in .htaccess for dreamhost shared hosting)
# $development = true : reads environment settings through the vlucas/phpdotenv package

$development = false;

if ($development) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->safeLoad();
}

$base_url = $_ENV['BASE_URL'];

# the web app credentials
$app_valid_email = $_ENV['VALID_EMAIL'];
$app_valid_pass = $_ENV['VALID_PASS'];

# the ispring-learn API credentials
$ispring_auth_url = $_ENV['ISPRING_AUTH_URL'];
$ispring_auth_email = $_ENV['ISPRING_AUTH_EMAIL'];
$ispring_auth_pass = $_ENV['ISPRING_AUTH_PASS'];

$ispring_department_id = $_ENV['ISPRING_DEPARTMENT_ID'];

$pagination_limit = $_ENV['PAGINATION_LIMIT']; # default
if (isset($_GET['pagination_limit']) && is_numeric($_GET['pagination_limit']) && $_GET['pagination_limit'] > 0) {
    $pagination_limit = $_GET['pagination_limit'];
}
