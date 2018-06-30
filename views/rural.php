<?php include "../partials/header.php" ?>
<?php include "../functions.php" ?>
<?php 

	if(isset($_POST['submit'])){
		$ptc = cleanInput($_POST['ptc']);
		$team = cleanInput($_POST['team']);
		$level = cleanInput($_POST['level']);
		$location = cleanInput($_POST['role']);
		$flags = 0;

		$connection = mysqli_connect('localhost', 'root', '', 'pogoconnect');

		$query = "INSERT INTO trainers(ptc, team, level, location, flags) ";
		$query .= "VALUES ('$ptc', '$team', '$level', '$location', '$flags')";

		$result = mysqli_query($connection, $query);

		if($result){
			header('Location: city.php');
		}
	}

?>
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="form-group infoBox col-lg-8">
			<form action="<?php echo cleanInput($_SERVER["PHP_SELF"]);?>" method="POST">
				<?php 
					if(isset($_POST['submit'])){
						if(!$result){
							echo "Something went wrong";
						}
					}
				?>
				<p>Enter your Pokemon Trainer Code here to enter your account into our database. As gifters and getters use the site, they'll add you as a friend. If you're a gifter, please send any extra gifts you have to trainers who don't have access to as many stops. If you're a getter, appreciate some generosity. Both parties with receive experience for leveling up their friend level.</p>
				<div class="form-group">
					<label for="ptc">Pokemon Trainer Code:</label>
						<input name="ptc" type="text" maxlength="12" title="No spaces or dashes">
				</div>
				<div class="form-group">
					<label for="role">Role:</label>
						<select name="role" id="role">
							<option name="city" value="city">Give Gifts</option>
							<option name="rural" value="rural">Get Gifts</option>
						</select>
				</div>
				<p>Everything else is optional, other trainers can sort by these stats if they'd only like to send gifts to certain kinds of players. Entering your info will make it more likely they'll choose you!</p>
				<div class="form-group">
					<label for="team">Team:</label>
					<select name="team">
						<option name="NULL" id="NULL">Not Specified</option>
						<option name="Mystic" id="Mystic">Mystic</option>
						<option name="Valor" id="Valor">Valor</option>
						<option name="Instinct" id="Instinct">Instinct</option>
					</select>
				</div>
				<div class="form-group">
					<label for="level">Level:</label>
						<input name="level" type="number" min="0" max="40" title="1-40">
				</div>
				<div class="form-group">	
					<button type="submit" class="btn btn-primary" name="submit"><img class="giftImage" src="../images/pogoGift.jpg" alt="Gift">Enter Me In!<img class="giftImage" src="../images/pogoGift.jpg" alt="Gift"></button>
				</div>
			</form>		
		</div>
		<div class="col-lg-2"></div>
	</div>

<?php include "../partials/footer.php" ?>