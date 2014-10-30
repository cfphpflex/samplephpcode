<?php
/**
 *Controller file in CodeIgniter
 * in MVC pattern, wrote this to provide
 * 1. default index function that would load by default if not calling the second function
 * 2. second function has to be called by name in order to load it
 * both show call to model, view
 * 
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

 
 
