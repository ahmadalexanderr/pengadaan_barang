<div class="card">
  <div class="card-header">
    Tampilkan Kategori
  </div>
  <div class="card-body">
    <form method="post" action="<?php echo base_url('admin/editJenis/'.$record['id_jenis_barang']);?>">
<div class="form-group col-md">
<label>Jenis Barang</label>
<input type="text" class="form-control" id="nama_jenis_barang" name="nama_jenis_barang" value="<?php echo $record['nama_jenis_barang'];?>" readonly>
<?php echo form_error('nama_jenis_barang', '<small class="text-danger pl-3">','</small>') ?>
</div>
<div class="form-group col-md">
<label>Perizinan</label>
 <?php 
        $style = 'class="form-control input-sm"';
        $value = $record['izin_jenis_barang'];
        echo form_dropdown('izin_jenis_barang', $izin_jenis_barang, $value, $style, '', 'required="required"'); 
    ?>
</div>
<div class="card-body">
<center>
<button type="submit" class="btn btn-primary" id="edit" value="Insert">Submit</button>
</center>
</form>
  </div>
</div>