<?php 
require_once 'CopyLeaks.php';

//Create an object from the class CopyLeaks.
$copyleaks = new CopyLeaks();

//Get the email and apikey then login to copyleaks API
$email = 'omariko_elelamy@hotmail.com';
$apikey = '29FE8DE3-FBA9-4737-8E39-4BB3400A26E9';
//Login to the copyleaks cloud.
$copyleaks->LoginCopyLeaks($email,$apikey);


//Free text to check 
//$textToCheck = "An atom is the smallest constituent unit of ordinary matter that has the properties of a chemical element.";
//Call the function that checks the free text.
//$copyleaks->FreeTextCheck($textToCheck);

//NOTE: The file has to be in the same directory of the file to run.
$file = 'Test.txt';
$copyleaks->FileCheck($file);




