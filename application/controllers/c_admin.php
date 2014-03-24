<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
//homepage
class C_Admin extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this -> data = array();
	}
	
	public function index(){
		//default homepage views loaded
		$data['title'] = "UPID Administrator";
		// Capitalize the first letter
		$this -> load -> model('m_admin');
		$this -> load -> view('sections/head', $data);
		$data['alertcat'] = $this -> m_admin -> getalertcategory();
		$data['contentView']='admin/alertcategory';
		$this -> load -> view('admin/admintemplate', $data);
	}

//alert category
	public function alertcat() {
		//default homepage views loaded
		$data['title'] = "UPID Administrator";
		// Capitalize the first letter
		$this -> load -> model('m_admin');
		$this -> load -> view('sections/head', $data);
		$data['alertcat'] = $this -> m_admin -> getalertcategory();
		$data['contentView']='admin/alertcategory';
		$this -> load -> view('admin/admintemplate', $data);
	
	}
	public function edit($type,$id){
		$data['type']=$type;
		$data['title'] = "UPID Administrator";
		$this->load->model('m_admin');
		if($type=='alert'){
		$data['alertcat']=$this->m_admin->getalertcat($id);
		}
		if($type=='country'){
		$data['alertcat']=$this->m_admin->getcountry($id);
		}
		if($type=='location'){
		$data['alertcat']=$this->m_admin->getlocation($id);			
		$data['country']=$this->m_admin->getcountries();
		$data['mycountry']=$this->m_admin->getcountry($data['alertcat']['countryID']);
		}
		if($type=='alerttype'){
		$data['alertcat']=$this->m_admin->getalerttype($id);			
		$data['country']=$this->m_admin->getalertcategory();
		$data['mycountry']=$this->m_admin->getalertcat($data['alertcat']['alertCategoryID']);
		}
		if ($type=='resource') {
		$data['alertcat']=$this->m_admin->getresource($id);	
		}
		$data['contentView']='admin/edit';
		$this -> load -> view('admin/admintemplate', $data);
		
	}
	
   	public function updatealertcat($alertid){
		$this->load->model('m_admin');
	   	$this->m_admin->updatealertcategory($alertid);
		redirect(base_url().'c_admin/alertcat/');
		
	}
	public function addalertcat(){
		$this->load->model('m_admin');
	   	$this->m_admin->addalertcategory();
		redirect(base_url().'c_admin/alertcat');
		
	}
	public function deletealertcat($alertid){
		$this->load->model('m_admin');		
		$this->m_admin->deletealertcategory($alertid);
		redirect(base_url().'c_admin/alertcat/');
		
	}
	
	
	//country
	public function country() {
		//default homepage views loaded
		$data['title'] = "UPID Administrator";
		// Capitalize the first letter
		$this -> load -> model('m_admin');
		$this -> load -> view('sections/head', $data);
		$data['alertcat'] = $this -> m_admin -> getcountries();
		$data['contentView']='admin/country';
		$this -> load -> view('admin/admintemplate', $data);
	
	}

   	public function updatecountry($alertid){
		$this->load->model('m_admin');
	   	$this->m_admin->updatecountry($alertid);
		redirect(base_url().'c_admin/country/');
		
	}
	public function addcountry(){
		$this->load->model('m_admin');
	   	$this->m_admin->addcountry();
		redirect(base_url().'c_admin/country');
		
	}
	public function deletecountry($alertid){
		$this->load->model('m_admin');		
		$this->m_admin->deletecountry($alertid);
		redirect(base_url().'c_admin/country/');
		
	}
	
	
	//resources
	public function resource() {
		$data['title'] = "UPID Administrator";
		$this -> load -> model('m_admin');
		$this -> load -> view('sections/head', $data);
		$data['alertcat'] = $this -> m_admin -> getresources();
		$data['contentView']='admin/resource';
		$this -> load -> view('admin/admintemplate', $data);
	
	}

   	public function updateresource($alertid){
		$this->load->model('m_admin');
	   	$this->m_admin->updateresource($alertid);
		redirect(base_url().'c_admin/resource/');
		
	}
	public function addresource(){
		$this->load->model('m_admin');
	   	$this->m_admin->addresource();
		redirect(base_url().'c_admin/resource');
		
	}
	public function deleteresource($alertid){
		$this->load->model('m_admin');		
		$this->m_admin->deleteresource($alertid);
		redirect(base_url().'c_admin/resource/');
		
	}
	
	
	//location
	public function location() {
		//default homepage views loaded
		$data['title'] = "UPID Administrator";
		// Capitalize the first letter
		$this -> load -> model('m_admin');
		$this -> load -> view('sections/head', $data);
		$data['alertcat'] = $this -> m_admin -> getlocations();
		$data['country'] = $this -> m_admin -> getcountries();
		$data['contentView']='admin/location';
		$this -> load -> view('admin/admintemplate', $data);
	
	}

   	public function updatelocation($alertid){
		$this->load->model('m_admin');
	   	$this->m_admin->updatelocation($alertid);
		redirect(base_url().'c_admin/location/');
		
	}
	public function addlocation(){
		$this->load->model('m_admin');
	   	$this->m_admin->addlocation();
		redirect(base_url().'c_admin/location');
		
	}
	public function deletelocation($alertid){
		$this->load->model('m_admin');		
		$this->m_admin->deletelocation($alertid);
		redirect(base_url().'c_admin/location/');
		
	}
	
	
	
	//Alert Types
	public function alerttype() {
		$data['title'] = "UPID Administrator";
		$this -> load -> model('m_admin');
		$this -> load -> view('sections/head', $data);
		$data['alertcat'] = $this -> m_admin -> getalerttypes();
		$data['country'] = $this -> m_admin -> getalertcategory();
		$data['contentView']='admin/alerttype';
		$this -> load -> view('admin/admintemplate', $data);
	}

   	public function updatealerttype($alertid){
		$this->load->model('m_admin');
	   	$this->m_admin->updatealerttype($alertid);
		redirect(base_url().'c_admin/alerttype/');	
	}
	public function addalerttype(){
		$this->load->model('m_admin');
	   	$this->m_admin->addalerttype();
		redirect(base_url().'c_admin/alerttype');	
	}
	public function deletealerttype($alertid){
		$this->load->model('m_admin');		
		$this->m_admin->deletealerttype($alertid);
		redirect(base_url().'c_admin/alerttype/');	
	}
}
?>
