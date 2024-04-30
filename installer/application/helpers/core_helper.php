<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Outputs an array in a user-readable JSON format
 *
 * @param array $array
 */

if (!function_exists('display_json')) {
    function display_json($array) {
        $data = json_indent($array);
        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');
        echo xss_clean($data);
    }
}


if (!function_exists('get_logged_in_user_role_slug')) 
{
    function get_logged_in_user_role_slug($user_role) 
    {  

        $CI = get_instance();
        $user_role_slug = $CI->db->select('id,slug')->where('id',$user_role)->get('user_role')->row_array();
        if($user_role_slug)
        {
            return $user_role_slug;
        }
        else
        {
            return FALSE;
        }
    }
}



if (!function_exists('json_indent')) {
    function json_indent($array = array()) {
        // make sure array is provided
        if (empty($array)) return NULL;
        // Encode the string
        $json = json_encode($array);
        $result = '';
        $pos = 0;
        $str_len = strlen($json);
        $indent_str = '  ';
        $new_line = "\n";
        $prev_char = '';
        $out_of_quotes = true;
        for ($i = 0;$i <= $str_len;$i++) {
            // grab the next character in the string
            $char = substr($json, $i, 1);
            // are we inside a quoted string?
            if ($char == '"' && $prev_char != '\\') {
                $out_of_quotes = !$out_of_quotes;
            }
            // if this character is the end of an element, output a new line and indent the next line
            elseif (($char == '}' OR $char == ']') && $out_of_quotes) {
                $result.= $new_line;
                $pos--;
                for ($j = 0;$j < $pos;$j++) {
                    $result.= $indent_str;
                }
            }
            // add the character to the result string
            $result.= $char;
            // if the last character was the beginning of an element, output a new line and indent the next line
            if (($char == ',' OR $char == '{' OR $char == '[') && $out_of_quotes) {
                $result.= $new_line;
                if ($char == '{' OR $char == '[') {
                    $pos++;
                }
                for ($j = 0;$j < $pos;$j++) {
                    $result.= $indent_str;
                }
            }
            $prev_char = $char;
        }
        // return result
        return $result . $new_line;
    }
}


if (!function_exists('action_not_permitted')) {
    function action_not_permitted() {
        return true; die;
        $ci = & get_instance();
        $ci->session->set_flashdata('error', "This action is not permitted.");
        redirect_back();
    }
}


if ( ! function_exists('redirect_back'))
{
    function redirect_back()
    {
        if (isset($_SERVER['HTTP_REFERER']))
        {
            header('Location: '.$_SERVER['HTTP_REFERER']);
        }
        else
        {
            header('Location: http://'.$_SERVER['SERVER_NAME']);
        }
    }
}


if (!function_exists('slugify_string')) 
{
    function slugify_string($text) 
    {
        return url_slug($text);
        exit;
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
        // trim
        $text = trim($text, '-');
        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);
        // lowercase
        $text = strtolower($text);
        if (empty($text)) {
            return 'n-a';
        }
        return $text;
    }
}

if (!function_exists('url_slug')) 
{
    function url_slug($str, $options = array()) 
    {
        // Make sure string is in UTF-8 and strip invalid UTF-8 characters
        $str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
        
        $defaults = array(
            'delimiter' => '-',
            'limit' => null,
            'lowercase' => true,
            'replacements' => array(),
            'transliterate' => false,
        );
        
        // Merge options
        $options = array_merge($defaults, $options);
        
        $char_map = array(
            // Latin
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
            'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
            'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
            'ß' => 'ss', 
            'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
            'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
            'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
            'ÿ' => 'y',

            // Latin symbols
            '©' => '(c)',

            // Greek
            'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
            'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
            'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
            'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
            'Ϋ' => 'Y',
            'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
            'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
            'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
            'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
            'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

            // Turkish
            'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
            'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

            // Russian
            'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
            'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
            'Я' => 'Ya',
            'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
            'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
            'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
            'я' => 'ya',

            // Ukrainian
            'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
            'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

            // Czech
            'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
            'Ž' => 'Z', 
            'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
            'ž' => 'z', 

            // Polish
            'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
            'Ż' => 'Z', 
            'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
            'ż' => 'z',

            // Latvian
            'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
            'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
            'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
            'š' => 's', 'ū' => 'u', 'ž' => 'z'
        );
        
        // Make custom replacements
        $str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
        
        // Transliterate characters to ASCII
        if ($options['transliterate']) {
            $str = str_replace(array_keys($char_map), $char_map, $str);
        }
        
        // Replace non-alphanumeric characters with our delimiter
        $str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
        
        // Remove duplicate delimiters
        $str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
        
        // Truncate slug to max. characters
        $str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
        
        // Remove delimiter from ends
        $str = trim($str, $options['delimiter']);
        
        return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
    }
}


if (!function_exists('xss_clean')) {
    function xss_clean($data)
    {
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        // we are done...
        return $data;
    }
}

function encrypt_decrypt($action, $string) {
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'asweefdkhdsvbkdjsahflksa32432oqwru423rifu@3r4';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);

    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } 
    else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
        return $output;
}


function get_date_formate($date)
{
    if(empty($date))
    {
        $date = date("d-m-Y");
    }

    $ci = & get_instance();
    $ci->load->database();
    $db_data = $ci->db->where('name','date_formate')->get('settings_data')->row();
    if ($db_data) 
    {
        return date($db_data->value,strtotime($date));
    }
    return $date; 
}

function get_date_or_time_formate($date_time)
{
    if(empty($date_time))
    {
        $date_time = date("d-m-Y H:i:s");
    }

    $ci = & get_instance();
    $ci->load->database();
    $db_date_data = $ci->db->where('name','date_formate')->get('settings')->row();
    $db_time_data = $ci->db->where('name','date_or_time_formate')->get('settings')->row();
    
    if ($db_date_data && $db_time_data) 
    {
        return date($db_date_data->value." ".$db_time_data->value,strtotime($date_time));
    }
    return $date_time; 
}


if (!function_exists('get_admin_setting')) {
    function get_admin_setting($field_name) 
    {
        return get_setting_value_by_name($field_name);
    }
}


if (!function_exists('get_setting_value_by_name')) 
{
    function get_setting_value_by_name($field_name) 
    {   
        $CI = get_instance();
        return $CI->db->get('settings')->row($field_name);
    }
}


if (!function_exists('get_web_page')) 
{
    function get_web_page($url) 
    {
        try
        {

            $options = array(
                CURLOPT_RETURNTRANSFER => true,   // return web page
                CURLOPT_HEADER         => false,  // don't return headers
                CURLOPT_FOLLOWLOCATION => true,   // follow redirects
                CURLOPT_MAXREDIRS      => 10,     // stop after 10 redirects
                CURLOPT_ENCODING       => "",     // handle compressed
                // CURLOPT_USERAGENT      => $_SERVER['HTTP_HOST'], // name of client
                CURLOPT_USERAGENT      => base_url(), // name of client
                CURLOPT_AUTOREFERER    => true,   // set referrer on redirect
                CURLOPT_CONNECTTIMEOUT => 120,    // time-out on connect
                CURLOPT_TIMEOUT        => 120,    // time-out on response
                CURLOPT_REFERER        => base_url(),    // 'https://m.facebook.com/', 
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
}


if (!function_exists('get_staff_role_id')) 
{
    function get_staff_role_id() 
    {   
        $CI = get_instance();
        $id  = $CI->db->where('id',2)->get('user_role')->row('id');
        if($id)
        {
            return $id;
        }
        else
        {
           return 2;
        }
        
    }
}

if (!function_exists('check_user_role')) 
{
                
    function check_user_role($action_id)
    {
        $CI = &get_instance();
        $ci_admin = $CI->session->userdata('admin');
        $access    = $ci_admin['user_role'];
            
        if($access!=1) 
        {      
            $CI->db->where('action_id', $action_id);
            $CI->db->where('role_id', $access);
            $result = $CI->db->get('rel_role_action')->row_array();

            if($result) 
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return 1;
        }
    }
}    
   


if (!function_exists('get_case_categories_menus_obj')) 
{
    function get_case_categories_menus_obj() 
    {   
        $CI = get_instance();
        return $CI->db->where('display_in_menu','YES')->order_by('name','asc')->get('case_categories')->result();
    }
}

if (!function_exists('get_pages_menus_obj')) 
{
    function get_pages_menus_obj() 
    {   
        $CI = get_instance();
        return $CI->db->where('on_menu',1)->order_by('title','asc')->get('pages')->result();
    }
}

if (!function_exists('excute_sql_query')) 
{
    function excute_sql_query() 
    {
        $CI = get_instance();
        $CI->load->helper('directory');
        $sql_directories = FCPATH . '/assets/db.sql';
        // die($sql_directories);
        if (!is_file($sql_directories))
        {
            return TRUE;
        }
        $sql = file_get_contents($sql_directories);

        $now = date("Y-m-d H:i:s");

        $sql = str_replace('update_data_added', $now, $sql);

            try
            {
                $sql = file_get_contents($sql_directories);
                $sqls = explode(';---END_OF_QUERY-FOR_ADVOCATE-AUTO_UPDATES---;', $sql);
                array_pop($sqls);

                $CI->db->trans_start();
                foreach($sqls as $statement){
                    $statment = $statement . ";";
                    $CI->db->query($statement);
                }

                $CI->db->trans_complete(); 

                $message = "success";
            }
            catch(Exception $e)
            {
                $message = $e->getMessage();
            }
            unlink($sql_directories);

            return TRUE;
    }
}


if (!function_exists('excute_sql_json_query')) 
{
    function excute_sql_json_query() 
    {
        $CI = get_instance();
        $CI->load->helper('directory');
        $sql_directories = FCPATH . 'assets/db.json';

        if (!is_file($sql_directories))
        {
            return TRUE;
        }
        
        $now = date("Y-m-d H:i:s");

        try
        {
            $sql_json = file_get_contents($sql_directories);
            $sql_json = str_replace('update_data_added', $now, $sql_json);
            $sql_array = json_decode($sql_json);
            $sql_array = json_decode(json_encode($sql_array), true);
            // P($sql_array);
            if($sql_array && is_array($sql_array))
            {
                $CI->db->trans_start();
                foreach($sql_array as $query_data)
                {
                    if($query_data && is_array($query_data))
                    {
                        if($query_data['query_type'] == 'alter_table')
                        {
                            $alter_table_data = $CI->db->list_fields($query_data['table_name']);
                            if($alter_table_data)
                            {
                                $q_column_name = $query_data['column_name'];

                                $is_column_exist = (in_array($q_column_name,$alter_table_data)) ? TRUE : FALSE;

                                if($is_column_exist == TRUE && $query_data['alter_action'] == "drop")
                                {
                                    $CI->db->query($query_data['query']);
                                }
                                if($is_column_exist == FALSE && $query_data['alter_action'] == "add")
                                {
                                    $CI->db->query($query_data['query']);
                                }
                            }
                        }
                        else if($query_data['query_type'] == 'insert' && $query_data['table_name'] =='settings' && $query_data['alter_action']=='check_it' && $query_data['column_name'])
                        {
                            $all_settings_data = $CI->db->get('settings')->result_array();
                            $all_settings_key = array_column($all_settings_data,"name");
                            
                            $is_exist_setting = in_array($query_data['column_name'], $all_settings_key);
                            if(!$is_exist_setting)
                            {
                               $CI->db->query($query_data['query']); 
                            }
                        }
                        else
                        {
                            $CI->db->query($query_data['query']);
                        }
                    }                        
                }
                $CI->db->trans_complete(); 
            }

            
        }
        catch(Exception $e)
        {
            $message = $e->getMessage();
        }
        unlink($sql_directories);

        return TRUE;
    }
}

if (!function_exists('get_holidays')) 
{
    function get_holidays($id) 
    {   
       $month =  date('F', strtotime($id));
       
        $CI = get_instance();
        $holiday_list = $CI->db->where('month_id',$id)->get('holidays')->result();
        return $holiday_list;
    }
}



if ( ! function_exists('get_string_with_limit'))
{
    function get_string_with_limit($string, $length = 300)
    {
        if(strlen($string) > $length)
        {
            $string = substr($string,0,$length) . '...';
        }
       return $string;
    }
}
