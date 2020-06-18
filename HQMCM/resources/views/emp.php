<?php


abstract class emp
{
    public $name;
    public $email;
    public $gender;
    public $type;
    public function __construct($name,$email,$gender,$type) {
        $this->name = $name;
        $this->email = $name;
        $this->gender = $name;
        $this->type = $name;
    }

      function echoinfo($emp){}
}
