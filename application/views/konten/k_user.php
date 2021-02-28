<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Data User</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member'); ?>">Home</a></li>
						<li class="breadcrumb-item active">Data User</li>
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

				<div class="col-md-12">
					<div class="card card-dark">
						<div class="card-header">
							<h3 class="card-title">Data User</h3>
						</div>
						<div class="card-body">
							<table id="tabelUser" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Username</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Alamat</th>
									<th class="text-center">Kecamatan</th>
									<th class="text-center">Kabupaten</th>
									<th class="text-center">Provinsi</th>
									<th class="text-center">Kodepos</th>
									<th class="text-center">Telepon</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $no=1;foreach($dataUser->result_array() as $rowUser): ?>
									<tr>
										<td class="text-center"><?= $no++; ?></td>
										<td class="text-center"><?= bersihkan($rowUser['email']); ?></td>
										<td class="text-center"><?= bersihkan($rowUser['nama']); ?></td>
										<td class="text-center"><?= bersihkan($rowUser['alamat']); ?></td>
										<td class="text-center"><?= bersihkan($rowUser['kecamatan']); ?></td>
										<td class="text-center"><?= bersihkan($rowUser['kabupaten']); ?></td>
										<td class="text-center"><?= bersihkan($rowUser['provinsi']); ?></td>
										<td class="text-center"><?= bersihkan($rowUser['kodepos']); ?></td>
										<td class="text-center"><?= bersihkan($rowUser['telp']); ?></td>
										<td class="text-center">
											<a href="<?= base_url('User/hapus/'.bersihkan($rowUser['id_user'])); ?>"><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button></a>
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
