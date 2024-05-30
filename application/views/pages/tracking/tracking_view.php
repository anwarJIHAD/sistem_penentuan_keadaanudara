<!DOCTYPE html>
<html>

<head>
	<title>User Tracking</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
	<style>
		#map {
			height: 80%;
			width: 100%;
		}

		html,
		body {
			height: 100%;
			margin: 0;
			padding: 0;
		}

		.marker {
			background-color: #FF0000;
			border-radius: 50%;
			width: 10px;
			height: 10px;
			cursor: pointer;
		}
	</style>
</head>

<body>
	<div id="map"></div>
	<script>
		// $(document).ready(function () {
		// 	// menambahkan control navigation
		// 	const nav = new mapboxgl.NavigationControl({
		// 		visualizePitch: true,
		// 	});
		// 	map.addControl(nav, 'bottom-right');
		// });
		// Ganti 'YOUR_ACCESS_TOKEN' dengan token akses Mapbox Anda
		mapboxgl.accessToken = 'pk.eyJ1Ijoiam9jaG9pMDcwNyIsImEiOiJjajczMWZrcTkwNHo2MzNvNGIzOHI3MW85In0.GSHlVF_HltDmEvomI2m_CA';
		var map = new mapboxgl.Map({
			container: 'map',
			style: 'mapbox://styles/mapbox/streets-v11',
			center: [106.816666, -6.200000], // Ganti dengan koordinat pusat di Indonesia (Jakarta)
			zoom: 12
		});
		const nav = new mapboxgl.NavigationControl({
			visualizePitch: true,
		});
		map.addControl(nav, 'bottom-right');
		fetch('Tracking/data')
			.then(response => response.json())
			.then(data => {
				const coordinates = data.map(item => {
					const longitude = parseFloat(item.propertieslongitude);
					const latitude = parseFloat(item.propertieslatitude);
					if (isNaN(longitude) || isNaN(latitude)) {
						console.error('Invalid coordinates:', item);
						return null;
					}
					return [longitude, latitude];
				}).filter(coord => coord !== null);

				map.on('load', function () {
					map.addSource('route', {
						'type': 'geojson',
						'data': {
							'type': 'Feature',
							'properties': {},
							'geometry': {
								'type': 'LineString',
								'coordinates': coordinates
							}
						}
					});

					map.addLayer({
						'id': 'route',
						'type': 'line',
						'source': 'route',
						'layout': {
							'line-join': 'round',
							'line-cap': 'round'
						},
						'paint': {
							'line-color': '#FF0000',
							'line-width': 4
						}
					});

					// Add points for each coordinate to allow click events
					data.forEach((item) => {
						const longitude = parseFloat(item.propertieslongitude);
						const latitude = parseFloat(item.propertieslatitude);
						const provinsi = item.propertiesnama_provinsi;
						const kabupaten = item.propertiesnama_kabupaten_kota; // Mendapatkan suhu dari data

						if (isNaN(longitude) || isNaN(latitude)) {
							console.error('Invalid coordinates for popup:', item);
							return;
						}

						const coord = [longitude, latitude];

						const el = document.createElement('div');
						el.className = 'marker';

						const marker = new mapboxgl.Marker(el)
							.setLngLat(coord)
							.addTo(map);

						console.log(`Marker added at ${coord}`); // Debugging log for marker addition

						el.addEventListener('click', () => {
							console.log(`Marker clicked at ${coord}`); // Debugging log for click event
							console.log(`Popup data: Latitude: ${latitude}, Longitude: ${longitude}, kabupaten: ${kabupaten}`);
							new mapboxgl.Popup()
								.setLngLat(coord)
								.setHTML(`Latitude: ${latitude}<br>Longitude: ${longitude}<br>kabupaten: ${kabupaten}`)
								.addTo(map);
						});
					});

					// Adjust the map to fit the coordinates
					if (coordinates.length > 0) {
						var bounds = coordinates.reduce(function (bounds, coord) {
							return bounds.extend(coord);
						}, new mapboxgl.LngLatBounds(coordinates[0], coordinates[0]));

						map.fitBounds(bounds, {
							padding: 20
						});
					}
				});

				// Add a click listener on the map to test popup without marker
				map.on('click', (e) => {
					let found = false;
					const tolerance = 0.0001; // Adjust the tolerance as needed (around 11 meters)

					// Mencoba menemukan data provinsi dan suhu dari titik yang diklik
					data.forEach((item) => {
						const longitude = parseFloat(item.propertieslongitude);
						const latitude = parseFloat(item.propertieslatitude);
						if (Math.abs(e.lngLat.lng - longitude) < tolerance && Math.abs(e.lngLat.lat - latitude) < tolerance) {
							const provinsi = item.propertiesnama_provinsi;
							const kabupaten = item.propertiesnama_kabupaten_kota;
							found = true;

							new mapboxgl.Popup()
								.setLngLat([longitude, latitude])
								.setHTML(`Latitude: ${latitude}<br>Longitude: ${longitude}<br>Provinsi: ${provinsi}<br>kabupaten: ${kabupaten}`)
								.addTo(map);
						}
					});

					if (!found) {
						new mapboxgl.Popup()
							.setLngLat(e.lngLat)
							.setHTML("Titik lokasi tidak dilewati")
							.addTo(map);
					}
				});
			})
			.catch(error => console.error('Error fetching data:', error));
	</script>
</body>

</html>
