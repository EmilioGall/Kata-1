<?php

function checkIfFlush($cards)
{
   // Check if the input contains exactly 5 cards
   if (count($cards) !== 5) {
      // Not a valid poker hand
      return false;
   }

   // Get the suit of the first card
   $suit = substr($cards[0], -1);

   // Check if all the cards have the same suit
   foreach ($cards as $card) {

      if (substr($card, -1) !== $suit) {

         // Found a card with a different suit
         return false;
      }
   }

   // All cards have the same suit
   return true;
}
