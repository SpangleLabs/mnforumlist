<?

function function_play($file) {

return('<object type="application/x-shockwave-flash"
data="http://mnforumlist.com/musicplayer.swf?song_url='.$file.'&amp;b_bgcolor=000000&amp;b_fgcolor=EDFF2B" 
width="17" height="17">
<param name="movie" 
value="http://mnforumlist.com/musicplayer.swf?song_url='.$file.'&amp;b_bgcolor=000000&amp;b_fgcolor=EDFF2B" />
<img src="images/noflash.gif" 
width="17" height="17" alt="" />
</object>');
}

?>