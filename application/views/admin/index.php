<div class="page-header">
	<h3>Dashboard</h3>
</div>
<div class="row">
	<div class="col-lg-3 col-md-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-3">
					<i class="glyphicon glyphicon-book"></i>
				</div>
				<div class="col-xs-9 text-right">
					<div class="huge">
						<font size="18"><b><?php echo $this->m_perpus->get_data('buku')->num_rows(); ?></b></font>
					</div>
					<div><b>Jumlah Buku</b></div>
				</div>
			</div>
		</div>
		<a href="<?php echo base_url().'admin/buku' ?>">
			<div class="panel-footer">
				<span class="pull-left">view details</span>
				<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>
<div class="row">
	<div class="col-lg-3 col-md-6">
	<div class="panel panel-primary">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-3">
					<i class="glyphicon glyphicon-book"></i>
				</div>
<div class="col-xs-9 text-right">
 <div class="huge">
 	<font size="18"><b><?php echo $this->m_perpus->get_data('anggota')->num_rows(); ?></b></font>
					</div>
					<div><b>Jumlah Anggota</b></div>
				</div>
			</div>
		</div>
		<a href="<?php echo base_url(). 'admin/anggota' ?>">
			<div class="panel-footer">
				<span class="pull-left-">view details</span>
				<span class="pull-right"><i class="glyphicon-arrow-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>

<div class="col-lg-3 col-md-6">
	<div class="panel panel-danger">
		<div class="panel-heading">
			<div class="row">
				<div class="col-xs-3">
					<i class="glyphicon glyphiconok"></i>
				</div>
				<div class="col-xs-9 text-right">
					<div class="huge">
						<font size="18"><b><?php echo $this->m_perpus->edit_data(array('status_peminjaman'=>0),'transaksi')->num_rows(); ?></b></font>
					</div>
					<div><b>Peminjaman Belum Selesai</b></div>
				</div>
			</div>
		</div>
		<a href="<?php echo base_url().'admin/peminjaman'; ?>">
			<div class="panel-footer">
				<span class="pull-left">view details</span>
				<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>

<div class="col-lg-3 col-md-6">
	<div class="panel panel-danger">
		<div class="panel panel-heading">
			<div class="row">
				<div class="col-xs-3">
					<i class="glyphicon glyphicon-ok"></i>
				</div>
				<div class="col-xs-9 text-right">
					<div class="huge">
					<font size="18"><b><?php echo $this->m_perpus->edit_data(array('status_peminjaman'=>1),'transaksi')->num_rows(); ?></b></font>
				</div>
				<div><b>Peminjaman Selesai</b></div>
			</div>
		</div>
	</div>
	<a href="<?php echo base_url().'admin/peminjaman'; ?>">
<div class="panel-footer">
				<span class="pull-left">view details</span>
				<span class="pull-right"><i class="glyphicon glyphicon-arrow-right"></i></span>
				<div class="clearfix"></div>
			</div>
		</a>
	</div>
</div>

<hr>

<div class="row">
	<div class="col-lg-4 col-md-7">
		<div class="panel panel_default">
			<div class="panel-heading">
				<h3 class="panel-title" style="font-size: 18px; font-weight: bold;"><i class="glyphicon glyphicon-random arrow-right"></i> buku</h3>
			</div>
			<div class="panel-body">
				<div class="list-group">
					<?php foreach ($buku as $b){ ?>
					<a href="#" class="list-group-item">
						<span class="badge"><?php if ($b->status_buku == 1){echo "tersedia";}else{echo "dipinjam";}?></span>
						<i class="glyphicon glyphicon-book"></i> <?php echo $b->judul_buku; ?>
					</a>
					<?php } ?>
				</div>
				<div class="text-right">
					<a href="<?php echo base_url(). 'admin/buku' ?>">lihat semua buku <i class="glyphicon glyphicon-arrow-right"></i></a>
				</div>
			</div>
		</div>
	</div>
<div class="col-lg-3 col-md-5">
	<div class="panel panel_default">
		<div class="panel-heading">
			<h3 class="panel-title" style="font-size: 18px; font-weight: bold;"><i class="glyphicon glyphicon-user"></i>anggota terbaru</h3>
		</div>
		<div class="panel-body">
			<div class="list-group">
				<?php foreach($anggota as $a){ ?>
				<a href="#" class="list-group-item">
					<span class="badge"><?php echo $a->gender; ?></span>
					<i class="glyphicon glyphicon-user"></i> <?php echo $a->nama_anggota; ?>
				</a>
				<?php } ?>
			</div>
			<div class="text-right">
				<a href="<?php echo base_url().'admin/anggota' ?>">lihat semua anggota <i class="glyphicon glyphicon-arrow-right"></i></a>
			</div>
		</div>
	</div>
</div>

<div class="col-lg-5 col-md-12">
	<div class="panel panel_default">
		<div class="panel-heading">
			<h3 class="panel-title" style="font-size: 18px; font-weight: bold;"><i class="glyphicon glyphicon-sort"></i>peminjaman terakhir</h3>
		</div>
		<div class="panel-body">
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-striped">
					<thead>
						<tr>
							<th>tgl. transaksi</th>
							<th>tgl. pinjam</th>
							<th>tgl. kembali</th>
							<th>total denda</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						foreach($transaksi as $p){
							?>
							<tr>
								<td><?php echo date('d/m/Y',strtotime($p->tgl_pencatatan)); ?></td>
								<td><?php echo date('d/m/Y',strtotime($p->tgl_pinjam)); ?></td>
								<td><?php echo date('d/m/Y',strtotime($p->tgl_kembali)); ?></td>
								<td><?php echo "Rp.".number_format($p->total_denda).",-"; ?></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
							<div class="text-right">
								<a href="<?php echo base_url().'admin/transaksi' ?>">lihat semua transaksi <i class="glyphicon glyphicon-arrow-right"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>