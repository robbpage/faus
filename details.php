<?PHP
//                                                     
//                                        details.php  
//                                                     

// get the product details
if(isset($_GET['id'])){ $prodID = $_GET['id']; } else { header("Location: index.php"); }
// database connection
include('inc/dbc.php');
$prodR = $dbc->query("
	SELECT p.prodSKU, p.prodNAME, i.infoTHICK, i.infoUNDER, i.infoPPC, i.infoSQFT, c.collID, c.collNAME, c.collFEAT
	FROM prod p
	LEFT JOIN info i ON p.prodID = i.infoPRODID
	LEFT JOIN coll c ON p.prodCOLL = c.collID
	WHERE p.prodID = $prodID");
while($prodA = $prodR->fetch_array(MYSQLI_ASSOC)){
	$collID    = $prodA['collID'];
	$collNAME  = $prodA['collNAME'];
	$collFEAT  = $prodA['collFEAT'];
	$prodSKU   = $prodA['prodSKU'];
	$prodNAME  = $prodA['prodNAME'];
	$prodTHICK = $prodA['infoTHICK'];
	$prodUNDER = $prodA['infoUNDER'];
	$prodPPC   = $prodA['infoPPC'];
	$prodSQFT  = $prodA['infoSQFT']; }
	$prodIMG = "img/large/$prodSKU.jpg";
	if(!is_file($prodIMG)){ $prodIMG = "img/large/noIMG.jpg"; }
// set page title
$title = "$prodNAME - $collNAME Collection - Fausfloor";
// include header
include('header.php');
?>
<div id="deatHEAD">
	<div id="deatCOLL" class="s20 white bold" onclick="location.href='products.php?id=<?PHP echo $collID ?>&col=<?PHP echo str_replace(' ','-',$collNAME); ?>-Collection'">     <?PHP echo $collNAME ?><br /><span class="s8 redD bold">COLLECTION</span></div>
	<div id="deatPROD" class="s40 bold white"><?PHP echo $prodNAME ?><br /><span class="s12 bold ital grayL"><span class="redD">SKU</span> <?PHP echo $prodSKU ?></span></div>
</div>

<div id="deatSHELL">
	<div id="deatCONT">
		<div id="deatIMGshell"><img src="<?PHP echo $prodIMG ?>" class="deatIMG" /></div>

		<div id="deatIMGext">
			<!--SWATCH | ROOM-->
			<div id="deatIMGnote" class="s12">
				<span class="redD bold">NOTE:</span> Color may vary depending on your monitor. Please see your<br />local retailer or order a sample to confirm color prior to purchase
				<!--<div class="buttonRED white shadD s14" onclick="msgWINDOW();">email product</div>-->
			</div>
		</div>

		<div id="deatINFOshell">
			<table class="deatTABLE">
				<tr>
					<td class="deatTBLname bold s16">Collection</td>
					<td class="deatTBLinfo"><?PHP echo $collNAME ?></td>
				</tr>
				<tr>
					<td class="deatTBLname bold s16">Product Name</td>
					<td class="deatTBLinfo"><?PHP echo $prodNAME ?></td>
				</tr>
				<tr>
					<td class="deatTBLname bold s16">Item Number</td>
					<td class="deatTBLinfo"><?PHP echo $prodSKU ?></td>
				</tr>
				<tr>
					<td class="deatTBLname bold s16">Thickness</td>
					<td class="deatTBLinfo"><?PHP echo $prodTHICK ?></td>
				</tr>
				<tr>
					<td class="deatTBLname bold s16">Underlayment</td>
					<td class="deatTBLinfo"><?PHP echo $prodUNDER ?></td>
				</tr>
				<tr>
					<td class="deatTBLname bold s16">Pieces per Carton</td>
					<td class="deatTBLinfo"><?PHP echo $prodPPC ?></td>
				</tr>
				<tr>
					<td class="deatTBLname bold s16">Square Foot per Carton</td>
					<td class="deatTBLinfo"><?PHP echo $prodSQFT ?></td>
				</tr>
			</table>
			<div><span class="s20 bold redD">Installing Your Floor</span><br />Whether you are a do-it-yourselfer or professional, laminate flooring is easy to install and maintain. With Fausfloor<sup>&reg;</sup> you can install your laminate floor without the need of glue or nails. To download instructions or watch our helpful videos visit the <a href="install.php" class="linkRED bold">Installation Section</a> of our website.</div><br />
			<div><span class="s20 bold redD">Care & Maintenance</span><br />To clean simply dust, sweep or vacuum using a non-beating bar attachment to remove everyday dirt.  For more helful tips and guides on how to properly care for and maintain your Fausfloor, please visit the <a href="maintenance.php" class="linkRED bold">Maintenance Section</a> of our website.</div>
		</div>
	</div>

<div id="featSHELL">
	<div id="collFEAT" class="s16 white"><span class="s30 bold ital shadD">Features & Benefits</span><?PHP echo $collFEAT; ?></div>
</div>

</div>
<?PHP include('footer.php'); ?>
