<?php
include_once("php_includes/check_login_status.php");
// Initialize any variables that the page might echo
// Make sure the _GET username is set, and sanitize it
if($user_ok == false){
	header("location: index.php");
    exit();	
}
?><?php
// Make sure the _GET username is set, and sanitize it
if(isset($_GET["q"])){
	$q = mysqli_real_escape_string($db_conx, $_GET['q']);
//	$workpermission = mysqli_real_escape_string($db_conx, $_GET['workpermission']);
	//$u = preg_replace('#[^a-z0-9]#i', '', $_GET['u']);
	$sql = "SELECT * FROM tanksandcollections WHERE work_permission_no LIKE '%q%' AND archived = 0";
	//$sql = "SELECT * FROM tbl_video LIMIT 2"; 
	$result = mysqli_query($db_conx,"SET NAMES utf8;");
	$result = mysqli_query($db_conx,"SET CHARACTER_SET utf8;"); 
	$result = mysqli_query($db_conx, $sql);  

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $workpid = $row['id'];
		$work_permission_no = $row['work_permission_no'];
		$equipment_type = $row['equipment_type'];
		$equipment_name = $row['equipment_name'];
		$equipment_no = $row['equipment_no'];
		$quantity = $row['quantity'];
		$quantity_unit = $row['quantity_unit'];
		$fix_type = $row['fix_type'];
		$equipment_condition = $row['equipment_condition'];	// must be unique
		$unit = $row['unit'];	// must be unique
		$notes = $row['notes'];
		$checkin_date = strftime("%d / %m / %Y", strtotime($row['checkin_date']));
		$approval_date = strftime("%d / %m / %Y", strtotime($row['approval_date']));
		$start_fix = strftime("%d / %m / %Y", strtotime($row['start_fix']));
        if($row['end_fix'] ==''){
                    $end_fix = '';
                }else{
                    $end_fix = strftime("%d / %m / %Y", strtotime($row['end_fix']));
                }

        if($row["checkout_date"] ==''){
                    $checkout_date = '';
                }else{
                    $checkout_date = strftime("%d / %m / %Y", strtotime($row["checkout_date"]));
                }

		$last_edit = strftime("%d / %m / %Y", strtotime($row['last_edit']));
		$edit_by = $row['edit_by'];
	}
} 
else {
    header("location: index.php");
    exit();	
}        
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8">
<title>Production Control</title>
<?php require_once("php_includes/head-tags.php") ?>
</head>
<body>
<div id="container">

		<?php require_once("header.php"); ?>

		<div id="body">
			<div id="content">
            <!-- here the content will be started -->
			<!-- here the content will be started -->
			<!-- here the content will be started -->
                <br>
<!--
<div style="text-align:center;">
<a class="btn" href="addworkpermission.php">اضف إذن شغل</a>
<a class="btn" href="addspareparts.php">اضف مقايسة</a>
<a class="btn" href="#">استعلام المقايسات</a>
<a class="btn" href="tanksandcollectionsinquiry.php">استعلام المجموعات</a>
</div>
-->
                <div id="datafromdatabase">
					<?php
	include_once("php_includes/db_conx.php");
	// echo "connection success";
    $q = $_GET['q'];
    $sql = "SELECT * FROM tanksandcollections WHERE (work_permission_no like '%$q%' OR equipment_no like '%$q%') AND archived = 0";
//	$sql = "SELECT * FROM tanksandcollections";
    // arabic setting for database
	$query = mysqli_query($db_conx,"SET NAMES utf8;");
	$query = mysqli_query($db_conx,"SET CHARACTER_SET utf8;");
	//
    $query = mysqli_query($db_conx, $sql);
   
    $numrows = mysqli_num_rows($query);
    
    //$row = mysqli_fetch_array($query, MYSQLI_ASSOC)
    //echo $rows;
                    
    
	if (mysqli_num_rows($query) > 0) {
        echo "<table>
            <tr id=\"table_header\">
            <th>رقم إذن الشغل</th>
            <th>الوحدة</th>
            <th>اسم المعدة / المجموعة</th>
            <th>نوع المعدة</th>
            <th>رقم المعدة</th>
            <th>الكمية</th>
            <th>تاريخ الدخول</th>
            <th>تاريخ الخروج</th>";
            if($rowuserid['user_type'] == 'editor'){ 
            echo "<th></th>";
            echo "<th></th>";
            }
            echo "</tr>";
    	// output data of each row
    				
	    while($row = mysqli_fetch_assoc($query)) {
	        // echo "id: " . $row["id"]. " - Name: " . $row["name"]. " - Unit: " . $row["unit"] . " - Notes: " . $row["notes"]. " - Enter date: " . $row["checkin"]. " - Fixstart: " . $row["fixstart"]. " - Fixend: " . $row["fixend"]. " - Checkout: " . $row["checkout"]. " - Family: " . $row["family"]. " - mmcnumber: " . $row["mmcnumber"]. " - workpermission: " . $row["workpermission"]. " - Tank Number: " . $row["tc_number"]. " - Collection: " . $row["tc_collection"]."<br>";
            
                $cid = strftime("%d - %m - %Y", strtotime($row["checkin_date"]));
                if($row["checkout_date"] ==''){
                    $cod = '';
                }else{
                    $cod = strftime("%d - %m - %Y", strtotime($row["checkout_date"]));
                }
                
            
        echo "<tr class=\"row-select\">
        
        <td class=\"work_permission_no_class\"><a href=\"workpermissiondocument.php?workpermission=".$row["work_permission_no"]."\">" . $row["work_permission_no"]. "</a></td>
        <td>" . $row["unit"]. "</td>
        <td class=\"equipment_name_class\" >" . $row["equipment_name"]. "</td>
        <td class=\"equipment_type_class\" >" . $row["equipment_type"]. "</td>
        <td>" . $row["equipment_no"]. "</td>
        <td>" . $row["quantity"]. "</td>
        <td class=\"checkin_date_class\">" . $cid . "</td>
        <td class=\"checkout_date_class\">" . $cod . "</td>";
        if($rowuserid['user_type'] == "editor"){
        echo "
        <td class =\"editbutton\" title=\"تعديل المستند\"><a href=\"workpermissiondocumentedit.php?workpermissionid=".$row["id"]."\" class=\"editlink\" title=\"تعديل المستند\">&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
        ";
        if($row["checkout_date"] !=''){
           echo "<td class =\"archivebutton\" title=\"حفظ المستند في الأرشيف\"><button class=\"archiving\" title=\"حفظ المستند في الأرشيف\" onclick=\"archive($(this).val())\" value=\"".$row["id"]."\"></td>"; 
        }else{
            echo "<td title=\"حفظ المستند في الأرشيف\"></td>";
        }
        
        echo "</tr>";
            }

	    }
        echo "</table>";
	}else{
        echo "<h2 style=\"text-align:center;\">لا يوجد نتائج</h2>";
    }
        //else {
//		echo "<br>";
//	    echo "0 results";
//	}
	
?>	
                </div>
                
                
            <!-- here the content will be ended -->
			<!-- here the content will be ended -->
			<!-- here the content will be ended -->
			
			</div>
            
			
			
</div>

<?php require_once("footer.php"); ?>
</div>
    <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript">

    function archive(archived){
//        dfatervalue
//        alert("it works " + dfatervalue);
//            alert(archived);
        
            if(confirm("هل تريد حفظ النموذج في الأرشيف")){
//                alert("تم الحفظ");
            var ajax = ajaxObj("POST", "archivecode.php");
            ajax.onreadystatechange = function() {
                
                if(ajaxReturn(ajax) == true) {
                    if(ajax.responseText == "archived success"){
//                        alert(ajax.responseText);
                        alert("تم الحفظ");
                    }
                    else{
                        alert("حدث خطأ");
                    }

                }
                
            }
            ajax.send("id="+archived);
            } else{
                alert("تم الغاء الحفظ");
            }
    }


</script>
</body>
</html>