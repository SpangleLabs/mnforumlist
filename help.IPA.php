<?
include('header.php');

echo('<h1>International Phonetic Alphabet Help</h1>
<div id="info">
You&#39;ve come to this page because you want some help in using the international phonetic alphabet, perhaps to spell your nation&#39;s name phonetically so people will know how to pronounce it or perhaps to learn to pronounce another nation&#39;s name.</div>

<h2>Consonants</h2>
<table border="1">
<tr>
<td><b>IPA</b></td>
<td><b>Speech</b></td>
<td><b>Examples</b></td>
<td><b>HTML code</b></td>
</tr><tr>
<td>b</td><td>'.function_play('pronounce/IPA-buy cab b.mp3').'</td><td><b>b</b>uy, ca<b>b</b></td> <td>&amp;#98;</td>
</tr><tr>
<td>d</td><td>'.function_play('pronounce/IPA-die cad d.mp3').'</td><td><b>d</b>ie, ca<b>d</b></td> <td>&amp;#100;</td>
</tr><tr>
<td>ð</td><td>'.function_play('pronounce/IPA-thy breathe father th.mp3').'</td><td><b>th</b>y, brea<b>the</b>, fa<b>th</b>er</td> <td>&amp;#240;</td>
</tr><tr>
<td>d&#658;</td><td>'.function_play('pronounce/IPA-giant badge jam J.mp3').'</td><td><b>g</b>iant, ba<b>dge</b>, <b>j</b>am</td> <td>&amp;#100;&amp;#658;</td>
</tr><tr>
<td>f</td><td>'.function_play('pronounce/IPA-phi caff fffff.mp3').'</td><td><b>ph</b>i, ca<b>ff</b></td><td>&amp;#102;</td>
</tr><tr>
<td>&#609;</td><td>'.function_play('pronounce/IPA-guy bag g.mp3').'</td><td><b>g</b>uy, ba<b>g</b></td><td>&amp;#609;</td>
</tr><tr>
<td>h</td><td>'.function_play('pronounce/IPA-high ahead huh.mp3').'</td><td><b>h</b>igh, a<b>h</b>ead</td><td>&amp;#104;</td>
</tr><tr>
<td>j</td><td>'.function_play('pronounce/IPA-yes yacht yuh.mp3').'</td><td><b>y</b>es, <b>y</b>acht</td><td>&amp;#106;</td>
</tr><tr>
<td>k</td><td>'.function_play('pronounce/IPA-chi sky crack k.mp3').'</td><td><b>ch</b>i, s<b>k</b>y, <b>c</b>ra<b>ck</b></td><td>&amp;#107;</td>
</tr><tr>
<td>l</td><td>'.function_play('pronounce/IPA-lie sly gal luh.mp3').'</td><td><b>l</b>ie, s<b>l</b>y, ga<b>l</b></td><td>&amp;#108;</td>
</tr><tr>
<td>m</td><td>'.function_play('pronounce/IPA-my smile cam muh.mp3').'</td><td><b>m</b>y, s<b>m</b>ile, ca<b>m</b></td><td>&amp;#109;</td>
</tr><tr>
<td>n</td><td>'.function_play('pronounce/IPA-nigh snide can nnn.mp3').'</td><td><b>n</b>igh, s<b>n</b>ide, ca<b>n</b></td><td>&amp;#110;</td>
</tr><tr>
<td>&#331;</td><td>'.function_play('pronounce/IPA-sang sink singer nggg.mp3').'</td><td>sa<b>ng</b>, si<b>n</b>k, si<b>ng</b>er</td><td>&amp;#331;</td>
</tr><tr>
<td>&#331;&#609;</td><td>'.function_play('pronounce/IPA-finger anger ngg.mp3').'</td><td>fi<b>ng</b>er, a<b>ng</b>er</td><td>&amp;#331;&amp;#609;</td>
</tr><tr>
<td>&#952;</td><td>'.function_play('pronounce/IPA-thigh math thhh.mp3').'</td><td><b>th</b>igh, ma<b>th</b></td><td>&amp;#952;</td>
</tr><tr>
<td>p</td><td>'.function_play('pronounce/IPA-pie spy cap puh.mp3').'</td><td><b>p</b>ie, s<b>p</b>y, ca<b>p</b></td><td>&amp;#112;</td>
</tr><tr>
<td>r</td><td>'.function_play('pronounce/IPA-rye try very ruh.mp3').'</td><td><b>r</b>ye, t<b>r</b>y, ve<b>r</b>y</td><td>&amp;#114;</td>
</tr><tr>
<td>s</td><td>'.function_play('pronounce/IPA-sigh mass sss.mp3').'</td><td><b>s</b>igh, ma<b>ss</b></td><td>&amp;#115;</td>
</tr><tr>
<td>&#643;</td><td>'.function_play('pronounce/IPA-shy cash emotion shh.mp3').'</td><td><b>sh</b>y, ca<b>sh</b>, emo<b>ti</b>on</td><td>&amp;#643;</td>
</tr><tr>
<td>t</td><td>'.function_play('pronounce/IPA-tie sty cat tt.mp3').'</td><td><b>t</b>ie, s<b>t</b>y, ca<b>t</b></td><td>&amp;#116;</td>
</tr><tr>
<td>t&#643;</td><td>'.function_play('pronounce/IPA-china catch chh.mp3').'</td><td><b>Ch</b>ina, ca<b>tch</b></td><td>&amp;#116;&amp;#643;</td>
</tr><tr>
<td>v</td><td>'.function_play('pronounce/IPA-vie have vuh.mp3').'</td><td><b>v</b>ie, ha<b>ve</b></td><td>&amp;#118;</td>
</tr><tr>
<td>w</td><td>'.function_play('pronounce/IPA-wye swine wuh.mp3').'</td><td><b>w</b>ye, s<b>w</b>ine</td><td>&amp;#119;</td>
</tr><tr>
<td>hw</td><td>'.function_play('pronounce/IPA-why whh.mp3').'</td><td><b>wh</b>y</td><td>&amp;#104;&amp;#119;</td>
</tr><tr>
<td>z</td><td>'.function_play('pronounce/IPA-xi zoo has zuh.mp3').'</td><td><b>x</b>i, <b>z</b>oo, ha<b>s</b></td><td>&amp;#122;</td>
</tr><tr>
<td>&#658;</td><td>'.function_play('pronounce/IPA-pleasure, vision, beige juh.mp3').'</td><td>plea<b>s</b>ure, vi<b>si</b>on, bei<b>g</b>e</td><td>&amp;#658;</td>
</tr><tr>
<td colspan="4" style="text-align:center"><b>Marginal consonants</b></td>
</tr><tr>
<td>x</td><td>'.function_play('pronounce/IPA-ugh loch chanukah chh.mp3').'</td><td>u<b>gh</b>, lo<b>ch</b>, <b>Ch</b>anukah</td><td>&amp;#120;</td>
</tr><tr>
<td>&#660;</td><td>-</td><td>uh-oh /&#712;&#652;&#660;o&#650;/</td><td>&amp;#660;</td>
</tr>
</table>
<br /><br /><br />

<h2>Vowels</h2>
<table border="1">
<tr>
<td><b>IPA</b></td>
<td><b>Speech</b></td>
<td><b>Examples</b></td>
<td><b>HTML code</b></td>
</tr><tr>
<td>&#593;&#720;</td><td>'.function_play('pronounce/IPA-balm baht father bra ah.mp3').'</td><td>b<b>a</b>lm, b<b>ah</b>t, f<b>a</b>ther, br<b>a</b></td><td>&amp;#593;&amp;#720;</td>
</tr><tr>
<td>&#594;</td><td>'.function_play('pronounce/IPA-bot pod john doll oh.mp3').'</td><td>b<b>o</b>t, p<b>o</b>d, J<b>oh</b>n, d<b>o</b>ll</td><td>&amp;#594;</td>
</tr><tr>
<td>&#230;</td><td>'.function_play('pronounce/IPA-bat pad shall ban ah.mp3').'</td><td>b<b>a</b>t, p<b>a</b>d, sh<b>a</b>ll, b<b>a</b>n</td><td>&amp;#230;</td>
</tr><tr>
<td>a&#618;</td><td>'.function_play('pronounce/IPA-bite ride file fine pie I.mp3').'</td><td>b<b>i</b>te, r<b>i</b>de, f<b>i</b>le, f<b>i</b>ne, p<b>ie</b></td><td>&amp;#97;&amp;#618;</td>
</tr><tr>
<td>a&#650;</td><td>'.function_play('pronounce/IPA-bout loud foul down how ow.mp3').'</td><td>b<b>ou</b>t, l<b>ou</b>d, f<b>ou</b>l, d<b>ow</b>n, h<b>ow</b></td><td>&amp;#97;&amp#650;</td>
</tr><tr>
<td>&#603;</td><td>'.function_play('pronounce/IPA-bet bed fell men eh.mp3').'</td><td>b<b>e</b>t, b<b>e</b>d, f<b>e</b>ll, m<b>e</b>n</td><td>&amp;#603;</td>
</tr><tr>
<td>e&#618;</td><td>'.function_play('pronounce/IPA-bait made fail vein pay ay.mp3').'</td><td>b<b>ai</b>t, m<b>a</b>de, f<b>ai</b>l, v<b>ei</b>n, p<b>ay</b></td><td>&amp;#101;&amp;#618;</td>
</tr><tr>
<td>&#618;</td><td>'.function_play('pronounce/IPA-bit lid fill bin ih.mp3').'</td><td>b<b>i</b>t, l<b>i</b>d, f<b>i</b>ll, b<b>i</b>n</td><td>&amp;#618;</td>
</tr><tr>
<td>i&#720;</td><td>'.function_play('pronounce/IPA-beat seed feel mean sea ee.mp3').'</td><td>b<b>ea</b>t, s<b>ee</b>d, f<b>ee</b>l, m<b>ea</b>n, s<b>ea</b></td><td>&amp;#105;&amp;#720;</td>
</tr><tr>
<td>&#596;&#720;</td><td>'.function_play('pronounce/IPA-bought maud down fall straw or.mp3').'</td><td>b<b>ough</b>t, M<b>au</b>d, d<b>aw</b>n, f<b>a</b>ll, str<b>aw</b></td><td>&amp;#596;&amp;#720;</td>
</tr><tr>
<td>&#596;&#618;</td><td>'.function_play('pronounce/IPA-exploit void foil coin boy oy.mp3').'</td><td>expl<b>oi</b>t, v<b>oi</b>d, f<b>oi</b>l, c<b>oi</b>n, b<b>oy</b></td><td>&amp;#596;&amp;#618;</td>
</tr><tr>
<td>o&#650;</td><td>'.function_play('pronounce/IPA-boat code foal bone go o.mp3').'</td><td>b<b>oa</b>t, c<b>o</b>de, f<b>oa</b>l, b<b>o</b>ne, g<b>o</b></td><td>&amp;#111;&amp;#650;</td>
</tr><tr>
<td>&#650;</td><td>'.function_play('pronounce/IPA-foot good full woman uh.mp3').'</td><td>f<b>oo</b>t, g<b>oo</b>d, f<b>u</b>ll, w<b>o</b>man</td><td>&amp;#650;</td>
</tr><tr>
<td>u&#720;</td><td>'.function_play('pronounce/IPA-boot food fool soon chew ooh.mp3').'</td><td>b<b>oo</b>t, f<b>oo</b>d, f<b>oo</b>l, s<b>oo</b>n, ch<b>ew</b></td><td>&amp;#117;&amp;#720;</td>
</tr><tr>
<td>ju&#720;</td><td>'.function_play('pronounce/IPA-cued cute mule tune queue.mp3').'</td><td>c<b>ue</b>d, c<b>u</b>te, m<b>u</b>le, t<b>u</b>ne, qu<b>eue</b></td><td>&amp;#106;&amp;#117;&amp;#720;</td>
</tr><tr>
<td>&#652;</td><td>'.function_play('pronounce/IPA-butt mud dull gun uh.mp3').'</td><td>b<b>u</b>tt, m<b>u</b>d, d<b>u</b>ll, g<b>u</b>n</td><td>&amp;#652;</td>
</tr><tr>
<td colspan="4" style="text-align:center"><b>R-colored vowels</b></td>
</tr><tr>
<td>&#593;r</td><td>'.function_play('pronounce/IPA-bard part barn snarl star ar.mp3').'</td><td>b<b>ar</b>d, p<b>ar</b>t, b<b>ar</b>n, sn<b>ar</b>l, st<b>ar</b> (also /&#593;&#720;r./)</td><td>&amp;#593;&amp;#114;</td>
</tr><tr>
<td>&#594;r</td><td>'.function_play('pronounce/IPA-moral forage oh.mp3').'</td><td>m<b>or</b>al, f<b>or</b>age</td><td>&amp;#594;&amp;#114;</td>
</tr><tr>
<td>&#230;r</td><td>'.function_play('pronounce/IPA-barrow marry uh.mp3').'</td><td>b<b>arr</b>ow, m<b>arr</b>y</td><td>&amp;#230;&amp;#114;</td>
</tr><tr>
<td>a&#618;&#601;r</td><td>'.function_play('pronounce/IPA-fire ir.mp3').'</td><td>f<b>ire</b></td><td>&amp;#97;&amp;#618;&amp;#601;&amp;#114;</td>
</tr><tr>
<td>a&#650;&#601;r</td><td>'.function_play('pronounce/IPA-hour our.mp3').'</td><td>h<b>our</b></td><td>&amp;#97;&amp;#650;&amp;#601;&amp;#114;</td>
</tr><tr>
<td>&#603;r</td><td>'.function_play('pronounce/IPA-error merry eugh.mp3').'</td><td><b>err</b>or, m<b>err</b>y</td><td>&amp;#603;&amp;#114;</td>
</tr><tr>
<td>&#603;&#601;r</td><td>'.function_play('pronounce/IPA-scared scarce carin there mary air.mp3').'</td><td>sc<b>are</b>d, sc<b>ar</b>ce, c<b>air</b>n, th<b>ere</b>, M<b>ar</b>y (/e&#618;r./)</td><td>&amp;#603;&amp;#601;&amp;#114;</td>
</tr><tr>
<td>&#618;r</td><td>'.function_play('pronounce/IPA-mirror sirius iuh.mp3').'</td><td>m<b>irr</b>or, S<b>ir</b>ius</td><td>&amp;#618;&amp;#114;</td>
</tr><tr>
<td>&#618;&#601;r</td><td>'.function_play('pronounce/IPA-beard fierce nearer serious ere.mp3').'</td><td>b<b>ear</b>d, f<b>ier</b>ce, n<b>ear</b>er, s<b>er</b>ious (/i&#720;r./)</td><td>&amp;#618;&amp;#601;&amp;#114;</td>
</tr><tr>
<td>&#596;r</td><td>'.function_play('pronounce/IPA-born for aural or.mp3').'</td><td>b<b>or</b>n, f<b>or</b>, <b>aur</b>al (/&#596;&#720;r./)</td><td>&amp;#596;&amp;#114;</td>
</tr><tr>
<td>&#596;&#618;&#601;r</td><td>-</td><td>l<b>oir</b></td><td>&amp;#596;&amp;#618;&amp;#601;&amp;#114;</td>
</tr><tr>
<td>&#596;&#601;r</td><td>-</td><td>b<b>oar</b>, f<b>our</b>, m<b>ore</b>, <b>or</b>al (/o&#650;r./)</td><td>&amp;#596;&amp;#601;&amp;#114;</td>
</tr><tr>
<td>&#650;r</td><td>-</td><td>c<b>our</b>ier</td><td>&amp;#650;&amp;#114;</td>
</tr><tr>
<td>&#650;&#601;r</td><td>'.function_play('pronounce/IPA-boor moor tourist or.mp3').'</td><td>b<b>oor</b>, m<b>oor</b>, t<b>our</b>ist (/u&#720;r./)</td><td>&amp;#650;&amp;#601&amp;#114;</td>
</tr><tr>
<td>j&#650;&#601;r</td><td>'.function_play('pronounce/IPA-cure err.mp3').'</td><td>c<b>ure</b></td><td>&amp;#106;&amp;#650;&amp;#601;&amp;#114;</td>
</tr><tr>
<td>&#652;r</td><td>'.function_play('pronounce/IPA-borough hurry, ugh.mp3').'</td><td>b<b>or</b>ough, h<b>urr</b>y</td><td>&amp;#652;&amp;#114;</td>
</tr><tr>
<td>&#604;r</td><td>'.function_play('pronounce/IPA-bird hurt curl burn furry errh.mp3').'</td><td>b<b>ir</b>d, h<b>ur</b>t, c<b>ur</b>l, b<b>ur</b>n, f<b>urr</b>y (/&#605;&#720;/)</td><td>&amp;#604;&amp;#114</td>
</tr><tr>
<td colspan="4" style="text-align:center"><b>Reduced vowels</b></td>
</tr><tr>
<td>&#601;</td><td>-</td><td>Ros<b>a</b>&rsquo;s, <b>a</b>&nbsp;mission</td><td>&amp;#601;</td>
</tr><tr>
<td>&#618;</td><td>'.function_play('pronounce/IPA-roses emission is eh.mp3').'</td><td>ros<b>e</b>s, <b>e</b>mission, <b>i</b>s </td><td>&amp;#618;</td>
</tr><tr>
<td>&#629;</td><td>'.function_play('pronounce/IPA-kilogram ommission eugh.mp3').'</td><td>kil<b>o</b>gram, <b>o</b>mission</td><td>&amp;#629;</td>
</tr><tr>
<td>&#650;</td><td>'.function_play('pronounce/IPA-beautiful curriculum eugh.mp3').'</td><td>beautif<b>u</b>l, curric<b>u</b>lum ([j&#650;])</td><td>&amp;#650;</td>
</tr><tr>
<td>i</td><td>'.function_play('pronounce/IPA-happy serious eee.mp3').'</td><td>happ<b>y</b>, ser<b>i</b>ous</td><td>&amp;#105;</td>
</tr><tr>
<td>&#601;r</td><td>'.function_play('pronounce/IPA-perform mercer eugh.mp3').'</td><td>p<b>er</b>form, merc<b>er</b> (also /&#602;/)</td><td>&amp;#601;&amp;#114;</td>
</tr><tr>
<td>&#601;n</td><td>'.function_play('pronounce/IPA-button un.mp3').'</td><td>butt<b>on</b></td><td>&amp;#601;&amp;#110;</td>
</tr><tr>
<td>&#601;m</td><td>'.function_play('pronounce/IPA-rhythm um.mp3').'</td><td>rhyth<b>m</b></td><td>&amp;#601;&amp;#109;</td>
</tr><tr>
<td>&#601;l</td><td>'.function_play('pronounce/IPA-bottle ul.mp3').'</td><td>bott<b>le</b></td><td>&amp;#601;&amp;#108;</td>
</tr>
</table>

<br /><br /><br />
<h2>Stress</h2>
<table border="1">
<tr>
<td>IPA</td>
<td>Examples</td>
<td>HTML</td>
</tr><tr>
<td>&#712;</td><td rowspan="2"><b>in</b>to<b>na</b>tion /&#716;&#618;nt&#629;&#712;ne&#618;&#643;&#601;n/,<br />
<b>bat</b>tleship /&#712;bæt&#601;l&#643;&#618;p/</td><td>&amp;#712;</td>
</tr><tr>
<td>&#716;</td><td>&amp;#716;</td>
</tr>
</table>

<br /><br /><br />
<h2>Syllabification</h2>
<table border="1">
<tr>
<td>IPA</td>
<td>Examples</td>
<td>HTML</td>
</tr><tr>
<td>.</td><td>shellfish /&#712;&#643;el.f&#618;&#643;/, selfish /&#712;self.&#616;&#643;/<br />
nitrate /&#712;na&#618;.tre&#618;t/, night-rate /&#712;na&#618;t.re&#618;t/<br />
hire /&#712;ha&#618;&#601;r/, higher /&#712;ha&#618;.&#601;r/<br />
moai /&#712;mo&#650;.a&#618;/</td><td>&amp;#46;</td>
</tr>
</table>');

include('footer.php');
?>