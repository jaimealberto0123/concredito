<?PHP
	include_once("Controller.php");

	class Time{

		public function Time(){
			
		}

		public function get_date_today(){
			$controller = new Controller();
			$query = "
				SELECT
					DAY(NOW()) AS 'day',
					MONTH(NOW()) AS 'month',
					YEAR(NOW()) AS 'year',
					DATE(NOW()) AS 'today_date',
					NOW() AS 'today_datetime',
					DATE(DATE_ADD(NOW(), INTERVAL 1 DAY)) AS 'tomorrow_date',
					DATE(DATE_SUB(NOW(), INTERVAL 1 DAY)) AS 'yesterday_date'
			";
			return $controller->select_uno_db($query);
		}

		public function get_last_day($month, $year){
			$controller = new Controller();
			$query = "
				SELECT DAY(LAST_DAY('".$year."-".$month."-01')) AS 'ultimo_dia';
			";
			return $controller->select_uno_db($query);
		}

	}

?>