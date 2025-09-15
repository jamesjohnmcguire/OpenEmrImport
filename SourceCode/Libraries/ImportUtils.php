<?php
/////////////////////////////////////////////////////////////////////////////
// Import Utils functions
//
// NOTES:
//
// Copyright @2018 - 2025 James John McGuire
// All rights reserved.
/////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////////////////////////
// ConvertDigit
/////////////////////////////////////////////////////////////////////////
function ConvertDigit($Digit)
{
	$number = (int)$Digit;

	return $number;
}

/////////////////////////////////////////////////////////////////////////
// ConvertDigits
/////////////////////////////////////////////////////////////////////////
function ConvertDigits($Digits)
{
	$hex_ary = array();
	foreach (mb_str_split($Digits) as $chr)
	{
		DebugEcho(__LINE__.": chr: ".$chr);
		$AsciiDigit	= ConvertDigit($chr);
		DebugEcho(__LINE__.": AsciiDigit: ".$AsciiDigit);
		$hex_ary[] = $AsciiDigit;
	}
	$AsciiDigits	= implode('',$hex_ary);
	return $AsciiDigits;
}

/////////////////////////////////////////////////////////////////////////
// ConvertKanjiDigit
/////////////////////////////////////////////////////////////////////////
function ConvertKanjiDigit($Digit)
{
	switch ($Digit)
	{
		case '一':
		{
			$AsciiDigit	= 1;
			break;
		}
		case '二':
		{
			$AsciiDigit	= 2;
			break;
		}
		case '三':
		{
			$AsciiDigit	= 3;
			break;
		}
		case '四':
		{
			$AsciiDigit	= 4;
			break;
		}
		case '五':
		{
			$AsciiDigit	= 5;
			break;
		}
		case '六':
		{
			$AsciiDigit	= 6;
			break;
		}
		case '七':
		{
			$AsciiDigit	= 7;
			break;
		}
		case '八':
		{
			$AsciiDigit	= 8;
			break;
		}
		case '九':
		{
			$AsciiDigit	= 9;
			break;
		}
		case '十':
		{
			$AsciiDigit	= 10;
			break;
		}
		default:
		{
			$AsciiDigit	= $Digit;
			break;
		}
	}

	return $AsciiDigit;
}

/////////////////////////////////////////////////////////////////////////
// DoesPptPropertyExist
/////////////////////////////////////////////////////////////////////////
function DoesPptPropertyExist($Type, $Ku, $Area, $Address1, $Address2,
	$Address3, $BuildingName, $BuildingNameJ, $UnitNumber)
{
	DebugEcho("DoesPptPropertyExist - Begin");
	$PptPropertyId	= 0;

	if ($Type == 2)
	{
		$PptBuilding	= new ppt_sale_building();
		$PptProperty	= new ppt_sale_property();
	}
	else
	{
		$PptBuilding	= new ppt_rent_building();
		$PptProperty	= new ppt_rent_property();
	}

	$PptBuildingId	= $PptBuilding->DoesBuildingExist($Ku,
														$Area,
														$Address1,
														$Address2,
														$Address3);

	if ($PptBuildingId > 0)
	{
		$PptPropertyId	= $PptProperty->DoesPropertyExist($PptBuildingId,
														$UnitNumber);
	}

	DebugEcho("DoesPptPropertyExist - End");
	return $PptPropertyId;
}

/////////////////////////////////////////////////////////////////////////
// fgetcsv_reg
/////////////////////////////////////////////////////////////////////////
 function fgetcsv_reg(&$handle, $length = null, $d = ',', $e = '"')
{
	$eof = false;
	$d = preg_quote($d);
	$e = preg_quote($e);
	$_line = "";
	while ($eof != true)
	{
		$_line .= (empty($length) ? fgets($handle) : fgets($handle, $length));
		$itemcnt = preg_match_all('/'.$e.'/', $_line, $dummy);
		if ($itemcnt % 2 == 0)
			$eof = true;
	}
	$_csv_line = preg_replace('/(?:\r\n|[\r\n])?$/', $d, trim($_line));
	$_csv_pattern = '/('.$e.'[^'.$e.']*(?:'.$e.$e.'[^'.$e.']*)*'.$e.'|[^'.$d.']*)'.$d.'/';
	preg_match_all($_csv_pattern, $_csv_line, $_csv_matches);
	$_csv_data = $_csv_matches[1];
	for($_csv_i=0;$_csv_i<count($_csv_data);$_csv_i++)
	{
		$_csv_data[$_csv_i]=preg_replace('/^'.$e.'(.*)'.$e.'$/s','$1',$_csv_data[$_csv_i]);
		$_csv_data[$_csv_i]=str_replace($e.$e, $e, $_csv_data[$_csv_i]);
	}
	return empty($_line) ? false : $_csv_data;
}

/////////////////////////////////////////////////////////////////////////
// FindAddressSplitCode
/////////////////////////////////////////////////////////////////////////
function FindAddressSplitCode($Address)
{
	$Code	= " ";
	$CodePosition	= mb_strpos($Address, "丁目");
	if ($CodePosition !== false)
	{
		$Code	= "丁目";
	}
	else
	{
		$CodePosition	= mb_strpos($Address, "−");
		if ($CodePosition !== false)
		{
			$Code	= "−";
		}
		else
		{
			$CodePosition	= mb_strpos($Address, "－");
			if ($CodePosition !== false)
			{
				$Code	= "－";
			}
			else
			{
				$CodePosition	= mb_strpos($Address, "ー");
				if ($CodePosition !== false)
				{
					$Code	= "ー";
				}
				else
				{
					$CodePosition	= mb_strpos($Address, "番");
					if ($CodePosition !== false)
					{
						$Code	= "番";
					}
				}
			}
		}
	}
	
	DebugEcho(__LINE__.": AddressSplitCode: ".$Code);
	return $Code;
}

/////////////////////////////////////////////////////////////////////////
// GetAreaId
/////////////////////////////////////////////////////////////////////////
function GetAreaId($AreaName)
{
	$AreaObject	= new ad_area();
	$AreaRecord	= $AreaObject->GetArea($AreaName);
	$AreaId		= $AreaRecord['areaid'];
	
	return $AreaId;
}

/////////////////////////////////////////////////////////////////////////
// GetAvailability
/////////////////////////////////////////////////////////////////////////
function GetAvailability($Contents)
{
	$Availability	= "";

	if ("即時" == $Contents)
	{
		$Availability	= "Now";
	}
	else
	{
		// 相談 = Negotiable (we don’t have a negotiable so don’t need)
		// 2009/11/上旬 = Nov,Beg,2009 YES
		// 2009/11/中旬 = Nov,Mid, 2009 YES
		// 2009/11/下旬 = Nov,End,2009 YES
		// Sometimes data in our system is like this – Apr,20,2009 or Nov,,2009

		if (10 < mb_strlen($Contents))
		{
			// Sometimes date AND comments too long, so cut off comments
			$TempAvailabilityParts	= explode('月', $Contents);
			//DebugEcho("TempAvailabilityParts");
			//DebugPrint($TempAvailabilityParts);
			$Availability		= $TempAvailabilityParts[0];
		}
		else
		{
			$Availability	= $Contents;
		}
	}

	return $Availability;
}

/////////////////////////////////////////////////////////////////////////
// GetBedrooms
/////////////////////////////////////////////////////////////////////////
function GetBedrooms($Rooms, &$Bedrooms, &$Den, &$Family, &$Maid,
	&$PlayRoom, &$Study, &$Tatami)
{
	if ('' == $Rooms)
	{
		$Bedrooms	= 0;
	}
	elseif (($Rooms == "1R") || ($Rooms == "1R"))
	{
		// studio
		$Bedrooms = 0;
	}
	else
	{
		$Bedrooms = (int)$Rooms;

		$Position	= stripos($Rooms, "D");
		if ($Position !== false)
		{
			$Den	= 1;
			DebugEcho(__LINE__.": Den: ".$Den);
		}

		$Position	= stripos($Rooms, "F");
		if ($Position !== false)
		{
			$Family	= 1;
			DebugEcho(__LINE__.": Family: ".$Family);
		}

		$Position	= stripos($Rooms, "M");
		if ($Position !== false)
		{
			$Maid	= 1;
			DebugEcho(__LINE__.": Maid: ".$Maid);
		}

		$Position	= stripos($Rooms, "P");
		if ($Position !== false)
		{
			$Playroom	= 1;
			DebugEcho(__LINE__.": Playroom: ".$Playroom);
		}

		$Position	= stripos($Rooms, "S");
		if ($Position !== false)
		{
			$Study	= 1;
			DebugEcho(__LINE__.": Study: ".$Study);
		}

		$Tatami	= stripos($Rooms, "T");
		if ($Position !== false)
		{
			$Tatami	= 1;
			DebugEcho(__LINE__.": Tatami: ".$Tatami);
		}
	}
	DebugEcho(__LINE__.": Bedrooms: ".$Bedrooms);
}

/////////////////////////////////////////////////////////////////////////
// GetBuildingName
//
// If it only contains ASCII characters, then it is copied into both, the
// English and Japanese, otherwise just Japanese.
/////////////////////////////////////////////////////////////////////////
function GetBuildingName($OriginalName, &$EnglishName, &$JapaneseName)
{
	$Result	= IsNonAsciiString($OriginalName);

	if (TRUE == $Result)
	{
		$JapaneseName	= $OriginalName;
		$EnglishName	= "";
	}
	else
	{
		$JapaneseName	= $OriginalName;
		$EnglishName	= $OriginalName;
	}

	DebugEcho(__LINE__.": building_buildingnamej: ".$JapaneseName);
	DebugEcho(__LINE__.": building_buildingname: ".$EnglishName);
}

/////////////////////////////////////////////////////////////////////////
// GetContactNames
/////////////////////////////////////////////////////////////////////////
function GetContactNames($Contact, &$FamilyName, &$GivenName)
{
	$NameParts	= explode('　', $Contact);
	$FamilyName	= $NameParts[0];

	if (count($NameParts) > 1)
	{
		$GivenName	= $NameParts[1];
	}
}

/////////////////////////////////////////////////////////////////////////
// GetContractType
/////////////////////////////////////////////////////////////////////////
function GetContractType($Contract)
{
	if ('' == $Contract)
	{
		$ContractType	= 6;	// Normal
	}
	if ('定' == $Contract)
	{
		$ContractType	= 7;	// Fixed
	}
	else
	{
		$ContractType	= 6;	// Normal
	}
	
	return $ContractType;
}

/////////////////////////////////////////////////////////////////////////
// GetCsvFileType
/////////////////////////////////////////////////////////////////////////
define("CSV_TYPE_REINS", 1);
define("CSV_TYPE_TATEMONO", 2);
define("CSV_TYPE_MITSUI", 3);

function GetCsvFileType($FileName)
{
	$CsvFileType	= 0;

	$Handle = fopen($FileName, "r");
	
	if (FALSE != $Handle)
	{
		// get the first row and check
		if (($data = fgetcsv_reg($Handle)) !== FALSE)
		{
			$Test	= $data[0];
			DebugEcho("GetCsvFileType - Test: ".$Test);
			$Marker	= mb_convert_encoding($Test, "UTF-8",
				"ASCII,JIS,UTF-8,EUC-JP,SJIS,eucjp-win,sjis-win,ISO-2022-JP,ISO-2022-JP-MS,Shift_JIS");
			DebugEcho("GetCsvFileType - Marker: ".$Marker);

			if ($Marker == "物件番号")
			{
				DebugEcho(__LINE__.": Type: CSV_TYPE_REINS");
				$CsvFileType	= CSV_TYPE_REINS;
			}
			elseif ($Marker == "東京建物不動産販売株式会社　賃貸営業部　空室物件一覧")
			{
				DebugEcho(__LINE__.": Type: CSV_TYPE_TATEMONO");
				$CsvFileType	= CSV_TYPE_TATEMONO;
			}
			elseif ($Marker == "週報ｸﾞﾙｰﾌﾟNO")
			{
				DebugEcho(__LINE__.": Type: CSV_TYPE_MITSUI");
				$CsvFileType	= CSV_TYPE_MITSUI;
			}
			elseif ($Marker == "路線")
			{
				DebugEcho(__LINE__.": Type: CSV_TYPE_MITSUI");
				$CsvFileType	= CSV_TYPE_MITSUI;
			}
			else
			{
				DebugEcho("Checking: ".$Marker);
				$SepPos	= mb_strpos($Marker, "報ｸﾞﾙｰﾌﾟNO");
				if ($SepPos !== false)
				{
					DebugEcho(__LINE__.": Type: CSV_TYPE_MITSUI");
					$CsvFileType	= CSV_TYPE_MITSUI;
				}
			}
		}

		fclose($Handle);
	}
	
	return $CsvFileType;
}

/////////////////////////////////////////////////////////////////////////
// GetEndAddresses
/////////////////////////////////////////////////////////////////////////
function GetEndAddresses($Address, &$Address1, &$Address2, &$Address3)
{
	$ResultCode	= FALSE;
	$SplitCode	= FindAddressSplitCode($Address);
	DebugEcho(__LINE__.": SplitCode: ".$SplitCode);

	$Addresses	= explode($SplitCode, $Address);
	DebugEcho(__LINE__.": Addresses");
	DebugPrint($Addresses);

	$Address1	= ConvertDigits($Addresses[0]);
	$Address1	= ConvertKanjiDigit($Address1);
	
	DebugEcho(__LINE__.": Address1: ".$Address1);

	$DashCount	= count($Addresses);
	DebugEcho(__LINE__.": DashCount: ".$DashCount);
	if ($DashCount > 2)
	{
		$Address2	= ConvertDigits($Addresses[1]);
		DebugEcho(__LINE__.": Address2: ".$Address2);
		$Address3	= ConvertDigits($Addresses[2]);
		DebugEcho(__LINE__.": Address3: ".$Address3);

		$ResultCode	= TRUE;
	}
	else
	{
		DebugEcho(__LINE__.": Dashes 2 or less");
		if ($DashCount > 1)
		{
			DebugEcho(__LINE__.": Dashes greater then 1");
			$SepPos	= mb_strpos($Addresses[1], "番");
			if ($SepPos !== false)
			{
				DebugEcho(__LINE__.": Separator: 番");
				$Addresses2	= explode('番', $Addresses[1]);
				DebugEcho("addresses2");
				DebugPrint($Addresses2);
				$Address2	= ConvertDigits($Addresses2[0]);
				DebugEcho(__LINE__.": Address2: ".$Address2);

				$DashCount	= count($Addresses2);
				if ($DashCount > 1)
				{
					//$building_address3	= mb_substr($Address2[1], 1);
					$Address3	= $Addresses2[1];
					$Address3	= str_replace("号", "", $Address3);
					$Address3	= ConvertDigits($Address3);
					DebugEcho(__LINE__.": building_address3: ".$Address3);
				}
				$ResultCode	= TRUE;
			}
			else
			{
				DebugEcho(__LINE__.": Checking Separator: －");
				$ResultCode	= ParseAddressEndSegment($Addresses[1], "－", $Address2,
					$Address3);
				
				if ($ResultCode	== FALSE)
				{
					DebugEcho(__LINE__.": Checking Separator: ー");
					$ResultCode	= ParseAddressEndSegment($Addresses[1], "ー", $Address2,
						$Address3);
					
					if ($ResultCode	== FALSE)
					{
						DebugEcho(__LINE__.": Checking Separator: −");
						$ResultCode	= ParseAddressEndSegment($Addresses[1], "−", $Address2,
							$Address3);
					
						if ($ResultCode	== FALSE)
						{
							// no separator
							DebugEcho(__LINE__.": Addresses[1]: ".$Addresses[1]);
							$TestNum	= ConvertDigits(trim($Addresses[1]));
							DebugEcho(__LINE__.": $TestNum: ".$TestNum);
							if (is_numeric($TestNum))
							{
								DebugEcho(__LINE__.": TestNum is int ");
								$Address2	= ConvertDigits(trim($Addresses[1]));
								$Address3	= "";
								$ResultCode	= TRUE;
							}
							else
							{
								DebugEcho(__LINE__.": TestNum is not int ");
								if (($Addresses[1] == "－") || ($Addresses[1] == "‐"))
								{
									$Address2	= "";
									$Address3	= "";
									$ResultCode	= TRUE;
								}
							}
						}
					}
				}
			}
		}
	}

	DebugEcho(__LINE__.": ResultCode: ".(int)$ResultCode);
	return $ResultCode;
}

/////////////////////////////////////////////////////////////////////////
// GetFloor
/////////////////////////////////////////////////////////////////////////
function GetFloor($RoomNumber)
{
	// Remove any letters
	$RoomNumber	= (int)$RoomNumber;
	// Remove last 2 digits
	$RoomNumber	= substr($RoomNumber, 0, strlen($RoomNumber)-2);
	return $RoomNumber;
}

/////////////////////////////////////////////////////////////////////////
// GetInt4dEx
/////////////////////////////////////////////////////////////////////////
function GetInt4dEx($data, $pos)
{
	//32/64bit architecture code:
	$_or_24 = ord($data[$pos+3]);

	if ($_or_24>=128)
		$_ord_24 = -abs((256-$_or_24) << 24);
	else
		$_ord_24 = ($_or_24&127) << 24;

	return ord($data[$pos]) | (ord($data[$pos+1]) << 8) | (ord($data[$pos+2]) << 16) | $_ord_24;
}

/////////////////////////////////////////////////////////////////////////
// GetKuId
/////////////////////////////////////////////////////////////////////////
function GetKuId($KuName)
{
	$KuObject	= new ad_ku();
	$KuRecord	= $KuObject->FindRecord($KuName);
	$KuId		= $KuRecord['kuid'];
	
	return $KuId;
}

/////////////////////////////////////////////////////////////////////////
// GetParkingFees
/////////////////////////////////////////////////////////////////////////
function GetParkingFees($ParkingFeeRange, &$MinParkingFee, &$MaxParkingFee)
{

	$ParkingFeeRange	= trim($ParkingFeeRange);

	if (($ParkingFeeRange != "") && ($ParkingFeeRange != "　"))
	{
		$ParkingFeeRange = str_replace(",", "", $ParkingFeeRange);
		$ParkingFeeRange = str_replace("円", "", $ParkingFeeRange);
		DebugEcho(__LINE__.": ParkingFeeRange: ".$ParkingFeeRange);

		$SplitPos	= mb_stripos($ParkingFeeRange, "～");
		if ($SplitPos !== false)
		{
			$ParkingFees	= explode('～', $ParkingFeeRange);
		}
		else
		{
			$SplitPos	= mb_stripos($ParkingFeeRange, "〜");
			if ($SplitPos !== false)
			{
				$ParkingFees	= explode('〜', $ParkingFeeRange);
			}
			else
			{
				DebugEcho(__LINE__.": Can not find Parking Fees");
			}
		}

		if ((isset($ParkingFees)) && (0 < count($ParkingFees)))
		{
			//DebugEcho("ParkingFees");
			//DebugPrint($ParkingFees);
			$MinParkingFee	= trim($ParkingFees[0]);

			if (count($ParkingFees) > 1)
			{
				$MaxParkingFee	= trim($ParkingFees[1]);
			}
			else
			{
				$MaxParkingFee = $MinParkingFee;
			}
			DebugEcho(__LINE__.": MinParkingFee: ".$MinParkingFee);
			DebugEcho(__LINE__.": MaxParkingFee: ".$MaxParkingFee);
		}
		else
		{
			$MaxParkingFee = $MinParkingFee	= 0;
		}
	}
	else
	{
		$MaxParkingFee = $MinParkingFee	= 0;
	}
}

/////////////////////////////////////////////////////////////////////////
// GetPrefectureId
/////////////////////////////////////////////////////////////////////////
function GetPrefectureId($PrefectureName)
{
	$Prefecture	= new ad_prefecture();
	$PrefectureRecord	= $Prefecture->FindRecord($PrefectureName);
	$PrefectureId		= $PrefectureRecord['prefectureid'];

	DebugEcho("PrefectureId: ".$PrefectureId);

	return $PrefectureId;
}

/////////////////////////////////////////////////////////////////////////
// GetRentalType
/////////////////////////////////////////////////////////////////////////
function GetRentalType($UnitNumber)
{
	if (empty($UnitNumber))
	{
		// House
		$RentalType	= 2;
	}
	else
	{
		// Apartment
		$RentalType	= 1;
	}

	return $RentalType;
}

/////////////////////////////////////////////////////////////////////////
// GetStationId
/////////////////////////////////////////////////////////////////////////
function GetStationId($Station)
{
	$Station	= str_replace("（東京）", "", $Station);

	$StationObject	= new ad_station();
	$StationRecord	= $StationObject->FindRecord($Station);
	$StationId		= $StationRecord['stationid'];
	DebugEcho(__LINE__." StationId: ".$StationId);
	
	return $StationId;
}

/////////////////////////////////////////////////////////////////////////
// GetTrainLineId
/////////////////////////////////////////////////////////////////////////
function GetTrainLineId($TrainLine)
{
	// take out tokyo metro and the other metro
	// the order of these may matter!!
	$TrainLine	= str_replace("伊勢崎線", "東武伊勢崎線", $TrainLine);

	$TrainLine	= str_replace("東武東武伊勢崎", "東武伊勢崎線", $TrainLine);
	$TrainLine	= str_replace("東武鉄道東武東上", "東武東上線", $TrainLine);
	$TrainLine	= str_replace("東武鉄道東武東上", "東武東上線", $TrainLine);
	$TrainLine	= str_replace("東武鉄道東武伊勢崎", "東武伊勢崎線", $TrainLine);
	$TrainLine	= str_replace("東京都交通局都電荒川", "都電荒川線", $TrainLine);
	$TrainLine	= str_replace("東京都交通局都営", "", $TrainLine);
	$TrainLine	= str_replace("東京急行電鉄池上", "池上線", $TrainLine);
	$TrainLine	= str_replace("東京急行電鉄大井町", "大井町線", $TrainLine);
	$TrainLine	= str_replace("東京メトロ", "", $TrainLine);
	$TrainLine	= str_replace("東急", "", $TrainLine);
	$TrainLine	= str_replace("都営", "", $TrainLine);
	$TrainLine	= str_replace("総武中央線", "総武線", $TrainLine);
	$TrainLine	= str_replace("西武鉄道", "", $TrainLine);
	$TrainLine	= str_replace("西武池袋・豊島", "西武池袋線", $TrainLine);
	$TrainLine	= str_replace("常磐緩行線", "常磐線", $TrainLine);
	$TrainLine	= str_replace("小田急電鉄小田急小田原", "小田急小田原線", $TrainLine);
	$TrainLine	= str_replace("小田急線", "小田急小田原線", $TrainLine);
	$TrainLine	= str_replace("京浜東北線", "京浜東北", $TrainLine);
	$TrainLine	= str_replace("京王電鉄京王", "", $TrainLine);
	$TrainLine	= str_replace("つくばＥＸ", "つくばエクスプレス線", $TrainLine);
	$TrainLine	= str_replace("ＪＲ", "", $TrainLine);

	$SenPos	= mb_strpos($TrainLine, "線");
	if ($SenPos !== false)
	{
		$TrainLine	= mb_substr($TrainLine, 0, mb_strlen($TrainLine) - mb_strlen("線"));
	}

	DebugEcho(__LINE__.": GetTrainLineId::TrainLine: ".$TrainLine);

	$LineObject		= new ad_trainline();
	$LineRecord		= $LineObject->FindRecord($TrainLine);
	$TrainLineId	= $LineRecord['trainlineid'];

	return $TrainLineId;
}

/////////////////////////////////////////////////////////////////////////
// GetWebPage
/////////////////////////////////////////////////////////////////////////
function GetWebPage(
	$Url,
	$MethodType,
	$SendData,
	$SetCookieJar=FALSE)
{
	global $g_Debug;

	$CurlObject	= curl_init( $Url );

	global $g_DevType;
	if("Localhost" == $g_DevType)
	{
		$LocalPath	= "/temp";
	}
	else
	{
		$LocalPath = ROOT_DIR."HJ/DataImport/uploads/";
	}
	//if (TRUE == $SetCookieJar)
	{
		curl_setopt($CurlObject, CURLOPT_COOKIEJAR, "$LocalPath/cookieFileName");
	}
	//else
	{
		curl_setopt($CurlObject, CURLOPT_COOKIEFILE, "$LocalPath/cookieFileName");
	}

	curl_setopt($CurlObject, $MethodType, 1);

	if (CURLOPT_POST == $MethodType)
	{
		foreach($SendData as $key=>$value)
		{
			$fields[] = "$key=$value";
		};
		$SendData = implode("&", $fields);
		//file_put_contents("/temp/PostData.html", $SendData);
		curl_setopt($CurlObject, CURLOPT_POSTFIELDS, $SendData);
	}

	curl_setopt($CurlObject, CURLOPT_RETURNTRANSFER,	true);		// return web page
	curl_setopt($CurlObject, CURLOPT_HEADER, 			false);		// don't return headers
	curl_setopt($CurlObject, CURLOPT_FOLLOWLOCATION, 	true);		// follow redirects
	curl_setopt($CurlObject, CURLOPT_ENCODING, 			"");		// handle all encodings
	curl_setopt($CurlObject, CURLOPT_USERAGENT, 		"Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.9.1.5) Gecko/20091102 Firefox/3.5.5 (.NET CLR 1.0.3705; .NET CLR 1.1.4322; .NET CLR 2.0.50727; .NET CLR 3.0.04506.30; .NET CLR 3.0.04506.648; .NET CLR 3.0.4506.2152; .NET CLR 3.5.21022; .NET CLR 3.5.30729)");
	curl_setopt($CurlObject, CURLOPT_AUTOREFERER, 		true);		// set referer on redirect
	curl_setopt($CurlObject, CURLOPT_CONNECTTIMEOUT, 	120);		// timeout on connect
	curl_setopt($CurlObject, CURLOPT_TIMEOUT, 			120);		// timeout on response
	curl_setopt($CurlObject, CURLOPT_MAXREDIRS, 		10);		// stop after 10 redirects
	curl_setopt($CurlObject, CURLOPT_SSL_VERIFYPEER, FALSE);

	$headers[] = 'Accept: image/gif, image/x-bitmap, image/jpeg, image/pjpeg';
	$headers[] = 'Connection: Keep-Alive';
	$headers[] = 'Content-type: application/x-www-form-urlencoded;charset=UTF-8'; 	
	curl_setopt($CurlObject, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($CurlObject, CURLOPT_HEADER, 1);
	curl_setopt($CurlObject, CURLOPT_ENCODING , 'gzip');
	//curl_setopt($CurlObject, CURLINFO_HEADER_OUT, true);

	set_time_limit(35);
	$content = curl_exec( $CurlObject );
	//$Info = curl_getinfo($CurlObject, CURLINFO_HEADER_OUT);
	//file_put_contents("/temp/PostData2.html", $Info);

	$err     = curl_errno( $CurlObject );
	DebugEcho(__LINE__.": curl_errno: ".$err);
	$errmsg  = curl_error( $CurlObject );
	//DebugEcho("curl_error: ".$errmsg);
	$header  = curl_getinfo( $CurlObject );
	//DebugEcho("curl_getinfo: ".$header);
	curl_close( $CurlObject );

	$header['errno']   = $err;
	$header['errmsg']  = $errmsg;
	$header['content'] = $content;
	return $header;
}

/////////////////////////////////////////////////////////////////////////
// GetXlsFileType
/////////////////////////////////////////////////////////////////////////
define("XLS_TYPE_MITSUBISHI", 1);
define("XLS_TYPE_MITSUI", 2);

function GetXlsFileType($FileName)
{
	DebugEcho(__LINE__.": GetXlsFileType - Begin");
	$XlsFileType	= 0;

	$ExcelData = new ExcelReader($FileName, true, 'UTF-8');
	$Marker	= $ExcelData->val(1, 1);
	DebugEcho(__LINE__.": GetXlsFileType - Marker: ".$Marker);

	if ($Marker == "路線")
	{
		DebugEcho(__LINE__.": Type: Xls_TYPE_MITSUI");
		$XlsFileType	= XLS_TYPE_MITSUI;
	}
	else
	{
		$Marker	= $ExcelData->val(5, 1);
		DebugEcho("GetXlsFileType - Marker (5,1): ".$Marker);

		if ($Marker == "申込状況")
		{
			DebugEcho(__LINE__.": Type: XLS_TYPE_MITSUBISHI");
			$XlsFileType	= XLS_TYPE_MITSUBISHI;
		}

		// else fail
	}
	
	DebugEcho(__LINE__.": GetXlsFileType - End");
	return $XlsFileType;
}

/////////////////////////////////////////////////////////////////////////
// mb_str_split
/////////////////////////////////////////////////////////////////////////
function mb_str_split($str, $length = 1)
{
	if ($length < 1) return FALSE;

	$result = array();

	for ($i = 0; $i < mb_strlen($str); $i += $length)
	{
		$result[] = mb_substr($str, $i, $length);
	}

	return $result;
}

/////////////////////////////////////////////////////////////////////////
// ParseAddress
/////////////////////////////////////////////////////////////////////////
function ParseAddress($Address, &$Ku, &$Area, &$Address1, &$Address2,
	&$Address3)
{
	$ResultCode			= FALSE;
	$RemainingAddress	= str_replace("東京都", "", $Address);
	DebugEcho("RemainingAddress: ".$RemainingAddress);

	$KuTest	= mb_substr($RemainingAddress, 0, 2);
	DebugEcho("KuTest: ".$KuTest);

	$KuObject	= new ad_ku();
	$AreaObject	= new ad_area();
	$KuRecord	= $KuObject->FindRecord($KuTest);
	$KuName		= $KuRecord['kuj'];
	$Ku			= $KuRecord['kuid'];
	if ($Ku != '' && $Ku > 0)
	{
		$RemainingAddress	= mb_substr($RemainingAddress, mb_strlen($KuName));
		DebugEcho(__LINE__.": RemainingAddress: ".$RemainingAddress);

		// Ku gone... Now get the Area and take it out
		// Open to suggestions on more elegant ways...
		$AreaTest1	= mb_substr($RemainingAddress, 0, 1);

		if (($AreaTest1 == "錦") || ($AreaTest1 == "湊") ||
			($AreaTest1 == "寿") || ($AreaTest1 == "芝") || 
			($AreaTest1 == "緑") || ($AreaTest1 == "桜") || 
			($AreaTest1 == "佃") || ($AreaTest1 == "砧"))
		{
			$AreaName	= $AreaTest1;
			$AreaRecord	= $AreaObject->GetArea($AreaName);
			$Area		= $AreaRecord['areaid'];
		}
		else
		{
			$AreaTest	= mb_substr($RemainingAddress, 0, 2);
			DebugEcho(__LINE__.": AreaTest: ".$AreaTest);
			DebugHex($AreaTest);

			$AreaCount	= $AreaObject->GetCount($AreaTest);
			DebugEcho(__LINE__.": AreaCount: ".$AreaCount);
			if ($AreaCount > 1)
			{
				// Try to get only one match, so try a longer name
				$AreaTest2	= mb_substr($RemainingAddress, 0, 3);
				DebugEcho(__LINE__.": AreaTest2: ".$AreaTest2);
				$AreaCount2	= $AreaObject->GetCount($AreaTest2);

				// TODO: This should be cyclical check
			}

			// if more then one, go for the first of longer ones
			if (($AreaCount > 1) && ($AreaCount2 > 0))
			{
				$AreaRecord	= $AreaObject->FindRecord($AreaTest2);
				$AreaName	= $AreaRecord['areaj'];
				$Area		= $AreaRecord['areaid'];
			}
			else
			{
				$AreaRecord	= $AreaObject->FindRecord($AreaTest);
				$AreaName	= $AreaRecord['areaj'];
				$Area		= $AreaRecord['areaid'];
			}
		}

		DebugEcho(__LINE__.": Area: ".$Area);
		if ($Area != '' && $Area > 0)
		{
			$RemainingAddress	= mb_substr($RemainingAddress, mb_strlen($AreaName));

			DebugEcho(__LINE__.": RemainingAddress: ".$RemainingAddress);

			$ResultCode = GetEndAddresses($RemainingAddress, $Address1, $Address2, $Address3);
		}
	}
	
	$Address1	= trim($Address1);
	$Address2	= trim($Address2);
	$Address3	= trim($Address3);

	DebugEcho(__LINE__.": ResultCode: ".(int)$ResultCode);
	return $ResultCode;
}

/////////////////////////////////////////////////////////////////////////
// ParseAddressEndSegment
/////////////////////////////////////////////////////////////////////////
function ParseAddressEndSegment($AddressLine, $Separator, &$Address2,
	&$Address3)
{
	$ResultCode	= FALSE;
	$SepPos	= mb_strpos($AddressLine, $Separator);
	if ($SepPos !== false)
	{
		DebugEcho(__LINE__.": checking: ".$AddressLine);
		$Addresses2	= explode($Separator, $AddressLine);
		DebugPrint($Addresses2, "addresses2");
		if (empty($Addresses2[0]))
		{
			$Address2	= ConvertDigits($Addresses2[1]);
			$Address3	= "";
			DebugEcho(__LINE__.": Address2: ".$Address2);
			$ResultCode	= TRUE;
		}
		else
		{
			$Address2	= ConvertDigits($Addresses2[0]);
			DebugEcho(__LINE__.": Address2: ".$Address2);

			$DashCount	= count($Addresses2);
			if ($DashCount > 1)
			{
				//$building_address3	= mb_substr($Address2[1], 1);
				$Address3	= $Addresses2[1];
				$Address3	= str_replace($Separator, "", $Address3);
				$Address3	= ConvertDigits($Address3);
				DebugEcho(__LINE__.": Address3: ".$Address3);
			}
			$ResultCode	= TRUE;
		}
	}

	//DebugEcho(__LINE__.": ResultCode: ");
	//var_dump($ResultCode);
	//DebugEcho("");
	return $ResultCode;
}

function TestEncodingType($Test)
{
	DebugEcho(__LINE__.": TestEncodingType - Test: ".$Test);
	$Type	= mb_detect_encoding($Test);
	DebugEcho(__LINE__.": TestEncodingType - Type: ".$Type);
	$Type	= mb_detect_encoding($Test, "ASCII,JIS,UTF-8,EUC-JP,SJIS,eucjp-win,sjis-win");
	DebugEcho(__LINE__.": TestEncodingType - Type: ".$Type);
	$Type	= mb_detect_encoding($Test,mb_detect_order(), TRUE);
	DebugEcho(__LINE__.": TestEncodingType - Type: ".$Type);
	$Type	= mb_detect_encoding($Test, "ASCII,JIS,UTF-8,EUC-JP,SJIS,eucjp-win,sjis-win", TRUE);
	DebugEcho(__LINE__.": TestEncodingType - Type: ".$Type);
	$Type	= mb_detect_encoding($Test, "ASCII,JIS,UTF-8,EUC-JP,SJIS,eucjp-win,sjis-win,BIG5");
	DebugEcho(__LINE__.": TestEncodingType - Type: ".$Type);
	$Type	= mb_detect_encoding($Test, "ASCII,JIS,UTF-8,EUC-JP,SJIS,eucjp-win,sjis-win,GB2312");
	DebugEcho(__LINE__.": TestEncodingType - Type: ".$Type);
	//$Type	= mb_detect_encoding($Test, "ASCII,JIS,UTF-8,EUC-JP,SJIS,eucjp-win,sjis-win,BIG5-HKSCS");
	//DebugEcho(__LINE__.": TestEncodingType - Type: ".$Type);

	$hex_ary = array();
	foreach (str_split($Test) as $chr)
		$hex_ary[] = sprintf("%02X", ord($chr));
	$HexValues	=  implode(' ',$hex_ary);
	DebugEcho(__LINE__.": HexValues: ".$HexValues);

	$Int4d	= GetInt4dEx($Test, 0);
	DebugEcho(__LINE__.": Int4d: ".$Int4d);
	
	$Marker	= mb_convert_encoding($Test, "UTF-8", "ANSI,JIS,UTF-8,EUC-JP,SJIS,eucJP-win,SJIS-win,ISO-2022-JP");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "ANSI,JIS,UTF-8,EUC-JP,SJIS,eucJP-win,SJIS-win,ISO-2022-JP,BIG5,GB2312");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	//$Marker	= mb_convert_encoding($Test, "UTF-8", "ANSI");
	//DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "JIS");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "EUC-JP");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "SJIS");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "eucJP-win");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "SJIS-win");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "ISO-2022-JP");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "Shift_JIS");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);

	$Marker	= mb_convert_encoding($Test, "UTF-8", "BIG5");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "GB2312");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "EUC-CN");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "CP936");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "HZ");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "EUC-TW");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "CP950");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "BIG-5");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);

	// no good
	//$Marker	= mb_convert_encoding($Test, "UTF-8", "GB18030");
	//DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	//$Marker	= mb_convert_encoding($Test, "UTF-8", "Cp1381");
	//DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	
	$Marker	= mb_convert_encoding($Test, "UTF-8", "ISO-10646-UCS-4");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "ISO-10646-UCS-2");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "UTF-7");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);

	$Marker	= mb_convert_encoding($Test, "UTF-8", "UTF-32");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "UTF-32BE");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "UTF-32LE");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "UTF-16");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "UTF-16BE");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "UTF-8", "UTF-16LE");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	
	// no good
	//$Marker = iconv('JIS', 'UTF-8', $Test);
	//DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker = iconv('SJIS', 'UTF-8', $Test);
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker = iconv('sjis-win', 'UTF-8', $Test);
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);

	// no good
	//$Marker	= mb_convert_encoding($Test, "ANSI", "UTF-8");
	//DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "JIS", "UTF-8");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "EUC-JP", "UTF-8");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "SJIS", "UTF-8");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "eucJP-win", "UTF-8");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "SJIS-win", "UTF-8");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
	$Marker	= mb_convert_encoding($Test, "ISO-2022-JP", "UTF-8");
	DebugEcho(__LINE__.": TestEncodingType - Marker: ".$Marker);
}
?>
