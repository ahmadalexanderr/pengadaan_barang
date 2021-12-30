<div class="card">
  <div class="card-header">
  Daftar Kategori
  <?php if ($this->session->userdata('level') == 'admin') { ?>
  <a href="<?php echo base_url('admin/accJenis'); ?>">Tampilan Kategori</a>
  <?php } else { ?>
  <a href="<?php echo base_url('subag/pengajuanKategori'); ?>">Tampilan Kategori</a>
  <?php } ?>
  <?php if ($this->session->userdata('level')==='admin') { ?>
   <a id="pengajuanKat" href="<?php echo base_url('admin/permintaanJenis'); ?>" data-toggle="modal" data-target="#ModalKat"><i class="fas fa-puzzle-piece"></i></a>
  <?php } else { ?>
    <a id="pengajuanKat" href="<?php echo base_url('subag/daftarKategori'); ?>" data-toggle="modal" data-target="#ModalKat"><i class="fas fa-puzzle-piece"></i></a>
  <?php } ?>
  </div>
  <div class="card-body">
    <table class="table table-hover">
  <thead>
  <?php echo $this->session->flashdata('message'); ?>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Kategori</th>
      <th scope="col">Waktu Pengajuan</th>
      <th scope="col">Status</th>
      <th scope="col">Jumlah Barang Ter-ACC</th>
      <?php if ($this->session->userdata('level') == 'admin') { ?>
      <th scope="col">Aksi</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
  <?php $i = 1; ?>
  <?php foreach ($jenis_barang as $jb) { ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $jb['nama_jenis_barang']; ?></td>
      <td><?php echo $jb['date_jenis_barang']; ?></td>
      <td><?php echo $jb['izin_jenis_barang']; ?></td>
      <td><?php echo $jb['total']; ?></td>
      <?php if ($this->session->userdata('level') == 'admin') { ?>
      <td><a href="<?php echo site_url('admin/hapusJenis/'.$jb['id_jenis_barang']);?>">Hapus</a></td>
      <?php } ?>
    </tr>
    <?php $i++; ?>
  <?php } ?>
  </tbody>
</table>
<br>
<div class="float-right">
</div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ModalKat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
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
 <?php if ($this->session->userdata("level")=='admin') { ?>
    <form method="POST" action="<?php echo base_url('admin/permintaanJenis'); ?>">
    <?php } else { ?>
      <form method="POST" action="<?php echo base_url('subag/daftarKategori'); ?>">
    <?php } ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Kategori</label>
    <input type="text" class="form-control" id="nama_jenis_barang" name="nama_jenis_barang" aria-describedby="emailHelp" value="<?php echo set_value("nama_jenis_barang"); ?>" placeholder="Masukan jenis barang">
    <?php echo form_error('nama_jenis_barang', '<small class="text-danger pl-3">','</small>') ?>
  </div>
     <?php 
        $style = 'class="form-control input-sm" style="visibility:hidden"';
        echo form_dropdown('izin_jenis_barang', $izin_jenis_barang, 'pending', $style, '', 'required="required"'); 
    ?>
     <?php echo form_error('level', '<small class="text-danger pl-3">','</small>') ?>
  </div>
</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <center><button type="submit" class="btn btn-primary">Submit</button></center>
          </form>
        </div>
      </div>
    </div>
  </div>
<style>
#pengajuanKat {
  float: right;
}
</style>

