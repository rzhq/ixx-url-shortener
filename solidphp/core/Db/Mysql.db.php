<?php
/* Solidphp Mysql数据库类
 * @package		core_Db
 * @author		aurorax
 * @lastmodify	2013/08/31
 */
 
	class Mysql{
		
		private $link;
		private $server;
		private $user;
		private $pass;
		private $dbname;
		private $per;
		private $encode;
		
		private $sql;
		private $result;
		
		function __construct($server='',$user='',$pass='',$dbname='',$per='',$encode=''){
			$this->server = $server;
			$this->user = $user;
			$this->pass = $pass;
			$this->dbname = $dbname;
			$this->per = $per;
			$this->encode = $encode;
			$this->connect();
		}
		
		
		public function connect(){
			$this->link = @mysql_connect($this->server,$this->user,$this->pass);
			@mysql_query('SET NAMES '.$this->encode);
			@mysql_select_db($this->dbname);	
		}
		
		function __destruct(){
			if(!$this->per){
				@mysql_close($this->link);
			}
		}
		
		public function link(){
			return $this->link;
		}		
		
		/* SQL语句执行
		 * 若$sql不空则执行$sql中的语句,否则执行$this->sql中的语句
		 */
		public function query($sql=''){
			if(!empty($sql)){
				$this->sql = mysql_real_escape_string($sql);
			}
			$this->result = @mysql_query($this->sql,$this->link);
			return $this->result;
		}
		
		/* 取回数据
		 * 若$sql不空则执行$sql中的语句并取回对应数据,否则执行$this->sql中的语句并取回对应数据
		 * @return	array()
		 */
		public function fetch($sql=''){
			$this->query($sql);
			$row = array();
			while($row[]=@mysql_fetch_array($this->result));
			unset($row[sizeof($row)-1]);
			if(sizeof($row)==1)
				if(sizeof($row[0])==2)
					return $row[0][0];
				else
					return $row[0];
			else
				return $row;
		}
		
		/* 创建表
		 * 若$con=true且表$table存在则删除旧表后创建新表
		 * 若$con=false且表$table存在则不能创建表
		 * @return	boolean
		 */
		public function createTable($table,$columns,$con=false){
			if($con)
				$this->deleteTable($table);
			$this->sql = 'CREATE TABLE '.$table.'('.$columns.') DEFAULT CHARSET '.$this->encode;
			return $this->query();
		}
		
		public function deleteTable($table){
			$this->sql = 'DROP TABLE IF EXISTS '.$table;
			return $this->query();
		}
		
		public function select($column,$table,$condition=''){
			$this->sql = 'SELECT '.$column.' FROM '.$table;
			if(!empty($condition)){
				$this->sql .= ' WHERE '.$condition;
			}
			return $this->fetch();
		}
		
		public function insert(){
			$args = func_get_args();
			$this->sql = 'INSERT INTO '.$args[0].' VALUES(\''.$args[1].'\'';
			for($i=2;$i<sizeof($args);$i++)
				$this->sql .= ',\''.$args[$i].'\'';
			$this->sql .= ')';
			return $this->query();
		}
		
		public function update(){
			$args = func_get_args();
			$size = sizeof($args);
			$last = $size - 1;
			$this->sql = 'UPDATE '.$args[0].' SET '.$args[1].' = \''.$args[2].'\'';
			if($last > 4){
				for($i=4;$i<$last;$i=$i+2)
					$this->sql .= ', '.$args[$i-1].' = \''.$args[$i].'\'';
			}
			$this->sql .= ' WHERE '.$args[$last];
				
			return $this->query();
		}
		
		public function delete($table,$condition=''){
			$this->sql = 'DELETE FROM '.$table;
			if(!empty($condition))
				$this->sql .= ' WHERE '.$condition;
			return $this->query();
		}
	}