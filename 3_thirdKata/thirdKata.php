<?php

$version = $_GET['user-version'];

// var_dump($version);

class VersionManager
{

   private int $major;
   private int $minor;
   private int $patch;
   private array $history = [];

   // Constructor to initialize the version
   public function __construct($version = "0.0.1")
   {

      if (empty($version)) {

         $this->major = 0;
         $this->minor = 0;
         $this->patch = 1;
      } else {

         // Split the version string by the dot '.'
         $parts = explode('.', $version);

         // Check for invalid parts
         foreach ($parts as $key => $part) {

            if ($key < 2 && !is_int($part)) {
               throw new Exception("Error occured while parsing version!");
            }
         }

         // Initialize default values
         $this->major = 0;
         $this->minor = 0;
         $this->patch = 0;

         // Assign valid part to MAJOR
         if (isset($parts[0]) && is_numeric($parts[0])) {
            $this->major = (int)$parts[0];
         }

         // Assign valid part to MINOR
         if (isset($parts[1]) && is_numeric($parts[1])) {
            $this->minor = (int)$parts[1];
         }

         // Assign valid part to PATCH
         if (isset($parts[2]) && is_numeric($parts[2])) {
            $this->patch = (int)$parts[2];
         }
      }

      // Store initial version in history
      $this->recordCurrentVersion();
   }

   private function recordCurrentVersion()
   {

      array_push($this->history, [$this->major, $this->minor, $this->patch]);
   }

   // Method to increase MAJOR version
   public function major()
   {

      $this->major++;

      $this->minor = 0;

      $this->patch = 0;

      $this->recordCurrentVersion();

      return $this;
   }

   // Method to increase MINOR version
   public function minor()
   {

      $this->minor++;

      $this->patch = 0;

      $this->recordCurrentVersion();

      return $this;
   }

   // Method to increase PATCH version
   public function patch()
   {

      $this->patch++;

      $this->recordCurrentVersion();

      return $this;
   }

   // Method to rollback to the previous version
   public function rollback()
   {

      if (count($this->history) < 2) {

         throw new Exception("Cannot rollback!");
      }

      // Remove current version from history
      array_pop($this->history);

      // Restore the last recorded version (the new current version will be this)
      [$this->major, $this->minor, $this->patch] = $this->history[count($this->history)-1];

      // allows method chaining
      return $this; 

   }

   // Method to release the version string
   public function release()
   {

      return "{$this->major}.{$this->minor}.{$this->patch}";
   }


};

$classVersion = new VersionManager($version);

// var_dump($classVersion->release());

// var_dump((new VersionManager())->major()->rollback()->release());
// var_dump((new VersionManager())->minor()->rollback()->release());
// var_dump((new VersionManager())->patch()->rollback()->release());
// var_dump((new VersionManager())->major()->patch()->rollback()->release());
// var_dump((new VersionManager())->major()->patch()->rollback()->major()->rollback()->release());

echo '<pre class="text-primary">' . var_export((new VersionManager()), true) . '</pre>'; //0.0.1
echo '<pre>' . var_export((new VersionManager())->major(), true) . '</pre>'; // 1.0.0
echo '<pre class="text-primary">' . var_export((new VersionManager())->major()->patch(), true) . '</pre>'; // 1.0.1
echo '<pre>' . var_export((new VersionManager())->major()->patch()->rollback(), true) . '</pre>'; // 1.0.0
echo '<pre class="text-primary">' . var_export((new VersionManager())->major()->patch()->rollback()->major(), true) . '</pre>'; // 2.0.0
echo '<pre>' . var_export((new VersionManager())->major()->patch()->rollback()->major()->rollback(), true) . '</pre>'; // 1.0.0
echo '<pre class="text-primary">' . var_export((new VersionManager())->major()->patch()->rollback()->major()->rollback()->release(), true) . '</pre>'; // 1.0.0



// try {
//    $this->assertSame("0.0.1", (new VersionManager())->major()->rollback()->release());
//    $this->assertSame("0.0.1", (new VersionManager())->minor()->rollback()->release());
//    $this->assertSame("0.0.1", (new VersionManager())->patch()->rollback()->release());
//    $this->assertSame("1.0.0", (new VersionManager())->major()->patch()->rollback()->release());
//    $this->assertSame("1.0.0", (new VersionManager())->major()->patch()->rollback()->major()->rollback()->release());
// } catch (Exception $e) {
//    $this->fail();
// }

?>

<!DOCTYPE html>
<html lang="en">

<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <!-- Link Bootstrap -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
   <!-- /Link Bootstrap -->

   <title>Kata1_third</title>

</head>

<body>

   <div class="container-sm">

      <h1 class="my-3 text-center text-primary">Version Manager</h1>

      <div class="row justify-content-center">

         <form class="col-8" action="thirdKata.php" method="GET">

            <!-- Word Input -->
            <div class="mb-3 border rounded-3 p-2">

               <label for="user-word" class="form-label">
                  Insert here a version (es. "1.2.3").
               </label>

               <input type="text" class="form-control" id="user-version" name="user-version">

            </div>
            <!-- /Word Input -->

            <button type="submit" class="btn btn-primary">Submit</button>

         </form>

      </div>

   </div>

</body>

</html>