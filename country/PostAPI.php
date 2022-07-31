<?php
class PostAPI{
    private $localhost;
    private $user;
    private $password;
    private $dbName;

    public function __construct($local, $user, $password, $dbName)
    {
        $this->local = $local;
        $this->user = $user;
        $this->password = $password;
        $this->dbName = $dbName;
    }

    public function postData(){
        $connect = mysqli_connect($this->local,$this->user, $this->password, $this->dbName);
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
         }
           echo "Connected successfully";
       
        //if(isset($_POST['csv'])){
           
            
            if($_FILES['csv']){
         
                $filename = explode('.',$_FILES['csv']['name']);
                if($filename[1] =='csv'){
                    $handle = fopen($_FILES['csv']['tmp_name'], "r");
                    while($data = fgetcsv($handle)){
                        $item1 = mysqli_real_escape_string($connect, $data[0]);
                        $item2 = mysqli_real_escape_string($connect,$data[1]);
                        $item3 = mysqli_real_escape_string($connect, $data[2]);
                        echo json_encode($item3);
                        $item4 = mysqli_real_escape_string($connect,$data[3]);

                        $item5 = mysqli_real_escape_string($connect, $data[4]);
                        $item6 = mysqli_real_escape_string($connect,$data[5]);
                        $item7 = mysqli_real_escape_string($connect, $data[6]);
                        $item8 = mysqli_real_escape_string($connect,$data[7]);
                        $item9 = mysqli_real_escape_string($connect, $data[8]);
                        $item10 = mysqli_real_escape_string($connect,$data[9]);
                        $item11 = mysqli_real_escape_string($connect, $data[10]);
                      
                        $query = "INSERT INTO table_countries( continent, currency_code, code_two, code_three, numerics_code, f_code, calling_code, common_names, official_names, endonym, demonym) VALUES 
                        ('$item1', '$item2', '$item3', '$item4' , '$item5' , '$item6' , '$item7' , '$item8' , '$item9' , '$item10' , '$item11' )";
                        mysqli_query($connect, $query);
                    }

                    fclose($handle);
                }

           }
    
    }

    public function getData(){
        $connect = mysqli_connect($this->local,$this->user, $this->password, $this->dbName);
        if ($connect->connect_error) {
            die("Connection failed: " . $connect->connect_error);
        }else{
            echo "Connected successfull";  
        }

         
    
            
           // $query = "SELECT * FROM currencies LIMIT" .$limit
        if(isset($_GET['search']) && isset($_GET['limit']) ){
                $search = $_GET['search'];
                $limit = $_GET['limit'];
                $query = "SELECT * FROM table_countries WHERE continent= '$search' LIMIT ".$limit;
           
            
            if ( $result = mysqli_query($connect, $query)) {
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

       
        exit;
    }
}