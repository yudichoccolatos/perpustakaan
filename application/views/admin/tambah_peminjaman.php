<div class="page-header">
<h3>Transaksi Baru</h3>
</div>
<form action="<?= base_url().'admin/transaksi_add_act'?>" method="post">
<div class="form-group">
    <label>Anggota</label>
    <select name="anggota" class="form-control">
    <option value="">-Pilih Anggota-</option>
        <?php foreach($anggota as $a){ ?>
        <option value="<?php echo $a->id_anggota; ?>"><?php echo $a->nama_anggota; ?></option>
        <?php } ?>
    </select>
    <?= form_error('anggota');?>
    </div>
    <div class="form-group">
    <label>Buku</label>
        <select name="buku" class="form-control">
    <option value="">-Pilih Buku-</option>
        <?php foreach($buku as $b){ ?>
        <option value="<?php echo $b->id_buku; ?>"><?php echo $b->judul_buku; ?></option>
        <?php } ?>
    </select>
        <?= form_error('buku');?>
    </div>
    <div class="form-group">
    <label>Tanggal Pinjam</label>
        <input type="date" name="tgl_pinjam" class="form-control">
        <?= form_error('tgl_pinjam');?>
    </div>
    <div class="form-group">
    <label>Tanggal Kembali</label>
        <input type="date" name="tgl_kembali" class="form-control">
        <?= form_error('tgl_kembali');?>
    </div>
    
    <div class="form-group">
    <label>Harga Denda / Hari</label>
        <input type="text" name="denda" class="form-control">
        <?= form_error('denda');?>
    </div>
    
    <div class="form-group">
        <input type="submit" value="Simpan" class="form-control">
    </div>
</form>