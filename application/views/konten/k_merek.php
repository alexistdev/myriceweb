<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Merek</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member'); ?>">Home</a></li>
						<li class="breadcrumb-item active">Merek</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">

		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php
					echo $this->session->flashdata('notifikasi');
					echo $this->session->flashdata('notifikasi2'); ?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<form action="<?= base_url('Merek'); ?>" method="post">

						<div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="namaMerek">Nama Merek <span class="text-danger">*</span></label>
											<input type="text" name="namaMerek" id="namaMerek" maxlength="100" class="form-control" value="<?= set_value('namaMerek'); ?>" placeholder="Nama Merek" required="required">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<button type="submit" class="btn btn-primary">Simpan</button>
											<a href="<?= base_url('Member'); ?>"><button type="button" class="btn btn-danger">Batal</button></a>
										</div>
									</div>
								</div>
							</div>
						</div>

					</form>
				</div>
				<div class="col-md-8">
					<div class="card">
						<div class="card-body">
							<table id="tabelkategori" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nama Merek</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $no=1;foreach($dataMerek->result_array() as $rowMerek): ?>
									<tr>
										<td class="text-center"><?= $no++; ?></td>
										<td class="text-center"><?= bersihkan($rowMerek['nama_merek']); ?></td>
										<td class="text-center">
											<a href="<?= base_url('Merek/hapus/'.bersihkan($rowMerek['id_merek'])); ?>"><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button></a>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
