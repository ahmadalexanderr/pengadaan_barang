<div class="card">
  <div class="card-header">
  <!-- Nav Item - Tambah Barang -->
  Daftar barang yang saya ajukan
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
       <th scope="col">Waktu Pengajuan</th>
       <th scope="col">Status Permintaan</th>
       <th scope="col">Status Penerimaan</th>
       <?php if ($this->session->userdata('level')!= 'subag') { ?>
      <th scope="col">Konfirmasi Penerimaan Barang</th>
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
      <td><?php echo $sb['date_barang']; ?></td>
      <td><?php echo $sb['nama_status_submisi']; ?></td>
      <td><?php echo $sb['nama_status_terima']; ?></td>
        <?php if ($this->session->userdata('level') == 'admin' && $sb['nama_status_submisi'] == 'Permintaan diterima' && $sb['nama_status_terima'] == 'Belum diterima pengaju') { ?>
      <td><a href="<?php echo site_url('admin/konfirmasiBarang/'.$sb['id']);?>">Konfirmasi</a>
      <?php } elseif ($this->session->userdata('level')=='user' && $sb['nama_status_submisi'] == 'Permintaan diterima'  && $sb['nama_status_terima'] == 'Belum diterima pengaju'){ ?>
        <td><a href="<?php echo site_url('user/konfirmasiBarang/'.$sb['id']);?>">Konfirmasi</a>
      <?php } elseif ($sb['nama_status_submisi'] == 'Pending'){ ?>
        <td><div class="alert alert-warning" role="alert">
  Tunggu ACC
</div></td>
      <?php } elseif ($sb['nama_status_submisi'] == 'Permintaan ditolak'){  ?>
        <td><div class="alert alert-danger" role="alert">
  Maaf, pengajuan ditolak
</div></td>
      <?php } elseif ($sb['nama_status_terima'] == 'Diterima pengaju'){ ?>
        <td><div class="alert alert-success" role="alert">
  Terkonfirmasi
</div></td>
      <?php } ?>
      <?php if ($this->session->userdata('level') == 'admin' && $sb['nama_status_submisi'] != 'Pending') { ?>
      <td><a href="<?php echo site_url('admin/alasan_control/'.$sb['id']);?>">Lihat Laporan</a>
     <?php } elseif ($this->session->userdata('level') == 'user' && $sb['nama_status_submisi'] != 'Pending') { ?>
      <td><a href="<?php echo site_url('user/alasan_control/'.$sb['id']);?>">Lihat Laporan</a>
     <?php } ?>
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
