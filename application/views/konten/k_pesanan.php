<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Pesanan</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member'); ?>">Home</a></li>
						<li class="breadcrumb-item active">Pesanan</li>
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
							<h3 class="card-title">Data Pesanan</h3>
						</div>
						<div class="card-body">
							<table id="tabelPesanan" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Judul</th>
									<th class="text-center">Tanggal</th>
									<th class="text-center">Sub Total</th>
									<th class="text-center">Biaya Antar</th>
									<th class="text-center">Total Jumlah</th>
									<th class="text-center">Status</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $no=1;foreach($dataPesanan->result_array() as $rowPesanan): ?>
									<tr>
										<td class="text-center"><?= $no++; ?></td>
										<td class="text-center"><?= bersihkan($rowPesanan['nama']); ?></td>
										<td class="text-center"><?= bersihkan($rowPesanan['judul']); ?></td>
										<td class="text-center"><?= bersihkan($rowPesanan['tanggal']); ?></td>
										<td class="text-center"><?= bersihkan($rowPesanan['sub_total']); ?></td>
										<td class="text-center"><?= bersihkan($rowPesanan['biaya_antar']); ?></td>
										<td class="text-center"><?= bersihkan($rowPesanan['total_jumlah']); ?></td>
										<td class="text-center"><?= bersihkan($rowPesanan['status']); ?></td>
										<td class="text-center">

											<a href="<?= base_url('Pesanan/antar/'.bersihkan($rowPesanan['id_order'])); ?>"><button class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="top" title="Antar"><i class="fas fa-truck"></i></button></a>
											<a href="<?= base_url('Pesanan/hapus/'.bersihkan($rowPesanan['id_order'])); ?>"><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button></a>
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
