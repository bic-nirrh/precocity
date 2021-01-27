<?php
session_start();
include("head.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Precocity:Ideogram</title>
  <style>
    body {
	font: 14px Arial;
	line-height: 19.6px;
	padding: 0 15px;
	background-color: #FFF;
}
    a, a:visited {text-decoration: none;}
    a:hover {text-decoration: underline;}
    a, a:hover, a:visited, a:active {color: #0366d6;}
  body,td,th {
	color: #000000;
}
  </style>
  <script type="text/javascript" src="ideogram-master/dist/js/ideogram.min.js"></script>

<meta charset="utf-8">
</head>
<body>
<h2 align="center">Chromosomal location of SNPs associated with precocious puberty <sup><a href="help.php#ideo"><i style="font-size:12px;color:#1DA8BF" class="fa fa-question-circle" ></i></a></sup></h2>
<table width="90%" border="0" cellspacing="0" cellpadding="20" align="center">
  <tr>
    <td><p align="justify"><font size="+1">The SNP visualizer tool aids to pictorially review the allelic variation and chromosomal coordinates of SNPs reported to be associated with precocious puberty. Chromosomes, in haploid state, are shown as vertical bars. Black and grey bands represent heterochromatin region; lighter bands represent euchromatin region; and blue represents variable region. Centromere is marked in pink.</font></p>
    <p align="justify">
    <font size="+1">
    Users can select a shape from list of shapes (circles, triangles or rectangles) to display SNPs. The SNP id and chromosomal location of SNPs associated with precocious puberty can be viewed by hovering mouse over each of the SNP pointers.
    </font></p></td>
  </tr>
</table>


    
     <table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
      <tr bgcolor="#FFFFFF"><td>
<h3>Annotation shape:
  <select id="shape-menu">
    <option>Triangle</option>
    <option>Circle</option>
    <option>Rectangle</option>
    <option>Narrow rectangle</option>
  </select>
</h3>
<script type="text/javascript">

  var d3 = Ideogram.d3;

  var annotHeight =  4.5;

  d3.selectAll('select').on('change', function() {

    var shape = this.options[this.selectedIndex].text.toLowerCase();

    if (shape === 'narrow rectangle') {
      shape =
        'm0,0 l 0 ' + (2 * annotHeight) +
        'l ' + annotHeight/2 + ' 0' +
        'l 0 -' + (2 * annotHeight) + 'z';
    }

    drawIdeogram(shape);

  });


  function drawIdeogram(shape) {

    var annotationTracks = [
      {id: 'pathogenicTrack', displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
      {id: 'uncertainSignificanceTrack', displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
      {id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape},
		{id: 'benignTrack',  displayName: 'Precocious puberty associated', color: '#F00', shape: shape}
    ];
	  
	  
    var legend = [{
      name: 'SNPs',
      rows: [
        {name: 'Precocious puberty associated', color: '#F00', shape: shape}
      ]
    }];
	
    var config = {
      organism: 'human',
      orientation: 'vertical',
      chrWidth: 18,
      annotationsPath: 'ideogram-master/data/annotations/snp_new.json',
      annotationTracks: annotationTracks,
      annotationHeight: annotHeight,
      legend: legend
    };
    if (typeof ideogram !== 'undefined') {
      d3.select(ideogram.config.container + '> div').remove();
    }

    ideogram = new Ideogram(config);
  }

  drawIdeogram('triangle');

</script>
</h1></td></tr></table>
</body>
</html>