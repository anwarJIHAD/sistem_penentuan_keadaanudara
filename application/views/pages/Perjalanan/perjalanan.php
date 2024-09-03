<!-- Bootstrap Table with Header - Light -->
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="py-1 mb-3"><span class="text-muted fw-light"></span> Perjalanan</h4>
<script>
	function detail(start, end) {
			window.location.href = "<?= base_url() ?>C_Rute/detail/" + start + "/" + end;
		}
</script>


	<!-- Responsive Datatable -->
	<div class="card">
		<h5 class="card-header">Data Perjalanan</h5>
		<!-- <div class="card-header d-flex flex-row justify-content-end gap-3">
			<a href="<?= base_url('C_Unit/tambah') ?>" class="btn btn-primary">
				<i class="menu-icon tf-icons mdi mdi-plus"></i>
				<div style="font-size:10px;">Tambah Perangkat</div>
			</a>

		</div> -->
		<div class="row justify-content-start ml-3">
			<div class="col-8 col-sm-6 col-lg-4 ml-50" style="margin-left: 25px;">
				<label class="form-label">Date:</label>
				<div class="mb-0 pl-3 d-flex justify-content-start">
					<input type="text" class="form-control dt-date flatpickr-range dt-input flatpickr-input"
						value="<?= $start_input ?> to <?= $end_input ?>" data-column="5"
						placeholder="StartDate to EndDate" data-column-index="4" name="dt_date" readonly="readonly"
						style="width: 220px; margin-right: 10px;">
					<button class="btn btn-primary" id="filter_date">Filter</button>
				</div>
				<input type="hidden" class="form-control dt-date start_date dt-input" data-column="5" id="start_date"
					data-column-index="4" name="value_from_start_date" value="<?= $start_date ?>">
				<input type="hidden" class="form-control dt-date end_date dt-input" name="value_from_end_date"
					id="end_date" data-column="5" data-column-index="4" value="<?= $end_date ?>">
			</div>

		</div>
		<div class="card-datatable table-responsive">
			<?= $this->session->flashdata('message'); ?>
			<table class="dt-responsive_ table border-top nowrap " style="width:100%">
				<thead>
					<tr>
						<th></th>
						<th>No</th>
						<th>Rute</th>
						<th>Waktu Mulai</th>
						<th>Waktu Selesai</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<?php foreach ($routes as $index => $route): ?>
					<tr>
						<td>Route <?php echo $index + 1; ?></td>
						<td><?php echo $route[0]->datetime; ?></td>
						<td><?php echo end($route)->datetime; ?></td>
						<td>
							<a href="<?php echo site_url('routes/detail/' . $route[0]->id . '/' . end($route)->id); ?>">View
								Details</a>
						</td>
					</tr>
				<?php endforeach; ?>
				<!-- <tfoot>
						<tr>
							<th></th>
							<th>No</th>
							<th>Nama Komunitas</th>
							<th>Perangkat</th>
							<th>email</th>
							<th>Password</th>
							<th>Status</th>
						</tr>
					</tfoot> -->
			</table>
		</div>
	</div>
	<!--/ Responsive Datatable -->
</div>
<!-- Bootstrap Table with Header - Light -->
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
	crossorigin="anonymous"></script>
<script>
	$(function () {
		var dt_responsive_table = $('.dt-responsive_');
		var dt_responsive;

		function initializeDataTable(start_date, end_date) {
			if (dt_responsive_table.length) {
				dt_responsive = dt_responsive_table.DataTable({
					ajax: {
						url: '<?= base_url('C_Rute/get') ?>',
						type: 'POST',
						data: {
							start_date: start_date,
							end_date: end_date
						},
						dataSrc: function (json) {
							console.log('Data yang diterima:', json);
							return json.data;
						}
					},
					columns: [
						{ data: null, defaultContent: '', orderable: false },
						{ data: 'no' },
						{ data: 'rute' },
						{ data: 'start' },
						{ data: 'finish' },
						{ data: 'actions' },
					],
					columnDefs: [
						{
							className: 'control',
							orderable: false,
							targets: 0,
							searchable: false,
							render: function (data, type, full, meta) {
								return '';
							}
						}
					],
					destroy: true,
					dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
					responsive: {
						details: {
							display: $.fn.dataTable.Responsive.display.modal({
								header: function (row) {
									var data = row.data();
									return 'Detail dari ' + data['rute'];
								}
							}),
							type: 'column',
							renderer: function (api, rowIdx, columns) {
								var data = $.map(columns, function (col, i) {
									return col.title !== ''
										? '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
										'<td>' + col.title + ':</td> ' +
										'<td>' + col.data + '</td>' +
										'</tr>'
										: '';
								}).join('');

								return data ? $('<table class="table"/><tbody />').append(data) : false;
							}
						}
					}
				});
			}
		}

		$('#filter_date').on('click', function () {
			var start_date = $('#start_date').val().split('/').reverse().join('-').replace(/(\d{4})-(\d{2})-(\d{2})/, '$3-$2-$1');
			var end_date = $('#end_date').val().split('/').reverse().join('-').replace(/(\d{4})-(\d{2})-(\d{2})/, '$3-$2-$1');

			if (start_date == '' || end_date == '') {
				alert('Tanggal Kosong');
			} else {
				window.location.href = "<?= base_url() ?>C_Rute/index/" + start_date + "/" + end_date;
			}
		});


		// Inisialisasi DataTable dengan nilai default
		var start_date = $('#start_date').val();
		var end_date = $('#end_date').val();
		initializeDataTable(start_date, end_date);

		// Kontrol form filter ke ukuran default
		setTimeout(() => {
			$('.dataTables_filter .form-control').removeClass('form-control-sm');
			$('.dataTables_length .form-select').removeClass('form-select-sm');
		}, 200);
		
	});

</script>







<!-- <script>

	$(function () {
		var dt_responsive_table = $('.dt-responsive_');

		// Responsive Table Initialization
		if (dt_responsive_table.length) {
			var dt_responsive = dt_responsive_table.DataTable({
				ajax: {
					url: '<?= base_url('C_Rute/get') ?>',
					data: function (d) {
						d.start_date = $('#start_date').val();
						d.end_date = $('#end_date').val();
					}
				},
				columns: [
					{ data: null, defaultContent: '', orderable: false },
					{ data: 'no' },
					{ data: 'rute' },
					{ data: 'start' },
					{ data: 'finish' },
					{ data: 'actions' },
				],
				columnDefs: [
					{
						className: 'control',
						orderable: false,
						targets: 0,
						searchable: false,
						render: function (data, type, full, meta) {
							return '';
						}
					}
				],
				destroy: true,
				dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
				responsive: {
					details: {
						display: $.fn.dataTable.Responsive.display.modal({
							header: function (row) {
								var data = row.data();
								return 'Details of ' + data['rute'];
							}
						}),
						type: 'column',
						renderer: function (api, rowIdx, columns) {
							var data = $.map(columns, function (col, i) {
								return col.title !== ''
									? '<tr data-dt-row="' + col.rowIndex + '" data-dt-column="' + col.columnIndex + '">' +
									'<td>' + col.title + ':</td> ' +
									'<td>' + col.data + '</td>' +
									'</tr>'
									: '';
							}).join('');

							return data ? $('<table class="table"/><tbody />').append(data) : false;
						}
					}
				}
			});

			// Event listener untuk tombol filter
			$('#filter_date').on('click', function () {
				if ($('#start_date').val() == '' || $('#end_date').val() == '') {
					alert('Tanggal Kosong')
				} else {
					dt_responsive.ajax.reload();
				}
			});
		}
	

		// Filter form control to default size
		setTimeout(() => {
			$('.dataTables_filter .form-control').removeClass('form-control-sm');
			$('.dataTables_length .form-select').removeClass('form-select-sm');
		}, 200);
	});

</script> -->
