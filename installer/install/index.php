<?php

$php_version_success = false;
$mysql_success = false;
$curl_success = false;
$mbstring_success = false;
$gd_success = false;
$timezone_success=false;
$zip_success=false;

$php_version_required = "7.0";
$current_php_version = PHP_VERSION;

//check required php version
if (version_compare($current_php_version, $php_version_required) >= 0) {
    $php_version_success = true;
}

//check mySql 
if (function_exists("mysqli_connect")) {
    $mysql_success = true;
}

//check curl 
if (function_exists("curl_version")) {
    $curl_success = true;
}

//check mbstring 
if (extension_loaded('mbstring')) {
    $mbstring_success = true;
}

//check gd
// if (extension_loaded('gd') && function_exists('gd_info')) {
//     $gd_success = true;

// }

if (extension_loaded('zip') && function_exists('gd_info')) {
    $zip_success = true;
}

// $timezone_settings = ini_get('date.timezone');
// if ($timezone_settings) {
//     $timezone_success = true;
// }

//check if all requirement is success && $gd_success && $timezone_success
if ($php_version_success && $mysql_success && $curl_success && $mbstring_success && $zip_success) {
    $all_requirement_success = true;
} else {
    $all_requirement_success = false;
}


$writeable_directories = array(
    'routes' => '/index.php',
    'config' => '/application/config/config.php',
    'database' => '/application/config/database.php',
    // 'excel' => '/excel',
    'assets/uploads' => '/assets/uploads',
);

foreach ($writeable_directories as $value) {
    if (!is_writeable(".." . $value)) {
        $all_requirement_success = false;
    }
}

$base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
$base_url .= "://" . $_SERVER['HTTP_HOST'];
$base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
$base_url = str_replace('/install/', '/', $base_url);


$dashboard_url = $base_url.'admin/login';


include "view/index.php";
?>