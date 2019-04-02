<?php
include_once("php_includes/check_login_status.php");
// Initialize any variables that the page might echo
// Make sure the _GET username is set, and sanitize it
if($user_ok == false){
	// header("location: index.php");
 //    exit();	
}
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Dashboard</title>
<?php require_once("php_includes/head-tags.php") ?>
</head>
<body>
<div id="container">

		<?php require_once("header.php"); ?>

		<div id="body">
			
                <div id="content"  class="animated fadeIn">
            <!-- here the content will be started -->
            <!-- here the content will be started -->
            <!-- here the content will be started -->
                <div class="sidebar">
                    <a href="addcrop.php">
                    <div class="sidebar-buttons">
                        <img src="images/icons/add.png" id="add-crop-image"> 
                        <h4>Add New Crop</h4>
                        <h5><span style="color: red;">*</span>Credentials Required</h5>

                    </div>
                    </a>
                    <button class="sidebar-buttons" value="1">
                        <h4> Crop #1 - Orange</h4>
                        <h5>09 / 11 / 2018 to 01 / 04 / 2019</h5>
                    </button>
                    <button class="sidebar-buttons" value="2">
                       <h4> Crop #2 - potatos</h4>
                       <h5>09 / 11 / 2018 to 01 / 04 / 2019</h5>
                    </button>
                    <button class="sidebar-buttons" value="3">
                       <h4> Crop #3 - Watermelon</h4>
                       <h5>09 / 11 / 2018 to 01 / 04 / 2019</h5>
                    </button>
                    <button class="sidebar-buttons">
                        <h4> Crop #4 - Orange</h4>
                        <h5>09 / 11 / 2018 to 01 / 04 / 2019</h5>
                    </button>
                    <button class="sidebar-buttons">
                       <h4> Crop #5 - potatos</h4>
                       <h5>09 / 11 / 2018 to 01 / 04 / 2019</h5>
                    </button>
                    <button class="sidebar-buttons">
                       <h4> Crop #6 - Watermelon</h4>
                       <h5>09 / 11 / 2018 to 01 / 04 / 2019</h5>
                    </button>
                    <button class="sidebar-buttons">
                        <h4> Crop #7 - Orange</h4>
                        <h5>09 / 11 / 2018 to 01 / 04 / 2019</h5>
                    </button>
                    <button class="sidebar-buttons">
                       <h4> Crop #8 - potatos</h4>
                       <h5>09 / 11 / 2018 to 01 / 04 / 2019</h5>
                    </button>
                    <button class="sidebar-buttons">
                       <h4> Crop #9 - Watermelon</h4>
                       <h5>09 / 11 / 2018 to 01 / 04 / 2019</h5>
                    </button>
                </div>

                <div id="content-for-sidebar">
                    <?php 
                        $latitude = 27.97321;
                        $longitude = 74.92577;
                        // 
                        $temp = 37;
                        $wind = "25 km/hour";
                        $humidity = "15%";
                        $solarr = "10 mj/m2";
                        $soilm = "50 mm/m";
                        // 
                        $lastirr = "Sunday 31 / 03 / 2019";
                        $upirr = "Tuesday 02 / 04 / 2019";
                        $plantlife = "Incomplete";
                    ?>
                  <h3>Crop No. - Name</h3>
                  <div class="dynamic-content-for-sidebar">
                      <!-- Start from here the tabs -->
                            <button class="tablink" onclick="openPage('Monitoring', this, '#47a3da')" id="defaultOpen">Monitoring</button>
                            <button class="tablink" onclick="openPage('Status', this, '#47a3da')">Status</button>
                            <button class="tablink" onclick="openPage('Graphs', this, '#47a3da')">Graphs</button>
                            <button class="tablink" onclick="openPage('Reports', this, '#47a3da')">Reports</button>
                            <button class="tablink" onclick="openPage('Crops-options', this, '#47a3da')">Crops options</button>


                            <div id="Monitoring" class="tabcontent" class="animated fadeIn">
                              <h3>Today is
                                <span style="color: #47a3da;">
                                <?php
                                echo " " . date("l") ." ". date("d / m / Y");
                                ?>
                                </span> 
                              </h3>
                                <div id="temp-div" class="animated fadeIn">
                                    <h1 id="temp"><?php echo $temp; ?><sup style="font-size: 0.4em;">&#8451;</sup></h1>
                                </div>
                                <div id="tempotherattributes" class="animated fadeIn">
                                    <h4 id="wind">Wind Speed: <?php echo $wind; ?></h4>
                                    <h4 id="humidity">Humidity: <?php echo $humidity; ?></h4>
                                    <h4 id="solarr">Solar Radiation: <?php echo $solarr; ?></h4>
                                    <h4 id="soilm">Soil Moisture: <?php echo $soilm; ?></h4>
                                </div>
                              <p>Weather is updated dailey depending on online api weather from abc.</p>
                            </div>
                            
                            <div id="Status" class="tabcontent">
                                <div class="animated fadeIn">
                              <h3>Crop Status</h3>
                              <h3 id="lastirr">Last irrigation timing: <?php echo $lastirr; ?></h3>
                              <h3 id="upirr">Upcoming irrigation timing: <?php echo $upirr; ?></h3>
                              <h3 id="plantlife">Lifecycle Stage: <?php echo $plantlife; ?></h3>
                              <p>Some news this fine day!</p> 
                              </div>
                            </div>

                            <div id="Graphs" class="tabcontent">
                              <div id="chartContainer1" style="min-height: 470px; max-width: 920px; margin: 0px auto;"></div>
                              <br>
                              <div id="chartContainer2" style="min-height: 470px; max-width: 920px; margin: 0px auto;"></div>
                            </div>

                            <div id="Reports" class="tabcontent">
                              <h3>Reports</h3>
                              <p>Reports are send weekly and monthly to this e-mail:aaaaaa@aaaaaa.com</p>
                            </div>
                                
                            <div id="Crops-options" class="tabcontent">
                              <h3>Crops options</h3>
                              <p>Who we are and what we do.</p>
                            </div>
    
                      <!-- End is here for the tabs -->
                  </div>
                  <table>
                      <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Points</th>
                      </tr>
                      <tr class="row-select">
                        <td>Jill</td>
                        <td>Smith</td>
                        <td>50</td>
                      </tr>
                      <tr class="row-select">
                        <td>Eve</td>
                        <td>Jackson</td>
                        <td>94</td>
                      </tr>
                      <tr class="row-select">
                        <td>Adam</td>
                        <td>Johnson</td>
                        <td>67</td>
                      </tr>
                    </table>
                  


                </div>


                <!-- <div id="crop-overview">
                    <h3>Crop #1 - Orange</h3>
                    <h4>Start date: 01/05/2018 to End Date: 05/08/2019</h4>
                    
                </div>
                <div id="crop-overview">
                    <h3>Crop #2 - Water melon</h3>
                    <h4>Start date: 01/05/2018 to End Date: 05/08/2019</h4>
                    <div>
                        
                    </div>
                </div> -->
                <!-- <div id="crop-overview">
                    <h3>Crop #3 - potatos</h3>
                    <h4>Start date: 01/05/2018 to End Date: 05/08/2019</h4>
                    <div id="crop-overview-option">
                        <img src="images/icons/folder.png">
                        <h4 class="crop-overview-option-heading1">Crop constants</h4>
                        <p>Soil type: mud</p>
                        <p>Area: 250mm2</p>
                    </div> -->
                    <!-- <div id="crop-overview-option">
                        <img src="images/icons/folder.png">
                        <h4 class="crop-overview-option-heading1">Crop constants</h4>
                        <p>Soil type: mud</p>
                        <p>Area: 250mm2</p>
                    </div> -->
                    <!-- <div id="crop-overview-option">
                        <img src="images/icons/folder.png">
                        <h4 class="crop-overview-option-heading1">Crop constants</h4>
                        <p>Soil type: mud</p>
                        <p>Area: 250mm2</p>
                    </div> -->
                    <!-- <div id="crop-overview-option">
                        <img src="images/icons/folder.png">
                        <h4 class="crop-overview-option-heading1">Crop constants</h4>
                        <p>Soil type: mud</p>
                        <p>Area: 250mm2</p>
                    </div> -->
                    <!-- <div id="crop-overview-option">
                        <img src="images/icons/folder.png">
                        <h4 class="crop-overview-option-heading1">Crop constants</h4>
                        <p>Soil type: mud</p>
                        <p>Area: 250mm2</p>
                    </div>
                </div>
                 <div id="crop-overview">
                   <h3>Crop #4 - Sweet potatos</h3>
                    <h4>Start date: 01/05/2018 to End Date: 05/08/2019</h4>
                    
                </div>
                <div id="crop-overview">
                   <h3>Crop #5 - Strewberry</h3>
                    <h4>Start date: 01/05/2018 to End Date: 05/08/2019</h4>
                    
                </div> -->
                
                
            <!-- here the content will be ended -->
            <!-- here the content will be ended -->
            <!-- here the content will be ended -->
            
            
                
            <!-- here the content will be ended -->
			<!-- here the content will be ended -->
			<!-- here the content will be ended -->
			
            
			
		</div>	

</div>
<?php require_once("footer.php"); ?>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

    /////////////////////////////////////////////////////////////////
    $(document).ready(function(){
        $("#pdfreportfitcher").click(function(){
                    var reportval = document.getElementById("pdfreportfitcher").value; 
                    if(reportval != ""){
//                        alert(reportval);
//                        window.location = "TCPDF-master/examples/workpermissionreportgenerator.php?id="+reportval;
                        window.open("TCPDF-master/examples/workpermissionreportgenerator.php?id="+reportval , "_blank");
                        //window.location = "user.php?u="+ajax.responseText;              
                    }else {
                        alert("Something went wrong");
                    }
        });

         $(".sidebar-buttons").on('click', function(){

            var crop_id = $(this).val();

            // alert(crop_id);
            // document.getElementById("dfatercontent").innerHTML = '<img src=\"images/icons/preloader.svg\" width=\"80\" height=\"80\" style=\"margin:auto auto; margin-top:200px;\">';

            var ajax = ajaxObj("POST", "cropresponse.php");
            ajax.onreadystatechange = function() {
                if(ajaxReturn(ajax) == true) {
                        // document.getElementsByClassName("dynamic-content-for-sidebar").innerHTML = ajax.responseText;
                        document.getElementById("content-for-sidebar").innerHTML = ajax.responseText;

                }
            }
            ajax.send("crop_id="+crop_id);
        });

        $(".tablink").on('click', function(){

            var chart1 = new CanvasJS.Chart("chartContainer1", {
                animationEnabled: true,
                theme: "light2",
                title:{
                    text: "Water requirment (mm/day)"
                },
                axisX:{
                    valueFormatString: "D MMMM",
                    crosshair: {
                        enabled: true,
                        snapToDataPoint: true
                    }
                },
                axisY: {
                    title: "ETC",
                    crosshair: {
                        enabled: true
                    }
                },
                toolTip:{
                    shared:true
                },  
                legend:{
                    cursor:"pointer",
                    verticalAlign: "bottom",
                    horizontalAlign: "left",
                    dockInsidePlotArea: true,
                    itemclick: toogleDataSeries
                },
                data: [{
                    type: "line",
                    showInLegend: true,
                    name: "Usage per day",
                    markerType: "square",
                    xValueFormatString: "DD MMM, YYYY",
                    color: "#F08080",
                    dataPoints: [
                        { x: new Date(2017, 0, 3), y: <?php echo 650; ?> },
                        { x: new Date(2017, 0, 4), y: 700 },
                        { x: new Date(2017, 0, 5), y: 710 },
                        { x: new Date(2017, 0, 6), y: 658 },
                        { x: new Date(2017, 0, 7), y: 734 },
                        { x: new Date(2017, 0, 8), y: 963 },
                        { x: new Date(2017, 0, 9), y: 847 }
                    ]
                }]
            });
            chart1.render();

            function toogleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else{
                    e.dataSeries.visible = true;
                }
                chart1.render();
            }



                /////////////////////////////////////////////////////////////////

                /////////////////////////////////////////////////////////////////
                

            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                theme: "light2",
                title:{
                    text: "Crop Coefficient"
                },
                axisX:{
                    valueFormatString: "DD MMMM",
                    crosshair: {
                        enabled: true,
                        snapToDataPoint: true
                    }
                },
                axisY: {
                    title: "KC",
                    crosshair: {
                        enabled: true
                    }
                },
                toolTip:{
                    shared:true
                },  
                legend:{
                    cursor:"pointer",
                    verticalAlign: "bottom",
                    horizontalAlign: "left",
                    dockInsidePlotArea: true,
                    itemclick: toogleDataSeries
                },
                data: [
                {
                    type: "line",
                    showInLegend: true,
                    name: "Unique Visit",
                    lineDashType: "dash",
                    dataPoints: [
                        { x: new Date(2017, 0, 3), y: 200 },
                        { x: new Date(2017, 0, 4), y: 200 },
                        { x: new Date(2017, 0, 5), y: 200 },
                        { x: new Date(2017, 0, 6), y: 200 },
                        { x: new Date(2017, 0, 7), y: 400 },
                        { x: new Date(2017, 0, 8), y: 600 },
                        { x: new Date(2017, 0, 9), y: 600 },
                        { x: new Date(2017, 0, 10), y: 600 },
                        { x: new Date(2017, 0, 11), y: 600 },
                        { x: new Date(2017, 0, 12), y: 600 },
                        { x: new Date(2017, 0, 13), y: 400 },
                        { x: new Date(2017, 0, 14), y: 200 },
                        { x: new Date(2017, 0, 15), y: 200 },
                        { x: new Date(2017, 0, 16), y: 200 }
                    ]
                }]
            });
            chart2.render();

            function toogleDataSeries(e){
                if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                    e.dataSeries.visible = false;
                } else{
                    e.dataSeries.visible = true;
                }
                chart2.render();
            }

            });
        });

    /////////////////////////////////////////////////////////////////
function openPage(pageName,elmnt,color) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].style.backgroundColor = "";
    }
    document.getElementById(pageName).style.display = "block";
    elmnt.style.backgroundColor = color;

}


// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();


//     function dfater(dfatervalue){
// //        dfatervalue
// //        alert("it works " + dfatervalue);
//         window.open('TCPDF-master/examples/workpermissiondfatergenerator.php?id='+dfatervalue , '_blank');
//     }

// 	$(document).ready(function(){

//         $(".sidebar-buttons").on('click', function(){
// 			var crop_id = $(this).val();

//             alert(crop_id);
//             // document.getElementById("dfatercontent").innerHTML = '<img src=\"images/icons/preloader.svg\" width=\"80\" height=\"80\" style=\"margin:auto auto; margin-top:200px;\">';

//             var ajax = ajaxObj("POST", "cropresponse.php");
//             ajax.onreadystatechange = function() {
//                 if(ajaxReturn(ajax) == true) {
//                         // document.getElementsByClassName("dynamic-content-for-sidebar").innerHTML = ajax.responseText;
//                         document.getElementById("content-for-sidebar").innerHTML = ajax.responseText;

//                 }
//             }
//             ajax.send("crop_id="+crop_id);
//         });
        
// //        $(".dfaterbutton").click(function(){
// //            alert(document.getElementsByClassName("dfaterbutton").value);
// ////           $("#datafromdatabase").load("out.php");
// //        });
        
// 	});
</script>
</body>
</html>