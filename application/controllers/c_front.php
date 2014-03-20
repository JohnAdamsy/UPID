<?php

class C_Front extends CI_Controller {
	var $data;

	public function __construct() {
		parent::__construct();
		$this -> data = array();
	}

	public function index() {
		$data = $this -> get_dashboard("poverty");
		$data['contentView'] = "index";
		$data['title'] = 'UPID Dashboard';
		$this -> base_params($data);
	}

	public function get_dashboard($alert_category = "poverty") {
		$data['graphTitle'] = $alert_category . ' trends';
		$data['reports'] = $alert_category . ' reports';

		//reports
		$report_columns = array("#", "Report Name", "Modified");
		$sql = "SELECT * 
		        FROM filed_reports f
		        LEFT JOIN alert_category ac ON ac.alertCategoryID=f.category
		        WHERE ac.categoryName LIKE '%$alert_category%'";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$data['filed_reports'] = $this -> generate_table($report_columns, $results);

		//resources
		$resource_columns = array("#", "Resource Name", "Total");
		$sql = "SELECT rt.resourceTypeName, SUM(rm.resourceCount) AS total
		        FROM resource_type rt
		        LEFT JOIN resources r ON rt.resourceTypeID=r.resourceType
		        LEFT JOIN resource_map rm ON rm.resourceId=r.resourceId
		        LEFT JOIN alert_category ac ON ac.alertCategoryID=rt.category
		        WHERE ac.categoryName LIKE '%$alert_category%'
		        GROUP BY rt.resourceTypeID";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$data['resource_reports'] = $this -> generate_table($resource_columns, $results);

		//alerts
		$alerts_columns = array("#", "Alert", "Zone", "Time", "Content");

		$sql = "SELECT at.alertCategoryID,uc.countryName,ua.alertDateTime,ua.alertContent 
		        FROM upid_alert ua 
		        LEFT JOIN alert_type at ON at.alertTypeID=ua.alertTypeID
		        LEFT JOIN alert_category ac ON ac.alertCategoryID=at.alertCategoryID
		        LEFT JOIN alert_location al ON al.locationID=ua.alertLocation
		        LEFT JOIN upid_country uc ON uc.upidCountryID=al.countryID
		        WHERE ac.categoryName LIKE '%$alert_category%'
		        GROUP BY ua.alertID
		        ORDER BY ua.alertID desc";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$data['summaries'] = $this -> generate_table($alerts_columns, $results);

		return $data;

		/*
		 $data['summaries'] = "";
		 $data['filed_reports'] = "";
		 $data['resource_reports'] = "";
		 //$data['summaries'] = $this -> alerts_listing();
		 //$data['filed_reports'] = $this -> report_listing();
		 //$data['resource_reports'] = $this -> resource_listing();

		 //Make Chart
		 $columns = array('2009', '2010', '2011', '2012', '2013');
		 //$sql = "SELECT incident_type_name AS Name, YEAR(ss_time_id) AS ssTime, COUNT(*) AS total FROM  `security_summary` ss,  `security_incident_types` si WHERE si.incident_type_id = ss.ss_incident_type GROUP BY si.incident_type_id";
		 //$query = $this -> db -> query($sql);
		 //$results = $query -> result_array();
		 $series = array();
		 $total_series = array();
		 $results = array();
		 $seriesData = array();
		 $value = 0;
		 //echo "<pre>";print_r($results);echo "</pre>";die;
		 if ($results) {
		 foreach ($results as $result) {
		 $occurence[$result['ssTime']][$result['Name']] = $result['total'];
		 $dataSource[] = array("name" => $result['Name'], "ssTime" => (int)$result['ssTime'], "total" => (int)$result['total']);
		 $series[] = array("valueField" => $result['Name'], "name" => $result['Name']);
		 }

		 foreach ($occurence as $key => $value) {
		 $seriesData["ssTime"] = $key;
		 foreach ($value as $k => $val) {
		 $seriesData[$k] = (int)$val;
		 }
		 }
		 }
		 //die ;
		 $finalData[] = $seriesData;
		 $finalData = json_encode($finalData);
		 $resultArraySize = 10;
		 $data['resultArraySize'] = $resultArraySize;
		 $data['container'] = 'chart_expiry';
		 $data['chartType'] = 'chart_v';
		 $data['chartTitle'] = "Crime Trends";
		 $data['categories'] = json_encode($columns);
		 $data['yAxis'] = 'Total';
		 $data['dataSource'] = $finalData;
		 $data['series'] = json_encode($series);*/
	}

	public function generate_table($columns, $data = array()) {
		$this -> load -> library('table');
		$tmpl = array('table_open' => '<table class="dataTables table table-bordered table-hover">');
		$this -> table -> set_template($tmpl);
		$this -> table -> set_heading($columns);
		foreach ($data as $mydata) {
			$this -> table -> add_row($mydata);
		}
		return $this -> table -> generate();
	}

	public function base_params($data = array()) {
		$this -> load -> view('template', $data);
	}

	public function alerts_listing() {
		$dyn_table = "";
		$sql = "SELECT * FROM security_summary ss LEFT JOIN security_incident_types st ON ss.ss_incident_type=st.incident_type_id LEFT JOIN counties c ON c.county_id=ss.ss_county_id LEFT JOIN counties c1 ON c1.county_id=ss.ss_location_id LEFT JOIN constituencies cs ON ss.ss_constituency_id=cs.constituency_id LEFT JOIN stations s ON s.station_id=ss.ss_station_id LEFT JOIN security_incidencies si ON si.security_incident_id=ss.ss_incident_id GROUP BY ss.ss_id";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$dyn_table .= "<table class='table table-bordered table-hover' style='font-size:11px;'>
		<thead>
		<tr><th>Alert</th><th>Zone</th><th>Time</th><th>Content</th></tr>
		</thead>
		<tbody>";
		if ($results) {
			foreach ($results as $result) {
				$dyn_table .= "<tr><td nowrap='nowrap'>" . $result['incident_type_name'] . "</td><td>" . $result['constituency_name'] . "</td><td nowrap='nowrap'>" . date('d-M-Y', strtotime($result['ss_time_id'])) . "</td><td><a href='" . base_url() . 'c_incident/getIncident/' . $result['ss_id'] . "'>" . $result['security_incident_description'] . "</a></td></tr>";
			}
		} else {
			$dyn_table .= "";
		}
		$dyn_table .= "</tbody></table>";
		return $dyn_table;
	}

	public function report_listing() {
		$dyn_table = "";
		$sql = "SELECT * FROM filed_reports";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$dyn_table .= "<table class='table table-bordered table-hover' style='font-size:11px;'><thead style='background:#DDD;'><tr><th>Report Name</th><th>Modified</th><th colspan='2'>Options</th></tr></thead><tbody>";
		if ($results) {
			foreach ($results as $result) {
				if ($result['active'] == 1) {
					$options = "<a href='" . base_url() . "c_reports/disable/" . $result['reportID'] . "' class='red'>Disable</a>";
				} else {
					$options = "<a href='" . base_url() . "c_reports/enable/" . $result['reportID'] . "' class='green'>Enable</a>";
				}

				$dyn_table .= "<tr><td><a href='" . base_url() . "reports/" . $result['reportUrl'] . "'>" . strtoupper($result['reportTitle']) . "</a></td><td>" . date('d-M-Y', strtotime($result['dateModified'])) . "</td><td><a href='" . base_url() . "c_reports/getReport/" . $result['reportID'] . "'>Details</a></td><td>$options</td></tr>";
			}
		} else {
			$dyn_table .= "";
		}
		$dyn_table .= "</tbody></table>";
		echo $dyn_table;
	}

	public function resource_listing() {
		$dyn_table = "";
		$sql = "SELECT r.resourceName, SUM( rm.resourceCount ) AS total, rm.dateCreated FROM  `resource_map` rm,  `resources` r WHERE r.resourceId = rm.resourceId GROUP BY r.resourceId";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$dyn_table .= "<table class='table table-bordered table-hover' style='font-size:11px;'><thead style='background:#DDD;'><tr><th>Resource Name</th><th>Status</th><th colspan='2'>Total</th></tr></thead><tbody>";
		if ($results) {
			foreach ($results as $result) {
				if ($result['total'] >= 50) {
					$options = "<span class='green'><b>H</b></span>";
				} else {
					$options = "<span class='red'><b>L</b></span>";
				}

				$dyn_table .= "<tr><td>" . $result['resourceName'] . "</td><td>" . $options . "</td><td>" . $result['total'] . "</td></tr>";
			}
		} else {
			$dyn_table .= "";
		}
		$dyn_table .= "</tbody></table>";
		return $dyn_table;

	}

	public function getChart() {
		$columns = array('2009', '2010', '2011', '2012', '2013');
		$sql = "SELECT incident_type_name AS Name, YEAR(ss_time_id) AS ssTime, COUNT(*) AS total FROM  `security_summary` ss,  `security_incident_types` si WHERE si.incident_type_id = ss.ss_incident_type GROUP BY si.incident_type_id";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$series = array();
		$total_series = array();
		$value = 0;
		if ($results) {
			foreach ($results as $result) {
				$column = $result['ssTime'];
				$value = $result['total'];
				foreach ($columns as $year) {
					if ($column == $year) {
						$table_data[] = (double)$value;
					} else {
						$table_data[] = 0;
					}
				}
				$series = array('name' => $result['Name'], 'data' => $table_data);
				$total_series[] = $series;
				unset($table_data);
			}
			$results = json_encode($total_series);
			$resultArraySize = 10;
			$data['resultArraySize'] = $resultArraySize;
			$data['container'] = 'chart_expiry';
			$data['chartType'] = 'chart_v';
			$data['title'] = 'UPID Dashboard';
			$data['chartTitle'] = "Crime Trends";
			$data['categories'] = json_encode($columns);
			$data['yAxis'] = 'Total';
			$data['resultArray'] = $results;
			return $data;
		}
	}

}
?>
