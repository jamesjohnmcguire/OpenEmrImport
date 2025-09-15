<?php
/////////////////////////////////////////////////////////////////////////////
// Generic collection of debugging and utility functions.
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////

function CommonStart()
{
	global $g_Debug;
	global $g_BlackBerryDevice;
	global $g_iPhone;
	global $g_ImagePath;
	if ($g_Debug	== true)
	{
		// later bit of overkill on the error settings
		ini_set('display_errors', true);
		ini_set('display_startup_errors', true);
		error_reporting(E_ALL);
	}

	session_start();
	ob_start();

	DebugEcho("Post vars");
	DebugPrint($_POST);
	if (isset($_GET))
	{
		DebugEcho("Get vars");
		DebugPrint($_GET);
	}

	if (isset($_SESSION))
	{
		DebugEcho("Session");
		DebugPrint($_SESSION);
	}

	if (isset($_SESSION))
	{
		DebugEcho("Cookies");
		DebugPrint($_COOKIE);
	}

	DebugEcho ("Testing Devices");
	$g_BlackBerryDevice	= IsBlackBerryDevice();
	$g_iPhone	= IsIphoneDevice();

	
	if(TRUE == $g_BlackBerryDevice)
	{
		$g_ImagePath	= "Images/Rim";
	}
	elseif(TRUE == $g_iPhone)
	{
		$g_ImagePath	= "Images/IPhone";
	}
	else
	{
		$g_ImagePath	= "Images";
	}
}

function CommonEnd()
{
	include_once "./Html/Footer.html";
	ob_end_flush();
}

function DirList ($directory)
{
	// create an array to hold directory list
	$results = array();

	// create a handler for the directory
	$handler = opendir($directory);

	// keep going until all files in directory have been read
	while ($file = readdir($handler))
	{

		// if $file isn't this directory or its parent, 
		// add it to the results array
		if ($file != '.' && $file != '..')
		{
			$results[] = $file;
		}
	}

	closedir($handler);

	return $results;
}

function GeneratePassword($length = 8)
{
	$password = "";
	$possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
	$i = 0; 

	while ($i < $length)
	{ 
		// pick a random character from the possible ones
		$char = substr($possible, mt_rand(0, strlen($possible)-1), 1);

		// we don't want this character if it's already in the password
		if (!strstr($password, $char))
		{ 
			$password .= $char;
			$i++;
		}
	}

	return $password;
}

/*
if (!function_exists ('getmxrr') ) {
  //function getmxrr($hostname, &$mxhosts, &$mxweight) {
  function getmxrr($hostname, &$mxhosts) {
    if (!is_array ($mxhosts) ) {
      $mxhosts = array ();
    }

    if (!empty ($hostname) ) {
      $output = "";
      @exec ("nslookup.exe -type=MX $hostname.", $output);
      $imx=-1;

      foreach ($output as $line) {
        $imx++;
        $parts = "";
        if (preg_match ("/^$hostname\tMX preference = ([0-9]+), mail exchanger = (.*)$/", $line, $parts) ) {
          //$mxweight[$imx] = $parts[1];
          $mxhosts[$imx] = $parts[2];
        }
      }
      return ($imx!=-1);
    }
    return false;
  }
}
*/

function GetStateCode()
{
	$stateCode = array(1=> "NA",
		"AL" ,
		  "AK" ,
		  "AZ" ,
		  "AR" ,
		  "CA" ,
		  "CO" ,
		  "CT" ,
		  "DE" ,
		  "DC" ,
		  "FL" ,
		  "GA" ,
		  "HI" ,
		  "ID" ,
		  "IL" ,
		  "IN" ,
		  "IA" ,
		  "KS" ,
		  "KY" ,
		  "LA" ,
		  "ME" ,
		  "MD" ,
		  "MA" ,
		  "MI" ,
		  "MN" ,
		  "MS" ,
		  "MO" ,
		  "MT" ,
		  "NE" ,
		  "NV" ,
		  "NH" ,
		  "NJ" ,
		  "NM" ,
		  "NY" ,
		  "NC" ,
		  "ND" ,
		  "OH" ,
		  "OK" ,
		  "OR" ,
		  "PA" ,
		  "RI" ,
		  "SC" ,
		  "SD" ,
		  "TN" ,
		  "TX" ,
		  "UT" ,
		  "VT" ,
		  "VA" ,
		  "WA" ,
		  "WV" ,
		  "WI" ,
		  "WY" );
	return $stateCode;
}

function GetStateName()
{
	$stateName = array(1=> "Other",
  "Alabama",
      "Alaska",
      "Arizona",
      "Arkansas",
      "California",
      "Colorado",
      "Connecticut",
      "Delaware",
      "District of Columbia",
      "Florida",
      "Georgia",
      "Hawaii",
      "Idaho",
      "Illinois",
      "Indiana",
      "Iowa",
      "Kansas",
      "Kentucky",
      "Louisiana",
      "Maine",
      "Maryland",
      "Massachusetts",
      "Michigan",
      "Minnesota",
      "Mississippi",
      "Missouri",
      "Montana",
      "Nebraska",
      "Nevada",
      "New Hampshire",
      "New Jersey",
      "New Mexico",
      "New York",
      "North Carolina",
      "North Dakota",
      "Ohio",
      "Oklahoma",
      "Oregon",
      "Pennsylvania",
      "Rhode Island",
      "South Carolina",
      "South Dakota",
      "Tennessee",
      "Texas",
      "Utah",
      "Vermont",
      "Virginia",
      "Washington",
      "West Virginia",
      "Wisconsin",
      "Wyoming");
return $stateName;
}

function IsBlackBerryDevice()
{
	$BlackBerryDevice	= FALSE;

	$UserAgent			= $_SERVER['HTTP_USER_AGENT'];

	$Position = stripos($UserAgent, "blackberry");

	if ($Position !== FALSE)
	{
		$BlackBerryDevice	= TRUE;
	}

	return $BlackBerryDevice;
}

/////////////////////////////////////////////////////////////////////////////
// IsNonAsciiString
/////////////////////////////////////////////////////////////////////////////
function IsNonAsciiString($TestString)
{
	$NonAsciiString	= FALSE;
	// Failed patterns
	//$pattern ='/^[-a-zA-Z0-9_;-a\s]*$/u';
	//$pattern ='/^[-a-zA-Z0-9\s]/';
	//$pattern ='/[\x{30A0}-\x{30FF}\x{3040}-\x{309F}\x{4E00}-\x{9FBF}]*$/u';
	//$pattern ='/^[-a-zA-Z0-9_\x{30A0}-\x{30FF}'
	//		 .'\x{3040}-\x{309F}\x{4E00}-\x{9FBF}\s]*$/u';
	$Pattern ='/[^a-zA-Z0-9\s-_\.;:\$\#]/';

	$Result	= preg_match($Pattern, $TestString);

	if (1 == $Result)
	{
		$NonAsciiString	= TRUE;
	}
	
	return $NonAsciiString;
}

function IsIphoneDevice()
{
	DebugEcho("IsIphoneDevice Begin");
	$iPhoneDevice	= FALSE;

	$UserAgent			= $_SERVER['HTTP_USER_AGENT'];
	DebugEcho("UserAgent: ".$UserAgent);

	$Position = stripos($UserAgent, "iPhone");
	DebugEcho("Position: ".$Position);

	if ($Position !== FALSE)
	{
		$iPhoneDevice	= TRUE;
		DebugEcho("IsIphoneDevice TRUE");
	}
	else
	{
		$Position = strpos("ipod", $UserAgent);

		if ($Position !== FALSE)
		{
			$iPhoneDevice	= TRUE;
			DebugEcho("IsIphoneDevice TRUE");
		}
	}

	if ($Position === FALSE)
	{
		DebugEcho("IsIphoneDevice FALSE");
	}

	DebugEcho("IsIphoneDevice End");
	return $iPhoneDevice;
}

/////////////////////////////////////////////////////////////////////////////
/**
 * IsWindows function
 */
/////////////////////////////////////////////////////////////////////////////
if ( ! function_exists('IsWindows'))
{
	function IsWindows()
	{
		$is_windows = FALSE;

		if (strncasecmp(PHP_OS, 'WIN', 3) == 0)
		{
			$is_windows = TRUE;
		}

		return $is_windows;
	}
}

if ( ! function_exists('ReadCsvFile'))
{
	function ReadCsvFile($filePath, $skipFirst = true)
	{
		$lines = NULL;

		putenv("LANG=en_US.UTF-8");
		setlocale(LC_ALL, 'en_US.UTF-8');
	
		if (($handle = fopen($filePath, "r")) !== FALSE)
		{
			$i = 0;
			while (($line = fgetcsv($handle)) !== FALSE)
			{
				if ((false == $skipFirst) || ($i > 0))
				{
					for ($j=0; $j<count($line); $j++)
					{
						$lines[$i][$j] = $line[$j];
					}
				}
				$i++;
			}

			fclose($handle);
		}

		return $lines;
	}
}

/////////////////////////////////////////////////////////////////////////////
// RecursiveRemoveDirectory
//
//
// RecursiveRemoveDirectory( directory to delete, empty )
// expects path to directory and optional TRUE / FALSE to empty
/////////////////////////////////////////////////////////////////////////////
function RecursiveRemoveDirectory($directory, $empty=FALSE)
{
	if(substr($directory,-1) == '/')
	{
		$directory = substr($directory,0,-1);
	}

	if(!file_exists($directory) || !is_dir($directory))
	{
		return FALSE;
	}
	elseif(is_readable($directory))
	{
		$handle = opendir($directory);
		while (FALSE !== ($item = readdir($handle)))
		{
			if($item != '.' && $item != '..')
			{
				$path = $directory.'/'.$item;

				if(is_dir($path))
				{
					recursive_remove_directory($path);
				}
				else
				{
					unlink($path);
				}
			}
		}

		closedir($handle);

		if($empty == FALSE)
		{
			if(!rmdir($directory))
			{
				return FALSE;
			}
		}
	}

	return TRUE;
}

/**
 * Show info message
 *
 * @param	string
 * @return	void
 */
if ( ! function_exists('ShowMessage'))
{
	function  ShowMessage($message, $redirect = '')
	{
		$CI =& get_instance();

		$CI->session->set_flashdata('message', $message);

		redirect($redirect);
	}
}

function VerifyEmailAddress(
	$EmailAddress)
{
	DebugEcho ("Email: ".$EmailAddress);

	$ValidEmailAddress	= FALSE;
	//$ValidEmailRegEx	= "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
	//$ValidEmailRegEx	= "/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";
	//$ValidEmailRegEx	= "/^[\w]+(\.[\w]+)*@([\w\-]+\.)+[a-zA-Z]{2,7}$/";
	//$ValidEmailRegEx	= "/^([a-zA-Z0-9])+([a-zA-Z0-9\.\\+=_-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/";

	$ValidEmailRegEx	= "/^([a-z0-9])(([-a-z0-9._])*([a-z0-9]))*\@([a-z0-9])(([a-z0-9-])*([a-z0-9]))+(\.([a-z0-9])([-a-z0-9_-])?([a-z0-9])+)+$/i";

	//$EmailAddress = "email-address_to.validate@guru.jp";
	//echo preg_match ($ValidEmailRegEx, $EmailAddress);

	// checks proper syntax
	if(preg_match($ValidEmailRegEx, $EmailAddress))
	{
		if (function_exists ('getmxrr') )
		{
			// gets domain name
			list($username,$domain)=split('@',$EmailAddress);

			// checks for if MX records in the DNS
			$mxhosts = array();
			if(!getmxrr($domain, $mxhosts))
			{
				// no mx records, ok to check domain
				if (fsockopen($domain,25,$errno,$errstr,30))
				{
				  $ValidEmailAddress	= TRUE;
				}
			}
			else
			{
				// mx records found
				foreach ($mxhosts as $host)
				{
					if (fsockopen($host,25,$errno,$errstr,30))
					{
						$ValidEmailAddress	= TRUE;
						break;
					}
				}
			}
		}
		else
		{
			$ValidEmailAddress	= TRUE;
		}
	}
	else
	{
		DebugEcho("Email does not match proper regex: ".$EmailAddress);
	}

	return $ValidEmailAddress;
}
