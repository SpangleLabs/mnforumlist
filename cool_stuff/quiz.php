<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>How Many MicroNations Can You Name in 5 Minutes?</title>

	<style>
	#clock { font-size: 4em; color: #0080ff; padding: 10px 0; }
	#country { width: 350px; font-size: 1.2em; }
	#countriesRemaining span.r { font-size: 1.5em; }
	#foundCountries { color: #004080; font-size: 1.2em; }
	#foundCountries .highlighted { color: #0080ff; text-decoration: underline; }
	</style>

<script type="text/javascript">

var countries;
var found = new Array();
var remaining;

function Country(name, alt)
{
	this.name = name;
	this.found = false;
	this.tNames = new Array();
	this.tNames.push( translate(name) );
	for ( var i=0; i<alt.length; i++ )
	{
		this.tNames.push( translate(alt[i]) );
	}
}

function loadCountries()
{
	countries = new Array();<?
include('../connect.php');
include('../function.nonlatin.php');

$raw_nations = mysql_query('SELECT Name, Full_name FROM '.$db_pre.'data');
$num_nations = mysql_num_rows($raw_nations);

for($a=0;$a<$num_nations;$a++) {
$dat_nations = mysql_fetch_array($raw_nations);

$dat_nations['Name'] = function_nonlatinconv('html','lati',str_replace("'","\'",$dat_nations['Name']));
$dat_nations['Full_name'] = function_nonlatinconv('html','lati',str_replace("'","\'",$dat_nations['Full_name']));

if($dat_nations['Full_name']!="") { $dat_nations['Full_name'] = "'".$dat_nations['Full_name']."'"; }


echo("countries.push( new Country('".$dat_nations['Name']."', new Array(".$dat_nations['Full_name'].")));\n");

}

?>
	remaining = countries.length;
	displayRemaining();
}

function translate(x)
{
	x = x.toLowerCase()
	x = x.replace(/\bsaint\b/, "st");
	x = x.replace(/\band\b/, "");
	x = x.replace(/\bof\b/, "");
	x = x.replace(/\bthe\b/, "");
	x = x.replace(/[^a-z]/g, "");
	return x;
}

function checkCountry()
{
	var text = document.getElementById("country").value;
	text = translate(text);
	for ( i=0; i<countries.length; i++)
	{
		var c = countries[i];
		for ( j=0; j<c.tNames.length; j++ )
		{
			if ( text == c.tNames[j] )
			{
				if ( !c.found )
				{
					c.found = true;
					remaining--;
					found.push( c.name );
					displayFound(c.name);
					displayRemaining();
				}
			    document.getElementById("country").value = "";
				return;
			}
		}
	}
}

function displayRemaining()
{
	document.getElementById("countriesRemaining").innerHTML = "<p><span class=\"r\">" + (<?echo($num_nations);?>-remaining) + "</span> countries named.&nbsp;&nbsp;<span class=\"r\">" + remaining + "</span> left.";
}

function displayFound( highlighted )
{
	found.sort();
	var x = new Array();
	x.push("<p>");
	for (var i=0; i<found.length; i++)
	{
		if ( i > 0 )
			x.push(", ");
		var c = found[i];
		if ( c == highlighted )
			x.push("<span class=\"highlighted\">" + c + "</span>");
		else
			x.push(c);
	}
	document.getElementById("foundCountries").innerHTML = x.join('');
}

function doNotFound()
{
	var x = new Array();
	x.push("<p><b>You Missed</b>: ");
	var comma = false;
	for (var i=0; i<countries.length; i++)
	{
		var c = countries[i];
		if ( !c.found )
		{
			if ( comma )
				x.push(", ");
			else
				comma = true;
			x.push(c.name);
		}
	}
	document.getElementById("notFound").innerHTML = x.join('');
}

function keyDownCountry(e)
{
	if (document.all)
		code = window.event.keyCode;
	else code = e.which;

	if ( code == 13 )
		checkCountry();
}

var minutes;
var seconds;

function load()
{
	minutes = 5;
	seconds = 0;
	loadCountries();
	displayClock();
	document.getElementById("country").disabled = false;
	setTimeout( decrementClock, 1000 );
}

function decrementClock()
{
	if ( minutes == 0 && seconds == 0 )
		return;
	seconds--;
	if ( seconds < 0 )
	{
		seconds = 59;
		minutes--;
	}

	displayClock();
	if ( minutes == 0 && seconds == 0 )
		timeUp();
	else	
		setTimeout( decrementClock, 1000 );
}

function giveUp()
{
	minutes = 0;
	seconds = 0;
	displayClock();
	timeUp();
}

function displayClock()
{
	document.getElementById("clock").innerHTML = minutes + ":" + padZero(seconds);
}

function padZero(num)
{
	if ( num == 0 )
		return "00";
	else if ( num < 10 )
		return "0" + num;
	else
		return "" + num;
}

function timeUp()
{
	document.getElementById("country").disabled = true;
	alert("Your time is up!");
	doNotFound();
}


</script>

</head>
<body onload="load()">

	<div id="content">
		<h1>How Many MicroNations Can You Name in 5 Minutes?</h1>
		<div style="color: #666;">
		There are <?echo($num_nations);?> micronations on the forumlist.  You've got 5 minutes to name as many as you can.  Go!
		<br /><b>The rules:</b>
		<ul>
			<li>Use the common, English name
			<li>Spelling counts
			<li>We will try to cut as much slack as possible.
			<li>Don't look on the ForumList while doing the quiz.
		</ul>
		</div>

		<div id="clock">
		</div>

		<input type="button" onclick="giveUp()" value="Give Up"><p>
		Enter country name here and press enter: 
		<br><input type="text" id="country" onkeydown="keyDownCountry(event)">

		<div id="countriesRemaining">
		</div>

		<div id="foundCountries">
		</div>

		<div id="notFound">
		</div>


	</div>
</body>
</html>