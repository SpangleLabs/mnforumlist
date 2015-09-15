<?
$var_ig_get=1;
//include('header.php');
include('connect.php');

echo('                  <style>
<!--
.postbody { font-size : 12px; line-height: 18px}

-->
                  </style>
                  <body bgcolor="#FFFF00">

                  <td
 style="height: 120px; text-align: center; background-color: rgb(0, 0, 0);" width="1187">
                  <div align="center">
                    <center>
            <table border="4" cellpadding="4" cellspacing="0"
 width="1125" bordercolorlight="#999999" bordercolordark="#808000" bgcolor="#FFFFFF" style="border-collapse: collapse" bordercolor="#111111">
              <tbody>
                <tr>

                  <td align="center" valign="top" width="1109" bgcolor="#000000" bordercolorlight="#FFFF00" bordercolordark="#FFFF00" bordercolor="#000000">
                  <p align="center">
                  <b><font color="#FFFFFF" size="2" face="Verdana"><br>
                  </font></b><font face="Times New Roman" color="#FFFF00" size="5">
                  M</font><font face="Times New Roman" color="#FFFFFF" size="5"> 
                  N </font><font face="Times New Roman" color="#FFFF00" size="5">
                  F</font><font face="Times New Roman" color="#FFFFFF" size="5"> 
                  O </font><font face="Times New Roman" color="#FFFF00" size="5">
                  R</font><font face="Times New Roman" color="#FFFFFF" size="5"> 
                  U </font><font face="Times New Roman" color="#FFFF00" size="5">
                  M</font><font face="Times New Roman" color="#FFFFFF" size="5"> 
                  L </font><font face="Times New Roman" color="#FFFF00" size="5">
                  I</font><font face="Times New Roman" color="#FFFFFF" size="5"> 
                  S </font>
                  <font face="Times New Roman" color="#FFFF00" size="5">
                  T</font><font face="Times New Roman" color="#FFFFFF" size="5">&nbsp; </font>

                  <font face="Times New Roman" color="#FFFF00" size="5">
                  D</font><font face="Times New Roman" color="#FFFFFF" size="5"> 
                  O </font>
                  <font face="Times New Roman" color="#FFFF00" size="5">
                  T</font><font face="Times New Roman" color="#FFFFFF" size="5">&nbsp; </font>

                  <font face="Times New Roman" color="#FFFF00" size="5">
                  C</font><font face="Times New Roman" color="#FFFFFF" size="5"> 
                  O </font>
                  <font face="Times New Roman" color="#FFFF00" size="5">
                  M</font><font face="Verdana"><b><font color="#FFFF00" style="font-size: 26pt"><br>
                  </font><font color="#FFFFFF" size="2"><br>
                  </font><font color="#FFFF00" style="font-size: 26pt">M i c r o 
                  n a t i o n&nbsp; L i s t</font></b></font></p>

                  <p align="center">
            &nbsp;</td>
                </tr>
              </tbody>
            </table></center>
                  </div>
                  <p align="center"></p>
                  <p align="center"></p>
                  <p align="center"></p>

                  <p align="center"></p>
                  <p align="center"></p>
                  <div align="center">
                    <center>
            <table border="4" cellpadding="20" cellspacing="0"
 width="1126" bordercolorlight="#999999" bordercolordark="#808000" bgcolor="#FFFFFF" style="border-collapse: collapse" bordercolor="#111111">
              <tbody>
                <tr>
                  <td height="32" width="1078" style="font-family: Verdana, Arial, Helvetica, sans-serif" colspan="7">
                  <font size="2" face="Verdana">

                  <p style="text-align: center"><b><font size="5">List of 
                  Virtual Micronations</font></b> </p>
                  <p style="text-align: left"><font size="2">This page documents 
                  micronational entities which have no physical manifestation in 
                  the corporeal world. It includes:</font></p>
                  <ul>
                    <li>
                    <p style="text-align: left">Micronations that exist solely 
                    in an<font size="2"> electronic context</font>.</li>

                    <li>
                    <p style="text-align: left">Micronations that are comprised 
                    of entirely fictional elements (including population, geography, physical 
                    infrastructure and materiel and events), and that engage in entirely 
                    fictional non-realtime interactions with other micronations.</li>
                    <li>
                    <p style="text-align: left">Micronations whose members may assume 
                    pseudonymous identities, but whose activities consist 
                    largely or entirely to<font size="2"> realtime online 
                    role-playing type interactions.&nbsp;</font></li>
                  </ul>
                  </font></td>
                  </tr>

                <tr>');


/////////////////////////MAIN MYSQL
$sql_data = 'SELECT
data.NatID as NatID, 
data.Name as Name, 
data.Status as Status, 
data.FAOF as FAOF, 
data.Deleted as Deleted, 
flags.File_name as Flag_file, 
pronounce.Sound_file as Sound_file, 
COUNT(DISTINCT forums.ID) as num_forums, 
COUNT(DISTINCT culture.ID) as num_culture, 
COUNT(DISTINCT logs.ID) as num_logs, 
((actnew.Post_count-actold.Post_count)/(actnew.Date-actold.Date)) as PPD, 
(actnew.Post_count-actold.Post_count) as Post_change, 
actold.Date as Date_old, 
actnew.Date as Date_new, 
data.Act_IDOld as Actold_ID
 FROM `'.$db_pref.'data` data 
LEFT JOIN `'.$db_pref.'forums` forums ON forums.NatID = data.NatID 
LEFT JOIN `'.$db_pref.'culture` culture ON culture.NatID = data.NatID 
LEFT JOIN `'.$db_pref.'activity` logs ON logs.NatID = data.NatID 
LEFT JOIN `'.$db_pref.'flags` flags ON flags.ID = data.Flag_thumb
LEFT JOIN `'.$db_pref.'pronounce` pronounce ON pronounce.NatID = data.NatID 
LEFT JOIN `'.$db_pref.'activity` actold ON actold.ID = data.Act_IDOld 
LEFT JOIN `'.$db_pref.'activity` actnew ON actnew.ID = data.Act_IDNew 
 GROUP BY data.NatID;';

$raw_data = mysql_query($sql_data);
$num_data = mysql_num_rows($raw_data);
$raw_total_nations = mysql_query('SELECT `NatID` FROM `'.$db_pre.'data`');
$total_nations = mysql_num_rows($raw_total_nations);


/////////////////////////INTRO TEXT




/////////////////////////TABLE HEADERS
echo('
                  <td height="32" width="102" bgcolor="#000000" style="font-family: Verdana, Arial, Helvetica, sans-serif">
                  <p style="text-align: center"><font color="#FFFFFF">&nbsp;<b>Name<br>
                  <font size="1">(flag form)</font></b></font></td>
                  <td style="text-align: left; font-family:Verdana, Arial, Helvetica, sans-serif" height="32" width="223" bgcolor="#000000">
                  <p style="text-align: center;"><font color="#FFFFFF"><b>Name<br>
                  <font size="1">(word form)</font></b></font></p>

                  </td>
                  <td height="32" width="39" bgcolor="#000000" style="text-align: center; font-family:Verdana, Arial, Helvetica, sans-serif"> 
                  <font color="#FFFFFF" size="1" face="Verdana"><b>Email</b></font></td>
                  <td align="center" height="32" width="174" bgcolor="#000000" style="font-family: Verdana, Arial, Helvetica, sans-serif"> 
                  <font color="#FFFFFF"><b>Primary contact<br>
                  <font size="1">(+ phone number, if available... this is more than a little bit stalkerish.)</font></b></font></td>
                  <td align="center" height="32" width="93" bgcolor="#000000" style="font-family: Verdana, Arial, Helvetica, sans-serif"> 
                  <font color="#FFFFFF"><b>Contact location<br /><font size="1">(Relevant: <a href="http://www.youtube.com/watch?v=55iXRfDOBsI">Very relevant link.</a>)</font></b></font></td>

                  <td align="center" height="32" width="158" bgcolor="#000000" style="font-family: Verdana, Arial, Helvetica, sans-serif"> 
                  <font color="#FFFFFF"><b>Postal address</b></font></td>
                  <td height="32" width="57" bgcolor="#000000" style="text-align: center; font-family:Verdana, Arial, Helvetica, sans-serif"> 
                  <font color="#FFFFFF"><b>Status</b></font></td>
</tr>');


/////////////////////////START TABLE CONTENTS
for($a=0;$a<$num_data;$a++) {
$dat_data = mysql_fetch_array($raw_data);

if($dat_data['FAOF']=="0") {
$dat_data['FAOF'] = "";
} else {
$dat_data['FAOF'] = date("d\/m\/Y",$dat_data['FAOF']);
}
if($dat_data['PPD']=='-123456.789') {
$dat_data['PPD'] = 0;
} else {
$dat_data['PPD'] = round($dat_data['PPD'],3);
}


/////////////////////////CONVERT MY DATESTAMPS INTO HUMAN READABLE ONES
$dat_data['Date_oldread'] = gmdate('d\/m\/Y',(($dat_data['Date_old']*86400)-719528*86400));
$dat_data['Date_newread'] = gmdate('d\/m\/Y',(($dat_data['Date_new']*86400)-719528*86400));
$date_monthago = floor(gmdate('Y')*365.2425)+gmdate('z')+1-31;
if($dat_data['Date_new']>=$date_monthago && $dat_data['Actold_ID']!=0) {
$PPD_text = '<abbr title="'.$dat_data['Post_change'].' posts between '.$dat_data['Date_oldread'].' and '.$dat_data['Date_newread'].'">'.$dat_data['PPD'].'</abbr>';
} else {
$PPD_text = '-';
}

/////////////////////////GET FLAG AND PRONOUNCIATION /////////////// NEEDS TO BE REMOVED!
if($dat_data['Flag_file']!='') {
$flag = '<img src="'.$dat_data['Flag_file'].'" alt="{FLAG}" /> ';
}

if($dat_data['Status']=='Alive') {
$dat_data['Status'] = 'Alive';
} else {
$dat_data['Status'] = 'Dead';
}


/////////////////////////ECHO TABLE ROW INFOMATION
echo('
                <tr>
                  <td align="left" height="16" width="102" style="font-family: Verdana, Arial, Helvetica, sans-serif"> <font size="1"><b>
                  '.$flag.'</b></font></td>

                  <td align="left" height="16" width="223" style="font-family: Verdana, Arial, Helvetica, sans-serif"> <font size="1"><a href="nation.php?ID='.$dat_data['NatID'].'">'.$dat_data['Name'].'</a></font></td>
                  <td height="16" valign="middle" width="39" style="text-align: center; font-family:Verdana, Arial, Helvetica, sans-serif"> 
                  <font size="1">'.$PPD_text.'</font></td>
                  <td align="left" height="16" valign="middle"
 width="174" style="font-family: Verdana, Arial, Helvetica, sans-serif"> <font size="1">?</font></td>
                  <td height="16" valign="middle" width="93" style="font-family: Verdana, Arial, Helvetica, sans-serif"> <font size="1">?</font></td>
                  <td height="16" valign="middle" width="158" style="font-family: Verdana, Arial, Helvetica, sans-serif"> <font size="1">?</font></td>

                  <td height="16" valign="middle"
 width="57" style="text-align: center; font-family:Verdana, Arial, Helvetica, sans-serif"> <font color="#000000" size="2">'.$dat_data['Status'].'</font></td>
                </tr>

');
unset($flag,$pronounce,$PPD_text);

}


/////////////////////////ENDING TEXT
echo('

                <tr>
                  <td align="left" height="16" width="1078" colspan="7" bgcolor="#000000" style="font-family: Verdana, Arial, Helvetica, sans-serif">   
                  <b><font color="#FFFFFF">Notes:</font></b></td>
                </tr>
                <tr>
                  <td align="left" height="16" width="1078" colspan="7" style="font-family: Verdana, Arial, Helvetica, sans-serif"> <u><b>
                  <font size="2">Inclusion criteria:</font></b></u><p> 
                  <font size="1">To be included in this list, a micronation must 
                  be able to demonstrate that it has been in existence for a 
                  minimum of 12 months.<br>

                  Micronations whose members publicly advocate the prosecution 
                  of acts of criminality will not be listed.</font></p>
                  <p>  
                  <font size="2"><b><u>Website link:</u></b></font></p>
                  <p> 
                  <font size="1">If the micronation is <font color="#008000">active</font> 
                  or <font color="#FF9900">inactive</font>, a link to its 
                  website is provided.</font></p>
                  <p> 
                  <font size="1">If the micronation is <font color="#FF0000">defunct</font>, a 
                  link is provided to the following:<br>

                  (i) an archived version of the micronation&#39;s website <i>- or 
                  if that does not exist, </i><br>
                  (ii) the relevant <a href="http://en.wikipedia.org/">Wikipedia</a> 
                  article about the micronation <i>- or if that does not exist,
                  </i><br>
                  (iii) a report about the micronation published by a reliable 
                  print media source. </font>
                  </p>

                  <p><font size="2"><b><u>Email:</u></b></font></p>
                  <p><font size="1">If the micronation lists an email address on its website, 
                  it is linked with an
                  <img src="images/envelope_transparent_x22.gif"
 border="0" width="22" height="13"> . </font></p>
                  <p><font size="1">If the micronation has no published email address, and only 
                  allows form-based communication via its website, no email 
                  address is listed.</font></p>
                  <p><font size="2"><b><u>Primary contact: </u>
                  </b> </font></p>

                  <p><font size="1">For <font color="#008000">active</font> micronations, the 
                  primary contact is the founder or current leader - whichever 
                  is most relevant.</font></p>
                  <p><font size="1">For <font color="#FF9900">inactive</font> or
                  <font color="#FF0000">defunct</font> micronations, the primary 
                  contact is the founder or last known leader.</font></p>
                  <p><font size="1">The name of the primary contact is their actual legal name; 
                  false names, pseudonymous identities and assumed styles and 
                  titularies are not listed.</font></p>

                  <p><font size="1">If the primary contact has a known publicly-listed telephone 
                  number, it is listed below their name.</font></p>
                  <p><font size="1">If the primary contact is known to be deceased, the entry is 
                  marked with a </font><b> <big><font
 size="1">†</font></big></b><font size="1">&nbsp; </font></p>
                  <p><font size="1">Where information is uncertain or unknown, it is marked with a
                  <b>?</b></font></p>
                  <p><font size="2"><u><b>Contact location:</b></u></font></p>
                  <p><font size="1">The contact location is the primary contact&#39;s most recent 
                  known primary place of residence.</font></p>

                  <p><font size="1">Where information is uncertain or unknown, it is marked with a
                  <b>?</b></font></p>
                  <p><u><font size="2"><b>Status:</b></font></u><p>
                  <font size="1">
                  <font color="#008000">Active</font> = the micronation&#39;s 
                  website has been updated within the previous 12 months, or 
                  offline activity is credibly known to have occurred.</font><p>
                  <font size="1">

                  <font color="#FF9900">Inactive</font> = there is no credible 
                  evidence of online <i>or</i> offline activity by the 
                  micronation in the previous 12 months, but its domain and 
                  website remain registered and publicly accessible, and there 
                  is a credible reason to believe that this indicates a 
                  willingness or intent on the part of those involved to revive 
                  the project at some future juncture.</font><p><font size="1">
                  <font color="#FF0000">Defunct</font> = the micronation has 
                  entirely ceased to exist. There is no credible evidence of 
                  online or offline activity of any sort in the previous 12 
                  months, and no credible reason to assume this is likely to 
                  change. Alternatively, those involved in creating or 
                  maintaining it have announced the termination of the project, 
                  are credibly known to be no longer involved, or are no longer 
                  contactable. If the micronation possessed a website, that site 
                  <i>may</i> still be publicly accessible by default (ie without 
                  the need for human intervention) - but it is more 
                  likely than not to now <i>only</i> be accessible via third party archives, or not at 
                  all.</font></td>

                </tr>
              </tbody>
            </table></center>
                  </div>
                  <p align="center"></p>
                  <div align="center">
                    <center>
            <table border="4" cellpadding="4" cellspacing="0"
 width="1125" bordercolorlight="#999999" bordercolordark="#808000" bgcolor="#FFFFFF" style="border-collapse: collapse" bordercolor="#111111">
                <tr>

                  <td align="center" valign="top" bgcolor="#FFFF00" width="1109">
                  <p align="center"><br>
                  <font face="Verdana" size="4">
                  <b>
                  <a href="http://en.wikipedia.org/wiki/List_of_Sovereign_States">List of Physical Micronations</a></b>&nbsp; </font>
                  <font size="5">&#9819;</font><font face="Verdana" size="4">&nbsp;
                  <font color="#999999">
                  <b>

                List of Virtual Micronations</b></font></font><br>
                  <br>
                  <font face="Verdana">
                  <b><a href="http://www.mnforumlist.com/">Home</a>&nbsp;
                  </b>&#9830;<b>&nbsp; <a href="http://hub.mn/forum">Forum</a>&nbsp;
                  </b>&#9830;<b>&nbsp;
                  <a href="http://micras.org/wiki">Wiki</a>&nbsp; </b>&#9830;<b>&nbsp; 
                  <a href="http://www.amazon.com/Last-Theorem-Arthur-C-Clarke/dp/0345470230/ref=sr_1_1?s=books&ie=UTF8&qid=1301637112&sr=1-1">Recommended Reading</a>&nbsp; </b>&#9830;<b>&nbsp; 
                  <a href="http://hub.mn">Links</a></b></font><br>

&nbsp;</td>
                </tr>
            </table></center>
                  </div>
                  <p align="center"></p>
                  <div align="center">
                    <center>
            <table border="4" cellpadding="4" cellspacing="0"
 width="1125" bordercolorlight="#999999" bordercolordark="#808000" bgcolor="#FFFFFF" style="border-collapse: collapse" bordercolor="#111111">
                <tr>

                  <td align="center" valign="top" bgcolor="#000000" width="1109">
                  <p align="center">
                  <font size="1" color="#FFFF00" face="Verdana">This horrible website design but none of its contents are © 2008-2009 George Cruickshank. Unauthorised reproduction was prohibited, but I did it anyway<br>
                  </font>
                  <font face="Verdana" size="1">
                  <font color="#FFFF00">Contact website owner: </font>
                  <a href="mailto:dr-spangle@dr-spangle.com">
                  <font color="#FFFF00">dr-spangle@dr-spangle.com</font></a></font></td>

                </tr>
            </table></center>
                  </div>');
?>