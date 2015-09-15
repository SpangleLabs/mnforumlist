<?

function function_spamstop($str)
{
$array_to = array(  "&amp;", "&gt;", "&lt;", "&quot;", "&#47;", "&#46;", "&#58;", "&#64;");
$array_from = array("&",     ">",    "<",    "\"",     "/",     ".",     ":",     "@");

return str_replace($array_from,$array_to,$str);
}

?>