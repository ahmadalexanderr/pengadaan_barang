<!-- Tambah Barang Modal-->
  <div class="modal fade" id="tambahBarang" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Pengajuan Barang</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="card">
  <div class="card-header">
  <div class="alert alert-warning" role="alert">
<center>Konten bernuansa vulgar, pornografi, dan SARA akan dihapus</center>
  </div>
  </div>
  <div class="card-body">
        <?php if ($this->session->userdata('level') == 'admin') { ?>
    <form method="post" action="<?php echo base_url('admin/daftarBarang'); ?>">
    <?php } else { ?>
    <form method="post" action="<?php echo base_url('user/daftarBarang'); ?>">
      <?php } ?>
    <?php echo $this->session->flashdata('message'); ?>
  <div class="form-group col-md">
      <label>Kategori</label>
   <div class="form-group control">
   <select class="form-control" name="id_jenis_barang" id="id_jenis_barang" required>
    <?php foreach($approved_jenis_barang as $row):?>
    <option value="<?php echo $row['id_jenis_barang'];?>"><?php echo $row['nama_jenis_barang'];?></option>
    <?php endforeach;?>
    </select>
  </div> 
    </div>
  <div class="form-group col-md">
    <label>Barang</label>
    <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo set_value("nama_barang"); ?>" placeholder="Silahkan isi barang yang anda butuhkan...">
    <?php echo form_error('nama_barang', '<small class="text-danger pl-3">','</small>') ?>
  </div>
  <div class="form-group col-md">
    <label>Jumlah</label>
    <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" value="<?php echo set_value("jumlah_barang"); ?>" placeholder="Silahkan isi jumlah...">
    <?php echo form_error('jumlah_barang', '<small class="text-danger pl-3">','</small>') ?>
  </div>
    <div class="form-group col-md">
      <label>Satuan</label>
      <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo set_value("satuan"); ?>" placeholder="Silahkan isi satuan...">
      <?php echo form_error('satuan', '<small class="text-danger pl-3">','</small>') ?>
    </div>
   <div class="form-group control" style="visibility:hidden;">
    <select class="form-control" name="id_status_submisi" id="id_status_submisi" required readonly>
    <?php foreach($status_submisi_pending as $row):?>
    <option value="<?php echo $row['id_status_submisi'];?>"><?php echo $row['nama_status_submisi'];?></option>
    <?php endforeach;?>
    </select>
    </div> 
  <div class="form-group control" style="visibility:hidden">
   <select class="form-control" name="id_status_terima" id="id_status_terima" required readonly>
    <?php foreach($status_terima_pending as $row):?>
    <option value="<?php echo $row['id_status_terima'];?>"><?php echo $row['nama_status_terima'];?></option>
    <?php endforeach;?>
    </select>
  </div> 
  <div class="form-group col-md">
    <center>
    <button type="submit" id="submit" class="btn btn-primary" value="Insert">Buat Pengajuan</button>
    </center>
  </div>
</form>
  </div>