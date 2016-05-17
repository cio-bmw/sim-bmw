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
printer_draw_text($printer,idprospek,$x+10,$y); 
printer_draw_text($printer,prospek,$x+10,$y); 
printer_draw_text($printer,phone,$x+10,$y); 
printer_draw_text($printer,alamat,$x+10,$y); 
printer_draw_text($printer,catatan,$x+10,$y); 
printer_draw_text($printer,marketing_idmarketing,$x+10,$y); 
printer_draw_text($printer,sektor_idsektor,$x+10,$y); 
printer_draw_text($printer,kavling,$x+10,$y); 
 
$y = $y+$h; 
$sql = " select * from prospek"; 
$result = mysql_query($sql); 
$i=1;  
while($row = mysql_fetch_array($result)) { 
printer_draw_text($printer,$i,$x+10,$y); 
printer_draw_text($printer,$row['idprospek'],$x+10,$y); 
printer_draw_text($printer,$row['prospek'],$x+10,$y); 
printer_draw_text($printer,$row['phone'],$x+10,$y); 
printer_draw_text($printer,$row['alamat'],$x+10,$y); 
printer_draw_text($printer,$row['catatan'],$x+10,$y); 
printer_draw_text($printer,$row['marketing_idmarketing'],$x+10,$y); 
printer_draw_text($printer,$row['sektor_idsektor'],$x+10,$y); 
printer_draw_text($printer,$row['kavling'],$x+10,$y); 
 
$y = $y+$h; 
$i++;
} 
printer_delete_font($font);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
?> 
