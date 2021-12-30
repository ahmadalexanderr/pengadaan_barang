 <?php if ($this->session->userdata('level') == 'admin') { ?>
    <form method="post" action="<?php echo base_url('admin/pengajuan/'.$record['id']); ?>">
    <?php } elseif ($this->session->userdata('level') == 'user') { ?>
    <form method="post" action="<?php echo base_url('user/pengajuan/'.$record['id']); ?>">
      <?php } else { ?>
        <form method="post" action="<?php echo base_url('subag/daftarBarang/'.$record['id']); ?>">
      <?php } ?>
 <div class="form-group col-md">
  <textarea rows="5" cols="10" style="width:90%" class="form-control" id="alasan" name="Alasan" value="<?php echo $record['id']; ?>" readonly><?php echo $record['alasan']; ?></textarea>
  </div>
  <div class="form-group col-md">
    <center>
    <button type="submit" id="edit" class="btn btn-primary" value="Insert">Saya Mengerti</button>
    </center>
   </div>
  </form>
