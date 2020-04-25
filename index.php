<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<link rel="icon" href="./favicon.ico">
		<title>Vuether</title>

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
		<link rel="stylesheet" href="css/all.css" />

		<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/axios@0.12.0/dist/axios.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/lodash@4.13.1/lodash.min.js"></script>
		<script src="js/moment.min.js"></script>
		
		<script src="https://unpkg.com/feather-icons"></script>
	</head>

	<body>

		<div class="container" id="app">
			<div class="weather-side">
				<div class="weather-gradient"></div>
				<div class="date-container">
					<h2 class="date-dayname">Tuesday</h2><span class="date-day">{{ todayDateTime }}</span><i class="location-icon" data-feather="map-pin"></i><span class="location">{{ location }}</span>
				</div>
				<div class="weather-container"><img v-bind:src="srcImage" />
					<h1 class="weather-temp">{{ temperature }}°C</h1>
					<h3 class="weather-desc">{{ weather }}</h3>
				</div>
			</div>
			<div class="info-side">
				<div class="today-info-container">
					<div class="today-info">
						<div class="precipitation"> <span class="title">PRECIPITATION</span><span class="value">0 %</span>
							<div class="clear"></div>
						</div>
						<div class="humidity"> <span class="title">HUMIDITY</span><span class="value">{{ humidity }} %</span>
							<div class="clear"></div>
						</div>
						<div class="wind"> <span class="title">WIND</span><span class="value">{{ wind }} km/h</span>
							<div class="clear"></div>
						</div>
					</div>
				</div>
				<div class="week-container">
					<ul class="week-list">
						<li class="active"><i class="day-icon" data-feather="sun"></i><span class="day-name">Tue</span><span class="day-temp">29°C</span></li>
						<li><i class="day-icon" data-feather="cloud"></i><span class="day-name">Wed</span><span class="day-temp">21°C</span></li>
						<li><i class="day-icon" data-feather="cloud-snow"></i><span class="day-name">Thu</span><span class="day-temp">08°C</span></li>
						<li><i class="day-icon" data-feather="cloud-rain"></i><span class="day-name">Fry</span><span class="day-temp">19°C</span></li>
						<div class="clear"></div>
					</ul>
				</div>
				<div class="location-container">
					<input type="text" name="location" class="form-control" v-model="location" placeholder="Insert a city name" style="width: 130px; display: inline;">
					<button class="location-button" v-on:click="getWeather"> <i data-feather="map-pin"></i><span>Change location</span></button>
				</div>
			</div>
		</div>

		<script>
			var today = new Date();
			var date = today.getDate()+'/'+(today.getMonth()+1)+'/'+today.getFullYear();
			var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
			
			feather.replace();
			
			new Vue({
				el: "#app",

				data: {
					location: '',
					weather: 'n/a',
					humidity: 'n/a',
					temperature: 'n/a',
					wind: '0',
					todayDateTime: date + ' ' + time,
					srcImage: '',
				},
				created: function () {
					console.log(date, time);
				},
				methods: {
					getWeather: function ()
					{
						var vm = this;

						axios.get('https://api.openweathermap.org/data/2.5/weather?units=metric&q=' + this.location + '&appid=a73c8e323a5ee668508492bd85da9ce8')
							.then(function (response)
							{
								console.log(response);
								vm.weather = response.data.weather[0].description;
								vm.wind = response.data.wind.speed;
								vm.humidity = response.data.main.humidity;
								vm.temperature = parseInt(response.data.main.temp);
								vm.srcImage = "http://openweathermap.org/img/wn/" + response.data.weather[0].icon + "@2x.png"
							})
							.catch(function (error)
							{

							})
					}
				},
				
			});

		</script>

	</body>
</html>
