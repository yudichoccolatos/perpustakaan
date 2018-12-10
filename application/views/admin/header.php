<!DOCTYPE html>
<html>
<head>
	<title>Dashboard - aplikasi perpustakaan</title>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css' ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/datatable/datatables.css' ?>">
	<script type="text/javascript" src="<?php echo base_url().'assets/datatable/jquery.dataTables.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/datatable/datatables.js';?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js'; ?>"></script>
	<script type="text/javascript" src="<?php echo base_url().'assest/datatable/datatables.js'; ?>"></script>

</head>
<body>
	<nav class="navbar navbar-default">
		<div class="container">
			<!-- brand and toggle get ground for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-togglecollapsed" data-toggle="collapse" data-target="#b5-example-navbarcollapse-1" aria-expanded="false">
					<span class="sr-only">toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="<?php echo base_url().'admin'; ?>">perpustakaan</a>
			</div>
			<div class="collapse navbar-collapse" id="bs-examplenavbar-collapse-1">
				<ul class="nav navbar-nav">
					<li class="active"><a href="<?php echo base_url().'admin'; ?>"><span class="glyphicon glyphicon-home"></span> Dashboard <span class="sronly"></span></a></li>
					<li><a href="<?php echo base_url(). 'admin/buku'; ?>"><span class="glyphicon glyphicon-book"></span> data buku</a></li>
					<li><a href="<?php echo base_url().'admin/anggota'; ?>"><span class="glyphicon glyphicon-user"></span> data anggota</a></li>
					<li><a href="<?php echo base_url().'admin/peminjaman'; ?>"><span class="glyphicon glyphicon-sort"></span> transaksi peminjaman</a></li>
					<li><a href="<?php echo base_url().'admin/laporan'; ?>"><span class="glyphicon glyphicon-list-alt"></span> laporan</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="<?php echo base_url().'admin/logout'; ?>"><span class="glyphicon glyphicon-log-out"></span> logout</a></li>
					<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdwon" role="button" aria-haspopup="true" aria-expanded="false"><?php echo "halo, <b>".$this->session->userdata('nama'); ?></b><span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="<?php echo base_url().'admin/ganti_password' ?>"><i class="glypicon glypicon-lock"></i> ganti password</a></li>
                            <li><a href="<?php echo base_url().'admin/logout'; ?>"><i class="glyphicon-log-out"></i></a></li>						</ul>
                            </li></ul>
        </div>
    <!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
	<div class="container">