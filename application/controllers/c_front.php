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
		$report_columns = array("<h3>Report Name</h3>", "<h3>Modified</h3>");
		$sql = "SELECT *
		        FROM filed_reports f
		        LEFT JOIN alert_category ac ON ac.alertCategoryID=f.category
		        WHERE ac.categoryName LIKE '%$alert_category%'
		        ORDER BY f.reportID desc";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$data['filed_reports'] = $this -> generate_table($report_columns, $results, "reports");

		//resources
		$resource_columns = array("<h3>Resource Name</h3>", "<h3>Status</h3>", "<h3>Total</h3>");
		$sql = "SELECT rt.resourceTypeName, SUM(rm.resourceCount) AS total
		        FROM resource_type rt
		        LEFT JOIN resources r ON rt.resourceTypeID=r.resourceType
		        LEFT JOIN resource_map rm ON rm.resourceId=r.resourceId
		        LEFT JOIN alert_category ac ON ac.alertCategoryID=rt.category
		        WHERE ac.categoryName LIKE '%$alert_category%'
		        GROUP BY rt.resourceTypeID";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$data['resource_reports'] = $this -> generate_table($resource_columns, $results, "resources");

		//alerts
		$alerts_columns = array("<h3>Alert</h3>", "<h3>Zone</h3>", "<h3>Time</h3>", "<h3>Content</h3>");

		$sql = "SELECT *
		        FROM upid_alert ua 
		        LEFT JOIN alert_type at ON at.alertTypeID=ua.alertTypeID
		        LEFT JOIN alert_category ac ON ac.alertCategoryID=at.alertCategoryID
		        LEFT JOIN alert_location al ON al.locationID=ua.alertLocation
		        LEFT JOIN upid_country uc ON uc.upidCountryID=al.countryID
		        WHERE ac.categoryName LIKE '%$alert_category%'
		        GROUP BY ua.alertID
		        ORDER BY ua.alertDateTime desc";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();
		$data['summaries'] = $this -> generate_table($alerts_columns, $results, "alerts");

		//trend chart
		$current_year = date('Y');
		$from_year = date('Y', strtotime('-6 year'));
		$columns = range($from_year, $current_year);

		$sql = "SELECT at.alertTypeName AS Name, YEAR(ua.alertDateTime) AS ssTime, COUNT(*) AS total 
				FROM upid_alert ua 
		        LEFT JOIN alert_type at ON at.alertTypeID=ua.alertTypeID
		        LEFT JOIN alert_category ac ON ac.alertCategoryID=at.alertCategoryID
		        WHERE ac.categoryName LIKE '%$alert_category%'
		        GROUP BY ua.alertID";
		$query = $this -> db -> query($sql);
		$results = $query -> result_array();

		$occurence = array();
		$series = array();
		$total_series = array();
		$seriesData = array();
		$value = 0;

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
		$finalData[] = $seriesData;
		$finalData = json_encode($finalData);
		$resultArraySize = 10;
		$data['resultArraySize'] = $resultArraySize;
		$data['container'] = 'chart_expiry';
		$data['chartType'] = 'chart_v';
		$data['chartTitle'] = $alert_category . " Trends";
		$data['categories'] = json_encode($columns);
		$data['yAxis'] = 'Total';
		$data['dataSource'] = $finalData;
		$data['series'] = json_encode($series);

		return $data;
	}

	public function generate_table($columns, $data = array(), $report_type) {
		$this -> load -> library('table');
		$tmpl = array('table_open' => '<table class="dataTables table table-bordered table-hover table-condensed table-striped">');
		$this -> table -> set_template($tmpl);
		$this -> table -> set_heading($columns);

		foreach ($data as $mydata) {
			$temp_array = array();
			if ($report_type == "reports") {
				$temp_array[] = "<a href='reports/" . $mydata['reportUrl'] . "'>" . $mydata['reportTitle'] . "</a>";
				$temp_array[] = date('d/m/Y', strtotime($mydata['dateModified']));
			} else if ($report_type == "alerts") {
				$temp_array[] = $mydata['alertTypeName'];
				$temp_array[] = $mydata['countryName'];
				$temp_array[] = date('d/M/Y', strtotime($mydata['alertDateTime']));
				$temp_array[] = $mydata['alertContent'];
			} else if ($report_type == "resources") {
				if ($mydata['total'] >= 50) {
					$options = "<span class='green'><b>H</b></span>";
				} else {
					$options = "<span class='red'><b>L</b></span>";
				}
				$temp_array[] = $mydata['resourceTypeName'];
				$temp_array[] = $options;
				$temp_array[] = $mydata['total'];
			}
			$this -> table -> add_row($temp_array);
			unset($temp_array);
		}
		return $this -> table -> generate();
	}

	public function modal($type = "") {
		$content = "";
		$group_div = "<div class='control-group'>";
		$control_div = "<div class='controls'>";
		$close_div = "</div>";
		if ($type == "resource") {
			$inputs = array("resourceName" => "resourceName", "resourceType" => "resourceType", "ownership" => "ownership", "additionalInformation" => "additionalInformation", "resourceMap" => "resourceMap", "location" => "location", "resourceCount" => "resourceCount");
		} else if ($type == "alerts") {
			$inputs = array("alertTypeID" => "alertTypeID", "alertContent" => "alertContent", "alertLocation" => "alertLocation");
		} else if ($type == "reports") {
			$inputs = array("reportTitle" => "reportTitle", "reportUrl" => "reportUrl");
		}
		foreach ($inputs as $text => $input) {
			$content .= $group_div;
			$label = "<label class='control-label'>" . $text . "</label>";
			$content .= $label;
			$content .= $control_div;
			$textfield = "<input type='text' id='" . $type . "_" . $input . "' name='" . $input . "'/>";
			$content .= $textfield;
			$content .= $close_div;
			$content .= $close_div;
		}
		echo $content;
	}

	public function base_params($data = array()) {
		$this -> load -> view('template', $data);
	}

}
?>
