  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <div class="card">
  <div class="card-header">
    Pengajuan Barang
  </div>
  <div class="card-body">
    <?php if ($this->session->userdata('level') == 'admin') { ?>
    <form method="post" action="<?php echo base_url('admin/editBarang/'.$record['id']); ?>">
    <?php } else { ?>
    <form method="post" action="<?php echo base_url('subag/accBarang/'.$record['id']); ?>">
      <?php } ?>
    <?php echo $this->session->flashdata('message'); ?>
    <div class="form-group col-md">
    <label>Pengaju</label>
    <input readonly type="text" class="form-control" id="username" name="username" value="<?php echo $record['username']; ?>">
    <?php echo form_error('nama_barang', '<small class="text-danger pl-3">','</small>') ?>
  </div>
  <div class="form-group col-md">
      <label>Jenis</label>
   <div class="form-group control">
   <select readonly class="form-control" name="id_jenis_barang" id="id_jenis_barang" required>
    <?php foreach($approved_jenis_barang as $row):?>
    <option value="<?php echo $row['id_jenis_barang'];?>" <?php if($record['id_jenis_barang'] == $row['id_jenis_barang']) { echo 'selected';}?>><?php echo $row['nama_jenis_barang'];?></option>
    <?php endforeach;?>
    </select>
  </div>
    </div>
  <div class="form-group col-md">
    <label>Barang</label>
    <input readonly type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $record['nama_barang']; ?>">
    <?php echo form_error('nama_barang', '<small class="text-danger pl-3">','</small>') ?>
  </div>
  <div class="form-group col-md">
    <label>Jumlah</label>
    <input readonly type="text" class="form-control" id="jumlah_barang" name="jumlah_barang"value="<?php echo $record['jumlah_barang']; ?>">
    <?php echo form_error('jumlah_barang', '<small class="text-danger pl-3">','</small>') ?>
  </div>
    <div class="form-group col-md">
      <label>Satuan</label>
      <input readonly type="text" class="form-control" id="satuan" name="satuan" value="<?php echo $record['satuan']; ?>">
      <?php echo form_error('satuan', '<small class="text-danger pl-3">','</small>') ?>
    </div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
$(function(){
	$('select[name=id_status_submisi]').on('change',function(){
		$.ajax({
      url: "<?php echo site_url('Status_terima/getStatusTerima?id_status_submisi='); ?>"+$(this).val(),
            type: "GET",
         }).done(function(data) {
            $('select[name=id_status_terima]').html(data);
         }).fail(function() {

         }).always(function() {

        });
	});
});
</script>
 <div class="form-group col-md">
 <label>Status Submisi</label>
    <!-- <?php $value = $record['nama_status_submisi'] ?> -->
    <?php echo form_dropdown('id_status_submisi', $dropdownItems, $value, 'class="form-control"');?>
  </div>
  <div class="form-group col-md">
  <?php
  $data = array(
        'name'        => 'alasan',
        'id'          => 'alasan',
        'value'       => set_value('alasan'),
        'rows'        => '5',
        'cols'        => '10',
        'style'       => 'width:100%',
        'class'       => 'form-control',
        'placeholder' => 'laporan (opsional)'
    );

    echo form_textarea($data);
  ?>
  </div>
 <div class="form-group col-md" style=visibility:hidden>
 <label>Status Penerimaan Barang</label>
    <?php $value = $record['id_status_terima']; ?>
    <?php echo form_dropdown('id_status_terima', [], $value, 'class="form-control"'); ?>
  </div>
  </div>
  <div class="form-group col-md">
    <center>
    <button type="submit" id="edit" class="btn btn-primary" value="Insert">ACC</button>
    </center>
   </div>
</form>
