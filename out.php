<h2 style='direction:rtl;text-align:center;'>تمام خروج المعدات و المجموعات</h2>
<hr class="style2">
               <?php
                    //$checkoutdate == "" && $endfix != ""
	include_once("php_includes/db_conx.php");
    $sql2 = "SELECT * FROM tanksandcollections where (end_fix !='' AND checkout_date != '') AND archived = 0";
    // arabic setting for database
	$query2 = mysqli_query($db_conx,"SET NAMES utf8;");
	$query2 = mysqli_query($db_conx,"SET CHARACTER_SET utf8;");
	//
    $query2 = mysqli_query($db_conx, $sql2);
   
    $numrows2 = mysqli_num_rows($query2);
                    
    $rowcounter = 1;
    
    
    //$row = mysqli_fetch_array($query, MYSQLI_ASSOC)
    //echo $rows;
    
	if (mysqli_num_rows($query2) > 0) {
        echo "<h3 style='direction:rtl;text-align:center;'> " .$numrows2. " معدة و مجموعة خرجت </h3>";
    	// output data of each row
    	echo "<table>
        <tr id=\"table_header\">
        <th>رقم إذن الشغل</th>
        <th>الوحدة</th>
        <th>اسم المعدة / المجموعة</th>
        <th>نوع المعدة</th>
        <th>رقم المعدة</th>
        <th>الكمية</th>
        <th>تاريخ الدخول</th>
        <th>تاريخ الجاهز</th>
        <th>تاريخ الخروج</th>
        <th>م</th>
        </tr>";			
	    while($row = mysqli_fetch_assoc($query2)) {
                $cid = strftime("%d - %m - %Y", strtotime($row["checkin_date"]));
                if($row["end_fix"] ==''){
                    $crd = '';
                }else{
                    $crd = strftime("%d - %m - %Y", strtotime($row["end_fix"]));
                }
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
        <td class=\"ready_date_class\">" . $crd . "</td>
        <td class=\"checkout_date_class\">" . $cod . "</td>
        <td>" .$rowcounter. "</td>
        </tr>";
             $rowcounter = $rowcounter + 1;
	    }
        echo "</table>";
	}else{
		echo "<br>";
        echo"<h3 style='direction:rtl;text-align:center;'>لا يوجد معدات او مجموعات جاهزة</h3>";
	}

?>