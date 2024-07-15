<div class="container-xxl flex-grow-1 container-p-y">
	<h4 class="fw-bold py-3 mb-4"> <a class="text-muted fw-light" href="<?= base_url('C_Nasabah') ?>">Nasabah/</a>
		Edit</h4>
	<!-- Basic Layout -->
	<div class="row">
		<div class="col-xl">
			<div class="card mb-4">
				<div class="card-header d-flex justify-content-between align-items-center">
					<h5 class="mb-0">Edit Nasabah</h5>
				</div>
				<div class="card-body">
					<form action="" method="POST" enctype="multipart/form-data">
						<div class="form-floating form-floating-outline mb-4">
							<input type="text" class="form-control" name="nama" id="basic-default-fullname"
								value="<?= $Unit['nama_komunitas']; ?>" placeholder="Masukkan Nama Komunitas" />
							<label for="basic-default-fullname">Nama Komunitas</label>
							<?= form_error('nama', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-floating form-floating-outline mb-4">
							<input type="text" class="form-control" name="email" id="basic-default-company"
								value="<?= $Unit['email']; ?>" placeholder="Masukkan email" />
							<label for="basic-default-company">email</label>
							<?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-floating form-floating-outline mb-4">
							<input type="text" id="basic-default-phone" name="unit_alat" class="form-control phone-mask"
								value="<?= $Unit['id_alat']; ?>" placeholder="Masukkan unit alat" />
							<label for="basic-default-phone">nama unit alat</label>
							<?= form_error('unit_alat', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<div class="form-floating form-floating-outline mb-4">
							<input type="text" id="basic-default-message" value=""
								class="form-control" name="password" placeholder="Masukkan password Nasabah"
								style="height: 60px" />
							<label for="basic-default-message">password</label>
							<?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
						</div>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</form>
				</div>
			</div>
		</div>
		<!-- Merged -->

	</div>
</div>
<!-- / Content -->
