<?php 
                        if(isset($_POST['crop_id'])){

                            require_once("eto.php");

                            $latitude = 30.04594;
                            $longitude = 31.23271;
                            $HEREWEATHERjson = makegetrequest("https://weather.cit.api.here.com/weather/1.0/report.json?product=observation&latitude=$latitude&longitude=$longitude&oneobservation=true&app_id=MmULkIGd5MqVS0v2rn1k&app_code=kpdQy_21nKhhOihcYE-KKw");
                            $HEREWEATHER = json_decode($HEREWEATHERjson, TRUE);
                            $mintemp = $HEREWEATHER["observations"]["location"][0]["observation"][0]["lowTemperature"];
                            $maxtemp = $HEREWEATHER["observations"]["location"][0]["observation"][0]["highTemperature"];
                            $temp = (int)$HEREWEATHER["observations"]["location"][0]["observation"][0]["temperature"];
                            $humidity = $HEREWEATHER["observations"]["location"][0]["observation"][0]["humidity"]."%";;
                            $wind = $HEREWEATHER["observations"]["location"][0]["observation"][0]["windSpeed"]." km/hour";
                            $descrippp = $HEREWEATHER["observations"]["location"][0]["observation"][0]["skyDescription"];
                            $latitude = $HEREWEATHER["observations"]["location"][0]["observation"][0]["latitude"];
        

                            // 
                            $crop_name = "btates";
                            $crop_id = $_POST['crop_id'];

                            
                            
                            $solarr = "10 mj/m2";
                            $soilm = "50 mm/m";
                            // 
                            $lastirr = "Sunday 31 / 03 / 2019";
                            $upirr = "Tuesday 02 / 04 / 2019";
                            $plantlife = "Incomplete";
                        }
                    ?>
                  <h3>Crop No. <?php echo $crop_id; ?> - <?php echo $crop_name; ?></h3>
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
                              <h3>Monthly Report</h3>
                              <h3>Weekly Report</h3>
                              <p>Reports are send weekly and monthly to this e-mail:aaaaaa@aaaaaa.com</p>
                            </div>
                                
                            <div id="Crops-options" class="tabcontent">
                              <h3>Crops options</h3>
                              <p>Who we are and what we do.</p>
                            </div>
    
                      <!-- End is here for the tabs -->
                  </div>
