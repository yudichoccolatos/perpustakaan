<div class="page-header">
	<h3>ganti password</h3>
</div>
<div class="row">
	<div class="col-md-6 col-md-offset-3">
		<?php
		if(isset($GET['pesan'])){
			if($GET['pesan'] == "berhasi"){
				echo "<div class='alert alert-success'>password berhasil di ganti.</div>";
			}
		}
		?>
		<form action="<?php echo base_url(). 'admin/ganti_password_act' ?>" method="post">
			<div class="form-group">
				<label>password baru</label>
				<input class="form_control" type="password" name="ulang_pass">
				<?php echo form_error('pass_baru'); ?>
			</div>
			<div class="form-group">
				<input class="btn btn-primary btn-sm" type="submit" value="simpan">
			</div>
		</form>
	</div>
</div>