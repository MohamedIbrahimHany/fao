<?php
/*
our apis

Google Elevation
https://maps.googleapis.com/maps/api/elevation/json?locations=39.7391536,-104.9847034&key=AIzaSyA5i_iF0CHlkfpXQdcuZUhbd_b5H5vI55I

OPEN WEATHER
This include Rain mm and sun duration 
http://api.openweathermap.org/data/2.5/weather?lat=37.623485&lon=31.119258&appid=919493d4379c1abf22214cb5e01d70f4&units=metric
https://openweathermap.org/current

HERE WEATHER API

https://weather.cit.api.here.com/weather/1.0/report.json?product=observation&latitude=29.974158&longitude=30.914143&oneobservation=true&app_id=MmULkIGd5MqVS0v2rn1k&app_code=kpdQy_21nKhhOihcYE-KKw


*/


	function calcradiation($hrs){
		$step1 = (14)*pow($hrs,1.24)*pow(($hrs * pi() /180),-0.19);
		$stephalf = 30 * pow(sin($hrs),2);
		$step2 = 10550/$stephalf;
		$step3 = 10*pow(sin($hrs),3);
		$step4 = $step1 + $step2 + $step3;
		$step5 = $step4/24;
		return $step5 / 100;
	}

	function makegetrequest($c){
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $c);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");


		$headers = array();
		$headers[] = "Accept: application/json";
		$headers[] = "Authorization: Bearer APIKEY";
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);
		if (curl_errno($ch)) {
		    echo 'Error:' . curl_error($ch);
		}
		curl_close ($ch);
		return $result;
	}

?>