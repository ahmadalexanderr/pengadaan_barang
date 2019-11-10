<div class="card">
  <div class="card-header">
   Reset User
  </div>
  <div class="card-body">
   <form method="post" action="<?php echo base_url('admin/resetUser/'.$record['id']); ?>">
   <div class="form-group">
  <div class="form-group">
    <label for="username">Username</label>
  <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" value="<?php echo $record['username']; ?>" readonly>
  </div>
  <div class="form-group">
    <label for="Reset Password">Reset Password</label>
  <input type="password" class="form-control" id="resetpassword1" name="resetpassword1" aria-describedby="emailHelp">
  <?php echo form_error('resetpassword1', '<small class="text-danger pl-3">','</small>') ?>
  </div>
  <div class="form-group">
    <label for="Confirm Reset Password">Ulangi Reset Password</label>
  <input type="password" class="form-control" id="resetpassword2" name="resetpassword2" aria-describedby="emailHelp">
  <?php echo form_error('resetpassword2', '<small class="text-danger pl-3">','</small>') ?>
  </div>
  <label for="exampleInputPassword1">Level Akses</label> 
  <?php 
        $style = 'class="form-control input-sm"';
        $value = $record['level'];
        echo form_dropdown('level', $level_user, $value, $style, '', 'required="required"'); 
     ?>
     <?php echo form_error('level', '<small class="text-danger pl-3">','</small>') ?>
    </div>
    <center>
     <button id="edit" type="submit" class="btn btn-primary">Reset</button>
     </center>
    </form>
  </div>
</div>
</div>