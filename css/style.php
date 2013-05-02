<?
    header("Content-type: text/css; charset: UTF-8");
	include('../include/inc.php');
?>
/* Main Layout Styles */
body {
	font-family: Open Sans, sans-serif;
	font-size: 1em;
	line-height: 1.2em;
	margin: 0;
	padding: 0;
	z-index: 1;
	overflow-x: hidden;
}
#main {
	margin: 40px;
	background-color: fff;
	max-width: 900px;
	margin: 0 auto;
}
header {
	/*position: fixed;*/
	width: 100%;
	margin: 0;
	padding: 1px;
	height: 35px;
	border-bottom: 1px dotted #ddd;
	background-color: #eee;
	z-index: 99;
}
<? if ($loggedIn) { ?>
@media all and (max-width: 1600px) {
	header {
		height: 70px;
	}
}
<? } ?>
#headEl {
	width: 100%;
	margin: 0 auto;
}
<? if ($loggedIn) { ?>
@media all and (max-width: 1600px) {
	#headEl {
		width: 900px;
	}
}
<? } else { ?>
#headEl {
	width: 900px;
}
<? } ?>
h1 {
	font-size: 1.5em;
	margin: 0 50px;
	padding: 10px 0;
	z-index: 99;
	width: 50%;
}
<? if ($loggedIn) { ?>
@media all and (max-width: 1600px) {
	h1 {
		left: 0;
		margin: 0;
	}
}
<? } else { ?>
h1 {
	left: 0;
	margin: 0;
}
<? } ?>
#notifications {
	max-width: 900px;
	margin: 0 50px;
	text-align: right;
	position: relative;
	top: -83px;
}
#notifications > form {
	display: inline;
}
#notifications > form input {
	height: 30px;
	padding: 3px 5px;
	margin: 0;
}
<? if ($loggedIn) { ?>
@media all and (min-width: 1599px) {
	#notifications {
		position: absolute;
		right: 0;
		top: -2px;
	}
}
@media all and (max-width: 1600px) {
	#notifications {
		top: -46px;
		margin: 0 auto;
	}
}
<? } ?>
#notificationsBar, #friendsBar {
	position: absolute;
	right: 0;
	top: 40px;
	min-width: 300px;
	border: 1px solid #ddd;
	background-color: #eee;
	padding: 2px;
	margin: 0 5px;
	z-index: 99;
}
#notNum {
	position: absolute;
	text-align: center;
	color: white;
	font-size: 10px;
	top: 25px;
	right: -10px;
	width: 20px;
	height: 20px;
	background: #999;
	border: 2px solid white;
	border-radius: 20px;
	z-index: 100;
}
#msg {
	position: fixed;
	top: 50px;
	left: 50%;
	margin-left:-100px;
	width: 300px;
	border: 1px dotted #eee;
	background-color: #ddd;
	padding: 10px;
	z-index: 101;
    opacity: 0;
    visibility: hidden;
    
    animation: fade 6.6s;
    -moz-animation: fade 6.6s;
    -webkit-animation: fade 6.6s;
    -o-animation: fade 6.6s;
}
<? if ($loggedIn) { ?>
@media all and (min-width: 1600px) {
	#msg {
		left: 10px;
		margin-left: 0;
	}
}
<? } ?>
@keyframes fade {
	0%   {opacity:1; position: fixed; visibility: visible;}
	75%  {opacity:1; position: fixed; visibility: visible;}
	100% {opacity:0; position: fixed; visibility: hidden;}
}
@-moz-keyframes fade {
	0%   {opacity:1; position: fixed; visibility: visible;}
	75%  {opacity:1; position: fixed; visibility: visible;}
	100% {opacity:0; position: fixed; visibility: hidden;}
}
@-webkit-keyframes fade {
	0%   {opacity:1; position: fixed; visibility: visible;}
	75%  {opacity:1; position: fixed; visibility: visible;}
	100% {opacity:0; position: fixed; visibility: hidden;}
}
@-o-keyframes fade {
	0%   {opacity:1; position: fixed; visibility: visible;}
	75%  {opacity:1; position: fixed; visibility: visible;}
	100% {opacity:0; position: fixed; visibility: hidden;}
}
#deleteMsg {
	position: absolute;
	top: 15px;
	right: 15px;
}
#loggedInOpt {
	position: absolute;
	top: -2px;
}
#loggedInOpt form input {
	height: 30px;
	padding: 3px 5px;
	margin: 0;
}
#loggedInOpt * {
	display: inline;
}
<? if ($loggedIn) { ?>
@media all and (max-width: 1600px) {
	#loggedInOpt {
		top: 33px;
	}
}
<? } ?>
#search {
	font-size: 0.9em;
	position: relative;
	text-align: right;
	width: 50%;
	top: -40px;
}
<? if ($loggedIn) { ?>
@media all and (min-width: 1600px) {
	#search {
		max-width: 900px;
		margin: 0 auto;
	}
}
@media all and (max-width: 1600px) {
	#search {
		max-width: 900px;
		left: 50%;
	}
}
<? } ?>
#search form {
	z-index: 98;
}
#search input[type="submit"] {
	font-size: 0.9em;
	height: 30px;
	padding: 3px 5px;
	margin: 0;
}
footer {
	margin: 40px;
	border-top: 1px solid #CCC;
}
/* End Main Layout Styles */

/* General Styling */
ul {
	list-style: none;
}
form {
	line-height: 40px;
}
#loginForm input:not([type="submit"]):not([type="checkbox"]), #registerForm input:not([type="submit"]):not([type="checkbox"]) {
	border: 1tpx solid #999;
	height: 30px;
	float: right;
}
.searchResult, #posts, form[name="createPost"] {
	margin: 20px 0;
	padding: 20px 0;
	border: 1px solid #eee;
}
input[type="submit"], input[type="button"] {
	margin: 5px;
	padding: 5px;
	font-size: 0.8em;
	background-color: #ddd;
	background: url(overlay.png) repeat-x center #ddd;
	border: 1px dotted #eee;
}
input[type="submit"]:hover, input[type="button"]:hover {
	background: url(overlay.png) repeat-x center #eee;
	border: 1px dotted #fff;
}
textarea {
	width: 85%;
	padding: 5px;
	margin: 0;
	height: 50px;
	border: 1px solid #999;
	font-size: 0.8em;
	line-height: 1em;
}
img {
	max-width: 500px;
}
#posts {
	display: block;
}
iframe {
	display: block;
	z-index: 1;
}
/* End General Styling*/

/* Text Styling */
h1, h2, h3, h4, h5 {
	font-family: Oxygen, sans-serif;
}
a {
	color: #333;
}
a:visited {
	color: #555;
}
a:hover {
	color: #777;
}
#deleteMsg:hover {
	cursor: pointer;
}
.error {
	color: red;
}
.postTitle, .postTitle + p {
	margin: 10px 0;
}
#posts li {
	margin: 50px 0;
}
#posts li a:first-child, #posts .date, #posts .pi {
	font-size: 0.9em;
}
#posts .li a:first-child {
	padding-bottom: 30px;
}
#posts li ul li {
	margin: 10px;
}
/* End Text Styling */
