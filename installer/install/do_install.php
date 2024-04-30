<?php
ini_set('max_execution_time', 300); //300 seconds 




function p($p, $exit = 1)
{
    echo '<pre>';
    print_r($p);
    echo '</pre>';
    if ($exit == 1)
    {
        exit;
    }
} 

function get_web_page($url)
{
    $ark_root = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
    $ark_root  .= "://".$_SERVER['HTTP_HOST'];
    $ark_root .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
    
    $base_url = str_replace('/install/', '', $ark_root);
        
    try
    {
        $options = array(
            CURLOPT_RETURNTRANSFER => true,   // return web page
            CURLOPT_HEADER         => false,  // don't return headers
            CURLOPT_FOLLOWLOCATION => true,   // follow redirects
            CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
            CURLOPT_ENCODING       => "",     // handle compressed
            // CURLOPT_USERAGENT      => $_SERVER['HTTP_HOST'], // name of client
            CURLOPT_USERAGENT      => $base_url, // name of client
            CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
            CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
            CURLOPT_TIMEOUT        => 120,    // time-out on response
            CURLOPT_REFERER        => $base_url,    // 'https://m.facebook.com/', 
        );  
        
        $ch = curl_init($url);
        curl_setopt_array($ch, $options);

        $content  = curl_exec($ch);
        
        curl_close($ch);

        return $content;
    }
    catch(Exception $e) 
    {
        return json_encode(array());
    }
}

if (isset($_POST)) 
{ 
    $host = $_POST["host"];
    $dbuser = $_POST["dbuser"];
    $dbpassword = $_POST["dbpassword"];
    $dbname = $_POST["dbname"];

    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $username = $_POST["username"];
    
    $login_password = $_POST["password"] ? $_POST["password"] : "12345";

    //check required fields
    if (!($host && $dbuser && $dbname && $first_name && $last_name && $email && $login_password)) {
        echo json_encode(array("success" => false, "message" => "Please input all fields."));
        exit();
    }


    //check for valid email
    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo json_encode(array("success" => false, "message" => "Please input a valid email."));
        exit();
    }

    if(!preg_match('/^[a-zA-Z0-9]{5,}$/', $username)) 
    { 
        echo json_encode(array("success" => false, "message" => "Please input a valid username."));
        exit();
    }

    //check for valid database connection
    $mysqli = @new mysqli($host, $dbuser, $dbpassword, $dbname);
    if (mysqli_connect_errno()) {
        echo json_encode(array("success" => false, "message" => $mysqli->connect_error));
        exit();
    }

    //all input seems to be ok. check required fiels
    if (!is_file('database.sql')) {
        echo json_encode(array("success" => false, "message" => "The database.sql file could not found in install folder!"));
        exit();
    }

    /*
     * check the db config file
     * if db already configured, we'll assume that the installation has completed
     */
    $db_file_path = "../application/config/database.php";
    $db_file = file_get_contents($db_file_path);
    $is_installed = strpos($db_file, "install_enter_hostname");

    if (!$is_installed) {
        echo json_encode(array("success" => false, "message" => "Seems this app is already installed! You can't reinstall it again."));
        exit();
    }

    //start installation
    $sql = file_get_contents("database.sql");

    //set admin information to database
    $now = date("Y-m-d H:i:s");
    $today = date("Y-m-d H:i:s");
    $password = sha1($login_password);

    // $sql = str_replace('install_users_username', $username, $sql);
    // $sql = str_replace('install_admin_first_name', $first_name." ".$last_name, $sql);
    // $sql = str_replace('install_admin_email_address', $email, $sql);
    // $sql = str_replace('install_users_password', $password, $sql);
    // $sql = str_replace('install_admin_joining_date', $today, $sql);
    //create tables in datbase 

    $mysqli->multi_query($sql);
    do {
        
    } while (mysqli_more_results($mysqli) && mysqli_next_result($mysqli));

    //start insert new user data in users table

    $insert_query = "INSERT INTO `users` (`employee_id`, `name`, `image`, `username`, `password`, `gender`, `dob`, `email`, `contact`, `address`, `user_role`, `token`, `client_case_alert`, `department_id`, `designation_id`, `joining_date`, `joining_salary`, `status`, `message_status`) 
    VALUES
    (0, '".$first_name."', 'user-default.jpg', '".$username."', '".$password."', '', '".$today."', '".$email."', '', '', 1, 'expired', 1, 0, 0, '".$today."', '', 1, 1)";

  $insert_status = mysqli_query($mysqli, $insert_query);
  // end insert process in users table
    
    //start update settings table update_info column
    $update_setting_sql = 'UPDATE `settings` SET `update_info` = CONCAT(\'{"current_version_code":"3", "current_version_name":"2.0.2","purchase_code":"'.$token.'", "purchase_code_updated":true, "is_verified":"true", "last_updated": "'.$today.'", "message":"Purchase Code Verify Successfully...!", "next_version_name":"", "next_version_description":"","next_version_all_data":"[]", "next_version_zip_urls":"[]","next_version_all_in_one_zip":"","added":"'.$today.'","updated":"'.$today.'"}\') WHERE id = 1';

    mysqli_query($mysqli, $update_setting_sql);
  //end of update settings table  

    $token_update_sql = 'UPDATE `settings` SET `site_update_token` = "'.$token.'" WHERE id = 1';
    mysqli_query($mysqli, $token_update_sql);
    

    $mysqli->close();
    // database created
    // set the database config file
    $db_file = str_replace('install_enter_hostname', $host, $db_file);
    $db_file = str_replace('install_enter_db_username', $dbuser, $db_file);
    $db_file = str_replace('install_enter_db_password', $dbpassword, $db_file);
    $db_file = str_replace('install_enter_database_name', $dbname, $db_file);
    file_put_contents($db_file_path, $db_file);

    // set random enter_encryption_key
    $config_file_path = "../application/config/config.php";
    $encryption_key = substr(md5(rand()), 0, 15);
    $config_file = file_get_contents($config_file_path);
    $config_file = str_replace('install_enter_encryption_key', $encryption_key, $config_file);

    $base_url = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
    $base_url .= "://" . $_SERVER['HTTP_HOST'];
    $base_url .= str_replace(basename($_SERVER['SCRIPT_NAME']), "", $_SERVER['SCRIPT_NAME']);
    $base_url = str_replace('/install/', '/', $base_url);

    $config_file = str_replace('install_enter_base_url_here', $base_url, $config_file);
    file_put_contents($config_file_path, $config_file);
    // set the environment = production

    $index_file_path = "../index.php";

    $index_file = file_get_contents($index_file_path);
    $index_file = preg_replace('/pre_installation/', 'production', $index_file, 1); //replace the first occurence of 'pre_installation'
    file_put_contents($index_file_path, $index_file);

    echo json_encode(array("success" => true, "message" => "Installation successfull."));
    exit();
}