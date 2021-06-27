<?php

require_once __DIR__ . '/vendor/autoload.php';

# instead of hardcoding username and password for the app in the source files
# we read them from the evironment.

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

# The original ispring source code hard-coded some urls to point to
# http://wordparts.net/ispring/*
#
# To facilitate migration and usage of the codebase on multiple domains
# we extract out the base url and use that instead

$base_url = $_ENV['BASE_URL'];


# the web app credentials
$app_valid_email = $_ENV['VALID_EMAIL'];
$app_valid_pass = $_ENV['VALID_PASS'];

# the ispring-learn API credentials
$ispring_auth_url = $_ENV['ISPRING_AUTH_URL'];
$ispring_auth_email = $_ENV['ISPRING_AUTH_EMAIL'];
$ispring_auth_pass = $_ENV['ISPRING_AUTH_PASS'];

$ispring_department_id = $_ENV['ISPRING_DEPARTMENT_ID'];
