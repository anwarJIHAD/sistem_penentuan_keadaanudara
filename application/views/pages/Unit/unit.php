<!-- Bootstrap Table with Header - Light -->
<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="py-1 mb-3"><span class="text-muted fw-light"></span> Perangkat</h4>



	<!-- Responsive Datatable -->
	<div class="card">
		<h5 class="card-header">Perangkat</h5>
		<div class="card-header d-flex flex-row justify-content-end gap-3">
			<a href="<?= base_url('C_Unit/tambah') ?>" class="btn btn-primary">
				<i class="menu-icon tf-icons mdi mdi-plus"></i>
				<div style="font-size:10px;">Tambah Perangkat</div>
			</a>

		</div>
		<div class="card-datatable table-responsive">
			<?= $this->session->flashdata('message'); ?>
			<table class="dt-responsive table border-top">
				<thead>
					<tr>
						<th></th>
						<th>No</th>
						<th>Nama Komunitas</th>
						<th>Perangkat</th>
						<th>email</th>
						<th>Password</th>
						<th>Status</th>
					</tr>
				</thead>
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
	'use strict';

	$(function () {
		var dt_responsive_table = $('.dt-responsive');

		// Responsive Table Initialization
		if (dt_responsive_table.length) {
			var dt_responsive = dt_responsive_table.DataTable({
				ajax: '<?= base_url('C_Unit/get') ?>', // URL untuk mendapatkan data dari controller

				columns: [
					{ data: null, defaultContent: '', orderable: false }, // Kolom kontrol
					{ data: 'no' }, // Kolom No
					{ data: 'nama_komunitas' }, // Kolom Nama Komunitas
					{ data: 'id_alat' }, // Kolom Perangkat
					{ data: 'email' }, // Kolom Email
					{ data: 'password' }, // Kolom Password
					{ data: 'actions' }, // Kolom Password
				], columnDefs: [
					{
						className: 'control',
						orderable: false,
						targets: 0,
						searchable: false,
						render: function (data, type, full, meta) {
							return '';
						}
					}],
				destroy: true,
				dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
				responsive: {
					details: {
						display: $.fn.dataTable.Responsive.display.modal({
							header: function (row) {
								var data = row.data();
								return 'Details of ' + data['nama_komunitas'];
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

		// Filter form control to default size
		setTimeout(() => {
			$('.dataTables_filter .form-control').removeClass('form-control-sm');
			$('.dataTables_length .form-select').removeClass('form-select-sm');
		}, 200);
	});

</script>
