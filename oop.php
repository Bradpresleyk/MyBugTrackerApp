<?php


abstract class Customer{
   private $name;
   private $id = 1;
   protected $email;
   private $balance;


   public function __construct($id,$name,$email,$balance)
   {
      $this->id = $id;
      $this->name = $name;
      $this->email = $email;
      $this->balance = $balance;
   }

   abstract public function getEmail();

  }
// $customer = new Customer(1,"Brad King","bradpresley30@gmail.com",0);


class Subscriber extends Customer{
    public $plan;

    public function __construct($id, $name, $email, $balance, $plan){
        parent::__construct($id, $name, $email, $balance);
        $this->plan = $plan;
    }

   public function getEmail(){
       return $this->email;
   }
  
}


$subscriber = new Subscriber(1, "Brad King", "bradpresley30@gmail.com", 0, "Pro" );


echo $subscriber->getEmail();



class User{
   public $username;
   public $password;
   private static $passwordLength = 5;


   public static function getPasswordLength(){
      return self::$passwordLength;
   }
}


echo User::getPasswordLength();

?>