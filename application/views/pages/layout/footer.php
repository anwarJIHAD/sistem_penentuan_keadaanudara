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

<script src="<?= base_url('assets/template/') ?>assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>

<!-- Main JS -->
<script src="<?= base_url('assets/template/') ?>assets/js/main.js"></script>

<!-- Page JS -->
<script src="<?= base_url('assets/template/') ?>assets/js/dashboards-analytics.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/js/app-ecommerce-dashboard.js"></script>
<script src="<?= base_url('assets/template/') ?>assets/js/charts-chartjs.js"></script>
<!-- <script src="<?= base_url('assets/template/') ?>assets/js/app-logistics-fleet.js"></script> -->
<!-- <script src="<?= base_url('assets/template/') ?>assets/js/maps-leaflet.js"></script> -->



<script>
	mapboxgl.accessToken = 'pk.eyJ1Ijoiam9jaG9pMDcwNyIsImEiOiJjajczMWZrcTkwNHo2MzNvNGIzOHI3MW85In0.GSHlVF_HltDmEvomI2m_CA';
	var map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',
		center: [106.816666, -6.200000], // Koordinat pusat di Indonesia (Jakarta)
		zoom: 12
	});
</script>

</body>

</html>
