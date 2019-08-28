<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function enums($table , $field){
    $ci = get_instance();
    $query = "SHOW COLUMNS FROM ".$table." LIKE '$field'";
    $row = $ci->db->query("SHOW COLUMNS FROM ".$table." LIKE '$field'")->row()->Type;  
    $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        foreach ($enum_fields as $key=>$value)
        {
            $enums[$value] = $value; 
        }
        return $enums;
}