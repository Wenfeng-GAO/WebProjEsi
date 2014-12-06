<section class="section">

	<?php
	$account_index = 0;
	$account_lastname = "";
	$account_firstname = "";
	$account_username = "";
	
	// connect to the database, get the $link variable
	include 'includes/connection.inc.php';
	$result = $link->query ( "SELECT account_lastname, account_firstname, account_username FROM accounts WHERE 1" );
	$sql_count = $link->query("SELECT COUNT(account_id) FROM accounts");
	if (! ($result && $sql_count)) {
		throw new Exception ( "Database Error" );
	} else {
		if($tmp = $sql_count->fetch_assoc()) {
			$account_number = $tmp['COUNT(account_id)'];
			echo "<h3><span id=\"chercheur_list_title\">We have <span>$account_number</span> chercheurs in total:</span></h3>";
		}
		echo "<table id=\"table_head_chercheur\"><tr><th id=\"index_th\"></th><th>Nom</th><th>Prenom</th><th>Username</th></tr></table>";
		while ( $row = $result->fetch_assoc ()) {
			$account_index ++;
			$account_lastname = $row ['account_lastname'];
			$account_firstname = $row ['account_firstname'];
			$account_username = $row ['account_username'];
			echo "<table id=\"table_data_chercheur\"><tr><td class=\"index_td\">$account_index</td><td class=\"td\">$account_lastname</td><td class=\"td\">$account_firstname</td><td class=\"td\">$account_username</td></tr></table>";		
		}
	}
	?>
	
</section>

