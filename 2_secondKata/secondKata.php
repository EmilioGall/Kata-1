<?php

function countPositivesSumNegatives($input)
{
   // Check if the input is empty or null
   if (empty($input)) {

      return [];
   };

   // To count positive numbers
   $countPositives = 0;
   // To sum negative numbers
   $sumNegatives = 0;

   // Iterate through the input array
   foreach ($input as $number) {

      if ($number > 0) {

         // Increment count for positive numbers
         $countPositives++;

      } elseif ($number < 0) {

         // Sum up negative numbers
         $sumNegatives += $number;

      };
   };

   // Return the results in the arrays
   return [$countPositives, $sumNegatives];
}
