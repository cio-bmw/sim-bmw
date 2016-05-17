// Variable to store your files
var files;
 
// Add events
$('input[type=file]').on('change', prepareUpload);
 
// Grab the files and set them to our variable
function prepareUpload(event)
{
files = event.target.files;
}