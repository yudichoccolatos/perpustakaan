<div class="page-header">
	<h3>Anggota</h3>
</div>
<a href="<?php echo base_url().'admin/anggota_add'; ?>" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-plus"></span>Anggota Baru</a>
<br/><br/>
<div class="table-responsive">
	<table class="table table-bordered table-striped table-hover" id="table-datatable">
		<thead>
			<tr>
				<th>No</th>
				<th>Anggota</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>Nomor Telpon</th>
				<th>Alamat</th>
				<th>Email</th>
                <th>Pilihan</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			foreach ($anggota as $an){
				?>
				<tr>
				<td><?php echo $no++; ?></td>
				<td><?php echo $an->id_anggota; ?></td>
				<td><?php echo $an->nama_anggota; ?></td>
                <td><?php echo $an->gender; ?></td>
                <td><?php echo $an->no_telp; ?></td>
                <td><?php echo $an->alamat; ?></td>
                <td><?php echo $an->email; ?></td>
                    <td nowrap="nowrap">
					<a class="btn btn-warning btn-xs" href="<?php echo base_url().'admin/hapus_anggota/'.$an->id_anggota; ?>"><span class="glyphicon glyphicon-remove"></span></a>
				</td>
			</tr>
			<?php } ?>
		</tbody>
	</table>
</div>