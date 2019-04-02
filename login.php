<?php
function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ipaddress = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ipaddress = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
           $ipaddress = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ipaddress = getenv('REMOTE_ADDR');
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }
// AJAX CALLS THIS LOGIN CODE TO EXECUTE
if(isset($_POST['e'])){
	// CONNECT TO THE DATABASE
	include_once("php_includes/db_conx.php");
	// GATHER THE POSTED DATA INTO LOCAL VARIABLES AND SANITIZE
	$usernamee = mysqli_real_escape_string($db_conx, $_POST['e']);
	$p = md5($_POST['p']);
	// GET USER IP ADDRESS
    $taken_ip = get_client_ip();
    $ip = preg_replace('#[^0-9.]#', '', $taken_ip);
	// FORM DATA ERROR HANDLING
    
	if($usernamee == "" || $p == ""){
		echo "login_failed";
        exit();
	} else {
	// END FORM DATA ERROR HANDLING
        
		$sql = "SELECT user_id, username, password FROM users WHERE military_no='$usernamee' LIMIT 1";
        // arabic setting for database
		$query = mysqli_query($db_conx,"SET NAMES utf8;");
		$query = mysqli_query($db_conx,"SET CHARACTER_SET utf8;");
		//
        
        $query = mysqli_query($db_conx, $sql);
        $row = mysqli_fetch_row($query);
        
		$db_id = $row[0];
		$db_username = $row[1];
        $db_pass_str = $row[2];

		if($p != $db_pass_str){
			echo "login_failed";
            exit();
		} else {
			// CREATE THEIR SESSIONS AND COOKIES
			$_SESSION['userid'] = $db_id;
			$_SESSION['username'] = $db_username;
			$_SESSION['password'] = $db_pass_str;
			// UPDATE THEIR "IP" AND "LASTLOGIN" FIELDS
            date_default_timezone_set('Africa/Cairo');
			$today = date("Y-m-d H:i:s");
			$sql = "UPDATE users SET ip='$ip', lastlogin='$today' WHERE user_id='$db_id' LIMIT 1";
			// arabic setting for database
			$query = mysqli_query($db_conx,"SET NAMES utf8;");
			$query = mysqli_query($db_conx,"SET CHARACTER_SET utf8;");
			//
            $query = mysqli_query($db_conx, $sql);
			echo $db_username;  
		    exit();
		}
	}
    
    

	exit();
}
?>