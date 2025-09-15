<?php
/////////////////////////////////////////////////////////////////////////////
// $Id$
//
// Copyright © 2009 - 2018 by James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////
include_once "debug.php";
include_once "Mailer.php";

/****************************************************************************
* DatabaseLibrary - Generic Database Class
****************************************************************************/
class DatabaseLibrary
{
	private $connection = null;
	private $debug = null;
	private $debugLevel = null;
	private $lastQuery;
	private $mailer = null;

	/************************************************************************
	* constructor
	************************************************************************/
	public function __construct($host, $database, $username, $password,
		$sendMail = false, $debugLevel = Debug::WARNING,
		$logFile = 'DatabaseLibrary.log', &$lastQuery = null)
	{
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

		$this->debugLevel = $debugLevel;
		$this->debug = new Debug($debugLevel, $logFile);

		$this->debug->Show(Debug::INFO, "DatabaseLibrary::DatabaseLibrary");
		$this->mailer = new Mailer();

		$this->lastQuery = & $lastQuery;

		$this->debug->Show(Debug::INFO, "HostName: ".$host);
		$this->debug->Show(Debug::INFO, "Username: ".$username);
		$this->debug->Show(Debug::INFO, "Password: ".$password);
		$this->connection = new mysqli($host, $username, $password);

		if ($this->connection->connect_errno)
		{
			$error = $this->connection->connect_error;
			$this->debug->Show(Debug::ERROR,
				"DatabaseLib::DatabaseLib Error: $error");

			if (true == $sendmMail)
			{
				$this->mailer->ErrorReport($error);
			}

			throw new Exception($error);
		}
		else
		{
			$this->debug->Show(Debug::INFO,
				"DatabaseLib::DatabaseLib connection ok");
			$result	= $this->connection->select_db($database);

			if (false == $result)
			{
				$error = $this->connection->connect_error;
				$this->debug->Show(Debug::ERROR,
					"DatabaseLib::DatabaseLib Error: $error");
			}
			else
			{
				$this->connection->query("set names utf8;");
				$this->debug->Show(Debug::INFO,
					"DatabaseLib::DatabaseLib database selected");
			}
		}

		$this->debug->Show(Debug::INFO, "DatabaseLib::DatabaseLib End");
	}

	/************************************************************************
	* Delete
	************************************************************************/
	public function Delete($query, $values = null, $types = null)
	{
		$result = $this->BaseQuery($query, $values, $types);

		return $result;
	}

	/************************************************************************
	* DoesDataExist
	************************************************************************/
	public function DoesDataExist($object)
	{
		$result = false;

		if ((!empty($object)) && ($this->connection->num_rows > 0))
		{
			$result = true;
		}

		return $result;
	}

	/************************************************************************
	* Drop
	*
	* DANGER! Use with caution
	************************************************************************/
	public function Drop($database)
	{
		$query = "DROP DATABASE $database";
		$result = $this->BaseQuery($query, null, null);

		return $result;
	}

	/************************************************************************
	* GetCount
	*
	* Assumes query in the form of 'SELECT COUNT(*) FROM...'
	************************************************************************/
	public function GetCount($query, $values = null, $types = null)
	{
		$count = 0;

		$result	= $this->BaseQuery($query, $values, $types);

		if (!empty($result))
		{
			$rows = mysql_fetch_array($result);
			$this->debug->DebugPrint(Debug::INFO, $rows);
			$count = $rows['COUNT(*)'];
			$this->debug->Show(Debug::INFO, "count: ".$count);
		}

		return $count;
	}

	/************************************************************************
	* GetAll
	************************************************************************/
	public function GetAll($query, $values = array(), $types = array())
	{
		$rows = $this->BaseQuery($query, $values, $types);

		return $rows;
	}

	/************************************************************************
	* GetFirstRowFirstColum
	************************************************************************/
	public function GetFirstRowFirstColum($query, $index = 0)
	{
		$rows = $this->BaseQuery($query);

		return $rows[0][$index];
	}

	/************************************************************************
	* GetRow
	************************************************************************/
	public function GetRow($query, $values = null, $types = null)
	{
		$row = null;
		$result = $this->BaseQuery($query, $values, $types);

		if (!empty($result))
		{
			$count = $this->connection->num_rows;
			$this->debug->Show(Debug::INFO, "GetRow count: ".$count);

			if ($count > 0)
			{
				$row = $this->connection->fetch_assoc();
			}
		}

		return $row;
	}

	/************************************************************************
	* Insert
	* 
	* Returns the Id of the successfully inserted record, 
	* otherwise false or zero
	************************************************************************/
	public function Insert($query, $values = null, $types = null)
	{
		$result = 0;

		$result = $this->BaseQuery($query, $values, $types);

		if (!empty($result))
		{
			$result = $this->connection->insert_id;
		}

		return $result;
	}

	/************************************************************************
	* NextId
	*
	* NOTES: This assumes that $primaryKey is an AUTO_INCREMENT column
	************************************************************************/
	public function NextId($table, $primaryKey)
	{
		$statement = "SELECT $primaryKey FROM $table ".
			"ORDER BY $primaryKey DESC LIMIT 1";
		$result = $this->GetFirstRowFirstColum($statement, 'id');

		$id = (int)$result;
		$id++;

		return $id;
	}

	/************************************************************************
	* Update
	************************************************************************/
	public function Update($query, $values = null, $types = null)
	{
		$result = $this->BaseQuery($query, $values, $types);

		return $result;
	}

	/************************************************************************
	* BaseQuery
	*
	* @param string $query SQL query
	* @param array $values (optional) Values or variables to bind to query.
	* Can be empty for selecting all rows
	* @param string $types (optional) Variable type for each 
	* bound value/variable
	* @throws mysqli_sql_exception If any mysqli function failed due to
	* mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT)
	************************************************************************/
	private function BaseQuery(string $query, array $values = array(),
		array $types = array())
	{
		$result = null;

		$this->lastQuery = $query;

		$statement = $this->connection->prepare($query);

		if (!empty($values))
		{
			$amount = count($values);

			$type = '';
			for($index = 0; $index < $amount; $index++)
			{
				$type .= $types[$index];
			}

			$parameters[] = & $type;
			for($index = 0; $index < $amount; $index++)
			{
				$parameters[] = & $values[$index];
 
				//$statement->bind_param($type, $values[$index]);
			}

			call_user_func_array(
				array($statement, 'bind_param'), $parameters);
		}

		$successCode = $statement->execute();
		$results = $statement->get_result();

		if (false !== $results)
		{
			$count = $results->num_rows;
			$this->debug->Show(Debug::INFO, "BaseQuery count: ".$count);

			$result = $results->fetch_all(MYSQLI_ASSOC);

			$results->free();
		}
		else
		{
			$this->debug->Show(Debug::INFO, "get_result failed");
			$result = $successCode;
		}

		return $result;
	}
}
?>
