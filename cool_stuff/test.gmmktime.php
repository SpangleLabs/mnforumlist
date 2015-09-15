<?

echo(gmdate('d\/m\/Y',gmmktime(1,0,0,09,04,2008)).'<br />');
echo(gmdate('d\/m\/Y',gmmktime(1,0,0,09,4,2008)).'<br />');
echo(gmdate('d\/m\/Y',gmmktime(1,0,0,9,04,2008)).'<br />');
echo(gmdate('d\/m\/Y',gmmktime(1,0,0,9,4,2008)).'<br />');
echo('<br /><br /><br />');


echo(gmdate('d\/m\/Y',strtotime('04/09/2008')).'<br />');
echo(gmdate('d\/m\/Y',strtotime('4/09/2008')).'<br />');
echo(gmdate('d\/m\/Y',strtotime('04/9/2008')).'<br />');
echo(gmdate('d\/m\/Y',strtotime('4/9/2008')).'<br />');

?>