<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
	data-assets-path="<?= base_url('assets/template/') ?>assets/" data-template="horizontal-menu-template">

<head>
	<meta charset="utf-8" />
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>CycleSense -Tracking Keadaan Udara Komunitas Sepeda</title>

	<meta name="description" content="" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/template/') ?>assets/img/favicon/favicon.ico" />

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
		rel="stylesheet" />

	<!-- Icons -->
	<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/fonts/boxicons.css" />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/fonts/fontawesome.css" />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/fonts/flag-icons.css" />

	<!-- Core CSS -->
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/css/rtl/core.css"
		class="template-customizer-core-css" />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/css/rtl/theme-default.css"
		class="template-customizer-theme-css" />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/css/demo.css" />

	<!-- Vendors CSS -->
	<link rel="stylesheet"
		href="<?= base_url('assets/template/') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/libs/typeahead-js/typeahead.css" />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/libs/apex-charts/apex-charts.css" />

	<!-- Page CSS -->
	<style>
		#map {
			height: 500px;
			width: 100%;
		}

		.marker {
			background-color: #FF0000;
			border-radius: 50%;
			width: 10px;
			height: 10px;
			cursor: pointer;
		}
	</style>
	<!-- Helpers -->
	<script src="<?= base_url('assets/template/') ?>assets/vendor/js/helpers.js"></script>

	<!-- <script src="<?= base_url('assets/template/') ?>assets/vendor/js/template-customizer.js"></script> -->
	<script src="<?= base_url('assets/template/') ?>assets/js/config.js"></script>
</head>

<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-navbar-full layout-horizontal layout-without-menu">
		<div class="layout-container">
			<!-- Navbar -->

			<nav class="layout-navbar navbar navbar-expand-xl align-items-center bg-navbar-theme" id="layout-navbar">
				<div class="container-xxl">
					<div class="navbar-brand app-brand demo d-none d-xl-flex py-0 me-4">
						<a href="index.html" class="app-brand-link gap-2">
							<span class="app-brand-logo demo">
								<img src="<?= base_url('assets/template/') ?>assets\img\logo\logo_strata_png.png"
									alt="Logo" width="80" />
							</span>
							<span class="app-brand-text demo menu-text fw-bold">CycleSense 2.5</span>
						</a>

						<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-xl-none">
							<i class="bx bx-chevron-left bx-sm align-middle"></i>
						</a>
					</div>

					<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
						<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
							<i class="bx bx-menu bx-sm"></i>
						</a>
					</div>

					<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
						<ul class="navbar-nav flex-row align-items-center ms-auto">
							<a href="<?= base_url('Auth') ?>"> <button
									class="btn btn-primary btn-submit">Login</button></a>

						</ul>
					</div>

					<!-- Search Small Screens -->
					<div class="navbar-search-wrapper search-input-wrapper container-xxl d-none">
						<input type="text" class="form-control search-input border-0" placeholder="Search..."
							aria-label="Search..." />
						<i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
					</div>
				</div>
			</nav>

			<!-- / Navbar -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Content wrapper -->
				<div class="content-wrapper">
					<!-- Menu -->
					<!-- <aside id="layout-menu"
						class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
						<div class="container-xxl d-flex h-100">
							<ul class="menu-inner">
								<li class="menu-item active">
									<a href="dashboards-analytics.html" class="menu-link">
										<i class="menu-icon tf-icons bx bx-pie-chart-alt-2"></i>
										<div data-i18n="Dashboard">Dashboard</div>
									</a>
								</li>

								<li class="menu-item">
									<a href="https://themeselection.com/support/" target="_blank" class="menu-link">
										<i class="menu-icon tf-icons bx bx-support"></i>
										<div data-i18n="Support">Support</div>
									</a>
								</li>
								<li class="menu-item">
									<a href="https://demos.themeselection.com/sneat-bootstrap-html-admin-template/documentation/"
										target="_blank" class="menu-link">
										<i class="menu-icon tf-icons bx bx-file"></i>
										<div data-i18n="Documentation">Documentation</div>
									</a>
								</li>
							</ul>
						</div>
					</aside> -->
					<!-- / Menu -->

					<!-- Content -->

					<div class="container-xxl flex-grow-1 container-p-y">
						<div class="row">
							<div class="col-lg- mb-4 order-0">
								<div class="card">
									<div class="d-flex align-items-end row">
										<div class="col-sm-7">
											<div class="card-body">
												<h5 class="card-title text-primary">Selamat Datang 🎉</h5>
												<p class="mb-4">
													Sistem Informasi Keadaan Udara <span class="fw-medium">72%</span>

												</p>

											</div>
										</div>
										<div class="col-sm-5 text-center text-sm-left">
											<div class="card-body pb-0 px-0 px-md-4">
												<img src="<?= base_url('assets/template/') ?>assets/img/illustrations/man-with-laptop-light.png"
													height="140" alt="View Badge User"
													data-app-dark-img="illustrations/man-with-laptop-dark.png"
													data-app-light-img="illustrations/man-with-laptop-light.png" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6 col-lg-3 mb-4">
								<div class="card card-border-shadow-primary h-100">
									<div class="card-body">
										<div class="d-flex align-items-center mb-2 pb-1">
											<div class="avatar me-2">
												<span class="avatar-initial rounded bg-label-primary"><i
														class="bx bxs-truck"></i></span>
											</div>
											<h5 class="ms-1 mb-0">PM25 Tertinggi</h5>
										</div>
										<div class="d-flex justify-content-center">
											<h2 class="mb-0 text-danger">Pekanbaru</h2>
										</div>

									</div>
								</div>
							</div>


							<div class="col-sm-6 col-lg-3 mb-4">
								<div class="card card-border-shadow-info h-100">
									<div class="card-body">
										<div class="d-flex align-items-center mb-2 pb-1">
											<div class="avatar me-2">
												<span class="avatar-initial rounded bg-label-danger"><i
														class="bx bx-error"></i></span>
											</div>
											<h5 class="ms-1 mb-0">
												Lokasi Paling Tercemar</h5>
										</div>
										<div class="d-flex justify-content-center">
											<h2 class="mb-0">Rumbai</h2>
											<small class="text-danger"> Km</small>

										</div>
									</div>
								</div>
							</div>
						</div>
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
						<div class="row">
							<div class="col-md-12 col-lg-12 mb-4">
								<div class="card">
									<div class="row row-bordered g-0">
										<div class="col-md-12">
											<div class="card-header">
												<h5 class="card-title mb-0">Rata Rata Perbulan</h5>
												<small class="card-subtitle">Keadaan Udara (PM2.5)</small>
												<div class="d-flex justify-content-center">
													<div class="col col-sm-6 col-md-6 col-lg-6 p-2 p-2">
														<label for="tahun" class="form-label">Tahun</label>
														<select id="search_tahunA" name="keyword" class="form-control"
															value="<?= set_value('keyword'); ?>">
															<option class='text-center dropdown-toggle' value="">Semua
																Tahun
															</option>
															<?php foreach ($tahun as $p): ?>
																<option value="<?= $p; ?>">
																	<?= $p; ?>
																</option>
															<?php endforeach; ?>>

														</select>
													</div>
													<div class="col col-sm-6 col-md-6 col-lg-6 p-2 p-2">
														<label for="tahun" class="form-label">Wilayah</label>
														<select id="search_wilayahA" name="keyword" class="form-control"
															value="<?= set_value('keyword'); ?>">
															<option class='text-center dropdown-toggle' value="">
																Rata-Rata Seluruh Wilayah
															</option>
															<?php foreach ($wilayah as $p): ?>
																<option value="<?= $p['id_wilayah']; ?>">
																	<?= $p['nama_wilayah']; ?>
																</option>
															<?php endforeach; ?>>

														</select>
													</div>

												</div>

											</div>
											<div class="card-body chartbulan">
												<!-- <div id="totalIncomeChart1"></div> -->
												<canvas id="du_bulan" class="chartjs" data-height="270"></canvas>

											</div>
										</div>
									</div>
								</div>
								<!--/ Total Income -->
							</div>
							<div class="col-xl-12 col-lg-12 col-12 mb-4">
								<div class="card">
									<div class="col-md-12">
										<div class="card-header">
											<h5 class="card-title mb-0">Rata Rata Harian</h5>
											<small class="card-subtitle">Keadaan Udara (PM2.5)</small>
											<div class="d-flex justify-content-center">
												<div class="col col-sm-3 col-md-3 col-lg-3 p-2 p-3">
													<label for="tahun" class="form-label">Tahun</label>
													<select id="search_tahunH" name="keyword" class="form-control"
														value="<?= set_value('keyword'); ?>">
														<option class='text-center dropdown-toggle' value="">Semua Tahun
														</option>
														<?php foreach ($tahun as $p): ?>
															<option value="<?= $p; ?>">
																<?= $p; ?>
															</option>
														<?php endforeach; ?>>

													</select>
												</div>
												<div class="col col-sm-3 col-md-3 col-lg-3 p-2 p-3">
													<label for="bulan" class="form-label">Bulan</label>
													<select id="search_bulanH" name="keyword" class="form-control"
														value="<?= set_value('keyword'); ?>">
														<option class='text-center dropdown-toggle' value="">Rata-Rata
															Seluruh Bulan
														</option>
														<?php foreach ($bulan as $key => $p): ?>
															<option value="<?= $key; ?>">
																<?= $p; ?>
															</option>
														<?php endforeach; ?>
													</select>
												</div>
												<div class="col col-sm-3 col-md-3 col-lg-3 p-2 p-3">
													<label for="tahun" class="form-label">Wilayah</label>
													<select id="search_wilayahH" name="keyword" class="form-control"
														value="<?= set_value('keyword'); ?>">
														<option class='text-center dropdown-toggle' value="">Rata-Rata
															Seluruh Wilayah
														</option>
														<?php foreach ($wilayah as $p): ?>
															<option value="<?= $p['id_wilayah']; ?>">
																<?= $p['nama_wilayah']; ?>
															</option>
														<?php endforeach; ?>>

													</select>
												</div>

											</div>
										</div>

										<div class="card-body charthari">
											<canvas id="du_hari" class="chartjs" data-height="270"></canvas>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 col-lg-12 mb-4">
								<div class="card">
									<div class="row row-bordered g-0">
										<div class="col-md-12">
											<div class="card-header">
												<h5 class="card-title mb-0">Rata Rata Perbulan</h5>
												<small class="card-subtitle">Keadaan Cuaca (Temperature,
													Humidity)</small>
												<div class="d-flex justify-content-center">
													<div class="col col-sm-6 col-md-6 col-lg-6 p-2 p-2">
														<label for="tahun" class="form-label">Tahun</label>
														<select id="search_temperatureTahun" name="keyword"
															class="form-control" value="<?= set_value('keyword'); ?>">
															<option class='text-center dropdown-toggle' value="">Semua
																Tahun
															</option>
															<?php foreach ($tahun as $p): ?>
																<option value="<?= $p; ?>">
																	<?= $p; ?>
																</option>
															<?php endforeach; ?>>

														</select>
													</div>
													<div class="col col-sm-6 col-md-6 col-lg-6 p-2 p-2">
														<label for="tahun" class="form-label">Wilayah</label>
														<select id="search_wilayahWilayah" name="keyword"
															class="form-control" value="<?= set_value('keyword'); ?>">
															<option class='text-center dropdown-toggle' value="">
																Rata-Rata Seluruh Wilayah
															</option>
															<?php foreach ($wilayah as $p): ?>
																<option value="<?= $p['id_wilayah']; ?>">
																	<?= $p['nama_wilayah']; ?>
																</option>
															<?php endforeach; ?>>

														</select>
													</div>

												</div>

											</div>
											<div class="card-body chartbulan_temperature">
												<!-- <div id="totalIncomeChart1"></div> -->
												<div id="id_chart_temperature" class="px-2"></div>

											</div>
										</div>
									</div>
								</div>
								<!--/ Total Income -->
							</div>
							<div class="col-xl-12 col-lg-12 col-12 mb-4">
								<div class="card">
									<div class="col-md-12">
										<div class="card-header">
											<h5 class="card-title mb-0">Rata Rata Harian</h5>
											<small class="card-subtitle">Keadaan Udara (PM2.5)</small>
											<div class="d-flex justify-content-center">
												<div class="col col-sm-3 col-md-3 col-lg-3 p-2 p-3">
													<label for="tahun" class="form-label">Tahun</label>
													<select id="search_temperatureTahun_H" name="keyword"
														class="form-control" value="<?= set_value('keyword'); ?>">
														<option class='text-center dropdown-toggle' value="">Semua Tahun
														</option>
														<?php foreach ($tahun as $p): ?>
															<option value="<?= $p; ?>">
																<?= $p; ?>
															</option>
														<?php endforeach; ?>>

													</select>
												</div>
												<div class="col col-sm-3 col-md-3 col-lg-3 p-2 p-3">
													<label for="bulan" class="form-label">Bulan</label>
													<select id="search_temperatureBulan_H" name="keyword"
														class="form-control" value="<?= set_value('keyword'); ?>">
														<option class='text-center dropdown-toggle' value="">Rata-Rata
															Seluruh Bulan
														</option>
														<?php foreach ($bulan as $key => $p): ?>
															<option value="<?= $key; ?>">
																<?= $p; ?>
															</option>
														<?php endforeach; ?>
													</select>
												</div>
												<div class="col col-sm-3 col-md-3 col-lg-3 p-2 p-3">
													<label for="tahun" class="form-label">Wilayah</label>
													<select id="search_wilayahTemperatureH" name="keyword"
														class="form-control" value="<?= set_value('keyword'); ?>">
														<option class='text-center dropdown-toggle' value="">Rata-Rata
															Seluruh Wilayah
														</option>
														<?php foreach ($wilayah as $p): ?>
															<option value="<?= $p['id_wilayah']; ?>">
																<?= $p['nama_wilayah']; ?>
															</option>
														<?php endforeach; ?>>

													</select>
												</div>

											</div>
										</div>

										<div class="card-body charthari_temperature">
											<div id="id_chart_temperature_H" class="px-2"></div>

										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ Content -->

					<!-- Footer -->
					<footer class="content-footer footer bg-footer-theme">
						<div
							class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
							<div class="mb-2 mb-md-0">
								©
								<script>
									document.write(new Date().getFullYear());
								</script>
								, made with ❤️ by Team PCR

							</div>

						</div>
					</footer>
					<!-- / Footer -->

					<div class="content-backdrop fade"></div>
				</div>
				<!--/ Content wrapper -->
			</div>

			<!--/ Layout container -->
		</div>
	</div>

	<!-- Overlay -->
	<div class="layout-overlay layout-menu-toggle"></div>

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
