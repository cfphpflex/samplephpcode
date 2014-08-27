<?php
/**
 * CodeIgniter Controller example 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Somethingcontroller extends CI_Controller {
 
	 
	function index()
	   {
	      $this->load->model('GETMDEL'); 
	      $this->load->view('GETSOMEFILE.php', $this);
	      $this->load->view('GETSOMEVIEWFILE', $this);		
		
	  }
	
       public function getSomethingdata()
	 {
	      $this->load->model('GETMODEL'); 
	      //$this->load->view('SOMEFILE.php', $this);
	      $this->load->view('GETSOMEVIEWFILE', $this);
	}
	
   


}

 
 
