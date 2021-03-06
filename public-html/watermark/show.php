
<!doctype html>
<html lang="us">
<head>
<meta charset="utf-8">
<title>watermark</title>
<link href="css/ui-lightness/jquery-ui-1.10.3.custom.css" rel="stylesheet">
<link rel="stylesheet" href="css/bjqs.css">
<link rel="stylesheet" href="css/use.css">

<script src="js/jquery-1.9.1.js"></script>
<script src="js/jquery-ui-1.10.3.custom.js"></script>
<script src="js/jquery.tools2.js"></script>
<script src="js/bjqs-1.3.min.js" data='bjqsData'></script>
<script type='text/javascript' src='js/jquery.loadmask.js'></script>
<!--<script src="http://cdn.jquerytools.org/1.2.7/all/jquery.tools.min.js"></script>-->
<script>
$(document).ready(function() {

		var wmWidth = Math.floor($(window).width()*0.9*0.68/8);
		wmWidth = wmWidth.toString()+'px';
		<?php
		for($i=1;$i<=8;$i++){
		echo '$("#wm'.$i.'").css(\'width\', wmWidth );';
		}
		?>
		var wmSelected = 0;
		var iwmStr = 0;
		var coverStr = 0;
		
		//每200毫秒就抓一次現在停在哪一個view上面call funtion show() 讓watermark加框
		setInterval(show,200);
		
		//initial for jQuery object
		$( "#button" ).button();
		$( "#radioset" ).buttonset();
		$("#navigator").scrollable().navigator();
		$('#banner-fade').bjqs({height: 544,width: 960,responsive  : true,automatic : false,showcontrols : true, nexttext : '&rarr;', prevtext : '&larr;' });
		$( "#radioset" ).buttonset();

		//for watermark strength slidebar
		$( "#slider" ).slider({ value: 8, min: 1, max: 15, step: 0.1, slide: function( event, ui ) { $( "#amount" ).val( ui.value );}});
		$( "#amount" ).val(  $( "#slider" ).slider( "value" ) );

		$( "#progressbar" ).progressbar({ value: 20 });
		
		//for side information size slidebar
		$( "#slider2" ).slider({value: 80,min: 5,max: 160,step: 1,slide: function( event, ui ) {$( "#amount2" ).val( ui.value );}});
		$( "#amount2" ).val(  $( "#slider2" ).slider( "value" ) );
		
		//切換original及embedded image
		$("#radio1").click(function (){
		
		d_radio1 = new Date();
		<?php
		for($i=1;$i<=8;$i++){
			echo '$("#im'.$i.'").attr(\'src\', \'ori'.$i.'.jpg?\'+d_radio1.getTime());';
		}
		?>
			
		});
		$("#radio2").click(function (){
		d_radio2 = new Date();
		<?php
		for($i=1;$i<=8;$i++){
			echo '$("#im'.$i.'").attr(\'src\', \''.$i.'.jpg?\'+d_radio2.getTime());';
		}
		?>
		});
		//==================================


		//選擇input watermark image  被選到的加框
		$(".iwm").click(function (){

				iwmStr = this.alt.toString();
				if(iwmStr=='wm2'){
				$("#iwm2").css('border', "solid 2px");
				$("#iwm3").css('border', "0px");
				wmSelected = 1;
				$('#msg').html(iwmStr);
				}
				else if(iwmStr=='wm3'){
				$("#iwm3").css('border', "solid 2px");
				$("#iwm2").css('border', "0px");
				wmSelected = 1;
				$('#msg').html(456);
				}
				});
		//========================================


		//選擇source cover image 選到的加框
		$(".cover").click(function (){

				coverStr = this.alt.toString();
				if(coverStr=='cover1'){
					$("#cover1").css('border', "solid 2px");
					$("#cover2").css('border', "solid 0px");
					$("#cover3").css('border', "solid 0px");
					$("#cover4").css('border', "solid 0px");
					$("#cover5").css('border', "solid 0px");
					$("#cover6").css('border', "solid 0px");
				}
				else if(coverStr=='cover2'){
					$("#cover1").css('border', "solid 0px");
					$("#cover2").css('border', "solid 2px");
					$("#cover3").css('border', "solid 0px");
					$("#cover4").css('border', "solid 0px");
					$("#cover5").css('border', "solid 0px");
					$("#cover6").css('border', "solid 0px");	
				}
				else if(coverStr=='cover3'){
					$("#cover1").css('border', "solid 0px");
					$("#cover2").css('border', "solid 0px");
					$("#cover3").css('border', "solid 2px");
					$("#cover4").css('border', "solid 0px");
					$("#cover5").css('border', "solid 0px");
					$("#cover6").css('border', "solid 0px");	
				}
				else if(coverStr=='cover4'){
					$("#cover1").css('border', "solid 0px");
					$("#cover2").css('border', "solid 0px");
					$("#cover3").css('border', "solid 0px");
					$("#cover4").css('border', "solid 2px");
					$("#cover5").css('border', "solid 0px");
					$("#cover6").css('border', "solid 0px");	
				}
				else if(coverStr=='cover5'){
					$("#cover1").css('border', "solid 0px");
					$("#cover2").css('border', "solid 0px");
					$("#cover3").css('border', "solid 0px");
					$("#cover4").css('border', "solid 0px");
					$("#cover5").css('border', "solid 2px");
					$("#cover6").css('border', "solid 0px");	
				}
				else if(coverStr=='cover6'){
					$("#cover1").css('border', "solid 0px");
					$("#cover2").css('border', "solid 0px");
					$("#cover3").css('border', "solid 0px");
					$("#cover4").css('border', "solid 0px");
					$("#cover5").css('border', "solid 0px");
					$("#cover6").css('border', "solid 2px");	
				}

				$('#msg').html(coverStr);
				});
		//==================================================

		//embed & detect button
		$("#button").click(function (){
				if(iwmStr==0){
				alert("Please choose a watermark image");
				}
				else if(coverStr==0){
				alert("Please choose a source image");
				
				}
				else{
				$("#container").mask("Waiting...");
				//ajax
				$.ajax({
url: 'index.php',
cache: false,
dataType: 'html',
type:'GET',
data: { strength: $("#amount").val() ,size: $("#amount2").val() ,iwm: iwmStr,cover: coverStr },
error: function(xhr) {
alert('Ajax request ?o????~');
},
success: function(response) {
$('#msg').html( response );
var tmpStr =  response.toString() ;
var tmpStr1 = tmpStr.split(':');
tmpStr1 = tmpStr1[2];
var tmpStr2 = tmpStr1.split('|');
var tmpStr3;
//$('#msg').html( tmpStr2 );
$('#msg').fadeIn();


d = new Date();
<?php	
	for($i=1;$i<=8;$i++){
		echo '$("#wm'.$i.'").attr(\'src\', \'wm'.$i.'.jpg?\'+d.getTime());';
		echo '$("#im'.$i.'").attr(\'src\', \''.$i.'.jpg?\'+d.getTime());';
		echo 'tmpStr3 = tmpStr2['.($i-1).'].split(\',\');';
		echo '$(\'#ber'.$i.'\').html( \'View: '.$i.'<br />\'+tmpStr3[0]+\'%<br /> \'+tmpStr3[1]);' ;
		echo '$("#wm'.$i.'").css(\'width\', wmWidth );';
		echo '$(\'#msg'.$i.'\').fadeIn();';
	}
?>

	//$("#wm1").attr('src', 'wm1.jpg?'+d.getTime());
	$("#container").unmask();
wmSelected = 0;
	 }

});
//=========================ajax end=====================
}

});
//================button end======================

});
var old = 1;


//抓取現在在show哪一個view  並在watermark上加框
function show(){
	//alert(parseInt($(".active-marker").children().html()));
	
	var oldStr = "#wmdiv"+old.toString();
	$(oldStr).css('border', "0px");


	var showStr= "#wmdiv"+parseInt($(".active-marker").children().html()).toString();
	old = parseInt($(".active-marker").children().html());
	$(showStr).css('border', "solid 2px");
}


</script>

</head>
<body>

<div id="container" style=" width:90%; margin-left:5%; margin-right:5%">

<h1>Image Descriptors Based Digital Blind Watermarking for DIBR 3D Images</h1>
<div id="left" style="width:25%; float:left;">
<h2>Input Parameters</h2>


<!-- cover image -->
<div>
<h3 class="demoHeaders">Source Image</h3>
<div >
<img src="cover1.bmp" alt="cover1" class="cover" id="cover1" style="width:35%">
<img src="cover2.bmp" alt="cover2" class="cover" id="cover2" style="margin-left: 20%;width:35%;border:solid 2px;border-color:#ffffff;">
</div>
<div>
<img src="cover3.bmp" alt="cover3" class="cover" id="cover3" style="width:35%; margin-bottom:3%;">
<img src="cover4.bmp" alt="cover4" class="cover" id="cover4" style="margin-left: 20%;width:35%;border:solid 2px;border-color:#ffffff;">
</div>
<div>
<img src="cover5.bmp" alt="cover5" class="cover" id="cover5" style="width:35%">
<img src="cover6.bmp" alt="cover6" class="cover" id="cover6" style="margin-left: 20%;width:35%;border:solid 2px;border-color:#ffffff;">
</div>
</div>
<!-- cover image end-->

<!-- watermark image -->
<h3 class="demoHeaders">Watermark Image</h3>
<div><img src="wm2.bmp" alt="wm2" class="iwm" id="iwm2" style="width:35%"><img src="wm3.bmp" alt="wm3" class="iwm" id="iwm3" style="margin-left: 20%;width:35%"></div>
<!-- watermark image end-->


<!-- Slider -->
<h3 class="demoHeaders">Watermark Strength (&alpha;)</h3>
<div id="slider"></div>
<input type="text" id="amount" style="border: 0; color: #f6931f; font-weight: bold; font-size:18px"/>

<h3 class="demoHeaders">Side Information Size</h3>
<div id="slider2"></div>
<input type="text" id="amount2" style="border: 0; color: #f6931f; font-weight: bold; font-size:18px; width:35px;" /><b style="font-size:18px">kB</b>
<!-- slider end-->


<!-- Progressbar 
<h2 class="demoHeaders">Progressbar</h2>
<div id="progressbar"></div>
-->

<!-- button -->
<h3 class="demoHeaders">Embed & Detect</h3>
<button id="button">Embed & Detect</button>

<h3 class="demoHeaders">Image Type</h3>
<form style="margin-top: 1em;">
<div id="radioset">
<input type="radio" id="radio1" name="radio"><label for="radio1">Original</label>
<input type="radio" id="radio2" name="radio" checked="checked"><label for="radio2">Embedded</label>
</div>
</form>
<!-- button end-->

<!-- debug message-->
<div id="msg"> </div>


</div><!-- end of left column -->



<div id="right" style="width:65%; float:right; margin-left:5%;">
<h2>Output Image</h2>

<div id="banner-fade">

<!-- start Basic Jquery Slider -->
<!-- google jquery bjqs for more information -->
<ul class="bjqs">
<?php
$wmStrPre = "wm";
$wmStrPost = ".jpg";
for( $i=1;$i<=8;$i++ ){
	echo '<li><img src="'.$i.'.jpg" id="im'.$i.'" title="View'.$i.'"></li>';
}

?>
</ul>
<!-- end Basic jQuery Slider -->

</div>

<h2>Detected Watermark Image</h2>

<div style="float:left; width=100%"> 
<?php
for( $i=1;$i<=4;$i++ ){
	echo '<div style="float:left; margin-left:20px" id="wmdiv'.$i.'"><img src="wm'.$i.'.jpg" id="wm'.$i.'" style="width:120px"/><br /><p align="center" id="ber'.$i.'" style="font-size:18px;">View'.$i.'</p></div>';
}
?>
</div>
<div style="float:left;"> 
<?php
for( $i=5;$i<=8;$i++ ){
	echo '<div style="float:left; margin-left:20px" id="wmdiv'.$i.'"><img src="wm'.$i.'.jpg" id="wm'.$i.'" style="width:120px"/><br /><p align="center" id="ber'.$i.'" style="font-size:18px;">View'.$i.'</p></div>';
}
?>
</div>

</div>
</div> 
<!--  -right  end -->


</div>

</body>
</html>
