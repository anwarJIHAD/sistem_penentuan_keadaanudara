<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="py-3 mb-4"><span class="text-muted fw-light">Straair /</span> Dashboard</h4>
	<div class="row">
		<div class="col-lg- mb-4 order-0">
			<div class="card">
				<div class="d-flex align-items-end row">
					<div class="col-sm-7">
						<div class="card-body">
							<h5 class="card-title text-primary">Selamat Datang 🎉</h5>
							<p class="mb-4">
								Rute Perjalanan Anda Pada:  <span class="fw-medium"><?= $start_date ?></span>

							</p>

						</div>
					</div>
					<div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img src="<?= base_url('assets/template/') ?>assets/img/illustrations/boy-verify-email-light.png"
								height="140" alt="View Badge User"
								data-app-dark-img="illustrations/boy-verify-email-dark.png"
								data-app-light-img="illustrations/boy-verify-email-light.png" />
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Card Border Shadow -->
	<div class="row">
		
		<div class="col-sm-6 col-lg-3 mb-4">
			<div class="card card-border-shadow-danger h-100">
				<div class="card-body">
					<div class="d-flex align-items-center mb-2 pb-1">
						<div class="avatar me-2">
							<span class="avatar-initial rounded bg-label-danger"><i
									class="bx bx-git-repo-forked"></i></span>
						</div>
						<h5 class="ms-1 mb-0">Jarak Tempuh </h5>
					</div>
					<div class="d-flex justify-content-center">
						<h2 class="mb-0">454</h2>
						<small class="text-muted">Km</small>

					</div>
				</div>
			</div>
		</div>
		
	</div>
	<!--/ Card Border Shadow -->


	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<h5 class="card-header">Keadaan Udara (PM2.5)</h5>
				<div class="card-body">
					<div class="leaflet-map" id="map"></div>

					<!-- <div class="" id="mapdashboard"></div> -->

				</div>
			</div>
		</div>
	</div>

	<!--/ On route vehicles Table -->
</div>
<!-- / Content -->
<script>
	mapboxgl.accessToken = 'pk.eyJ1Ijoiam9jaG9pMDcwNyIsImEiOiJjajczMWZrcTkwNHo2MzNvNGIzOHI3MW85In0.GSHlVF_HltDmEvomI2m_CA';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',
		center: [106.816666, -6.200000], // Koordinat pusat di Indonesia (Jakarta)
		zoom: 12
	});

	const nav = new mapboxgl.NavigationControl({
		visualizePitch: true,
	});
	map.addControl(nav, 'bottom-right');

	fetch('<?= base_url('C_Rute/get_detail/') ?>' + <?= $start_id ?> + '/' + <?= $finish_id ?>)
		.then(response => response.json())
		.then(data => {
			console.log(data);
			const coordinates = data.map(item => {
				const longitude = parseFloat(item.longitude);
				const latitude = parseFloat(item.latitude);
				if (isNaN(longitude) || isNaN(latitude)) {
					console.error('Invalid coordinates:', item);
					return null;
				}
				return [longitude, latitude];
			}).filter(coord => coord !== null);

			map.on('load', function () {
				if (coordinates.length > 1) {
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
							'line-color': '#00FF00', // Warna hijau
							'line-width': 4
						}
					});
				}

				// Add points for each coordinate to allow click events
				data.forEach((item) => {
					const longitude = parseFloat(item.longitude);
					const latitude = parseFloat(item.latitude);
					const provinsi = item.properties?.nama_provinsi || 'undefined';
					const kabupaten = item.properties?.nama_kabupaten_kota || 'undefined'; // Adjust the property as necessary

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

					el.addEventListener('click', () => {
						new mapboxgl.Popup()
							.setLngLat(coord)
							.setHTML(`Latitude: ${latitude}<br>Longitude: ${longitude}<br>Provinsi: ${provinsi}<br>Kabupaten: ${kabupaten}`)
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
			// Menambahkan event listener untuk mendeteksi klik pada peta
			map.on('click', (e) => {
				let found = false;
				const tolerance = 0.0001; // Toleransi jarak dalam derajat (sekitar 11 meter)

				// Mencoba menemukan data pm25 dari titik yang diklik
				data.forEach((item) => {
					const longitude = parseFloat(item.longitude);
					const latitude = parseFloat(item.latitude);
					if (Math.abs(e.lngLat.lng - longitude) < tolerance && Math.abs(e.lngLat.lat - latitude) < tolerance) {
						const pm25 = parseFloat(item.pm25).toFixed(2);
						found = true;

						new mapboxgl.Popup({ offset: 25 })
							.setLngLat([longitude, latitude])
							.setHTML(`<h3 style="font-family: 'Montserrat', sans-serif; color: blue;">Informasi</h3><p style="font-family: 'Montserrat', sans-serif; color: black;"> [${longitude}, ${latitude}]</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Tanggal Update : ${item.datetime}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Nilai PM25 : ${pm25}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Temperature : ${item.temperature}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Humidity : ${item.humidity}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Pressure : ${item.pressure}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Lux : ${item.lux}</p>`)
							.addTo(map);
					}
				});

				if (!found) {
					new mapboxgl.Popup()
						.setLngLat(e.lngLat)
						.setHTML("Titik Lokasi Tidak Valid")
						.addTo(map);
				}
			});

			// Add a click listener on the map to test popup without marker

		})
		.catch(error => console.error('Error fetching data:', error));

</script>




<!-- <script>
	mapboxgl.accessToken = 'pk.eyJ1Ijoiam9jaG9pMDcwNyIsImEiOiJjajczMWZrcTkwNHo2MzNvNGIzOHI3MW85In0.GSHlVF_HltDmEvomI2m_CA';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',
		center: [106.816666, -6.200000], // Koordinat pusat di Indonesia (Jakarta)
		zoom: 12
	});
	const nav = new mapboxgl.NavigationControl({
		visualizePitch: true,
	});
	map.addControl(nav, 'bottom-right');
	fetch('<?= base_url('C_Rute/get_detail/') ?>' + <?= $start_id ?> + '/' + <?= $finish_id ?>)
		.then(response => response.json())
		.then(data => {
			console.log(data);
			const coordinates = data.map(item => {
				const longitude = parseFloat(item.longitude);
				const latitude = parseFloat(item.latitude);
				if (isNaN(longitude) || isNaN(latitude)) {
					console.error('Invalid coordinates:', item);
					return null;
				}
				return [longitude, latitude];
			}).filter(coord => coord !== null);

			map.on('load', function () {
				const groupedCoordinates = data.reduce((acc, item) => {
					const id = item.id;
					if (!acc[id]) {
						acc[id] = [];
					}
					acc[id].push([parseFloat(item.longitude), parseFloat(item.latitude)]);
					return acc;
				}, {});

				Object.keys(groupedCoordinates).forEach((id) => {
					const coords = groupedCoordinates[id];
					if (coords.length > 1) {
						map.addSource(`route-${id}`, {
							'type': 'geojson',
							'data': {
								'type': 'Feature',
								'properties': {},
								'geometry': {
									'type': 'LineString',
									'coordinates': coords
								}
							}
						});

						map.addLayer({
							'id': `route-${id}`,
							'type': 'line',
							'source': `route-${id}`,
							'layout': {
								'line-join': 'round',
								'line-cap': 'round'
							},
							'paint': {
								'line-color': '#FF0000',
								'line-width': 4
							}
						});
					}
				});

				// Add points for each coordinate to allow click events
				data.forEach((item) => {
					const longitude = parseFloat(item.longitude);
					const latitude = parseFloat(item.latitude);
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
					const longitude = parseFloat(item.longitude);
					const latitude = parseFloat(item.latitude);
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
</script> -->






<!-- <script>
	mapboxgl.accessToken = 'pk.eyJ1Ijoiam9jaG9pMDcwNyIsImEiOiJjajczMWZrcTkwNHo2MzNvNGIzOHI3MW85In0.GSHlVF_HltDmEvomI2m_CA';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',
		zoom: 12
	});
	const nav = new mapboxgl.NavigationControl({
		visualizePitch: true,
	});
	map.addControl(nav, 'bottom-right');
	fetch('<?= base_url('C_Rute/get_detail/') ?>' + <?= $start_id ?> + '/' + <?= $finish_id ?>)
		.then(response => response.json())
		.then(data => {
			console.log(data);
			let bounds = new mapboxgl.LngLatBounds();
			data.forEach((item, index) => {
				const longitude = parseFloat(item.longitude);
				const latitude = parseFloat(item.latitude);
				const pm25 = item.pm25; // Mendapatkan nilai pm25 dari data
				if (isNaN(longitude) || isNaN(latitude)) {
					console.error('Invalid coordinates:', item);
					return;
				}

				const el = document.createElement('div');
				el.className = 'marker';
				el.style.backgroundColor = '#FF0000'; // Set the marker color to red

				const marker = new mapboxgl.Marker(el)
					.setLngLat([longitude, latitude])
					.addTo(map);

				console.log(`Marker added at ${[longitude, latitude]}`); // Debugging log for marker addition

				el.addEventListener('click', () => {
					console.log(`Marker clicked at ${[longitude, latitude]}`); // Debugging log for click event
					console.log(`PM25 value: ${pm25}`);
					new mapboxgl.Popup()
						.setLngLat([longitude, latitude])
						.setHTML(`PM25: ${pm25}`)
						.addTo(map);
				});

				bounds.extend([longitude, latitude]);

				// Menggambar garis antara titik awal dan akhir
				if (item.sign == 'start' && data[index + 1] && data[index + 1].sign == 'end') {
					const start = [longitude, latitude];
					const end = [data[index + 1].longitude, data[index + 1].latitude];
					map.addLayer({
						id: 'route',
						type: 'line',
						source: {
							type: 'geojson',
							data: {
								type: 'Feature',
								geometry: {
									type: 'LineString',
									coordinates: [start, end]
								}
							}
						},
						layout: {
							'line-join': 'round',
							'line-cap': 'round'
						},
						paint: {
							'line-color': '#FF0000',
							'line-width': 2
						}
					});
				}
			});
			map.fitBounds(bounds, {
				padding: 20
			});

			// Menambahkan event listener untuk mendeteksi klik pada peta
			map.on('click', (e) => {
				let found = false;
				const tolerance = 0.0001; // Toleransi jarak dalam derajat (sekitar 11 meter)

				// Mencoba menemukan data pm25 dari titik yang diklik
				data.forEach((item) => {
					const longitude = parseFloat(item.longitude);
					const latitude = parseFloat(item.latitude);
					if (Math.abs(e.lngLat.lng - longitude) < tolerance && Math.abs(e.lngLat.lat - latitude) < tolerance) {
						const pm25 = parseFloat(item.pm25).toFixed(2);
						found = true;

						new mapboxgl.Popup({ offset: 25 })
							.setLngLat([longitude, latitude])
							.setHTML(`<h3 style="font-family: 'Montserrat', sans-serif; color: blue;">Informasi</h3><p style="font-family: 'Montserrat', sans-serif; color: black;">nama wilayah : ${item.nama_wilayah}</p><p style="font-family: 'Montserrat', sans-serif; color: black;"> [${longitude}, ${latitude}]</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Nilai PM25 : ${pm25}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Tanggal Update : ${item.datetime}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Temperature : ${item.temperature}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Humidity : ${item.humidity}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Pressure : ${item.pressure}</p><p style="font-family: 'Montserrat', sans-serif; color: black;">Lux : ${item.lux}</p>`)
							.addTo(map);
					}
				});

				if (!found) {
					new mapboxgl.Popup()
						.setLngLat(e.lngLat)
						.setHTML("Titik Lokasi Tidak Valid")
						.addTo(map);
				}
			});
		})
		.catch(error => console.error('Error fetching data:', error));
</script> -->
