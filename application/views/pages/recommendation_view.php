<!doctype html>

<html lang="en" class="light-style layout-menu-fixed layout-compact" dir="ltr" data-theme="theme-default"
	data-assets-path="<?= base_url('assets/template/') ?>assets/" data-template="horizontal-menu-template">

<head>
	<meta charset="utf-8" />
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>StraAir (Air Quality Tracking System With Mobile Station)</title>

	<meta name="description" content="" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon"
		href="<?= base_url('assets/template/') ?>assets\img\logo\logo_strata_png.png" />

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

		.rekomendasi:hover {
			background-color: #007bff;
			color: #007bff;
		}

		.rekomendasi:hover .coba {
			color: white;
			/* warna teks saat hover */
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
							<span class="app-brand-text demo menu-text fw-bold">STRAAIR</span>
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
					<a href="<?= base_url('') ?>" class="menu-link menu-toggle">
                      <i class="menu-icon tf-icons bx bx-home-circle"></i>
                      <div data-i18n="Dashboard">Dashboard</div>
                    </a>
					<div style="margin-left:100px;">
					<a href="<?= base_url('/C_Rekomendasi_all') ?>" class="menu-link ml-6">
                          <i class="menu-icon tf-icons bx bx-diamond"></i>
                          <div data-i18n="Rekomendasi">Rekomendasi</div>
                        </a>
						
					</div>
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
							<div class="col-12">
								<div class="card mb-4">
									<div class="card-header"><h5 class="card-title mb-0">Rekomendasi Wilayah</h5>
												<small class="card-subtitle">Sistem rekomendasi ini memanfaatkan teknologi canggih untuk memberikan analisis yang akurat tentang kualitas udara di berbagai wilayah. Dengan adanya fitur pengelompokan radius, pemantauan real-time, dan analisis berbasis algoritma KNN, sistem ini memberikan solusi praktis bagi komunitas sepeda dan masyarakat umum dalam merencanakan rute perjalanan yang lebih aman dan sehat.</small></div>
									<div class="card-body">
										<div class="leaflet-map" id="map"></div>

										<!-- <div class="" id="mapdashboard"></div> -->

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
	fetch('C_Rekomendasi_all/dataload')
		.then(response => response.json())
		.then(data => {
			console.log(data);
			let bounds = new mapboxgl.LngLatBounds();
			data.forEach((item) => {
				const longitude = parseFloat(item.longitude);
				const latitude = parseFloat(item.latitude);
				const recommendation = item.recommendation; // Mendapatkan nilai rekomendasi dari data

				if (isNaN(longitude) || isNaN(latitude)) {
					console.error('Invalid coordinates:', item);
					return;
				}

				// Tentukan warna popup berdasarkan nilai recommendation
				let popupColor = recommendation === "Direkomendasikan" ? 'green' : 'red';

				// Buat elemen gambar icon lokasi
				const el = document.createElement('img');
				el.src = 'https://docs.mapbox.com/mapbox-gl-js/assets/custom_marker.png'; // Gambar icon lokasi
				el.style.width = '30px';  // Atur ukuran icon
				el.style.height = '30px';

				// Buat marker dan popup otomatis muncul
				const marker = new mapboxgl.Marker(el)
					.setLngLat([longitude, latitude])
					.setPopup(new mapboxgl.Popup({ offset: 25, closeOnClick: false }) // Popup otomatis
						.setHTML(`<div style="background-color: ${popupColor}; padding: 10px; color: white;">${recommendation}</div>`))
					.addTo(map);

				// Tampilkan popup secara otomatis
				marker.getPopup().addTo(map);

				// Debugging log for marker addition
				console.log(`Marker added at ${[longitude, latitude]}`);

				// Tambah titik ke bounds untuk penyesuaian map
				bounds.extend([longitude, latitude]);
			});

			// Sesuaikan tampilan map agar fit ke semua marker
			map.fitBounds(bounds, {
				padding: 20
			});
		})
		.catch(error => console.error('Error fetching data:', error));
</script>



</body>

</html>
