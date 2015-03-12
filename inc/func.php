<?PHP
//                                                                                             
//                                                      F a u s f l o o r   F u n c t i o n s  
//                                                                                             

// contact us form submission
if(isset($_GET['contact'])){
	// first section
	$name  = strip_tags($_POST['ggNAME']);
	$email = $_POST['ggEMAIL'];
	$phone = strip_tags($_POST['ggPHONE']);
	$qANDc = strip_tags($_POST['ggQNCS']);
	$sub   = "Faus Website Contact Form - " . $_POST['ggSUBJECT'];
	// determine who recieves the message based on the subject
	switch($_POST['ggSUBJECT']){
		case "Customer Service": $sendto = "jsorce@qep.com"; break;
		case "Product Information": $sendto = "bward@qep.com"; break; //rtester@qep.com
		case "Technical/Warranty": $sendto = "bward@qep.com"; break; //rtester@qep.com
		case "Other": $sendto = "jsorce@qep.com"; break;
	}
	// clean some stuff up
	$contact = "phone: $phone";
	// prepare the email
	$body  = "$name - $email\n$phone \n\nQuestions or Comments\n$qANDc";
	$from   = "From: $name <$email>";
	// send the email
	if(mail($sendto, $sub, $body, $from, '-f $sendto')){
		echo "1";
	} else {
		echo "2";
	}
}

// wtb function
if(isset($_GET['wtb']) && $_GET['wtb'] == 'check'){
	include "dbc.php";
	$temp = $_GET['latlon'];
	$temp = str_replace("(", "", $temp);
	$temp = str_replace(")", "", $temp);
	$temp = explode(", ", $temp, 2);
	$latty = $temp[0];
	$longy = $temp[1];
	$rad = str_replace(" miles", "", $_GET['radius']);
	/*$query = "SELECT dist.cust_name, dist.addy,	dist.city, dist.state, dist.zip, dist.phone, dist.lat, dist.lon, dist.website, dist.rank,
				( 3959 * acos( cos( radians( $latty ) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians( $longy ) ) + sin( radians( $latty ) ) * sin( radians( lat ) ) ) ) AS distance
			FROM dist
			INNER JOIN dist_cross ON dist.pkID = dist_cross.distID
			WHERE dist_cross.siteID = 5
			HAVING distance <= $rad
			ORDER BY distance ASC
				";*/
	$query = "SELECT cust_name, addy,	city, state, zip, phone, lat, lon, website, rank, ( 3959 * acos( cos( radians( $latty ) ) * cos( radians( lat ) ) * cos( radians( lon ) - radians( $longy ) ) + sin( radians( $latty ) ) * sin( radians( lat ) ) ) ) AS distance
			FROM dist_faus
			HAVING distance <= $rad
			ORDER BY distance ASC
				";
	$result = $db_reg->query($query);
	$total = $db_reg->affected_rows;
	if($total == 0 || $total == -1 ){
		echo 0;	
	} else {
		echo 1;
	}
}
?>
