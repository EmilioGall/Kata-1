<?php

class Person
{
   // Define a class constant for species
   const species = 'Homo Sapiens';

   // Declare public properties
   public $name;
   public $age;
   public $occupation;

   // Define class constructor
   public function __construct($name, $age, $occupation)
   {
      $this->name = $name;
      $this->age = $age;
      $this->occupation = $occupation;
   }

   // Define the introduce method
   public function introduce()
   {
      return "Hello, my name is " . $this->name;
   }

   // Define the describe_job method
   public function describe_job()
   {
      return "I am currently working as a(n) " . $this->occupation;
   }

   // Define a static method to greet aliens
   public static function greet_extraterrestrials($species)
   {
      return "Welcome to Planet Earth " . $species . "!";
   }
}
