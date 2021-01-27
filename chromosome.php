<!DOCTYPE html>
<html>
<head>
  <title>Related genes | Ideogram</title>
  <style>
    body {font: 14px Arial; line-height: 19.6px; padding: 0 15px;}
    a, a:visited {text-decoration: none;}
    a:hover {text-decoration: underline;}
    a, a:hover, a:visited, a:active {color: #0366d6;}

    select, optgroup, option {
      float: left;
      font-size: 14px;
    }

    #ideogram-container {z-index: -1}

    #search-container {
      height: 26px;
      float: left;
      position: relative;
      top: -4px;
      margin-left: 10px;
    }

    #search-genes {
      padding-left: 3px;
      width: 200px;
      height: 20px;
      font-size: 14px;
      border-radius: 3px;
      border: 1px solid #888;
    }

    #search-button {
      height: 23px;
      width: 23px;
      font-size: 24px;
      background: #58F;
      color: #FFF;
      display: inline-block;
      position: relative;
      top: 2px;
      left: -25px;
      border-radius: 3px;
      text-align: center;
      padding-top: 1px;
      cursor: pointer;
    }

    #ideogram .annot path {
      cursor: pointer;
    }
  </style>
  <script type="text/javascript" src="ideogram-master/dist/js/ideogram.min.js"></script>
<link rel="icon" type="image/x-icon" href="ideogram-master/examples/vanilla/img/ideogram_favicon.ico">
</head>
<body>
  <h1>Related genes |    </h1>
  <a href="ideogram-master/examples">Overview</a> |
  <a href="ideogram-master/examples/vanilla/annotations-heatmap">Previous</a> |
  <a href="ideogram-master/examples/vanilla/differential-expression">Next</a> |
  <a href="https://github.com/eweitz/ideogram/blob/gh-pages/related-genes.html" target="_blank">Source</a>
  <p>
    Find interacting pathway genes and paralogs.  Uses data from
    <a href="https://rest.ensembl.org">Ensembl</a>,
    <a href="https://www.wikipathways.org">WikiPathways</a>, and
    <a href="https://mygene.info">MyGene.info</a>.
    See also <a href="ideogram-master/examples/vanilla/orthologs">Orthologs</a>.
  </p>
  <div>
    <select>
      <optgroup label="Model organisms">
        <option value="homo-sapiens" selected>Human (Homo sapiens)</option>
        <option value="mus-musculus">Mouse (Mus musculus)</option>
        <option value="rattus-norvegicus">Rat (Rattus norvegicus)</option>
        <!-- <option value="drosophila-melanogaster">Fly (Drosophila melanogaster)</option> -->
        <!-- <option value="caenorhabditis-elegans">Worm (Caenorhabditis elegans)</option> -->
        <option value="danio-rerio">Zebrafish (Danio rerio)</option>
        <!-- <option value="arabidopsis-thaliana">Thale cress (Arabidopsis thaliana)</option> -->
        <!-- <option value="saccharomyces-cerevisiae">Yeast (Saccharomyces cerevisiae)</option> -->
      </optgroup>
      <optgroup label="Vertebrates">
        <option value="pan-troglodytes">Chimpanzee (Pan troglodytes)</option>
        <option value="macaca-mulatta">Macaque (Macaca mulatta)</option>
        <option value="macaca-fascicularis">Crab-eating macaque (Macaca fascicularis)</option>
        <option value="felis-catus">Cat (Felis catus)</option>
        <option value="canis-lupus-familiaris">Dog (Canis lupus familiaris)</option>
        <option value="equus-caballus">Horse (Equus caballus)</option>
        <option value="bos-taurus">Cow (Bos taurus)</option>
        <option value="sus-scrofa">Pig (Sus scrofa)</option>
        <!-- <option value="petromyzon-marinus">Lamprey (Petromyzon marinus)</option> -->
      </optgroup>
      <!-- <optgroup label="Plants">
        <option value="zea-mays">Maize (Zea mays)</option>
        <option value="oryza-sativa">Rice (Oryza sativa)</option>
        <option value="solanum-lycopersicum">Tomato (Solanum lycopersicum)</option>
        <option value="musa-acuminata">Banana (Musa acuminata)</option>
        <option value="vitis-vinifera">Grape (Vitis vinifera)</option>
        <option value="micromonas-commoda">Green algae (Micromonas commoda)</option>
      </optgroup>
      <optgroup label="Insects">
        <option value="anopheles-gambiae">Mosquito (Anopheles gambiae)</option>
      </optgroup>
      <optgroup label="Protozoa">
        <option value="plasmodium falciparum">Malaria parasite (Plasmodium falciparum)</option>
        <option value="leishmania donovani">Leishmania parasite (Leishmania donovani)</option>
      </optgroup> -->
    </select>
  </div>
  <div style="float: left; width: 350px;">
    <label for="search-genes" id="search-container">
      <input id="search-genes" autocomplete="off" placeholder="Search gene (e.g. RAD51)"/>
      <span id="search-button">
        <svg width="12" height="13"><g stroke-width="2" stroke="#FFF" fill="none"><path d="M11.29 11.71l-4-4"/><circle cx="5" cy="5" r="4"/></g></svg>
      </span>
    </label>
  </div>
  <br/><br/><br/>
  <div id="ideogram-container"></div>
  <script type="text/javascript">

    const urlParams = parseUrlParams();

    const organism = 'org' in urlParams ? urlParams.org : 'homo-sapiens';

    document.querySelector(`[value="${organism}"]`).selected = true;
    document.querySelector('select').addEventListener('change', handleOrganism);

    if ('q' in urlParams) {
      document.querySelector('#search-genes').value = urlParams['q'];
    }

    document.querySelector('#search-button').addEventListener('click', handleSearch);
    document.querySelector('#search-genes').addEventListener('keyup', handleSearch);

    function parseUrlParams() {
      let rawParams = document.location.search;
      const urlParams = {};
      var param, key, value;
      if (rawParams !== '') {
        rawParams = rawParams.split('?')[1].split('&');
        rawParams.forEach(rawParam => {
          param = rawParam.split('=');
          key = param[0];
          value = param[1];
          urlParams[key] = value;
        });
      }
      return urlParams;
    }

    // Record app state in URL
    function updateUrl() {
      const params = Object.keys(urlParams).map(key => {
        return key + '=' + urlParams[key];
      }).join('&');
      history.pushState(null, null, '?' + params);
    }

    function handleOrganism() {
      const selectedOrg =
        document.querySelector('option:checked').text
          .split('(')[1].split(')')[0]
          .replace(/ /g, '-').toLowerCase();

      urlParams['org'] = selectedOrg;
      updateUrl();

      config.organism = selectedOrg;
      // const banded = !['homo sapiens', 'mus musculus'].includes(selectedOrg);
      // config.showFullyBanded = banded;
      delete ideogram;
      ideogram = new Ideogram(config);

    }

    // Process text input for the "Search" field.
    function handleSearch(event) {
      // Ignore non-"Enter" keyups
      if (event.type === 'keyup' && event.keyCode !== 13) return;

      const searchInput = event.target.value.trim();

      // Handles e.g. "BRCA1,BRCA2", "BRCA1 BRCA2", and "BRCA1, BRCA2"
      const geneSymbols = searchInput.split(/[, ]/).filter(d => d !== '')
      const geneSymbol = geneSymbols[0];

      urlParams['q'] = geneSymbol;
      updateUrl();

      ideogram.plotRelatedGenes(geneSymbol);
    }

    function plotGeneFromUrl() {
      if ('q' in urlParams) {
        ideogram.plotRelatedGenes(urlParams['q']);
      }
    }

    function onClickAnnot(annot) {
      document.querySelector('#search-genes').value = annot.name;
      urlParams['q'] = annot.name;
      updateUrl();
      ideogram.plotRelatedGenes(annot.name);
    }

    config = {
      organism: organism,
      container: '#ideogram-container',
      chrWidth: 8,
      chrHeight: 90,
      chrLabelSize: 10,
      annotationHeight: 5,
      onClickAnnot: onClickAnnot,
      onLoad: plotGeneFromUrl
    }

    let ideogram = Ideogram.initRelatedGenes(config)
  </script>
</body>
</html>
