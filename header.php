<!--<div id="header" class="wow slideInDown" data-wow-duration="1s">-->
        <div id="header">
<!--			<h2 class="elmessiri" id="english-logo"></h2>-->
            <?php
            if($user_ok == true){
                echo "<form method=\"GET\" action=\"search.php\">";
			echo "<input type=\"text\" name=\"q\" placeholder=\"ابحث عن اذن شغل او رقم معدة او مجموعة\" id=\"search\">";
                echo "</form>";
            echo "<a href=\"logout.php\" class=\"btns\">خروج</a>";
            echo "<a href=\"mainpage.php\" class=\"btns\" style=\"margin-left:15px;\">الرئيسية</a>";
            echo "<h3 class=\"userinheader\"  title=\"Smart Irrigation System\"><a href=\"user.php?userid=".$log_id."\">".$rowuserid['grade']." / ".$rowuserid['username']."</a></h3>";
            }else{
                
            }
            ?>
            
            <h2 class="elmessiri" id="arabic-logo" title="Smart Irrigation System"><a href="index.php">Smart Irrigation System</a></h2>
		</div>
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