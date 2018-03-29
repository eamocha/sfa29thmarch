<?php ini_set('memory_limit','512M');
$items_per_group=1000;
$EMPTIES="(107,106,105)";
//db settings
$db_username = 'root';
$db_password = '123456';
$db_name = 'sfa';
$db_host = 'localhost';

if(!defined('DB_HOST')) define('DB_HOST',$db_host);
if(!defined('DB_USER')) define('DB_USER',$db_username );
if(!defined('DB_PASSWORD')) define('DB_PASSWORD',$db_password);
if(!defined('DB_NAME')) define('DB_NAME',$db_name);


///other constants

if(!defined('TODAY')) define('TODAY',date("Y-m-d"));
if(!defined('THIS_Y_MONT')) define('THIS_MONT',date("M Y"));

//mysqli
$mysqli = new mysqli($db_host, $db_username, $db_password,$db_name);
//PDO
$pdo= "mysql:host=$db_host;dbname=$db_name";


//Function to sanitize values received from the form. Prevents SQL injection
function get_my_db()
{     static $mysqli;
    if (!$mysqli) {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD,DB_NAME);
		mysqli_set_charset($mysqli, "utf8");
    }
    return $mysqli;
}
	function clear($str) {
		$db=get_my_db();
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return $db->real_escape_string($str);
	}
function clean($str) {
		$db=get_my_db();
		$str = @trim($str);
		if(get_magic_quotes_gpc()) {
			$str = stripslashes($str);
		}
		return $db->real_escape_string($str);
	}
$currency = 'Kes '; //Currency sumbol or code
date_default_timezone_set('Africa/Nairobi');
$today_constant=date("Y-m-d H:i:s");



?>