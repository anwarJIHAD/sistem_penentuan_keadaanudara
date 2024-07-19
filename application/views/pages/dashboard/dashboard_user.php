<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="py-3 mb-4"><span class="text-muted fw-light">CycleSense /</span> Dashboard</h4>
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
			<div class="card card-border-shadow-primary h-100">
				<div class="card-body">
					<div class="d-flex align-items-center mb-2 pb-1">
						<div class="avatar me-2">
							<span class="avatar-initial rounded bg-label-primary"><i class="bx bxs-truck"></i></span>
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
			<div class="card card-border-shadow-warning h-100">
				<div class="card-body">
					<div class="d-flex align-items-center mb-2 pb-1">
						<div class="avatar me-2">
							<span class="avatar-initial rounded bg-label-warning"><i class="bx bx-time-five"></i></span>
						</div>
						<h5 class="ms-1 mb-0">Jumlah Rute</h5>
					</div>
					<div class="d-flex justify-content-center">
						<h2 class="mb-0">6</h2>
						<small class="text-muted">Rute</small>

					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mb-4">
			<div class="card card-border-shadow-danger h-100">
				<div class="card-body">
					<div class="d-flex align-items-center mb-2 pb-1">
						<div class="avatar me-2">
							<span class="avatar-initial rounded bg-label-danger"><i
									class="bx bx-git-repo-forked"></i></span>
						</div>
						<h5 class="ms-1 mb-0">Jarak Tempuh Total</h5>
					</div>
					<div class="d-flex justify-content-center">
						<h2 class="mb-0">454</h2>
						<small class="text-muted">Km</small>

					</div>
				</div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3 mb-4">
			<div class="card card-border-shadow-info h-100">
				<div class="card-body">
					<div class="d-flex align-items-center mb-2 pb-1">
						<div class="avatar me-2">
							<span class="avatar-initial rounded bg-label-danger"><i class="bx bx-error"></i></span>
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
	<!--/ Card Border Shadow -->

	<div class="row">
		<div class="col-12">
			<div class="card mb-4">
				<h5 class="card-header">Keadaan Udara</h5>
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
							<small class="card-subtitle">Keadaan Udara</small>
							<div class="d-flex justify-content-center">
								<div class="col col-sm-6 col-md-6 col-lg-6 p-2 p-2">
									<label for="tahun" class="form-label">Tahun</label>
									<select id="search_transaksipelapak" name="keyword" class="form-control"
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
									<select id="search_transaksipelapak" name="keyword" class="form-control"
										value="<?= set_value('keyword'); ?>">
										<option class='text-center dropdown-toggle' value="">
											Rata-Rata Seluruh Wilayah
										</option>
										<?php foreach ($wilayah_sample as $p): ?>
											<option value="<?= $p; ?>">
												<?= $p; ?>
											</option>
										<?php endforeach; ?>>

									</select>
								</div>

							</div>

						</div>
						<div class="card-body">
							<div id="totalIncomeChart1"></div>
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
						<small class="card-subtitle">Keadaan Udara</small>
						<div class="d-flex justify-content-center">
							<div class="col col-sm-3 col-md-3 col-lg-3 p-2 p-3">
								<label for="tahun" class="form-label">Tahun</label>
								<select id="search_transaksipelapak" name="keyword" class="form-control"
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
								<select id="search_transaksipelapak" name="keyword" class="form-control"
									value="<?= set_value('keyword'); ?>">
									<option class='text-center dropdown-toggle' value="">Rata-Rata
										Seluruh Bulan
									</option>
									<?php foreach ($bulan as $p): ?>
										<option value="<?= $p; ?>">
											<?= $p; ?>
										</option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col col-sm-3 col-md-3 col-lg-3 p-2 p-3">
								<label for="tahun" class="form-label">Wilayah</label>
								<select id="search_transaksipelapak" name="keyword" class="form-control"
									value="<?= set_value('keyword'); ?>">
									<option class='text-center dropdown-toggle' value="">Rata-Rata
										Seluruh Wilayah
									</option>
									<?php foreach ($wilayah_sample as $p): ?>
										<option value="<?= $p; ?>">
											<?= $p; ?>
										</option>
									<?php endforeach; ?>>

								</select>
							</div>

						</div>
					</div>

					<div class="card-body">
						<canvas id="barChart" class="chartjs" data-height="270"></canvas>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ On route vehicles Table -->
</div>
<!-- / Content -->