<!doctype html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
	data-assets-path="<?= base_url('assets/template/') ?>assets/" data-template="horizontal-menu-template">

<head>
	<meta charset="utf-8" />
	<meta name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>Login-Syclesense</title>

	<meta name="description" content="" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?= base_url('assets/template/') ?>assets\img\logo\logo_strata_png.png" />

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
	<link rel="stylesheet"
		href="<?= base_url('assets/template/') ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/libs/typeahead-js/typeahead.css" />
	<!-- Vendor -->
	<link rel="stylesheet"
		href="<?= base_url('assets/template/') ?>assets/vendor/libs/@form-validation/form-validation.css" />

	<!-- Page CSS -->
	<!-- Page -->
	<link rel="stylesheet" href="<?= base_url('assets/template/') ?>assets/vendor/css/pages/page-auth.css" />

	<!-- Helpers -->
	<script src="<?= base_url('assets/template/') ?>assets/vendor/js/helpers.js"></script>
	<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
	<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
	<script src="<?= base_url('assets/template/') ?>assets/vendor/js/template-customizer.js"></script>
	<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
	<script src="<?= base_url('assets/template/') ?>assets/js/config.js"></script>
</head>


<body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
							<div class="app-brand mb-1 d-flex justify-content-center">
					<a href="#" class="app-brand-link gap-2">
						<span class="app-brand-logo demo">
							<img src="<?= base_url('assets/template/') ?>assets/img/logo/logo_strata_png.png"
								alt="Logo" width="300" />
						</span>
					</a>
				</div>

					<!-- /Logo -->
					 <div class="text-center">
					 <h4 class="mb-2 ">Selamat Datang Di Sistem Informasi Kualitas Udara </h4>
              <p class="mb-4">LOGIN ADMIN</p>

					 </div>
            
              <form id="formAuthentication" class="mb-3" action="" method="POST">
                <div class="mb-3">
                  <label for="email" class="form-label">Email atau Username</label>
                  <input
                    type="text"
                    class="form-control"
                    id="email"
                    name="email"
                    placeholder="Enter your email or username"
                    autofocus />
					<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

                </div>
                <div class="mb-3 form-password-toggle">
                  <div class="d-flex justify-content-between">
                    <label class="form-label" for="password">Password</label>
                  </div>
                  <div class="input-group input-group-merge">
                    <input
                      type="password"
                      id="password"
                      class="form-control"
                      name="password"
                      placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                      aria-describedby="password" />
					  <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                  </div>
                </div>
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember-me" />
                    <label class="form-check-label" for="remember-me"> Remember Me </label>
                  </div>
                </div>
                <div class="mb-3">
                  <button class="btn btn-primary d-grid w-100" type="submit">Sign in</button>
                </div>
              </form>

            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

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
    <script src="<?= base_url('assets/template/') ?>assets/vendor/libs/@form-validation/popular.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/vendor/libs/@form-validation/bootstrap5.js"></script>
    <script src="<?= base_url('assets/template/') ?>assets/vendor/libs/@form-validation/auto-focus.js"></script>

    <!-- Main JS -->
    <script src="<?= base_url('assets/template/') ?>assets/js/main.js"></script>

    <!-- Page JS -->
    <script src="<?= base_url('assets/template/') ?>assets/js/pages-auth.js"></script>
  </body>

</html>
