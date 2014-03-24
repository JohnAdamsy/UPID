<?php
class M_Admin extends CI_Model{
			
		
//Start Alert Category
	public function addalertcategory(){
		$this->categoryName=$this->input->post('alertcategory');
		$this->db->insert('alert_category',$this);
	}
	
 public function getalertcat($alertcatid)
	{
		$this->db->select('alertCategoryID, categoryName');
		$this->db->where('alertCategoryID', $alertcatid);
		$query = $this->db->get('alert_category');
		return $query->row_array();
	}
	
	public function getalertcategory(){
		$query=$this->db->query("SELECT * FROM alert_category order by alertCategoryID ASC");
	
		 return $query->result_array();
	}
	
	public function updatealertcategory($alertid)
	{
		$this->categoryName=$this->input->post('alertcategory');
		$this->db->where('alertCategoryID', $alertid);
		$this->db->update('alert_category', $this);
	}
	
	
	public function deletealertcategory($alertid)
	{
		
		$this->db->where('alertCategoryID', $alertid);
		$this->db->delete('alert_category', $this);
		
	}
	
	/* End Alert Category */
			
//Start upid_country
	public function addcountry(){
		$this->countryName=$this->input->post('country');
		$this->db->insert('upid_country',$this);
	}
	
 public function getcountry($alertcatid)
	{
		$this->db->select('upidCountryID, countryName');
		$this->db->where('upidCountryID', $alertcatid);
		$query = $this->db->get('upid_country');
		return $query->row_array();
	}
	
	public function getcountries(){
		$query=$this->db->query("SELECT * FROM upid_country order by upidCountryID ASC");
	
		 return $query->result_array();
	}
	
	public function updatecountry($alertid)
	{
		$this->countryName=$this->input->post('country');
		$this->db->where('upidCountryID', $alertid);
		$this->db->update('upid_country', $this);
	}
	
	
	public function deletecountry($alertid)
	{
		
		$this->db->where('upidCountryID', $alertid);
		$this->db->delete('upid_country', $this);
		
	}
//end upid_country


//Start resource_type
	public function addresource(){
		$this->resourceTypeName=$this->input->post('resource');
		$this->db->insert('resource_type',$this);
	}
	
 public function getresource($alertcatid)
	{
		$this->db->select('resourceTypeID, resourceTypeName');
		$this->db->where('resourceTypeID', $alertcatid);
		$query = $this->db->get('resource_type');
		return $query->row_array();
	}
	
	public function getresources(){
		$query=$this->db->query("SELECT * FROM resource_type order by resourceTypeID ASC");
	
		 return $query->result_array();
	}
	
	public function updateresource($alertid)
	{
		$this->resourceTypeName=$this->input->post('resource');
		$this->db->where('resourceTypeID', $alertid);
		$this->db->update('resource_type', $this);
	}
	
	
	public function deleteresource($alertid)
	{
		
		$this->db->where('resourceTypeID', $alertid);
		$this->db->delete('resource_type', $this);
		
	}
//end upid_country


//Start location
	public function addlocation(){
		$this->localityName=$this->input->post('location');
		$this->countryID=$this->input->post('country');
		$this->regionName=$this->input->post('region');
		$this->db->insert('alert_location',$this);
	}
	
 public function getlocation($alertcatid)
	{
		$this->db->select('locationID, regionName, localityName,countryID');
		$this->db->where('locationID', $alertcatid);
		$query = $this->db->get('alert_location');
		return $query->row_array();
	}
	
	public function getlocations(){
		$query=$this->db->query("SELECT * FROM alert_location,upid_country WHERE alert_location.countryID= upid_country.upidCountryID  order by locationID ASC");
	
		 return $query->result_array();
	}
	
	public function updatelocation($alertid)
	{
		$this->localityName=$this->input->post('location');
		$this->regionName=$this->input->post('region');
		$this->countryID=$this->input->post('country');
		$this->db->where('locationID', $alertid);
		$this->db->update('alert_location', $this);
	}
	
	
	public function deletelocation($alertid)
	{
		
		$this->db->where('locationID', $alertid);
		$this->db->delete('alert_location', $this);
		
	}
//end upid_location

	//Start alert type
	public function addalerttype(){
		$this->alertTypeName=$this->input->post('alerttype');
		$this->alertCategoryID=$this->input->post('alertcategory');
		$this->db->insert('alert_type',$this);
	}
	
 public function getalerttype($alertcatid)
	{
		$this->db->select('alertTypeID, alertTypeName,alertCategoryID');
		$this->db->where('alertTypeID', $alertcatid);
		$query = $this->db->get('alert_type');
		return $query->row_array();
	}
	
	public function getalerttypes(){
		$query=$this->db->query("SELECT * FROM alert_type,alert_category WHERE alert_type.alertCategoryID= alert_category.alertCategoryID  order by alertTypeID ASC");
	
		 return $query->result_array();
	}
	
	public function updatealerttype($alertid)
	{
		$this->alertTypeName=$this->input->post('alerttype');
		$this->alertCategoryID=$this->input->post('alertcategory');
		$this->db->where('alertTypeID', $alertid);
		$this->db->update('alert_type', $this);
	}
	
	
	public function deletealerttype($alertid)
	{
		
		$this->db->where('alertTypeID', $alertid);
		$this->db->delete('alert_type', $this);
		
	}
//end alert type
	
	
	}