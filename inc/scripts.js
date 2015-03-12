//                                              //
//    F a u s f l o o r  J a v a s c r i p t    //
//                                              //

// n a v i g a t i o n  s t u f f
// mouseovers
$(function(){
	$(document).on("mouseover",".drop",function(){
		dropFunction('block',$(this).attr('id'));
	}).on("mouseout",".drop",function(){
		dropFunction('none',$(this).attr('id'));
	})
})
function dropFunction(type,obj){
	$('#'+obj+'drop').css({'display':type});
}
// clicks
function navCLICK(loc,name){
	if(loc == 1 || loc == 2 || loc == 3){
		document.location.href="products.php?id="+loc+"&col="+name;
	} else if(loc == 4){
		document.location.href="products.php";
	} else {
		document.location.href=name;
	}
}

// f a q s
$(function(){
	$(".faqQUES").click(function(){
		var mrPLOS = $(this).attr('id');
		$("#ANSW"+mrPLOS).toggle(100);
	})
	$(".faqANSW").click(function(){
		$(this).toggle(100);
	})
})

// c o n t a c t  u s  f o r m
/* submit */
$(function(){
	$("#formSUB").click(function(){
		if($('#ggCorpID').val() != ""){
			// do nothing
		} else {
			// process the form
			if($('#ggNAME').val() && $('#ggEMAIL').val() && $('#ggQNCS').val() && $('#ggSUBJECT').val() != ""){
				// validate email address format
				var valid = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
				var email = $('#ggEMAIL').val();
				if(valid.test(email)){
					// everything is good, send the message
					$(function(){
						$.post("inc/func.php?contact", $('#form').serialize(), function(data){
							if(data == 1){
								// message sent
								errPOP('Your message has been sent.  Thank you.');
								$('#ggNAME').val("");
								$('#ggEMAIL').val("");
								$('#ggPHONE').val("");
								$('#ggSUBJECT').val("");
								$('#ggQNCS').val("");
							} else {
								// message failed
								errPOP('Something went wrong, please try again.');
							}
						});
					});
				} else {
					// invalid email
					errPOP('<span class="s20 red"><strong>Invalid Email Address</strong></span><br />Please make sure you\'ve entered a properly formatted email address.');
				}
			} else {
				// missing fields
				errPOP('Please fill out all the required fields');
			}
		}
	})
})

// w h e r e  t o  b u y
function clearIT(id) {
	var itemID   = document.getElementById(id);
	var itemVAL  = itemID.value;
	var curCLASS = itemID.className;
	if(itemVAL == "Address or Zip/Postal Code" || itemVAL == "Search ..." || itemVAL == "enter code"){ itemID.value=''; itemID.className = curCLASS.replace('gray', 'black bold').replace('ital', ''); }
	if(itemVAL != "" || itemVAL != "Address or Zip/Postal Code" || itemVAL != "Search ..." || itemVAL != "enter code"){ itemID.className.replace('gray', 'black bold').replace('ital', '')}}
function fillIT(id, value) {
	var itemID  = document.getElementById(id);
	var itemVAL = value;
	var curCLASS = itemID.className;
	if(itemID.value == ""){ itemID.value = itemVAL; itemID.className = curCLASS.replace('black bold', 'gray ital'); }}

/* geocoder function */
var geocoder;
function codeAddress() {
	var address = document.getElementById("address").value;
	geocoder = new google.maps.Geocoder();
	if (geocoder) {
		geocoder.geocode({'address': address}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var LatLon = results[0].geometry.location;
				var checkMe = AddressCheck(LatLon);
					//document.addzip.submit();
			} else {
		 		msgCloser(2);
			}
	  	});
	}
}

function AddressCheck(latlon){
	var getBack;
	var radius = document.getElementById("radius").value;
	$.post( "inc/func.php?wtb=check&latlon="+latlon+"&radius="+radius, function( data ) {
		 var getBack = makeMap(data,latlon);
	});
}
function makeMap(data,latlon){
  if(data == 0){
	 alertBar(1,"alertDiv") 
  } else {
	 document.addzip.subby.value=latlon;
	 document.addzip.submit();
  }
}
$(function(){
	$('#wtb-radiusArrowShell').mouseover(function(){
		$('#wtb-radiusFly').css({'display':'inline'});
	}).mouseout(function(){
		$('#wtb-radiusFly').css({'display':'none'});
	})
})
function radIT(therad){
	$('#radius').val(therad+' miles');
	$('#wtb-radiusFly').css({'display':'none'});
}

// m a i n  p a g e  s l i d e r
if($('#slideSHELL')){
	$(function(){
		$('#slideCENT img:gt(0)').hide();
		setInterval(function(){
		  $('#slideCENT :first-child').fadeOut(500)
			 .next('img').fadeIn(0)
			 .end().appendTo('#slideCENT');}, 
		  4000);
	});
}

// p o p - u p s
function errPOP(msg){
	// get browser window height and width
	var height = $(window).height();
	var width  = $(window).width();
	$('#errDIM').css({'height':height,'width':width,'opacity':1});
	// put the error message into the errMSG div
	$('#errMSG').html(msg);
	var msgHEIGHT = $('#errSHELL').height();
	var msgOFFSET = (height/2)-(msgHEIGHT/2);
	$('#errSHELL').css({'margin-top':msgOFFSET,'display':'block'});
}
function unPOP(page){
	$('#errSHELL').css({'margin-top':'-500px'});
	$('#vidSHELL').animate({ marginTop: 0 },300);
	$('#errDIM').css({'opacity':0});
	setTimeout(function(){
		$('#errDIM').css({'height':0,'width':0});
		$('#errSHELL').css({'display':'none'});
		$('#vidSHELL').css({'height':0,'width':0,'display':'none'});
		if(page != "one"){ window.location.href = "index.php"; };
	},400);
}
function vidPOP(ytLINK,ytHeight,ytWidth){
	// get browser window height and width
	var winHEIGHT = $(window).height();
	var winWIDTH  = $(window).width();
	var ytHEIGHT  = ytHeight+'px';
	var ytWIDTH   = ytWidth+'px';
	var ytOFFSET  = (winHEIGHT/2)-(ytHeight/2)+'px';
	$('#errDIM').css({'height':winHEIGHT,'width':winWIDTH,'opacity':1});
	$('#vidSHELL').html('<iframe width="'+ytWIDTH+'" height="'+ytHEIGHT+'" src="' + ytLINK + '" frameBorder="0" allowfullscreen allowtransparency=true></iframe><div id="vidCLOSE"><div class="buttonRED white shadD s18">close</div></div>').css({'display':'block','opacity': 1, 'width':ytWIDTH,'margin-top':(winHEIGHT/2)});
	$('#vidCLOSE').css({'left':((ytWidth/2)-70)+'px','opacity':1});
	$('#vidSHELL').animate({ height: ytHEIGHT, marginTop: ytOFFSET }, 300);
}
