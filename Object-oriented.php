<?php

abstract class newAccount{
    abstract function register($school);
}

class person extends newAccount {

    public $id;
    public $name;
    public $city;
    private $password;

    function register($school){}

    public function set($id,$name,$city){
        $this ->id = $id;
        $this ->name = $name;
        $this ->city = $city;
    }

    public function showData ($person){
        echo "Id : " . $this ->id . "  Name :" . $this ->name . "<br>";
    }
    /*
    public function chick(){
        if ($this-> id < 1000){
            echo "accept";
        }else{
            echo "Not accept";
        }
    }
    */
    public function changePassword($password){
        $this ->password = md5($password);
    }
    final function sayhello(){
        echo ("Welcome - <h1>". $this->name ."</h1>" );
    }

}

class student extends person{
    public $school;
    function register($school){
        $this->school = $school;
    }

    /*
    final function className(){
      echo "Student Class";
  }
*/

}


//new object >> person1
$p1 = new person();
$p1 ->set(1,"moaz","gaza");
$p1->changePassword("maoz2121");


//new object >> person2
$p2 = new person();
$p2 ->set(2,"hozifa","gaza");
$p2->changePassword("hozifaPass");

//new object >> student
$s1 = new student();
$s1 ->set(3,"shaban","gaza");
$s1->changePassword("shaban213");
$s1->register("gaza high school");



//show data
$p1 -> showData($p1);
$p2 -> showData($p2);
$s1 -> showData($s1);


/*
echo "<pre>";
var_dump($p1);
$p1 ->sayhello();
var_dump($p2);
$p2 ->sayhello();
var_dump($s1);
$s1 ->sayhello();
echo "</pre>";
*/
