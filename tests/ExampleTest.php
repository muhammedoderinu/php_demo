<?php
   header('Access-control-Allow-Origin: *');
   header('content-type: application/json; charset=utf-8');
   include('C:\xampp\htdocs\php_demo\currency\PostAPI.php');

test('example', function () {
    expect(true)->toBeTrue();
});

test(' Database connection successful', function(){
 
      $local = 'localhost';
      $pwd = '';
      $user = 'root';
      $dbName = 'locations';
    
    $postApi = new PostAPI($local, $user, $pwd, $dbName);
    $response = $postApi->connect();
    //expect($response)->not()->toBeNull();
    $this->assertEquals($response,"connected successfully" ); 

});

