<?
function function_whitelist($file_type) {

$whitelist = array('application/msword','image/png','image/gif','image/jpeg','image/pjpeg','application/vnd.oasis.opendocument.text','application/vnd.oasis.opendocument.spreadsheet','image/bmp','text/plain','application/pdf','image/x-xcf','application/x-shockwave-flash','image/x-png','application/x-font-ttf','application/vnd.oasis.opendocument.database','application/msword','text/rtf','video/x-ms-wmv','image/svg','image/svg+xml');

if(in_array($file_type,$whitelist)) {
return 1;
} else {
return 0;
}}

?>