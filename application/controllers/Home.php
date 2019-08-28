<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'vendor/autoload.php';
use PhpOffice\PhpWord\PhpWord;
class Home extends CI_Controller {
   public function __construct()
   {
     parent::__construct();
     $this->load->model('Barang_model');
   }
   public function test(){
      try {
         $phpWord = new \PhpOffice\PhpWord\PhpWord();
         $section = $phpWord->addSection();
         $section->addText('Hello World');
         $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
          header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
          header("Content-Disposition: attachment; filename='myFile.docx'");
          $objWriter->save('php://output');
      } catch (Exception $e) {
         echo $e->getMessage();
   }
}

}