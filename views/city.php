<?php include "../partials/header.php" ?>
<?php include "../functions.php" ?>

<?php 

//Getting trainers from DB
if(isset($_GET['submit'])){

	$team = cleanInput($_GET['team']);
	$level = cleanInput($_GET['level']);
	$role = cleanInput($_GET['role']);

	//initialize query string
	$query = "SELECT * FROM trainers ";

	// Option for choosing players by team
	switch ($team) {
    case "Not Specified":
        break;
    case "Mystic":
        $query .= " WHERE team='Mystic' ";
        break;
    case "Valor":
        $query .= " WHERE team='Valor' ";
        break;
    case "Instinct":
        $query .= " WHERE team='Instinct' ";
        break;
    default:
        break;
    }


    //Option for choosing players by level
    switch ($level) {
    case "Not Specified":
        break;
    case "1-10":
        $query .= " WHERE level BETWEEN 1 AND 10";
        break;
    case "11-20":
        $query .= " WHERE level BETWEEN 11 AND 20";
        break;
    case "21-30":
        $query .= " WHERE level BETWEEN 21 AND 30";
        break;
    case "31-40":
        $query .= " WHERE level BETWEEN 3 AND 40";
        break;
    default:
        break;
    }

    //Load role
    if($role=="rural"){
    	$query .=" WHERE location = 'rural' ";
    } else if($role=="city"){
    	$query .=" WHERE location = 'city' ";
    }

	$query .= " ORDER BY RAND() LIMIT 5";

	//Result of SQL query
	$connection = mysqli_connect('localhost', 'root', '', 'pogoconnect');
	$result = mysqli_query($connection, $query);
}
?>


	  	<div class="infoBox">
			<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="get">
		  		<p>Find real trainers who are willing to give gifts or are looking to receive gifts. Make sure to select giver or receives, then optionally filter these results by team or level.</p>
		  		<label for="role">Role:</label>
					<select name="role">
						<option name="rural" id="rural" value="rural">Load gift Receivers</option>
						<option name="city" id="city" value="city">Load gift Givers</option>
					</select>
				<br>
				<label for="level">Level:</label>
					<select name="level">
						<option name="NULL" id="NULL">Not Specified</option>
						<option name="low" id="low">1-10</option>
						<option name="mid" id="mid">11-20</option>
						<option name="late" id="late">21-30</option>
						<option name="end" id="end">31-40</option>
					</select>
				<br>
		  		<label for="team">Team:</label>
					<select name="team">
						<option name="NULL" id="NULL">Not Specified</option>
						<option name="Mystic" id="Mystic">Mystic</option>
						<option name="Valor" id="Valor">Valor</option>
						<option name="Instinct" id="Instinct">Instinct</option>
					</select>
				<br>
				
		  		<button class="btn btn-success" type="submit" name="submit">Generate Trainer Codes</button>
		  	</form>
	  	</div>
	  	<!-- Results Box -->
	  	<?php if(isset($_GET['submit'])){ ?>
		  	<div class="infoBox">
			  	<?php if(!$result) {
			  		//if no results were found
		  			echo "No trainers found with that criteria";
		  		} else { ?>
		  			<iframe name="votar" style="display:none;"></iframe>
			  		<form action="../routes/flags.php" method="post" target="votar">
			  			<!-- build table for results -->
				  		<table id="cityTable">
				  				<tr>
				  					<th>Trainer Code</th>
				  					<th>Level</th>
				  					<th>Team</th>
				  					<th>Role</th>
				  					<th>Clear</th>
				  					<th title="Use this if a trainer cannot receive more friends">Report</th>
				  				</tr>

					  		<?php 
					  			while($row = mysqli_fetch_assoc($result)){ ?>
					  				<tr>
					  					<td><?php echo $row['ptc']; ?> </td>
					  					<td><?php echo $row['level']; ?> </td>
					  					<td><?php echo $row['team']; ?> </td>
					  					<td><?php
					  						if($row['location']=="city"){
					  							echo "Giver";
					  						} else if($row['location']=="rural") {
					  							echo "Receiver";
					  						}
					  					  ?></td>
					  					<td><button class="btn btn-success clearButton" type="submit" name="flag">X</button> </td>
					  					<!-- TODO: implement flags -->
						  				<td><button class="btn btn-warning flagButton" type="submit" name="flag" id=<?php echo $row['id']; ?> >X</button> </td>
					  				</tr>
					  			<?php }	?>
				  		</table>
			  		</form>
		  		<?php }	?>
		  	</div>
	  	<?php } ?>
	</div>

<?php include "../partials/footer.php" ?>