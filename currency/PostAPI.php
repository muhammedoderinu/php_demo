<?php
class PostAPI{
    private $localhost;
    private $user;
    private $password;
    private $dbName;
    public $logValue;
    public $connect;

    public function __construct($local, $user, $password, $dbName)
    {
        $this->local = $local;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    public function postData(){
       
           
       
        
           
            
            if($_FILES['csv']){
         
                $filename = explode('.',$_FILES['csv']['name']);
                if($filename[1] =='csv'){
                    $handle = fopen($_FILES['csv']['tmp_name'], "r");
                    while($data = fgetcsv($handle)){
                        $item1 = mysqli_real_escape_string($this->connect, $data[0]);
                        $item2 = mysqli_real_escape_string($this->connect,$data[1]);
                        $item3 = mysqli_real_escape_string($this->connect, $data[2]);
                        $item4 = mysqli_real_escape_string($this->connect,$data[3]);
                        $item5 = mysqli_real_escape_string($this->connect, $data[4]);
                       
                      
                        $query = "INSERT INTO currencies(is_code, numeric_code, common_name, official_name, symbol) VALUES 
                        ('$item1', '$item2', '$item3', '$item4' , '$item5' )";
                        mysqli_query($this->connect, $query);
                    }

                    fclose($handle);
                }else{
                    return 'file name must be csv';
                }

           }
    
    }

    public function connect(){
        $this->connect = mysqli_connect($this->local,$this->user, $this->password, $this->dbName);
        if ($this->connect->connect_error) {
            die("Connection failed: " . $this->connect->connect_error);
         }else

           echo "Connected successfull";
         
          return  $this->logValue = "connected successfully";
        
           
    }

    public function getData(){
            
         // $query = "SELECT * FROM currencies LIMIT" .$limit
            if(isset($_GET['search']) && isset($_GET['limit']) ){
                $search = $_GET['search'];
                $limit = $_GET['limit'];
                $query = "SELECT * FROM currencies WHERE is_code= '$search' LIMIT ".$limit;
           
            
            if ( $result = mysqli_query($this->connect, $query)) {
                if($result->num_rows >= 1) {
                    echo "Table exists";
                    $itemRecords = array();
                    for($x = 1; $x <= $limit; $x+=1){
                        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                        array_push($itemRecords, $row);

                    }
                    echo json_encode($itemRecords);
                }
            }
            else {
                echo "Table does not exist";
            }
            
        
        }else{
            echo ('   error in url follow the url guidline in the doc');
        }

      
        return $this->logValue;
       
        //exit;
       
    }
}