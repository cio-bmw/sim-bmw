<?php 
require_once "config.php"; 
$id = $_GET['id'];
//set initial y axis position per page
$y = 30;
$x = 50;
$h = 12;
 
$printer = printer_open('epson');
printer_set_option($printer, PRINTER_MODE, "RAW"); 
printer_start_doc($printer);
printer_start_page($printer);
$font = printer_create_font("Arial", 28, 20, PRINTER_FW_NORMAL, TRUE, FALSE, TRUE, 0); 
printer_select_font($printer, );
// membuat header 
printer_draw_text($printer,idprospekflow,$x+10,$y); 
printer_draw_text($printer,prospekflow,$x+10,$y); 
printer_draw_text($printer,dateflow,$x+10,$y); 
printer_draw_text($printer,prospek_idprospek,$x+10,$y); 
 
$y = $y+$h; 
$sql = " select * from prospekflow"; 
$result = mysql_query($sql); 
$i=1;  
while($row = mysql_fetch_array($result)) { 
printer_draw_text($printer,$i,$x+10,$y); 
printer_draw_text($printer,$row['idprospekflow'],$x+10,$y); 
printer_draw_text($printer,$row['prospekflow'],$x+10,$y); 
printer_draw_text($printer,$row['dateflow'],$x+10,$y); 
printer_draw_text($printer,$row['prospek_idprospek'],$x+10,$y); 
 
$y = $y+$h; 
$i++;
} 
printer_delete_font($font);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
?> 
