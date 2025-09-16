<?php
/////////////////////////////////////////////////////////////////////////////
// Practice Fusion Excel Import Script
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////

global $timeStart;
$timeStart = microtime(true);

require_once "Libraries/common.php";
require_once "Libraries/debug.php";
require_once "PracticeFusionImport.php";
require_once "Libraries/ImportUtils.php";

Common::SetDebugMode();

ini_set('memory_limit','1024M');

if (function_exists('apache_setenv'))
{
	apache_setenv('no-gzip', '1');
}

ini_set('zlib.output_compression', 0);

header('Content-Type: text/html; charset=utf-8');
mb_internal_encoding('UTF-8');
mb_regex_encoding('UTF-8');

$debugLevel = Debug::DEBUG;
$logFile = 'import.log';
$debugger = new Debug($debugLevel, $logFile);
$debugger->Show($debugLevel, "starting import process");

$path = getcwd();

$excelFileName = null;

if (PHP_SAPI == 'cli')
{
	if (!empty($argv[1]))
	{
		$excelFileName = $argv[1];
	}
	if (!empty($argv[2]))
	{
		$host = $argv[2];
	}
	if (!empty($argv[3]))
	{
		$username = $argv[3];
	}
	if (!empty($argv[4]))
	{
		$password = $argv[4];
	}
}
else
{
	if ((!empty($_GET)) && (!empty($_GET['file'])))
	{
		$excelFileName = $_GET['file'];
	}
}

$practiceFusionImport = new PracticeFusionImport(
	$debugLevel, $logFile, $path, $host, $username, $password);

$practiceFusionImport->Import($excelFileName);

$totalTime	= microtime(true) - $timeStart;
$debugger->Show(
	$debugLevel, "import process finished - total time: $totalTime");
Common::FlushBuffers();

?>
