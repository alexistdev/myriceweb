<?php
defined('BASEPATH') or exit('No direct script access allowed');?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Produk</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?= base_url('Member'); ?>">Home</a></li>
						<li class="breadcrumb-item active">Produk</li>
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
							<h3 class="card-title">Data Produk</h3>
							<button class="btn btn-primary btn-sm float-right">Tambah</button>
						</div>
						<div class="card-body">
							<table id="tabelkategori" class="table table-bordered table-hover">
								<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center">Merek</th>
									<th class="text-center">Kategori</th>
									<th class="text-center">Nama Produk</th>
									<th class="text-center">Jumlah</th>
									<th class="text-center">Ukuran</th>
									<th class="text-center">Harga</th>
									<th class="text-center">Gambar</th>
									<th class="text-center">Action</th>
								</tr>
								</thead>
								<tbody>
								<?php $no=1;foreach($dataProduk->result_array() as $rowProduk): ?>
									<tr>
										<td class="text-center"><?= $no++; ?></td>
										<td class="text-center"><?= bersihkan($rowProduk['nama_merek']); ?></td>
										<td class="text-center"><?= bersihkan($rowProduk['nama_kategori']); ?></td>

										<td class="text-center"><?= bersihkan($rowProduk['nama_produk']); ?></td>
										<td class="text-center"><?= bersihkan($rowProduk['jumlah']); ?></td>
										<td class="text-center"><?= bersihkan($rowProduk['ukuran']); ?></td>
										<td class="text-center"><?= bersihkan($rowProduk['total_harga']); ?></td>
										<td class="text-center"><img src="<?= base_url('foto/'.bersihkan($rowProduk['gambar'])); ?>" width="50px" height="auto" alt="<?= bersihkan($rowProduk['gambar']); ?>"></td>
										<td class="text-center">
											<a href="<?= base_url('Produk/hapus/'.bersihkan($rowProduk['id_produk'])); ?>"><button class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></button></a>
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
