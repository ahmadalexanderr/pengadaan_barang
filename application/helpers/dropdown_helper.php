<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
 
	
  function listData($table,$name,$value,$options=[]) {
      $items = array();
	  $ci = get_instance();
	  $defaultOptions = [];
	  $options = array_merge($defaultOptions,$options);

	  if(array_key_exists('where', $options)) {
		$ci->db->where($options['where']);
	  }

      $query = $ci->db->select("$name,$value")->from($table)->get();
      if ($query->num_rows() > 0) {
          foreach($query->result() as $data) {
              $items[$data->$name] = $data->$value;
          }
          $query->free_result();
          return $items;
      }
  }
 
/* End of file dropdwon_helper.php */
/* Location: ./application/helper/dropdown_helper.php */
