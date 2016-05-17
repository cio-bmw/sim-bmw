<html lang="en">
<head>
<title>Simplest jQuery Slideshow</title>

<style>
body {font-family:Arial, Helvetica, sans-serif; font-size:12px;}

.fadein { 
position:relative; height:100px; width:500px; margin:0 auto;
background: url("slideshow-bg.png") repeat-x scroll left top transparent;
padding: 10px;
 }
.fadein img { position:absolute; left:10px; top:10px; }
</style>

<script src="js/jquery.min.js"></script>
<script>
$(function(){
	$('.fadein img:gt(0)').hide();
	setInterval(function(){$('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');}, 6000);
});
</script>

</head>
<body>
<div class="fadein">	
	
<?
 foreach(glob('./slide/*.*') as $filename){
?>
     <img src="<? echo $filename;?>">
<?
 }
?>
		
</div>
</body>
</html>