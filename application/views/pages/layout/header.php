<!doctype html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact" dir="ltr"
	data-theme="theme-default" data-assets-path="<?= base_url('assets/template/') ?>assets/"
	data-template="vertical-menu-template">

<head>
	<meta charset="utf-8" />
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>Dashboard - User</title>

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
	<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
	<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
	<link rel="stylesheet"
		href="<?= base_url('assets/template/') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/libs/typeahead-js/typeahead.css" />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/libs/apex-charts/apex-charts.css" />
	<link rel="stylesheet"
		href="<?= base_url('assets/template/') ?>assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
	<link rel="stylesheet"
		href="<?= base_url('assets/template/') ?>assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />

	<!-- Page CSS -->
	<link rel="stylesheet" href="../../assets/vendor/css/pages/app-logistics-fleet.css" />

	<link rel="stylesheet"
		href="<?= base_url('assets/template/') ?>assets/vendor/css/pages/app-logistics-dashboard.css" />

	<!-- Helpers -->
	<script src="<?= base_url('assets/template/') ?>assets/vendor/js/helpers.js"></script>
	<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
	<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
	<!-- <script src="<?= base_url('assets/template/') ?>assets/vendor/js/template-customizer.js"></script> -->
	<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
	<script src="<?= base_url('assets/template/') ?>assets/js/config.js"></script>
	<style>
		#map {
			height: 250px;
			width: 100%;
		}

		.layout-navbar {
			background-color: #A5D6A7 !important;
			/* background: rgb(0, 255, 242);
			background: linear-gradient(0deg, rgba(0, 255, 242, 1) 19%, rgba(132, 245, 238, 1) 52%, rgba(154, 231, 247, 1) 93%) !important;
			*/
		}

		.menus {
			background-color: #A5D6A7 !important;
		}
	</style>
	<link rel="stylesheet" href="../../assets/vendor/css/pages/app-logistics-fleet.css" />
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://code.jquery.com/jquery-3.7.1.js"
		integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	<script>
		function swall(pesan, teks, status) {

			Swal.fire({
				title: pesan,
				text: teks,
				icon: status,
				customClass: {
					confirmButton: 'btn btn-primary'
				},
				buttonsStyling: false
			});

		}

		function edit(id, jenis) {
			let kategori = jenis;
			console.log(kategori);
			let href; // Mendeklarasikan href di luar blok if dan else
			if (jenis == 'Unit') {
				href = "<?= base_url('C_Unit/edit/') ?>" + id; // Mengassign href tanpa let di sini
			} else {
				// Mengassign href tanpa let di sini
			}

			Swal.fire({
				title: "Edit Data",
				text: "Silahkan klik tombol Edit untuk melakukan perubahan data!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#ffc107",
				cancelButtonColor: "#d33",
				confirmButtonText: "Edit",
			}).then((result) => {
				if (result.value) {
					document.location.href = href;
				}
			});
		}
		function hapus(id, jenis) {
			// console.log(jenis);
			let href; // Mendeklarasikan href di luar blok if dan else
			if (jenis == 'Unit') {
				href = "<?= base_url('C_Unit/hapus/') ?>" + id;
			} else {
				href = "<?= base_url('C_Saldo/hapus/') ?>" + id + '/' + jenis;
			}

			Swal.fire({
				title: "Hapus Data?",
				text: "Silahkan klik tombol Edit untuk melakukan perubahan data!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Ya, hapus data!",
			}).then((result) => {
				if (result.value) {
					document.location.href = href;
				}
			});
		}
	</script>
</head>

<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">
			<!-- Menu -->

			<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme ">
				<div class="app-brand menus">
					<a href="index.html" class="app-brand-link">
						<span class="app-brand-logo demo">
							<!-- <img src="<?= base_url('assets/template/') ?>assets\img\icons\brands\safari.png" alt="Logo"
								width="30" /> -->
							<img src="<?= base_url('assets/template/') ?>assets\img\logo\logo_strata_png.png" alt="Logo"
								width="200" />
						</span>
						<!-- <span class="app-brand-text demo menu-text fw-bold ms-2">SycleS 2.5</span> -->
					</a>

					<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
						<i class="bx bx-chevron-left bx-sm align-middle"></i>
					</a>
				</div>

				<div class="menu-inner-shadow"></div>

				<ul class="menu-inner py-1 menus">
					<li class="menu-item">
						<a href="<?= base_url('C_Dashboard_user') ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bx-home-circle"></i>
							<div class="text-truncate" data-i18n="Dashboard">Dashboard</div>
						</a>
					</li>
					<li class="menu-item">
						<a href="<?= base_url('C_Rute') ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bxs-universal-access"></i>
							<div class="text-truncate" data-i18n="Manajemen Perjalanan">Manajemen Perjalanan</div>
						</a>
					</li>
					<li class="menu-item">
						<a href="<?= base_url('C_unit') ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bxs-customize"></i>
							<div class="text-truncate" data-i18n="Manajemen Perangkat">Manajemen Perangkat</div>
						</a>
					</li>
					<!-- <li class="menu-item">
						<a href="<?= base_url('C_Rekomendasi') ?>" class="menu-link">
							<i class="menu-icon tf-icons bx bxs-map-pin"></i>
							<div class="text-truncate" data-i18n="Rekomendasi Wilayah">Rekomendasi Wilayah</div>
						</a>
					</li> -->

				</ul>
			</aside>
			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">
				<!-- Navbar -->

				<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
					id="layout-navbar" style="background-color:red;">
					<div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
						<a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
							<i class="bx bx-menu bx-sm"></i>
						</a>
					</div>

					<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
						<!-- Search -->
						<div class="navbar-nav align-items-center">
							<div class="nav-item navbar-search-wrapper mb-0">

								<span class="d-none d-md-inline-block text-black">Hallo ,
									<?php echo $this->session->userdata('nama_komunitas'); ?></span>
								</a>
							</div>
						</div>
						<!-- /Search -->

						<ul class="navbar-nav flex-row align-items-center ms-auto">
							<!-- Place this tag where you want the button to render. -->
							<!-- User -->
							<li class="nav-item navbar-dropdown dropdown-user dropdown">
								<a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);"
									data-bs-toggle="dropdown">
									<div class="avatar avatar-online">
										<img src="<?= base_url('assets/template/') ?>assets/img/avatars/1.png" alt
											class="w-px-40 h-auto rounded-circle p-1" />
									</div>
								</a>
								<ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
									<li>
										<a class="dropdown-item pb-2 mb-1" href="#">
											<div class="d-flex align-items-center">
												<div class="flex-shrink-0 me-2 pe-1">
													<div class="avatar avatar-online">
														<img src="<?= base_url('assets/template/') ?>assets/img/avatars/1.png"
															alt class="w-px-40 h-auto rounded-circle" />
													</div>
												</div>
												<div class="flex-grow-1">
													<h6 class="mb-0">
														<?php echo $this->session->userdata('nama_komunitas'); ?>
													</h6>
													<small class="text-muted">Admin</small>
												</div>
											</div>
										</a>
									</li>
									<li>
										<div class="dropdown-divider my-1"></div>
									</li>

									<li>
										<div class="dropdown-divider my-1"></div>
									</li>
									<li>
										<a class="dropdown-item" href="<?= base_url('Auth/logout') ?>">
											<i class="mdi mdi-power me-1 mdi-20px"></i>
											<span class="align-middle">Log Out</span>
										</a>
									</li>
								</ul>
							</li>
							<!--/ User -->
						</ul>
					</div>

					<!-- Search Small Screens -->
					<div class="navbar-search-wrapper search-input-wrapper d-none">
						<input type="text" class="form-control search-input container-xxl border-0"
							placeholder="Search..." aria-label="Search..." />
						<i class="bx bx-x bx-sm search-toggler cursor-pointer"></i>
					</div>
				</nav>

				<!-- / Navbar -->

				<!-- Content wrapper -->
				<div class="content-wrapper">
					<!-- Content -->
