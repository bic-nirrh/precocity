<!DOCTYPE html>
<html>
<head>
  <title>Precocity:Ideogram</title>
  <style>
    body {font: 14px Arial; line-height: 19.6px; padding: 0 15px;}
    a, a:visited {text-decoration: none;}
    a:hover {text-decoration: underline;}
    a, a:hover, a:visited, a:active {color: #0366d6;}
  </style>
  <script type="text/javascript" src="ideogram-master/dist/js/ideogram.min.js"></script>

</head>
<body>

    
     <table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
      <tr bgcolor="#FFFFFF"><td>
<h1>Ideogram</h1>

  Annotation shape:
  <select id="shape-menu">
    <option>Triangle</option>
    <option>Circle</option>
    <option>Rectangle</option>
    <option>Narrow rectangle</option>
  </select>
</p>
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
      chrWidth: 6,
      annotationsPath: 'ideogram-master/data/annotations/snp.json',
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

</script></td></tr></table>
</body>
</html>