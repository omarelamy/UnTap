<?php 
/**
* This is a class that integrates with the CopyLeaks API. It should include the functionalities to check for text,url,file or image plagiarism. 
**/
//dependencies and autoload
include_once( getcwd().'/autoload.php');
use Copyleaks\CopyleaksCloud;
use Copyleaks\CopyleaksProcess;
use Copyleaks\Products;

class CopyLeaks
{
	private $clConst;
	private $clCloud;
	function __construct()
	{
		/* CREATE CONFIG INSTANCE */
		$config = new \ReflectionClass('Copyleaks\Config');
		$this->clConst = $config->getConstants();
	}

	function LoginCopyLeaks($email,$apikey)
	{
		// Use the email that you used to register to Copyleaks.
		// If you don't have an account yet register on https://copyleaks.com/account/register
		// Your API-KEY is available at the dashboards on https://api.copyleaks.com/. Choose the dashboard of the product that you would like to use.
	
		// Login to Copyleaks Cloud
		try{
			$this->clCloud = new CopyleaksCloud($email, $apikey, Products::Education);
		}catch(Exception $e){
			echo "<Br/>Failed to connect to Copyleaks Cloud with exception: ". $e->getMessage();
			die();
		}

		//validate login token
		if(!isset($this->clCloud->loginToken) || !$this->clCloud->loginToken->validate()){ 
			echo "<Br/><strong>Bad login credentials</strong>";
			die();
		}

		echo "<Br/><strong>Logged in successfully</strong><Br/>";
	}

	function FreeTextCheck($text)
	{
		try{
				// For more information about the optional headers please visit: https://api.copyleaks.com/GeneralDocumentation/RequestHeaders
				$additionalHeaders = array($this->clConst['HTTP_CALLBACK'].': https://requestb.in/1jrvnp41' );
				
				
				// Create process using one of the following option.
				$process = $this->clCloud->createByText($text, $additionalHeaders);
				
				echo "<BR/><strong>Process created!</strong> (PID = '" . $process->processId . "') - You will get notified with a callback soon";
					
			}
			catch(Exception $e)
			{

				echo "<br/>Failed with exception: ". $e->getMessage();
			}


			while ($process->getStatus() != 100)
			{
				sleep(2);              
			}

			//Get the results from the process
			$results = $process->getResult();
			// Print the results
				echo $results;
	}

	function FileCheck($filepath)
	{
		try{
				// For more information about the optional headers please visit: https://api.copyleaks.com/GeneralDocumentation/RequestHeaders
				$additionalHeaders = array($this->clConst['HTTP_CALLBACK'].': https://requestb.in/1jrvnp41' );
				
				
				// Create process using one of the following option.
				$process = $this->clCloud->createByFile($filepath, $additionalHeaders);
				
				echo "<BR/><strong>Process created!</strong> (PID = '" . $process->processId . "') - You will get notified with a callback soon";
					
			}
			catch(Exception $e)
			{

				echo "<br/>Failed with exception: ". $e->getMessage();
			}


			while ($process->getStatus() != 100)
			{
				sleep(2);              
			}

			//Get the results from the process
			$results = $process->getResult();
			// Print the results
			foreach ($results as $result) 
			{
				echo $result;
			}
	}
}


