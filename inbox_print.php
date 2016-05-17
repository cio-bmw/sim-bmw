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
printer_draw_text($printer,UpdatedInDB,$x+10,$y); 
printer_draw_text($printer,ReceivingDateTime,$x+10,$y); 
printer_draw_text($printer,Text,$x+10,$y); 
printer_draw_text($printer,SenderNumber,$x+10,$y); 
printer_draw_text($printer,Coding,$x+10,$y); 
printer_draw_text($printer,UDH,$x+10,$y); 
printer_draw_text($printer,SMSCNumber,$x+10,$y); 
printer_draw_text($printer,Class,$x+10,$y); 
printer_draw_text($printer,TextDecoded,$x+10,$y); 
printer_draw_text($printer,ID,$x+10,$y); 
printer_draw_text($printer,RecipientID,$x+10,$y); 
printer_draw_text($printer,Processed,$x+10,$y); 
 
$y = $y+$h; 
$sql = " select * from inbox"; 
$result = mysql_query($sql); 
$i=1;  
while($row = mysql_fetch_array($result)) { 
printer_draw_text($printer,$i,$x+10,$y); 
printer_draw_text($printer,$row['UpdatedInDB'],$x+10,$y); 
printer_draw_text($printer,$row['ReceivingDateTime'],$x+10,$y); 
printer_draw_text($printer,$row['Text'],$x+10,$y); 
printer_draw_text($printer,$row['SenderNumber'],$x+10,$y); 
printer_draw_text($printer,$row['Coding'],$x+10,$y); 
printer_draw_text($printer,$row['UDH'],$x+10,$y); 
printer_draw_text($printer,$row['SMSCNumber'],$x+10,$y); 
printer_draw_text($printer,$row['Class'],$x+10,$y); 
printer_draw_text($printer,$row['TextDecoded'],$x+10,$y); 
printer_draw_text($printer,$row['ID'],$x+10,$y); 
printer_draw_text($printer,$row['RecipientID'],$x+10,$y); 
printer_draw_text($printer,$row['Processed'],$x+10,$y); 
 
$y = $y+$h; 
$i++;
} 
printer_delete_font($font);
printer_end_page($printer);
printer_end_doc($printer);
printer_close($printer);
?> 
