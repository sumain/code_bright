<?php 
    namespace App;
    use App\Database;

    class ServiceFunctions extends Database{
        public $result_set = [];
		function __construct($user=null,$password=null,$db=null) {
            parent::__construct($user,$password,$db); 
        }

        public function getSessID(){
		
            return session_id();
        }
        public function getAuthontication(){
            
            //$this->printr($_SESSION);
            if(isset($_SESSION['userid'])){
                return 1;
            }else{
                return 0;
            }
        }
        
        
        public function selectQuery($query){
            $rows =[];
            try{
                $result = mysqli_query($this->conn,$query);
                if(mysqli_num_rows($result)){
                    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
                }
                mysqli_free_result($result);
               // mysqli_close($this->conn);		
            } catch (Exception $e) {
                $flag[1]  = $e->getMessage();
            }
            
            return $rows;
        }
		
		
		function showChildEmployee($parent,$dept) {
			
			$query = "Select employee.id, employee.name as emp,employee.email,roleid,dept,employee.parent,departments.name as department,details,emp1.name as parent  from employee ";
			$query .= "left join emp_dept_role on emp_dept_role.employeeid = employee.id ";
			$query .= "left join departments on emp_dept_role.dept = departments.id ";
			$query .= "left join roles on emp_dept_role.roleid = roles.id ";
			$query .= "left join employee AS emp1 on emp1.id = employee.parent ";
			$query .= "where emp_dept_role.dept ='".$dept."' and  employee.parent='".$parent."'";
			$resul = $this->selectQuery($query);
			
			//echo $query;
			//$this->printr($resul);

			if (!empty($resul) > 0) {
				$this->result_set[]= $resul;
				foreach($resul as $k => $ch){					
					$this->showChildEmployee($ch['id'],$dept);
				}
			}
		}
        
        public function insertQuery($data,$table){
            $id ='';
            $string='Insert into '.$table;
            if(!empty($data)){
                $field=[];
                $value=[];
                foreach($data as $key => $val){
                    $field[]=$key;
                    $value[]=$this->encode($val);
                }
                $string .='('.implode(',',$field).')values';
                $string .="('".implode("','",$value)."')";
                //echo $string;
                
                try{
                    mysqli_query($this->conn,$string);
                    $id = mysqli_insert_id($this->conn);
                   
                } catch (Exception $e) {
                    $flag[1]  = $e->getMessage();
                }
            }
            
            
            //mysqli_close($this->conn);
            return $id;
        }
        public function updateQuery($data,$table,$condition=array()) {
            $flag =[];
            $string='Update '.$table.' SET ';
            if(!empty($data)){
                foreach($data as $key => $val){
                    $string .= trim($key)."='".$this->encode($val)."',";
                }
                $string = substr($string , 0, -1).' Where ';
                
                if(!empty($condition)){
                    $flg = 0;
                    foreach($condition as $key => $val){
                        if($val){
                            $string .= trim($key)."='".$this->encode($val)."',";
                            $flg =1;
                        }
                    }
                    if($flg){
                        $string = substr($string , 0, -1).';';
                        try{
                            mysqli_query($this->conn,$string);
                            $flag[0] = mysqli_affected_rows($this->conn);
                            
                        } catch (Exception $e) {
                            $flag[1]  = $e->getMessage();
                        }
                    }
                }
            }
            return $flag;
        }
        
        public function deleteQuery($table, $condition=array()) {
            $string = "Delete from ".$table." WHERE ";
            if(!empty($condition)){
                $flg = 0;
                foreach($condition as $key => $val){
                    if($val){
                        $string .= trim($key)."='".trim($val)."',";
                        $flg =1;
                    }
                }
                if($flg){
                    $string = substr($string , 0, -1).';';
                    try{
                        mysqli_query($this->conn,$string);
                        $flag[0] = mysqli_affected_rows($this->conn);
                        
                    } catch (Exception $e) {
                        $flag[1]  = $e->getMessage();
                    }
                }
            }
        }
    
        public function printr($data){
            echo'<pre>';
            print_r($data);
            echo'</pre>';
        }
        function dateDecode($dates, $format = 1) {

            $date = '--';
            if ($dates == '' || $dates == '0000-00-00' || $dates == '1970-01-01' || $dates == '0000-00-00 00:00:00') {
                return '';
            } else {
                if ($format == 1)
                    $date = date("d M, Y", strtotime($dates));  //01 Nov, 2006
                if ($format == 2)
                    $date = date("d/m/Y", strtotime($dates));  //01/01/2006
                if ($format == 3)
                    $date = date("j F, Y - g:i:s A", strtotime($dates)); //1 November, 2006 - 12:00:00 AM
                if ($format == 4)
                    $date = date("M j, Y g:i a", strtotime($dates));     //Nov 1, 2006 12:00 am
                if ($format == 5)
                    $date = date("M d, Y", strtotime($dates));  //Nov 01, 2006
                if ($format == 6)
                    $date = date("g:i:s A", strtotime($dates));  //12:00:00 AM
            }
            return $date;
        }
        public function redirect($url)
        {
            if(!headers_sent())
                header("location:".$url);
            else
                echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        }
        public static function encode($string)
        {
            $string=trim($string);
            $string=addslashes($string);	
            $string=utf8_encode($string);
            return $string;
        }	
        
        public static function decode($string)
        {
            $string=trim($string);
            $string=stripslashes($string);	
            $string=utf8_decode($string);
            return $string;
        }
    }
?>