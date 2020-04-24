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
		
		<script src="https://unpkg.com/feather-icons"></script>
	</head>

	<body>

		<div class="container" id="app">
			<div class="weather-side">
				<div class="weather-gradient"></div>
				<div class="date-container">
					<h2 class="date-dayname">Tuesday</h2><span class="date-day">15 Jan 2019</span><i class="location-icon" data-feather="map-pin"></i><span class="location">Paris, FR</span>
				</div>
				<div class="weather-container"><i class="weather-icon" data-feather="sun"></i>
					<h1 class="weather-temp">29°C</h1>
					<h3 class="weather-desc">{{ weather }}</h3>
				</div>
			</div>
			<div class="info-side">
				<div class="today-info-container">
					<div class="today-info">
						<div class="precipitation"> <span class="title">PRECIPITATION</span><span class="value">0 %</span>
							<div class="clear"></div>
						</div>
						<div class="humidity"> <span class="title">HUMIDITY</span><span class="value">34 %</span>
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
					<input type="text" name="location" class="form-control" v-model="location">
					<button class="location-button" v-on:click="getWeather"> <i data-feather="map-pin"></i><span>Change location</span></button>
				</div>
			</div>
		</div>

		<script>
			feather.replace();
			
			new Vue({
				el: "#app",

				data: {
					location: "No city",
					weather: '',
					wind: '0',
				},

				methods: {
					getWeather: function ()
					{

						this.answer = 'Thinking...'
						var vm = this

						axios.get('https://api.openweathermap.org/data/2.5/weather?q=' + this.location + '&appid=a73c8e323a5ee668508492bd85da9ce8')
							.then(function (response)
							{
								console.log(response);
								vm.weather = response.data.weather[0].main;
								vm.wind = response.data.wind.speed;
							})
							.catch(function (error)
							{

							})
					}
				}
			});

		</script>

	</body>
</html>
