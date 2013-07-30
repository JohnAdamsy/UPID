<?php

class C_Resource extends CI_Controller {
	var $data;

	public function __construct() {
		parent::__construct();
		$this -> data = array();
	}

	public function index() {

	}

	public function addResource() {
		$sql = "select * from resources";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$data['resources'] = $results;
		$this -> load -> model('m_constituencies');
		$data['constituencies'] = $this -> m_constituencies -> getConstituenciesNames();
		$data['title'] = 'Add Resource';
		$data['contentView'] = 'add_resource_v';
		$this -> load -> view('template', $data);
	}

	public function setResource() {
		$this -> load -> model('m_resource');
		$this -> m_resource -> setResource();
		$this -> session -> set_userdata("msg_success","Resource Map was uploaded successfully");
		redirect("c_resource/addResource");
	}

	public function updateResource($id) {
		$title = $this -> input -> post("report_title");
		$modified = date('Y-m-d');
		$url = $this -> input -> post("last_url");
		$this -> session -> set_userdata("msg_success", "Report No:<b> " . $title . "</b> was uploaded successfully");
		if ($_FILES['file']['tmp_name']) {
			$config['upload_path'] = '././reports/';
			$config['allowed_types'] = 'pdf';
			$config['max_size'] = '1000000000';
			$this -> upload -> initialize($config);
			if ($this -> upload -> do_upload('file')) {
				$data = $this -> upload -> data();
				$last_file = $data['file_path'] . $url;
				unlink($last_file);
				$url = $data['file_name'];
			} else {
				$this -> session -> set_userdata("msg_error", $this -> upload -> display_errors());
			}
		}
		$sql = "update filed_reports fr set fr.reportTitle='$title',fr.dateModified='$modified',fr.reportUrl='$url' WHERE fr.reportID ='$id'";
		$query = $this -> db -> query($sql);
		redirect("c_reports/getReport/" . $id);
	}

	public function getResource($id) {
		$sql = "SELECT * FROM filed_reports fr WHERE fr.reportID ='$id'";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		if ($results) {
			$data['results'] = $results;
		}
		$data['title'] = 'View Report';
		$data['contentView'] = 'view_report_v';
		$this -> load -> view('template', $data);
	}

	public function enable($id) {
		$sql = "update filed_reports fr set fr.active='1' WHERE fr.reportID ='$id'";
		$query = $this -> db -> query($sql);
		redirect("c_front");
	}

	public function disable($id) {
		$sql = "update filed_reports fr set fr.active='0' WHERE fr.reportID ='$id'";
		$query = $this -> db -> query($sql);
		redirect("c_front");
	}

}
?>