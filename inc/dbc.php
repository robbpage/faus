<?PHP
//                                //
//  database connection settings  //
//                                //
#--    l o c a l  c o n n e c t    --#
if($_SERVER['SERVER_NAME'] == "webtest.qep.com"){
	$DB_NAME = 'fausfloor';
	$DB_HOST = '*.*.*.*';
	$DB_USER = '**********';
	$DB_PASS = '**********';
	//---------------------Corp
	$DB_NAME2 = 'corporate';
	//--------------------Product Register
	$DB_NAME3 = 'prod_register';
#--    r e m o t e  c o n n e c t    --#
} else {
	$DB_NAME = 'fausfloor';
	$DB_HOST = '*.*.*.*';
	$DB_USER = '**********';
	$DB_PASS = '**********';
	//---------------------Corp
	$DB_NAME2 = 'corporate';
	//--------------------Product Register
	$DB_NAME3 = 'prod_register';
}

$dbc = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);
$db_terms = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME2);
$db_reg = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME3);
?>
