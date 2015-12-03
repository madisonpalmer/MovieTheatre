<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <style>
            #accordion { 
                width: 500px; 
                margin: 100px auto; }
            #accordion div {
                float: left;
                width:25%;
                height: 300px;
                overflow: hidden;}
            #accordion:hover div { 
                width: 20px; }
            #accordion:hover div:hover {
                width: 440px;
                overflow: auto; }
            #accordion {
                width: 500px;
                height: 400px;
                margin: 20% auto; }
            #accordion div {
                    height:300px;
                    overflow: hidden;}
            #accordion:hover div {
                    height: 300px; }
            #accordion:hover div:hover {
                    height: 300px;
                    overflow: auto; }
            #part1{
                background-color: blue;
            }
            #part2{
                background-color: red;
            }
            #part3{
                background-color: orange;
            }
            #part4{
                background-color: pink;
            }
        </style>
        <div id="accordion">
	<div id="part1">
		<p>This text is in part 1.</p>
	</div>
	<div id="part2">
		<p>This text is in part 2.</p>
	</div>
	<div id="part3">
		<p>This text is in part 3.</p>
	</div>
	<div id="part4">
		<p>This text is in part 4.</p>
	</div>
</div>
    </body>
</html>
