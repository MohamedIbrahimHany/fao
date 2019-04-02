<?php
include_once("php_includes/check_login_status.php");
// Initialize any variables that the page might echo
// Make sure the _GET username is set, and sanitize it
if($user_ok == false){
	// header("location: index.php");
 //    exit();	
}
?><?php

//unit
//ezn
//eqtype
//eqname
//eqno
//qty
//qtyunit
//eqstatus 
//fixtype
//enterdate
//appdate
//stdate
//edate
//deldate
//notes

                    
				//				// arabic setting for database
//				$query = mysqli_query($db_conx,"SET NAMES utf8;");
//				$query = mysqli_query($db_conx,"SET CHARACTER_SET utf8;");
//				//
//				$query = mysqli_query($db_conx, $sql); 

               if(isset($_POST['ezn'])){
                    // CONNECT TO THE DATABASE
                    include_once("php_includes/db_conx.php");
                    //email api
                    // Function to get the client IP address
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
                    // GATHER THE POSTED DATA INTO LOCAL VARIABLES
                    //$fn = preg_replace('#[^أ-يa-zA-Z]#i', '', $_POST['fn']);
                    date_default_timezone_set('Africa/Cairo');
                    $today = date("Y-m-d H:i:s");

                    $workpermissionno = mysqli_real_escape_string($db_conx, $_POST['ezn']);
                    $equipmenttype = mysqli_real_escape_string($db_conx, $_POST['eqtype']);
                    $equipmentname = mysqli_real_escape_string($db_conx, $_POST['eqname']);
                    $equipmentno = mysqli_real_escape_string($db_conx, $_POST['eqno']);
                    $quantityy = mysqli_real_escape_string($db_conx, $_POST['qty']);
                    $quantityunit = mysqli_real_escape_string($db_conx, $_POST['qtyunit']);
                    $fixtype = mysqli_real_escape_string($db_conx, $_POST['fixtype']);
                    $equipmentcondition = mysqli_real_escape_string($db_conx, $_POST['eqstatus']);
                    $unit = mysqli_real_escape_string($db_conx, $_POST['unit']);
                    $mmcnumberr  = mysqli_real_escape_string($db_conx, $_POST['notes']); //////
                    $notess  = mysqli_real_escape_string($db_conx, $_POST['notes']);
                    $checkindate = mysqli_real_escape_string($db_conx, $_POST['enterdate']);
                    $approvaldate = mysqli_real_escape_string($db_conx, $_POST['appdate']);
                    $startfix = mysqli_real_escape_string($db_conx, $_POST['stdate']);
                    $endfix = mysqli_real_escape_string($db_conx, $_POST['edate']);;
                    $checkoutdate = mysqli_real_escape_string($db_conx, $_POST['deldate']);;
                    $lastedit = $today;
                    $editby = $rowuserid['grade']." ".$rowuserid['username'];

                    // GET USER IP ADDRESS
                    $ip = preg_replace('#[^0-9.]#', '', get_client_ip());
                    // DUPLICATE DATA CHECKS FOR USERNAME AND EMAIL
                    $sql = "SELECT work_permission_no FROM tanksandcollections WHERE work_permission_no='$workpermissionno' LIMIT 1";
                    
                    $query44 = mysqli_query($db_conx, $sql); 
                    $workpermission_check = mysqli_num_rows($query44);
                    // FORM DATA ERROR HANDLING
                    if($workpermission_check > 0){
                        echo "workpermission exist";
                        exit();
                    } else {
                    // END FORM DATA ERROR HANDLING
                        // Begin Insertion of data into the database

                        date_default_timezone_set('Africa/Cairo');
                        $today = date("Y-m-d H:i:s");
                        if($endfix != ""){
                        $sql = "INSERT INTO tanksandcollections (work_permission_no, equipment_type, equipment_name, equipment_no, quantity, quantity_unit, fix_type, equipment_condition, unit, mmcnumber, checkin_date, approval_date, start_fix, last_edit, end_fix, edit_by, notes) VALUES('$workpermissionno', '$equipmenttype', '$equipmentname', '$equipmentno', '$quantityy', '$quantityunit', '$fixtype', '$equipmentcondition', '$unit', '$mmcnumberr', '$checkindate', '$approvaldate', '$startfix', '$lastedit', '$endfix', '$editby', '$notess')";
                        }if($checkoutdate != ""){
                        $sql = "INSERT INTO tanksandcollections (work_permission_no, equipment_type, equipment_name, equipment_no, quantity, quantity_unit, fix_type, equipment_condition, unit, mmcnumber, checkin_date, approval_date, start_fix, last_edit, end_fix, checkout_date, edit_by, notes) VALUES('$workpermissionno', '$equipmenttype', '$equipmentname', '$equipmentno', '$quantityy', '$quantityunit', '$fixtype', '$equipmentcondition', '$unit', '$mmcnumberr', '$checkindate', '$approvaldate', '$startfix', '$lastedit', '$endfix', '$checkoutdate', '$editby', '$notess')";
                        }else{
                        $sql = "INSERT INTO tanksandcollections (work_permission_no, equipment_type, equipment_name, equipment_no, quantity, quantity_unit, fix_type, equipment_condition, unit, mmcnumber, checkin_date, approval_date, start_fix, last_edit, edit_by, notes) VALUES('$workpermissionno', '$equipmenttype', '$equipmentname', '$equipmentno', '$quantityy', '$quantityunit', '$fixtype', '$equipmentcondition', '$unit', '$mmcnumberr', '$checkindate', '$approvaldate', '$startfix', '$lastedit', '$editby', '$notess')";
                        }
                        
                        // arabic setting for database
                        $query = mysqli_query($db_conx,"SET NAMES utf8;");
                        $query = mysqli_query($db_conx,"SET CHARACTER_SET utf8;");
                        //
                        $query = mysqli_query($db_conx, $sql); 
                        
                        exit();
                    }
                    exit();
                }
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Add Crop</title>
<?php require_once("php_includes/head-tags.php") ?>


</head>
<body>
<div id="container">

		<?php require_once("header.php"); ?>

		<div id="body">
			<div id="content" >
            <!-- here the content will be started -->
			<!-- here the content will be started -->
			<!-- here the content will be started -->
                <div id="addworkpermissioncontainer" class="animated fadeIn">
						<div id="addworkpermission-form">
						  <h2>Add Crop</h2>
						  <!-- LOGIN FORM -->
						  <form id="addworkpermissionform" onsubmit="return false;">

                            <div class="row-holder">
                                <div class="addworkpermission-inputs-holder left">
                                    <h4>Crop Name </h4>
                                <input type="text" id="crop-name" class="addworkpermission-inputs">
                                
                                
                                </div>

                                <div class="addworkpermission-inputs-holder right">
                                    <h4>Crop Type </h4>
                                <select class="addworkpermission-inputs" id="crop-type" style="height:30px;display:inline-block;padding: 0 0;">
                                    <option value=""> </option>
                                    <option value="Lettuce">Lettuce</option>
                                    <option value="Spinach">Spinach</option>
                                    <option value="Tomato">Tomato</option>
                                    <option value="Cucumber">Cucumber</option>
                                    <option value="Sugarbeet">Sugarbeet</option>
                                    <option value="Beans">Beans</option>
                                    <option value="Soybeans">Soybeans</option>
                                    <option value="Rice">Rice</option>
                                    </select>
                                
                                
							     </div>
                            </div>


                              
                              <div class="row-holder">

                                    <div class="addworkpermission-inputs-holder left">
                                    <h4>Start Planting Date </h4>
                                    <input type="date" id="startdate" class="addworkpermission-inputs">
                                    
        							</div>
                                    <div class="addworkpermission-inputs-holder right">
                                    <h4>Geographic coordinate </h4>
                                    <input type="text" id="coordinate" class="addworkpermission-inputs" disabled="">   
        							</div>

                            </div>

                                <div class="row-holder">

                                    <div class="addworkpermission-inputs-holder left">

                                    <h4>Irrigation Type </h4>
                                    <select class="addworkpermission-inputs" id="irrigation-type" style="height:30px;display:inline-block;padding: 0 0;">
                                    <option value="1"> </option>
                                    <option value="0.6">Surface irrigation</option>
                                    <option value="0.75">Sprinkler irrigation</option>
                                    <option value="0.9">Drip irrigation</option>
                                    </select>
                                    

                                    </div>
                                      <div class="addworkpermission-inputs-holder right">
                                        <h4>Soil Type </h4>
                                    <select class="addworkpermission-inputs" id="soil-type" style="height:30px;display:inline-block;padding: 0 0;">
                                    <option value=""> </option>
                                    <option value="1">Coarse Sand</option>
                                    <option value="2">Fine Sand </option>
                                    <option value="3">Loamy Sand</option>
                                    <option value="4">Sandy Loam</option>
                                    <option value="5">Sandy Clay Loam</option>
                                    <option value="6">Loam</option>
                                    <option value="7">Silt Loam</option>
                                    <option value="8">Silty Clay Loam</option>
                                    <option value="9">Clay Loam</option>
                                    <option value="10">Silty Clay</option>
                                    <option value="11">Clay</option>
                                    <option value="12">Peat</option>
                                    </select>
                                    </div>
                                </div>

                                <!-- Google iframe here -->
                                <div id="note">

                                <div id="map"></div>
                                 <input type="text" id='lat' style="display: none;">
                                <input type="text" id='lon' style="display: none;">
                                <!-- Google iframe here -->

                                </div>

                                <hr class="style2">
                                <div class="row-holder">
                                    
                                    <div class="addworkpermission-inputs-holder left">
                                        <h3 id="optional-hint">Optional</h3>
                                        <br>
                                        <h4>Planting Area </h4>
                                        <input type="text" id="planting-area" class="addworkpermission-inputs">
                                        
                                    </div>
                                      <div class="addworkpermission-inputs-holder right">
                                        <h3 id="optional-hint"></h3>
                                        <br>
                                        <h4>Irrigation water salinity </h4>
                                        <input type="text" id="iws" class="addworkpermission-inputs">
                                    </div>
                                </div>

                                <div class="row-holder">
                                    
                                    <div class="addworkpermission-inputs-holder left">
                                        <h4>Distance between Plants </h4>
                                        <input type="text" id="distance" class="addworkpermission-inputs">
                                        
                                    </div>
                                      <div class="addworkpermission-inputs-holder right">
                                        <h4>Emitter disharge (for dip irrigation) </h4>
                                        <input type="text" id="emitterd" class="addworkpermission-inputs">
                                    </div>
                                </div>
                              
                              <div id="note">
                                <textarea id="irrigation-notes" placeholder="Notes about crop to be remembered"></textarea>
                              </div>

                              
                              
						    <div id="addworkpermission-status"></div>
                              <br>
                                <button id="addaddworkpermission-btn"> Add </button>
                              <br>
						  </form>
						  <!-- LOGIN FORM -->
						</div>

            </div> 
                
<!--                <button class="btn">اضف إذن شغل</button>-->
            <!-- here the content will be ended -->
			<!-- here the content will be ended -->
			<!-- here the content will be ended -->
			
            </div>
        </div>

		<?php require_once("footer.php"); ?>
</div>
<script>
      /*var map;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: -34.397, lng: 150.644},
          zoom: 8
        });
      }*/
      var clickLat;
      var clickLon;
       var map;
        function initMap() {
            var myLatlng = new google.maps.LatLng(24.18061975930,79.36565089010);
            var myOptions = {
                zoom:7,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            }
            map = new google.maps.Map(document.getElementById("map"), myOptions);
            // marker refers to a global variable
            marker = new google.maps.Marker({
                position: myLatlng,
                map: map
            });

            google.maps.event.addListener(map, "click", function(event) {
                // get lat/lon of click
                clickLat = event.latLng.lat();
                clickLon = event.latLng.lng();

                // show in input box
                document.getElementById("coordinate").value = clickLat.toFixed(5)+" , "+clickLon.toFixed(5);
                 document.getElementById("lat").value = clickLat.toFixed(5);
                document.getElementById("lon").value = clickLon.toFixed(5);

                  /*var marker = new google.maps.Marker({
                        position: new google.maps.LatLng(clickLat,clickLon),
                        map: map
                     });*/
                    marker.setPosition( new google.maps.LatLng( clickLat, clickLon ) );
                    map.panTo( new google.maps.LatLng( clickLat, clickLon ) );
            });
    }   


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
        //email check
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

        //enter-date check
        $("#startdate").blur(function(){
            var arg = document.getElementById("startdate").value;
            document.getElementById("enterdate").value = arg;
            document.getElementById("stdate").value = arg;
        });
        //workpermission check
        $("#ezn").keyup(function(){
                    var arg = document.getElementById("ezn");
                    var rx = new RegExp;
                    rx = /[ا-ي ئ ؤ ء a-z A-Z + - * ( ) & % $ # @ ! ~]/gi;
                    arg.value = arg.value.replace(rx, "");
        });
        //login function
        $("#addaddworkpermission-btn").click(function(){
                    var cropname = document.getElementById("crop-name").value;
                    var croptype = document.getElementById("crop-type").value;
                    var startdate = document.getElementById("startdate").value;
                    var coordinate = document.getElementById("coordinate").value;
                    var lat = document.getElementById("lat").value;
                    var lon = document.getElementById("lon").value;

                    var soiltype = document.getElementById("soil-type").value;
                    var irrigationtype = document.getElementById("irrigation-type").value;
                    var irrigationnotes = document.getElementById("irrigation-notes").value;
                    var plantingarea = document.getElementById("planting-area").value;
                    var iws = document.getElementById("iws").value;
                    var distance = document.getElementById("distance").value;
                    var emitterd = document.getElementById("emitterd").value;
                    
                    var date = new Date(startdate);
                    
//                    alert(unit+" "+ezn+" "+" "+eqtype+" "+eqname+" "+eqno+" "+qty+" "+qtyunit+" "+eqstatus+" "+fixtype+" "+enterdate+" "+appdate+" "+stdate+" "+edate+" "+deldate+" "+notes);
                    if(cropname == "" && croptype == "" && startdate == "" && coordinate == "" && irrigationtype == "" && soiltype == ""){
                        document.getElementById("addworkpermission-status").innerHTML = "Some Data are missing";
                        animate('#addworkpermission-status',0);
                    }else if(cropname == ""){
                        document.getElementById("addworkpermission-status").innerHTML = "Crop Name is missing";
                        animate('#addworkpermission-status',0);
                    } else if(croptype == ""){
                        document.getElementById("addworkpermission-status").innerHTML = "Crop Type is missing";
                        animate('#addworkpermission-status',0);
                    }else if(startdate == ""){
                        document.getElementById("addworkpermission-status").innerHTML = "Date is missing";
                        animate('#addworkpermission-status',0);
                    }else if(coordinate == ""){
                        document.getElementById("addworkpermission-status").innerHTML = "Coordinate is missing";
                        animate('#addworkpermission-status',0);
                    }else if(irrigationtype == ""){
                        document.getElementById("addworkpermission-status").innerHTML = "Irrigation type is missing";
                        animate('#addworkpermission-status',0);
                    }else if(soiltype == ""){
                        document.getElementById("addworkpermission-status").innerHTML = "Soil type is missing";
                        animate('#addworkpermission-status',0);
                    }else {
                        // alert(clickLat+" "+clickLon);
                    document.getElementById("addaddworkpermission-btn").style.display = "none";
                    document.getElementById("addworkpermission-status").innerHTML = '<img src=\"images/icons/preloader.svg\" alt=\"loading\" width=\"40\" height=\"40\">';
                    // document.getElementById("form-status").innerHTML = 'please wait ...';
                    var ajax = ajaxObj("POST", "createcroprecord.php");
                    ajax.onreadystatechange = function() {
                        if(ajaxReturn(ajax) == true) {
                            // if(ajax.responseText == "hi"){
                                alert(ajax.responseText);
                                document.getElementById("addworkpermission-status").innerHTML ="";
                                document.getElementById("addaddworkpermission-btn").style.display = "block";
//                             }
//                             else{
//                                //window.location = "user.php?u="+ajax.responseText;
// //                                   window.location = "mainpage.php";
//                                 alert("Crop Added");
//                                 document.getElementById("cropname").value ="";
//                                 document.getElementById("croptype").value ="";
//                                 document.getElementById("startdate").value ="";
//                                 document.getElementById("coordinate").value ="";
//                                 document.getElementById("irrigationtype").value ="";
//                                 document.getElementById("irrigationnotes").value ="1";
//                                 document.getElementById("plantingarea").value ="";
//                                 document.getElementById("iws").value ="";
//                                 document.getElementById("distance").value ="";
//                                 document.getElementById("emitterd").value ="";
//                                 document.getElementById("addworkpermission-status").innerHTML = '';
//                                 document.getElementById("addaddworkpermission-btn").style.display = "block";
                                
//                             }

                        }
                    }
                    ajax.send("cropname="+cropname+"&croptype="+croptype+"&date="+startdate+"&lat="+lat+"&lon="+lon+"&soiltype="+soiltype+"&irrigationtype="+irrigationtype+"&irrigationnotes="+irrigationnotes+"&plantingarea="+plantingarea+"&iws="+iws+"&distance="+distance+"&emitterd="+emitterd);
                }
        });  


    });

    //////////////////////////////////////////////////////////
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3fsR91pi7Tj2xDagMODccnlEhx9-H0Vw&callback=initMap"
    async defer></script>
</body>
</html>