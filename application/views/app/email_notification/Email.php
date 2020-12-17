<?php defined('BASEPATH') OR exit('No direct script access allowed');


class email extends CI_Controller {
	function __construct()
	{
	parent:: __construct();
	}

 public function index(){
 	//Load email library
$this->load->library('email');
	
//$this->load->library('encrypt');
 
//SMTP & mail configuration
$config = array(
            'protocol' => 'smtp', 
            'smtp_host' => 'dotnor.no', 
            'smtp_port' => 25, 
            'smtp_user' => 'testemail@palam.tempdom.site', 
            'smtp_pass' => 'loW1c#30', 
            'mailtype' => 'html', 
            'charset' => 'iso-8859-1'
            
);
$this->email->initialize($config);
$this->email->set_mailtype("html");
$this->email->set_newline("\r\n");
 
//Email content
$htmlContent = '<h1>Sending email via Gmail SMTP server</h1>';
$htmlContent .= '<p>This email has sent via Gmail SMTP server from CodeIgniter application.</p>';
 
    
     $this->email->to('satyamkuril143@gmail.com');
    $this->email->from('testemail@palam.tempdom.site');
    $this->email->subject('How to send email via Gmail SMTP server in CodeIgniter');
    $this->email->message($htmlContent);

 
//Send email
if ($this->email->send()) {
    		echo 'Your Email has successfully been sent.';
    	} else {
    		show_error($this->email->print_debugger());
    	}
}
}

