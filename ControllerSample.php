<?php
/**
 * CodeIgniter
 Controller example 
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Somethingcontroller extends CI_Controller {
 
	 
	function index()
	   {
	      $this->load->model('host'); 
	      $this->load->view('HeaderNav.php', $this);
		  $this->load->view('getSomethingview', $this);		
		
		}
	
	 public function getSomethingdata()
		{
			$this->load->model('host'); 
		    //$this->load->view('HeaderNav.php', $this);
			$this->load->view('getSomethingdata', $this);
		}
	
   


}

 
 