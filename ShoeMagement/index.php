<?php

require 'src/ShoeInterface.php';
require 'src/Traits.php';
require 'src/Shoe.php';
require 'src/SportsShoe.php';
require 'src/CasualShoe.php';
require 'src/ShoeStore.php';

use ShoeManagement\SportsShoe;
use ShoeManagement\CasualShoe;
use ShoeManagement\ShoeStore;

// Create instances of shoes
$sportsShoe = new SportsShoe("Nike", "Air Max");
$casualShoe = new CasualShoe("Adidas", "Stan Smith");

// Create instance of shoe store
$shoeStore = new ShoeStore();
$shoeStore->addShoe($sportsShoe);
$shoeStore->addShoe($casualShoe);

// List all shoes in the store
$shoeStore->listShoes();
