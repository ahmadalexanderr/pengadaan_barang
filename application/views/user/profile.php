<div class="card">
  <div class="card-header">
    Ubah Password
  </div>
  <div class="card-body">
  <?php if ($this->session->userdata('level') == 'admin') { ?>
    <?php echo form_open('admin/profile'); ?>
  <?php } elseif ($this->session->userdata('level') == 'subag'){ ?>
  <?php echo form_open('subag/profile'); ?>
  <?php } else { ?>
  <?php echo form_open('user/profile'); ?> 
  <?php } ?>
    <?php echo $this->session->flashdata('message'); ?>
  <div class="form-group">
    <label for="current_password">Username</label>
  <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" value="<?php echo $record['username']; ?>" readonly>
  </div>
  <div class="form-group">
    <label for="current_password">Password Baru</label>
    <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Password Lama">
    <?php echo form_error('current_password', '<small class="text-danger pl-3">','</small>') ?>
  </div>
  <div class="form-group">
    <label for="new_password">Password Baru</label>
    <input type="password" class="form-control" id="new_password1" name="new_password1" placeholder="Password Baru">
    <?php echo form_error('new_password1', '<small class="text-danger pl-3">','</small>') ?>
  </div>
  <div class="form-group">
    <label for="new_password2">Konfirmasi Password Baru</label>
    <input type="password" class="form-control" id="new_password2" name="new_password2" placeholder="Ulangi Password Baru">
   <?php echo form_error('new_password2', '<small class="text-danger pl-3">','</small>') ?>
  </div>
  <center>
  <button id="submit" type="submit" class="btn btn-primary">Submit</button>
  </center>
</form>
  </div>
</div>