<div class="card">
  <div class="card-header">
    User Management
    <a href="<?php echo base_url('admin/addUser/'); ?>" data-toggle="modal" data-target="#addUserModal"><i class="fas fa-user-plus" id="addUser"></i></a>
  </div>
  <div class="card-body">
     <?php echo $this->session->flashdata('message'); ?>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Username</th>
       <th scope="col">Password</th>
      <th scope="col">Level</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
    <?php $i = 1; ?>
    <?php foreach($user as $u){ ?>
    <tr>
      <th scope="row"><?php echo $i; ?></th>
      <td><?php echo $u['username']; ?></td>
      <td><?php echo $u['password']; ?></td>
      <td><?php echo $u['level']; ?></td>
      <td><a href="<?php echo base_url('admin/editUser/'.$u['id']); ?>">Edit</a>
      <a href="<?php echo base_url('admin/hapusUser/'.$u['id']); ?>">Hapus</a>
    </td>
    </tr>
    <?php $i++; ?>
     <?php } ?>
  </tbody>
</table>
  </div>
</div>
<style>
#addUser {
  float: right;
i}
</style>