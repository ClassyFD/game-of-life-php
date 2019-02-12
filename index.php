<!DOCTYPE html>
  <html>
    <head>
      <title>Game of Life PHP</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="description" content="Game of Life PHP">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style type="text/css"></style>      
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <style>
      <?php include('./index.css')?>
    </style>
    <body>
      <?php 
        include('./grid.php');
      ?>
      <main id="root">
        <article id="game-container">
        </article>
        <h1>Created using PHP!</h1>
        <button onclick="toggleStatus()">RESET</button>
      </main>
     <script type="text/javascript">
        let currentBlocks;
        let interval = setInterval(()=>{
          tick();
        }, 100);

        function toggleStatus() {
          currentBlocks = null;
          clearInterval(interval);
          $.ajax({
            url: 'grid.php',
            data: {blocks: true},
            type: 'get',
            success: function(output) {
              let blocks = JSON.parse(output);
              const container = document.getElementById('game-container');
              while (container.firstChild) {
                container.removeChild(container.firstChild);
              }
              currentBlocks = blocks;
              interval = setInterval(()=>{
                tick();
              }, 100)
              currentBlocks.map((xEl, xIn)=>{
                xEl.map((jEl, jIn)=>{
                  let newDiv = document.createElement('div');
                  newDiv.className = `grid-block-${jEl} grid-block`;
                  container.appendChild(newDiv);
                })
              })
            }
          })
        }
        function tick() {
          $.ajax({
            url: 'grid.php',
            data: {blocks: currentBlocks},
            type: 'post',
            success: function(output) {
              let blocks = JSON.parse(output);
              const container = document.getElementById('game-container');
              while (container.firstChild) {
                container.removeChild(container.firstChild);
              }
              currentBlocks = blocks;
              currentBlocks.map((xEl, xIn)=>{
                xEl.map((jEl, jIn)=>{
                  let newDiv = document.createElement('div');
                  newDiv.className = `grid-block-${jEl} grid-block`;
                  container.appendChild(newDiv);
                })
              })
            }
          })
        }
        function initBlocks() {
          $.ajax({
            url: 'grid.php',
            data: {blocks: true},
            type: 'get',
            success: function(output) {
              let blocks = JSON.parse(output);
              const container = document.getElementById('game-container');
              while (container.firstChild) {
                container.removeChild(container.firstChild);
              }
              currentBlocks = blocks;
              currentBlocks.map((xEl, xIn)=>{
                xEl.map((jEl, jIn)=>{
                  let newDiv = document.createElement('div');
                  newDiv.className = `grid-block-${jEl} grid-block`;
                  container.appendChild(newDiv);
                })
              })
            }
          })
        }
        initBlocks();
      </script> 
    </body>
  </html>