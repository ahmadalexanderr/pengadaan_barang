<div class="card">
  <div class="card-header">
   Edit User
  </div>
  <div class="card-body">
   <form method="post" action="<?php echo base_url('admin/editUser/'.$record['id']); ?>">
   <div class="form-group">
  <div class="form-group">
    <label for="current_password">Username</label>
  <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" value="<?php echo $record['username']; ?>" readonly>
  </div>
  <label for="exampleInputPassword1">Level Akses <?php echo $record['username']; ?></label> 
  <?php 
        $style = 'class="form-control input-sm"';
        $value = $record['level'];
        echo form_dropdown('level', $level_user, $value, $style, '', 'required="required"'); 
     ?>
     <?php echo form_error('level', '<small class="text-danger pl-3">','</small>') ?>
    </div>
    <center>
     <button id="edit" type="submit" class="btn btn-primary">Edit</button>
     </center>
    </form>
  </div>
</div>
</div>