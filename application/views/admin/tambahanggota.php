<div class="page-header">
<h3>Anggota Baru</h3>
</div>
<?= validation_errors('<p style="color:red;">','</p>');?>
<?php
if($this->session->flashdata()){
    echo "<div class='alert alert-danger alert-message'>";
    echo $this->session->flashdata('alert');
    echo "</div>";
}
?>
<form action="<?= base_url().'admin/anggota_add_act'?>" method="post" enctype='multipart/form-data'>

    <div class="form-group">
    <label>Nama Anggota</label>
        <input type="text" name="nama_anggota" class="form-control">
        <?= form_error('nama_anggota');?>
    </div>
    <div class="form-group">
    <label>Jenis Kelamin</label>
        <select name="gender" class="form-control">
        <option value="laki-laki">laki-laki</option>
        <option value="perempuan">perempuan</option>
            </select>
    </div>
    <div class="form-group">
    <label>Nomor Telpon</label>
        <input type="text" name="no_telp" class="form-control">
    </div>
    <div class="form-group">
    <label>Alamat</label>
        <input type="text" name="alamat" class="form-control">
    </div>
    <div class="form-group">
    <label>email</label>
        <input type="text" name="emali" class="form-control">
    </div>
    <div class="form-group">
    <label>Password</label>
        <input type="text" name="password" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" value="Simpan" class="form-control">
    </div>
</form>