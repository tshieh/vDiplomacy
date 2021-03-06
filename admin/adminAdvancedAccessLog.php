<?php

defined('IN_CODE') or die('This script can not be run by itself.');

$userIDs = $days = $gameIDs = $checkIPs = $checkIPsLong = '';

if ( isset($_REQUEST['userIDs']))
{
	foreach (explode(',',$_REQUEST['userIDs']) as $userID)
	{
		$userID=(int)$userID;
		if ($userID != 0)
			$allUserIDs[] = $userID;
	}
	if (isset($allUserIDs))
		$userIDs = implode (',',$allUserIDs);	
}

if ( isset($_REQUEST['gameIDs']))
{
	foreach (explode(',',$_REQUEST['gameIDs']) as $gameID)
	{
		$gameID=(int)$gameID;
		if ($gameID != 0)
			$allGameIDs[] = $gameID;
	}
	if (isset($allGameIDs))
		$gameIDs = implode (',',$allGameIDs);	
}	
	
if ( isset($_REQUEST['days']))
{
	$days=(int)$_REQUEST['days'];
}

if ( isset($_REQUEST['checkIPs']))
{
	foreach (explode(',',$_REQUEST['checkIPs']) as $checkIP)
	{
		$checkIPlong=ip2long($checkIP);
		if ($checkIPlong != 0)
		{
			$allIPs[] = $checkIP;
			$allIPsLong[] = $checkIPlong;
		}
	}
	if (isset($allIPs))
	{
		$checkIPs = implode (',',$allIPs);
		$checkIPsLong = implode (',',$allIPsLong);
	}
}

/**
 * Print a form for selecting which users to check
 */
print '<FORM method="get" action="admincp.php">
		<INPUT type="hidden" name="tab" value="AccessLog" />
		<TABLE>
		<TR><TD>User IDs:</TD><TD></STRONG><INPUT type="text" name="userIDs"  value="'.$userIDs .'" size="50" /></TD></TR>
		<TR><TD>IPs:</TD><TD></STRONG><INPUT type="text" name="checkIPs" value="'.$checkIPs.'" size="50" /></TD></TR>
		<TR><TD>GameIDs:</TD><TD></STRONG><INPUT type="text" name="gameIDs"  value="'.$gameIDs .'" size="50" /></TD></TR>
		<TR><TD><input type="submit" name="Submit" class="form-submit" value="Check" /></TD></TR>		
		</TABLE>
		<HR><STRONG>New users from the last </STRONG><INPUT type="text" name="days"  value="'. $days .'" size="5" /> days.
		<input type="submit" name="Submit" class="form-submit" value="Check" /><HR></form></P>';

if ($days != '')
{
	$sTime = time() - $days * (60*60*24);
	$sql = 'SELECT id, username, email, timeJoined
				FROM wD_Users
				WHERE timeJoined > '. $sTime .'
				ORDER BY id ASC';
	
	$tabl = $DB->sql_tabl($sql);
	
	print "<TABLE>";
	while ( list($userID, $username, $email, $timeJoined) = $DB->tabl_row($tabl) )
	{
		print '<TR><TD><a href="profile.php?userID='.$userID.'">'.$username.'</a></TD>';
		print '<TD>'.$email.'</TD>';
		print '<TD>'.gmstrftime("%a %d %b / %I:%M %p",$timeJoined).'</TD>';
		
		$sql_IPs = "SELECT ip FROM wD_AccessLog WHERE userID = ".$userID." GROUP BY ip";
		$tabl_IPs = $DB->sql_tabl($sql_IPs);
		$IPs=array();
		while ( list($IP) = $DB->tabl_row($tabl_IPs) )
			$IPs[]=$IP;
		print '<TD>';
		if (count($IPs) > 0)
		{
			list($IPcount) = $DB->sql_row("
				SELECT COUNT(*) FROM 
					(SELECT userID
						FROM wD_AccessLog
						WHERE ip IN ( ".implode(',',$IPs)." ) AND userID <> ".$userID."
					GROUP BY userID) AS IPmatch");
			print  ($IPcount > 0 ? 'IP:'.$IPcount:'');
		}
		print '</TD>';
		
		$sql_CCs = "SELECT cookieCode FROM wD_AccessLog WHERE userID = ".$userID." GROUP BY cookieCode";
		$tabl_CCs = $DB->sql_tabl($sql_CCs);
		$CCs=array();
		while ( list($CC) = $DB->tabl_row($tabl_CCs) )
			$CCs[]=$CC;
		print '<TD>';
		if (count($CCs) > 0)
		{
			list($CCcount) = $DB->sql_row("
				SELECT COUNT(*) FROM 
					(SELECT userID
						FROM wD_AccessLog
						WHERE cookieCode IN ( ".implode(',',$CCs)." ) AND userID <> ".$userID."
					GROUP BY userID) AS IPmatch");
			print  ($CCcount > 0 ? 'CC:'.$CCcount:'');
		}
		print '</TD>';
		
		print "<TD> <a href='admincp.php?tab=Multi-accounts&aUserID=".$userID."'>Check</a> </TD></TR>";
	}

	print "</TABLE>";

}
elseif ($userIDs.$checkIPsLong.$gameIDs != '')
{
	global $DB;
	/*
					WHERE ac.userID '.
					(isset($userIDs)?' IN ('.$userIDs.') ':' != 0 ').
					(isset($checkIPsLong)? ' AND ac.ip IN ('.$checkIPsLong.') ' : '').
					(isset($gameIDs)?      ' AND m.gameID IN ('.$gameIDs.') ' : '').'
	*/
	$sql = 'SELECT ac.userID, u.username, ac.request, ac.ip, ac.action, m.gameID, m.countryID
				FROM wD_AccessLogAdvanced ac
				LEFT JOIN wD_Members m ON (ac.memberID = m.id)
				LEFT JOIN wD_Users u ON (u.id = ac.userID)				
					WHERE ac.userID '.
					($userIDs != ''?' IN ('.$userIDs.') ':' != 0 ').
					($checkIPsLong != ''? ' AND ac.ip    IN ('.$checkIPsLong.') ' : '').
					($gameIDs      != ''? ' AND m.gameID IN ('.$gameIDs.') ' : '' ).'
				ORDER BY request ASC';
	
	$tabl = $DB->sql_tabl($sql);

	$timetable = array();
	$lastkey = 0;
	$lastday = '';
	
	while ( list($userID, $username, $time, $ip, $action, $gameID, $countryID) = $DB->tabl_row($tabl) )
	{
		if ($gameID != '')
			$game_users[$gameID][] = $userID;	
		$ip_users[$ip][] = $userID;
		

		if ($gameID != 0 && !isset($countries[$gameID]))
		{
			$Variant=libVariant::loadFromGameID($gameID);
			$countries[$gameID] = $Variant->countries;
		}
		
		$day = substr($time, 5,5);
		if ($day == $lastday)
			$day = '';
		else
			$lastday = $day;
			
		if ($lastkey != 0
			&& $timetable[$lastkey]['IP']        == $ip
			&& $timetable[$lastkey]['userID']    == $userID
			&& $timetable[$lastkey]['action']    == $action
			&& $timetable[$lastkey]['gameID']    == $gameID
			&& $timetable[$lastkey]['countryID'] == $countryID)
		{
			$timetable[$lastkey]['timeEnd'] = substr($time,11,5);
		}
		elseif ( !($action == 'Board' && $countryID == 0) )
		{
			$lastkey++;
			$timetable[$lastkey]=array(
				'day'      => $day,
				'timeStart'=> substr($time,11,5),
				'timeEnd'  => '',
				'IP'       => $ip,
				'userID'   => $userID,
				'username' => $username,
				'action'   => $action,
				'gameID'   => $gameID,
				'countryID'=> $countryID
			);
		}
	}
	
	asort ($ip_users);
	print '<BR>More than one user for one IPs used:
				<TABLE>
				<THEAD>
					<TH>IP</TH>
					<TH>count</TH>
					<TH>username(s)</TH>
				</THEAD>';
	foreach ($ip_users as $ip=>$ipuser)
	{
		$ipuser= array_unique($ipuser);
		if (count($ipuser) > 1)
		{
			print '<tr><td>'.long2ip($ip).'</td><td>'.count($ipuser).'</td><td>';
			foreach ($ipuser as $ipuserID)
			{
				$CheckUser = new User($ipuserID);
				print '<a href="profile.php?userID='.$CheckUser->id.'">'.$CheckUser->username.'</a> ';
			}
			print '</td></tr>';
		}
	}
	print '</TABLE>';

	asort ($game_users);
	print '<BR>More than one user in the same game:
				<TABLE>
				<THEAD>
					<TH>GameID</TH>
					<TH>count</TH>
					<TH>username(s)</TH>
				</THEAD>';
	foreach ($game_users as $game=>$gameuser)
	{
		$gameuser= array_unique($gameuser);
		if (count($gameuser) > 1)
		{
			print '<tr><td><A href="board.php?gameID='.$game.'">'.$game.'</A></td><td>'.count($gameuser).'</td><td>';
			foreach ($gameuser as $gameuserID)
			{
				$CheckUser = new User($gameuserID);
				print '<a href="profile.php?userID='.$CheckUser->id.'">'.$CheckUser->username.'</a> ';
			}
			print '</td></tr>';
		}
	}
	print '</TABLE>';

	print '<br>Timetable:
				<TABLE>
				<THEAD>
					<TH>day</TH>
					<TH>time</TH>
					<TH>ip</TH>
					<TH>username</TH>
					<TH>gameID</TH>
					<TH>country</TH>
				</THEAD>';
		
	foreach ($timetable as $row)
		print '<TR>
			<TD>'.$row['day'].'</TD>
			<TD>'.$row['timeStart'].($row['timeEnd'] != '' ? ' -> '.$row['timeEnd']:'').'</TD>
			<TD>'.long2ip($row['IP']).'</TD>
			<TD><A href="profile.php?userID='.$row['userID'].'">'.$row['username'].'</A></TD>'.
			($row['action'] == 'Board' ? 
				'<TD><A href="board.php?gameID='.$row['gameID'].'">'.$row['gameID'].'</A></TD>':
				'<TD colSpan=2>'.$row['action'].'</TD>').
			($row['countryID'] != 0 ? 
				'<TD>'.$countries[($row['gameID'])][($row['countryID'] - 1)].'</TD>':'<TD></TD>').
			'</TR>';
			
	print '</table>';
}
?>

