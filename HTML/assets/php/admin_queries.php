<?php


	function getGameHistory()
	{
		try
		{
			$db = new PDO('sqlite:assets/db/ewuscbb.db');
			$games = $db->query('SELECT Game_ID, Home, Away, Date, Time FROM Schedule');
			$db = NULL;

			foreach($games as $row)
			{
			  print "<tr><td><a href = admin_edit_game.php?id=".$row['Game_ID'].">" .$row['Game_ID']. "</a></td>";
			  print "<td>".(int)$row['Home']. "</td>";
			  print "<td>".(int)$row['Away']. "</td>";
			  print "<td>".$row['Date']."</td>";
			  print "<td>".$row['Time']."</td></tr>";
			}
		}
		catch(PDOException $e)
		{
			print 'Exception : '.$e->getMessage();
		}		
	}

// consolidate into 1 query?
	function getHomeStats()
	{
		$id  = (int)$_GET["id"];
		$db = new PDO("sqlite:assets/db/ewuscbb.db");
		$game = $db->query("SELECT First_Name, Last_Name, Points, FGM, FGA, TPM, TPA, FTM, FTA, Assists, Steals, Rebounds, Blocks FROM Player_Info join Schedule ON Team = Schedule.Home left outer join Player_Game_Stats on Schedule.Game_ID = Player_Game_Stats.Game_ID and Player_Game_Stats.Player_ID = Player_Info.Player_ID WHERE Schedule.Game_ID = " .$id);
		$db = NULL;

		foreach($game as $row)
		{
			  print "<tr><td>".$row['First_Name']. " " .$row['Last_Name']. "</td>";
		      print "<td>".$row['Points']."</td>";
		      print "<td>".$row['FGM']."</td>";
		      print "<td>".$row['FGA']."</td>";
		      print "<td>".$row['TPM']."</td>";
		      print "<td>".$row['TPA']."</td>";
		      print "<td>".$row['FTM']."</td>";
		      print "<td>".$row['FTA']."</td>";
		      print "<td>".$row['Assists']."</td>";
		      print "<td>".$row['Steals']."</td>";
		      print "<td>".$row['Rebounds']."</td>";
		      print "<td>".$row['Blocks']."</td></tr>";
		}
	}

	function getGameStats()
	{
		$id  = (int)$_GET["id"];
		$db = new PDO("sqlite:assets/db/ewuscbb.db");
		$game = $db->query("SELECT First_Name, Last_Name, Points, FGM, FGA, TPM, TPA, FTM, FTA, Assists, Steals, Rebounds, Blocks FROM Player_Info join Schedule ON Team = Schedule.Home OR Team = Schedule.Away left outer join Player_Game_Stats on Schedule.Game_ID = Player_Game_Stats.Game_ID and Player_Game_Stats.Player_ID = Player_Info.Player_ID WHERE Schedule.Game_ID = " .$id);
		$db = NULL;

		$stats = array();
		foreach($game as $row)
		{
			 $stats[] = $row;
		}
		echo json_encode($stats);
	}

	function getAwayStats()
	{
		$id  = (int)$_GET["id"];
		$db = new PDO('sqlite:assets/db/ewuscbb.db');
		$game = $db->query("SELECT First_Name, Last_Name, Points, FGM, FGA, TPM, TPA, FTM, FTA, Assists, Steals, Rebounds, Blocks FROM Player_Info join Schedule ON Team = Schedule.Away left outer join Player_Game_Stats on Schedule.Game_ID = Player_Game_Stats.Game_ID and Player_Game_Stats.Player_ID = Player_Info.Player_ID WHERE Schedule.Game_ID = " .$id);
		
		$db = NULL;

		foreach($game as $row)
		{
			  print "<tr><td>".$row['First_Name']. " " .$row['Last_Name']. "</td>";
		      print "<td>".$row['Points']."</td>";
		      print "<td>".$row['FGM']."</td>";
		      print "<td>".$row['FGA']."</td>";
		      print "<td>".$row['TPM']."</td>";
		      print "<td>".$row['TPA']."</td>";
		      print "<td>".$row['FTM']."</td>";
		      print "<td>".$row['FTA']."</td>";
		      print "<td>".$row['Assists']."</td>";
		      print "<td>".$row['Steals']."</td>";
		      print "<td>".$row['Rebounds']."</td>";
		      print "<td>".$row['Blocks']."</td></tr>";
		}
	}

	function getPlayers() 
	{
		try
		{
			$db = new PDO('sqlite:assets/db/ewuscbb.db');
			$games = $db->query('SELECT Player_ID, Last_Name, First_Name FROM Player_Info');
			$db = NULL;

			foreach($games as $row)
			{
				print '<tr onclick="admin_edit_player.php?id=' .$row['Player_ID']. '"><td>' .$row['Last_Name']. '</td>';
			  	print "<td>" .$row['First_Name']. "</a></td></tr>";
			  	//print "<tr><td><a href = admin_edit_player.php?id=" .$row['Player_ID']. ">" .$row['Last_Name']. "</a></td>";
			  //	print "<td><a href = admin_edit_player.php?id=" .$row['Player_ID']. ">" .$row['First_Name']. "</a></td></tr>";
			}
		}
		catch(PDOException $e)
		{
			print 'Exception : '.$e->getMessage();
		}		
	}


	function getSeasons() 
	{
		try
		{
			  print "<tr><td><a href = admin_manage_season.php?id=1</a>1</td>";
			  print "<td>11/11/2011<td>";
			  print "<td>4/26/2015<td><tr>";
			
		}
		catch(PDOException $e)
		{
			print 'Exception : '.$e->getMessage();
		}		
	}
?>


<!--

$("#search").on("keyup", function() {
    var value = $(this).val();

    $("table tr").each(function(index) {
        if (index !== 0) {

            $row = $(this);

            var id = $row.find("td:first").text();

            if (id.indexOf(value) !== 0) {
                $row.hide();
            }
            else {
                $row.show();
            }
        }
    });
});

Select * from Player_Game_Stats natural join Player_Info WHERE Game_ID == 2
-->