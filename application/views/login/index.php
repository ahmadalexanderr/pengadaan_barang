  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">

      <div class="col-lg-7">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Pengadaan Barang</h1>
                  </div>
                  <!-- <div class="flash-data" data-flashdata="<?php echo ($this->session->flashdata('flash')); ?>" ></div> -->
                  <?php echo $this->session->flashdata('flash'); ?>
                  <form class="user" method="post" action="<?php echo base_url('auth/index'); ?>">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="username" name="username" aria-describedby="emailHelp" placeholder="Enter Username..." value="<?php echo set_value('username'); ?>" >
                      <?php echo form_error('username', '<small class="text-danger pl-3">','</small>') ?>
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password" value="<?php echo set_value('password'); ?>">
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
                    <button type="submit"  class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>
                  <hr>
                  <div class="text-center">
                    <a class="small" href="<?php echo base_url('auth/forgot')?>">Bantuan</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
