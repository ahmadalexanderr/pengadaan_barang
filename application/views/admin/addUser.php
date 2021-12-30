 <!-- Modal Add User -->
<div class="modal fade" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">User Management</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
<div class="card">
  <div class="card-header">
  Tambah User
  </div>
  <div class="card-body">
 <form method="post" action="<?php base_url('admin/userManagement'); ?>">
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan username" value="<?php echo set_value("username"); ?>">
    <?php echo form_error('username', '<small class="text-danger pl-3">','</small>') ?>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" id="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
    <?php echo form_error('password', '<small class="text-danger pl-3">','</small>') ?>
  </div>
    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck" onclick="showPass()">
                        <label class="custom-control-label" for="customCheck">Show Password</label>
                        <script>
                          function showPass() {
                            var x = document.getElementById("password");
                            if(x.type === "password") {
                              x.type = "text";
                            } else {
                              x.type = "password";
                            }
                          }
                        </script>
                      </div>
                    </div>
 <div class="form-group">
  <label for="exampleInputPassword1">Level Akses</label>
  <?php
        $style = 'class="form-control input-sm"';
        $value = set_value("level");
        echo form_dropdown('level', $level_user, $value, $style, '', 'required="required"');
   ?>
     <?php echo form_error('level', '<small class="text-danger pl-3">','</small>') ?>
    </div>
  </div>
</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <center><button type="submit" class="btn btn-primary">Tambah User</button></center>
          </form>
        </div>
      </div>
    </div>
  </div>
