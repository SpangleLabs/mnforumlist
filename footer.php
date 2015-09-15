<br /><br />
<hr /><script type="text/javascript"><!--
google_ad_client = "pub-5547405481417256";
/* ForumList */
google_ad_slot = "2848926708";
google_ad_width = 728;
google_ad_height = 90;
//-->
</script>
<script type="text/javascript"
src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>

<?
echo('<br />'.function_lang('LANGUAGE_SELECT',$conf_lang,$db_pref).'<form action="change_language.php" method="post"><select name="Language">');
$sql_languages = 'SELECT `ID`,`Name` FROM `'.$db_pref.'langs` ORDER BY `Name` ASC';
$raw_languages = mysql_query($sql_languages);
$num_languages = mysql_num_rows($raw_languages);
for($a=0;$a<$num_languages;$a++) {
$dat_languages = mysql_fetch_array($raw_languages);
if($dat_languages['ID']==$conf_lang) {
echo('<option value="'.$dat_languages['ID'].'" selected="selected">'.$dat_languages['Name'].'</option>');
} else {
echo('<option value="'.$dat_languages['ID'].'">'.$dat_languages['Name'].'</option>');
}
}
echo('</select><input type="submit" value="'.function_lang('LANGUAGE_CHANGE',$conf_lang,$db_pref).'" />');
?>
</form>
</div>
<div id="bottomimg"><img src="images/footer.png" alt="" /></div>

<p>
    <a href="http://validator.w3.org/check?uri=referer"><img
        src="images/valid-xhtml10.png"
        alt="Valid XHTML 1.0 Strict" height="31" width="88" /></a>

 <a href="http://jigsaw.w3.org/css-validator/validator?uri=http://mnforumlist.com/style.css">
  <img style="border:0;width:88px;height:31px"
       src="images/valid-css.png" 
       alt="Valid CSS!" />
 </a>
 <a href="http://validator.w3.org/feed/check.cgi?url=http://mnforumlist.com/updatesrss.php">
  <img title="Validate my RSS feed"
       src="images/valid-rss.png"
       alt="[Valid RSS]" />
 </a>
</p>

</body>
</html>