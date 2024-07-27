<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
	<div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
		<div class="mb-2 mb-md-0">
			©
			<script>
				document.write(new Date().getFullYear());
			</script>
			, made with Anwar by
			<a href="https://themeselection.com" target="_blank" class="footer-link fw-medium">CycleSense</a>
		</div>

	</div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
<script src="<?= base_url('assets/template/') ?>assets/vendor/libs/jquery/jquery.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/vendor/libs/popper/popper.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/vendor/js/bootstrap.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/vendor/libs/hammer/hammer.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/vendor/libs/i18n/i18n.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/vendor/libs/typeahead-js/typeahead.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/vendor/js/menu.js"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="<?= base_url('assets/template/') ?>assets/vendor/libs/apex-charts/apexcharts.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/vendor/libs/chartjs/chartjs.js"></script>

<!-- Main JS -->
<script src="<?= base_url('assets/template/') ?>assets/js/main.js"></script>

<!-- Page JS -->
<script src="<?= base_url('assets/template/') ?>assets/js/dashboards-analytics.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/js/app-ecommerce-dashboard.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/js/charts-chartjs.js"></script>
<!-- <script src="<?= base_url('assets/template/') ?>assets/js/maps-leaflet.js"></script> -->



<script>
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
	fetch('C_DashboardUmum/datamap')
		.then(response => response.json())
		.then(data => {
			console.log(data);
			let bounds = new mapboxgl.LngLatBounds();
			data.forEach((item) => {
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
</script>

</body>

</html>