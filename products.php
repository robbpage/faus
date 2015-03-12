<?PHP
//                                                     
//                                       products.php  
//                                                     

// database connection
include('inc/dbc.php');
$collID   = $_GET['id'];
$collNAME = str_replace("-"," ",$_GET['col']);

if($collID != ""){
	// query for the collection name and description
	$collR = $dbc->query("
		SELECT *
		FROM coll
		WHERE collID = $collID");
	while($collA = $collR->fetch_array(MYSQLI_ASSOC)){
		$collDESC = $collA['collDESC'];
		$collFEAT = $collA['collFEAT'];
		$collNAME = $collA['collNAME'];
		$collSUBS = "COLLECTION";
	}
	// query for the products in the selected collection
	$prodR = $dbc->query("
		SELECT *
		FROM prod
		WHERE prodCOLL = $collID AND prodSTAT = 1
		ORDER BY prodSORT ASC");
	while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
		$prodID   = $prodA['prodID'];
		$prodSKU  = $prodA['prodSKU'];
		$prodNAME = $prodA['prodNAME'];
		$prodLINK = "details.php?id=$prodID&name=".str_replace(" ","-",$prodNAME);
		$prodDISP .= "		<div id='prodCASE' onclick='location.href=\"$prodLINK\";'><img src='img/thumb/$prodSKU.jpg' class='prodTHUMB' />$prodNAME<br /><span class='s10'><span class='redD' style='line-height: 20px;'>SKU</span> $prodSKU</span></div>\n";
	}
} else {
	$collDESC = "Whatever your style or way of life, we have the perfect laminate for you. Fausfloor has pioneered numerous advances in laminate flooring, resulting in the most realistic designs and textures available in the industry. Any home atmosphere, modern or functional, rustic or classic... The richness of our collections won't limit your imagination.";
	$collNAME = "the Fausfloor";
	$collSUBS = "PRODUCT LINE";
	// query for all the products
	$prodR = $dbc->query("
		SELECT p.*, c.collNAME
		FROM prod p
		LEFT JOIN coll c ON p.prodCOLL = c.collID
		WHERE p.prodSTAT = 1
		ORDER BY p.prodCOLL DESC, p.prodSORT ASC");
	while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
		$prodID   = $prodA['prodID'];
		$prodSKU  = $prodA['prodSKU'];
		$prodNAME = $prodA['prodNAME'];
		$colNAME2 = strtoupper($prodA['collNAME'])." COLLECTION";
		$prodDISP .= "<div id='prodCASE' onclick='location.href=\"$prodLINK\";'><img src='img/thumb/$prodSKU.jpg' class='prodTHUMB' /><span class='bold s10 redD'>$colNAME2</span><br />$prodNAME<br /><span class='s10'><span class='redD' style='line-height: 20px;'>SKU</span> $prodSKU</span></div>";
	}
}
$title = "$collNAME Collection - Fausfloor";
include('header.php');
?>

<div id="collHEAD" class="white s60">
	<div id="collHEADname"><h1><?PHP echo $collNAME ?><div id="collHEADcoll" class="s24 redD"><?PHP echo $collSUBS ?></div></h1></div>
</div>

<div id="collSHELL">
	<div id="collBLURB" class="s16 ital gray"><?PHP echo $collDESC ?></div>
	<div id="prodSHELL">
<?PHP echo $prodDISP ?>
		<div style="clear: both;"></div>
	</div>
</div>

<div id="featSHELL">
	<div id="collFEAT" class="s16 white"><span class="s30 bold ital shadD">Features & Benefits</span><?PHP echo $collFEAT; ?></div>
</div>

<?PHP include('footer.php'); ?>
