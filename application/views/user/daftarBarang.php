<div class="card">
  <div class="card-header">
  <!-- Nav Item - Tambah Barang -->
  Daftar ACC Barang
  <?php if ($this->session->userdata('level')!='subag') {
    if ($this->session->userdata('level') == 'admin') { ?>
      <a class="" href="<?php echo base_url('admin/submitBarang');?>" id="submitBarang" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#tambahBarang">
      <i class="fas fa-cart-plus"></i>
      </a>
      <?php } else { ?>
      <a class="" href="<?php echo base_url('user/daftarBarang');?>" id="submitBarang" role="button" aria-haspopup="true" aria-expanded="false" data-toggle="modal" data-target="#tambahBarang">
      <i class="fas fa-cart-plus"></i>
      </a> 
      <?php } ?>
     <?php } ?>
  </div>
  <?php echo $this->session->flashdata("message"); ?>
  <div class="card-body">
   <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Kode Pengajuan</th> 
      <th scope="col">Jenis</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Satuan</th>
      <th scope="col">Pengaju</th>
      <th scope="col">Waktu Pengajuan</th>
      <th scope="col">Status Permintaan</th>
      <th scope="col">Status Penerimaan</th>
      <!-- <th scope="col">Status Penerimaan</th> -->
      <th scope="col">ACC</th>
      <?php if ($this->session->userdata('level') != 'user'){ ?>
      <th scope="col">Laporan Pengajuan</th>
      <?php } ?>
    </tr>
  </thead>
  <tbody>
  <?php $i = 1; ?>
  <?php foreach ($submit_barang as $sb) { ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $sb['nama_barang']; ?></td>
      <td><?php echo $sb['id']; ?></td>
      <td><?php echo $sb['nama_jenis_barang']; ?></td>
      <td><?php echo $sb['jumlah_barang']; ?></td>
      <td><?php echo $sb['satuan']; ?></td>
      <td><?php echo $sb['username']; ?></td> 
      <td><?php echo $sb['date_barang']; ?></td>
      <td><?php echo $sb['nama_status_submisi']; ?></td>
      <td><?php echo $sb['nama_status_terima']; ?></td> 
        <?php if ($this->session->userdata('level') == 'admin' && $sb['nama_status_submisi'] == 'Pending') { ?>
      <td><a href="<?php echo site_url('admin/editBarang/'.$sb['id']);?>">ACC</a>
      <a href="<?php echo site_url('admin/deleteBarang/'.$sb['id']);?>">Hapus</a>
      <?php } elseif ($this->session->userdata('level')=='subag' && $sb['nama_status_submisi'] == 'Pending') { ?>
        <td><a href="<?php echo site_url('subag/accBarang/'.$sb['id']);?>">ACC</a>
      <a href="<?php echo site_url('subag/deleteBarang/'.$sb['id']);?>">Hapus</a>
      <?php } elseif ($sb['nama_status_submisi'] == 'Permintaan diterima') { ?>
       <td><div class="alert alert-success" role="alert">
        Sudah di-ACC
      </div></td>
     <?php } elseif ($sb['nama_status_submisi'] == 'Permintaan ditolak') { ?>
      <td><div class="alert alert-danger" role="alert">
        Sudah di-ACC
      </div></td> 
     <?php } ?>
      </td>
      <td><?php if ($this->session->userdata('level') == 'admin' && $sb['nama_status_submisi'] != 'Pending') { ?>
      <a href="<?php echo site_url('admin/all_alasan/'.$sb['id']);?>">Lihat Laporan</a>
     <?php } elseif ($this->session->userdata('level') == 'subag' && $sb['nama_status_submisi'] != 'Pending') {?> 
    <a href="<?php echo site_url('subag/alasan_control/'.$sb['id']);?>">Lihat Laporan</a>
     <?php } ?> 
     </td>
    </tr>
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
<style>
#submitBarang {
  float : right;
}
</style>