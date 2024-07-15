<div class="container-xxl flex-grow-1 container-p-y">
	<div class="card overflow-hidden">
		<!-- Map Menu Wrapper -->
		<div class="d-flex app-logistics-fleet-wrapper">
			<!-- Map Menu Button when screen is < md -->
			<div class="flex-shrink-0 position-fixed m-4 d-md-none w-auto z-1">
				<button class="btn btn-label-white border border-2 z-2 p-2" data-bs-toggle="sidebar" data-overlay=""
					data-target="#app-logistics-fleet-sidebar">
					<i class="bx bx-menu"></i>
				</button>
			</div>

			<!-- Map Menu -->
			<div class="app-logistics-fleet-sidebar col h-100" id="app-logistics-fleet-sidebar">
				<div class="card-header border-0 pt-4 pb-2 d-flex justify-content-center">
					<h5 class="mb-0 card-title">Data Perjalanan</h5>
					<!-- Sidebar close button -->
					<i class="bx bx-x bx-sm cursor-pointer close-sidebar d-md-none" data-bs-toggle="sidebar"
						data-overlay data-target="#app-logistics-fleet-sidebar"></i>
				</div>
				<!-- Sidebar when screen < md -->
				<div class="card-body p-0 logistics-fleet-sidebar-body">
					<!-- Menu Accordion -->
					<div class="accordion p-2" id="fleet" data-bs-toggle="sidebar" data-overlay
						data-target="#app-logistics-fleet-sidebar">
						<!-- Fleet 1 -->
						<div class="accordion-item shadow-none border-0 active mb-0" id="fl-1">
							<div class="accordion-header" id="fleetOne">
								<div role="button" class="accordion-button shadow-none" data-bs-toggle="collapse"
									data-bs-target="#fleet1" aria-expanded="true" aria-controls="fleet1">
									<div class="d-flex align-items-center">
										<div class="avatar-wrapper">
											<div class="avatar me-3">
												<span class="avatar-initial rounded-circle bg-label-secondary"><i
														class="bx bxs-truck"></i></span>
											</div>
										</div>
										<span class="d-flex flex-column">
											<span class="h6 mb-0">Kamis, 25 Juni 2024</span>
											<span class="text-muted">Pekanbaru, Riau, Indonesia</span>
										</span>
									</div>
								</div>
							</div>
							<div id="fleet1" class="accordion-collapse collapse show" data-bs-parent="#fleet">
								<!-- Mapbox Map container -->


								<div class="accordion-body pt-3 pb-0">
									<div class="col h-500 map-container">
										<!-- Map -->
										<div id="map" class="w-100 h-300"></div>
									</div>

									<!-- Overlay Hidden -->
									<div class="app-overlay d-none"></div>
								</div>
							</div>
						</div>
						<hr>
						<!-- Fleet 2 -->
						<div class="accordion-item shadow-none border-0 mb-0" id="fl-2">
							<div class="accordion-header" id="fleetTwo">
								<div role="button" class="accordion-button collapsed shadow-none"
									data-bs-toggle="collapse" data-bs-target="#fleet2" aria-expanded="true"
									aria-controls="fleet2">
									<div class="d-flex align-items-center">
										<div class="avatar-wrapper">
											<div class="avatar me-3">
												<span class="avatar-initial rounded-circle bg-label-secondary"><i
														class="bx bxs-truck"></i></span>
											</div>
										</div>
										<span class="d-flex flex-column">
											<span class="h6 mb-0">Rokan Hilir</span>
											<span class="text-muted">Bangko Pusako, Riau, Indonesia</span>
										</span>
									</div>
								</div>
							</div>
							<div id="fleet2" class="accordion-collapse collapse" data-bs-parent="#fleet">
								<div class="accordion-body pt-3 pb-0">
									<div class="col h-500 map-container">
										<!-- Map -->
										<div id="map" class="w-100 h-300"></div>
									</div>

									<!-- Overlay Hidden -->
									<div class="app-overlay d-none"></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>
</div>
