<?php

class C_Incident extends CI_Controller {
	var $data;

	public function __construct() {
		parent::__construct();
		$this -> data = array();
	}

	public function index() {
		$this -> listing();
	}

	public function addIncident() {
		
		$this -> load -> model('m_incident_types');
		$data['incident_types'] = $this -> m_incident_types -> getIncidentTypes();
		$this -> load -> model('m_counties');
		$data['counties'] = $this -> m_counties -> getCountyNames();
		$this -> load -> model('m_constituencies');
		$data['constituencies'] = $this -> m_constituencies -> getConstituenciesNames();
		$this -> load -> model('m_stations');
		$data['stations'] = $this -> m_stations -> getStationNames();
		$data['title'] = 'Add Incident';
		$data['contentView'] = 'add_incidence_v';
		$this -> load -> view('template', $data);
	}

	public function setIncident() {
		if ($_POST['incident_type'] != 0 || $_POST['county'] != 0 || $_POST['constituency'] != 0 || $_POST['station'] != 0 || $_POST[''] != "description") {
			$this -> load -> model('m_incident');
			$this -> m_incident -> setIncident();
		} else {
			redirect("c_front");
		}

	}

	public function updateIncident() {
		if ($_POST['incident_type'] != 0 || $_POST['county'] != 0 || $_POST['constituency'] != 0 || $_POST['station'] != 0 || $_POST[''] != "description") {
			$this -> load -> model('m_incident');
			$this -> m_incident -> updateIncident();
		} else {
			redirect("c_front");
		}
	}

	public function getIncident($id) {
		$this -> load -> model('m_incident_types');
		$data['incident_types'] = $this -> m_incident_types -> getIncidentTypes();

		$this -> load -> model('m_counties');
		$data['counties'] = $this -> m_counties -> getCountyNames();

		$this -> load -> model('m_constituencies');
		$data['constituencies'] = $this -> m_constituencies -> getConstituenciesNames();

		$this -> load -> model('m_stations');
		$data['stations'] = $this -> m_stations -> getStationNames();

		$sql = "SELECT * FROM security_summary ss, security_incidencies si WHERE ss.ss_id ='$id' AND si.security_incident_id = ss.ss_incident_id";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		if ($results) {
			$data['results'] = $results;
		}
		$data['title'] = 'View Incident';
		$data['contentView'] = 'view_incidence_v';
		$this -> load -> view('template', $data);
	}

	public function listing() {
		$results="";
        $sql="SELECT * FROM security_summary ss LEFT JOIN dim_security_incidence_type st ON ss.ss_incident_type=st.incidenceTypeID LEFT JOIN counties c ON c.county_id=ss.ss_county_id LEFT JOIN counties c1 ON c1.county_id=ss.ss_location_id LEFT JOIN constituencies cs ON ss.ss_constituency_id=cs.constituency_id LEFT JOIN stations s ON s.station_id=ss.ss_station_id GROUP BY ss.ss_id";
        $query = $this -> db -> query($sql);
		$results = $query -> result_array();
		if ($results) {
			$data['results'] = $results;
		}
		$data['summaries'] = $results;
	}

}
?>