<?php
include_once("php_includes/check_login_status.php");
// Initialize any variables that the page might echo
if(isset($_SESSION["userid"])){
	// header("location: mainpage.php");
 //    exit();
}
?><?php
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
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Smart Irrigation system</title>
<?php require_once("php_includes/head-tags.php") ?>
<script>
			jQuery.ajax({
            url: "php.php?url="+encodeURIComponent("https://weather.cit.api.here.com/weather/1.0/report.json?product=observation&latitude=30.04594%20&longitude=31.23271&oneobservation=true&app_id=mq7wwlzVevbQWUi1Lxz9&app_code=6wIchV7KtUYpOr7dodTKjg"),
            type: "GET",

            contentType: 'application/json; charset=utf-8',
            success: function(resultData) {
                //here is your json.
                  // process it
                  alert("success");

            },
            error : function(jqXHR, textStatus, errorThrown) {
            	alert("error");
            },

            timeout: 120000,
        	});

			function animate(id,valid){
				
				if(valid == 1){
				$(id).addClass('animated flash').one('webkitAnimationEnd mozAnimationEnd oAnimationEnd animationend' , function(){
					  		$(this).removeClass('animated flash');
				});
				}
				if(valid == 0){
				$(id).addClass('animated shake').one('webkitAnimationEnd mozAnimationEnd oAnimationEnd animationend' , function(){
					  		$(this).removeClass('animated shake');
				});
				}
			}
    
            
    
			$(document).ready(function(){
				//user check
                var uname = document.getElementById("username").value;
                var upass = document.getElementById("password").value;
				$("#username").blur(function(){

					var arg = document.getElementById("username").value;

					  if (arg != "") {
					  	animate('#username', 1);
					    $('#username').css('background-image',' url("images/icons/success.svg")');
					    $('#username').css('border',' 1px solid #47a3da');
					  } else {
					  	animate('#username', 0);
					    $('#username').css('background-image',' url("images/icons/error.svg")');
					    $('#username').css('border',' 1px solid red');
					  }
					  
					
				});

				//first-name check
			    $("#password").blur(function(){

					var arg = document.getElementById("password").value;

					  if (arg != "") {
					  	animate('#password', 1);
					    $('#password').css('background-image',' url("images/icons/success.svg")');
					    $('#password').css('border',' 1px solid #47a3da');
					  } else {
					  	animate('#password', 0);
					    $('#password').css('background-image',' url("images/icons/error.svg")');
					    $('#password').css('border',' 1px solid red');
					  }
					  
					
				});


			    
				    
				//login function
				$("#loginbtn").click(function(){
						var e = document.getElementById("username").value;
						var p = document.getElementById("password").value;
						if(e == "" || p == ""){
							document.getElementById("form-status").innerHTML = "Wrong Username or password";
						} else {
							document.getElementById("loginbtn").style.display = "none";
							document.getElementById("form-status").innerHTML = '<img src=\"images/icons/preloader.svg\" width=\"40\" height=\"40\">';
							// document.getElementById("form-status").innerHTML = 'please wait ...';
							var ajax = ajaxObj("POST", "index.php");
					        ajax.onreadystatechange = function() {
						        if(ajaxReturn(ajax) == true) {
						            if(ajax.responseText == "login_failed"){
                                        animate('#password', 0);
                                        $('#password').css('background-image',' url("images/icons/error.svg")');
                                        $('#password').css('border',' 1px solid red');
                                        animate('#username', 0);
                                        $('#username').css('background-image',' url("images/icons/error.svg")');
                                        $('#username').css('border',' 1px solid red');
										
										document.getElementById("loginbtn").style.display = "block";
									}
                                    else{
                                    animate('#username', 1);
                                    $('#username').css('background-image',' url("images/icons/success.svg")');
                                    $('#username').css('border',' 1px solid #47a3da');
                                    animate('#password', 1);
                                    $('#password').css('background-image',' url("images/icons/success.svg")');
                                    $('#password').css('border',' 1px solid #47a3da');
                                       //window.location = "user.php?u="+ajax.responseText;
                                       window.location = "mainpage.php";
                                    }
                                    
						        }
					        }
					        ajax.send("e="+e+"&p="+p);
						}
				});  


			});


</script>
</head>
<body>
<div id="container">

		<?php require_once("header.php"); ?>

		<div id="body">
			<!-- here the content will be added -->
			<!-- here the content will be added -->
			<!-- here the content will be added -->
			<div id="content">
				
                
			<div id="loginformcontainer" class="animated bounceInDown">
						<div id="login-form">
						  <h2>Smart Irrigation system</h2>
                          <h3 class="raleway">User Login</h3>
						  <!-- LOGIN FORM -->
						  <form id="loginform" onsubmit="return false;">

						  	<div class="inputs-holder">
						  		<h4>Username</h4>
							<input type="text" id="username" class="inputs">
							<span class="input-status" id="username-status"></span>
							</div>
						    
						    <div class="inputs-holder">
						    	<h4>Password</h4>
							<input type="password" id="password" class="inputs">
							<span class="password-status" id="password-status"></span>
							</div>

						    <div id="form-status"></div>
						    <button id="loginbtn">Log in</button>
						    <br>
 
						    <?php
                              //date_default_timezone_set('Africa/Cairo');
                             // $today = date("Y-m-d H:i:s");
                             // echo $today; ?>
						  </form>
						  <!-- LOGIN FORM -->
                            
						</div>
                <div>
                    
                </div>

            </div>
			<!-- here the content will be ended -->
			<!-- here the content will be ended-->
			<!-- here the content will be ended -->
			</div>
            
			
			
		</div>
        <span class="animated bounceInUp">
		<?php require_once("footer.php"); ?>
        </span>
</div>

</body>
</html>
<!--

    [[[[[[[[[[[[[[[      ]]]]]]]]]]]]]]]
    [::::::::::::::      ::::::::::::::]
    [::::::::::::::      ::::::::::::::]
    [::::::[[[[[[[:      :]]]]]]]::::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[       CODED By       ]:::::]
    [:::::[ Mohamed Ibrahim Hany ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [:::::[                      ]:::::]
    [::::::[[[[[[[:      :]]]]]]]::::::]
    [::::::::::::::      ::::::::::::::]
    [::::::::::::::      ::::::::::::::]
    [[[[[[[[[[[[[[[      ]]]]]]]]]]]]]]]

-->