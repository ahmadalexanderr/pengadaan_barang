<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Jenis</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Satuan</th>
      <th scope="col">Status</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php $i = 1; ?>
  <?php foreach ($submit_barang as $sb) { ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $sb['nama_barang']; ?></td>
      <td><?php echo $sb['jenis_barang']; ?></td>
      <td><?php echo $sb['jumlah_barang']; ?></td>
      <td><?php echo $sb['satuan']; ?></td>
      <td><?php echo $sb['status_submisi']; ?></td>
      <td><a href="">Update Status</a>
            <br/>
      <?php if ($this->session->userdata('level') === 'admin') { ?>
          <a href="">Hapus</a>
      <?php } ?>
      </td>
    </tr>
    <?php $i++; ?>
  <?php } ?>
  </tbody>
</table>
<br>
<div class="float-right">
  <div class="form-group col-md">
    <center>
    <button type="submit" class="btn btn-primary" value="Insert">Update status</button>
    </center>
  </div>
</div>