<!DOCTYPE html>
<html>
	<style type='text/css'>
		.big
		{
			font-size : 24px;
		}
		.small
		{
			font-size : 10px;
		}
		div#info
		{
			width : 100px;
			padding : 0px 2px 5px 2px;

			text-align : center;
			font-family : Arial;

			outline : 2px solid gray;
			background : #E6E6E6;
		}
	</style>
	<body>
		<?php
		//Getting city by your IP
		function update()
		{
			$ipjson = file_get_contents('http://api.hostip.info/get_json.php');
			$ipdjson = json_decode($ipjson, true);
			$country = ucfirst(strtolower($ipdjson['country_name']));
			$city = $ipdjson['city'];
			//Getting current weather
			$wjson = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=' . $city);
			$wdjson = json_decode($wjson, true);
			//Getting temperature and that kinda things
			$weather = $wdjson['weather'][0]['main']; 
			$temperature = $wdjson['main']['temp'] - 273.15; //Temperature in kelvin, then converted to celsius
			$pressure = $wdjson['main']['pressure']; //Pressure in hectopascals
			$humidity = $wdjson['main']['humidity']; //Humidity in percent
			$windspeed = $wdjson['wind']['speed']; //Windspeed in m/s
			//thing
			echo <<< EOF
			<div class='Module'>
				<h3>$city, $country</h3>
				<div class='Content'>
					<div id='info'>
						<p class='big'><b>$temperature<sup>o</sup>C</b></p>
						<p><i>$weather</i></p>
						<p class='small'>pressure: $pressure hPa</p>
						<p class='small'>humidity: $humidity%</p>
						<p class='small'>windspeed: $windspeed m/s</p>
					</div>
				</div>
			</div>
EOF;
		}
		update();
		?>
	</body>
</html>
