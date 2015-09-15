<?

function function_email($type,$var1,$var2,$var3) {
$admin_email = "drspangle13@gmail.com";


if($type=="New Nation") {
$email_contents = ('The Forumlist system has sent this email to notify you that '.$var1['email'].' ('.$_SERVER[REMOTE_ADDR].') has added his nation, '.$var1['full_name'].', ('.$var1['name'].') to the list.
Here is the raw data for you to check and then you can make necessary changes in admin panel.

'.print_r($var1,true));
$subject = "Forumlist: New Entry on the Forumlist system";
$headers = "From: ForumList";


} elseif($type=="Culture Uploaded") {
$email_contents = "Someone has uploaded an item of culture.. The nation is ".$var2." (".$var3.") and here are the file details:\n
".print_r($var1,true);
$subject = "Forumlist: File uploaded to CultureUpload";
$headers = "From: ForumList";


} elseif($type=="Culture Upload Failed") {
$email_contents = "Someone has tried to upload a file that isn't on the whitelist... The nation is ".$var2." (".$var3.") and here are the file details:\n
".print_r($var1,true);
$subject = "Forumlist: Disallowed filetype uploaded";
$headers = "From: ForumList";


} elseif($type=="Flag Upload Failed") {
$email_contents = "Someone has tried to upload a flag that isn't on the whitelist... The nation is ".$var2." (".$var3.") and here are the flag details:\n
".print_r($var1,true);
$subject = "Forumlist: Disallowed flag uploaded";
$headers = "From: ForumList";


} elseif($type=="Flag Uploaded") {
$email_contents = "Someone has uploaded a flag for the nation ".$var2." (".$var3.") and here are the flag details:\n
".print_r($var1,true);
$subject = "Forumlist: Flag uploaded";
$headers = "From: ForumList";


} elseif($type=="Modification requested") {
$email_contents = "Someone has requested a modification to the ".$var2." data of ".$var1.". Here is their request:\n\n\n".$var3;
$subject = "Forumlist: modification requested";
$headers = "From: ForumList";

} elseif($type=="New Description") {
$email_contents = "Someone has added a new description to Nation ID ".$var1['NatID'].", their name is ".$var1['Name']." and they used the IP address ".$var2."\n
Here is their description:\n\n
".$var1['Desc'];
$subject = "Forumlist: New description";
$headers = "From: ForumList";

}


mail($admin_email,$subject,$email_contents,$headers);
return 1;
}



?>