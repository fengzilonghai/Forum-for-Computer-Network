<?php
	
	class DB
	{
		protected $conn = null;

		protected function __construct() {
			
		}

		//Singleton
		public static function &getInstance() {
			static $instance = null;
			
			if($instance == null){
				$instance = new self();
			}
			
			return $instance;
		}

		//Connect
		public function connect($host, $port, $username, $password, $dbName, $dbCharset) {
			if(!$this->conn = @mysql_connect($host . ':' . $port, $username, $password)){
				$this->showMsg("Can not connect to database server.");
			}
			$charsetSql = 'SET character_set_connection={$dbCharset}, character_set_results={$dbCharset}, character_set_client=binary';
			$this->query($charsetSql);
			$this->select_db($dbName);
		}

		//Select
		public function select_db($dbName) {
			return mysql_select_db($dbName, $this->conn);
		}

		//Query
		public function query($sql) {
			return mysql_query($sql, $this->conn);
		}

		public function unbuffered_query($sql) {
			return mysql_unbuffered_query($sql, $this->conn);
		}

		//Fetch
		public function fetch($query, $type = MYSQL_ASSOC) {
			return mysql_fetch_array($query, $type);
		}

		//Num
		public function get_row_num($query) {
			return mysql_num_rows($query);
		}

		public function get_field_num($query) {
			return mysql_num_fields($query);
		}

		//Free resultset
		public function free($query) {
			return mysql_free_result($query);
		}

		public function ping() {
			return mysql_ping($this->conn);
		}

		//Close
		public function close() {
			return mysql_close($this->conn);
		}

		//Error
		public function get_errno() {
			return intval($this->conn ? mysql_errno($this->conn) : mysql_errno());
		}

		public function get_errinfo() {
			return $this->conn ? mysql_error($this->conn) : mysql_error();
		}
		
		public function showMsg($msg = '') {
			$message .= "<p>数据库出错:</p><pre><b>" . htmlspecialchars($msg) . "</b></pre>\n";
			$message .= "<b>Mysql error number</b>: ".$this->get_errno()."\n<br />";
			$message .= "<b>Mysql error description</b>: " . htmlspecialchars($this->get_errinfo()) . "\n<br />";
			$message .= "<b>Date</b>: ".date("Y-m-d @ H:i")."\n<br />";
			$message .= "<b>Script</b>: http://".$_SERVER['HTTP_HOST'].getenv("REQUEST_URI")."\n<br />";
			@header("content-Type: text/html; charset=UTF-8");
			echo $message;
			exit;
		}
	}
	
?>
