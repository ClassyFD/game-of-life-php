<!DOCTYPE html>
  <html>
    <head>
      <title>Game of Life PHP</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="description" content="Game of Life PHP">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <?php 
        include('./grid.php');
      ?>
    </head>
    <style>
      <?php include('./styles/index.css')?>
    </style>
    <body>
      <main id="root">
        <article id="game-container">
        </article>
        <h1>Created using PHP!</h1>
        <button onclick="resetBlocks()">RESET</button>
      </main>
     <script type="text/javascript">
        let currentBlocks;
        let interval = setInterval(()=>{
          tick();
        }, 100);
        const container = document.getElementById('game-container');

        const clearAndReplaceBlocks = (output) => {
          currentBlocks = JSON.parse(output);
          while (container.firstChild) {
            container.removeChild(container.firstChild);
          }
          currentBlocks.map((xEl, xIn)=>{
            xEl.map((jEl, jIn)=>{
              const newDiv = document.createElement('div');
              newDiv.className = `grid-block-${jEl} grid-block`;
              container.appendChild(newDiv);
            })
          })
        }

        const resetBlocks = () => {
          currentBlocks = null;
          clearInterval(interval);
          $.ajax({
            url: 'grid.php',
            data: {blocks: true},
            type: 'get',
            success: function(output) {
              clearAndReplaceBlocks(output);
              interval = setInterval(()=>{
                tick();
              }, 100);
            }
          })
        }

        const tick = () => {
          $.ajax({
            url: 'grid.php',
            data: {blocks: currentBlocks},
            type: 'post',
            success: function(output) {
              clearAndReplaceBlocks(output);
            }
          })
        }

        const initBlocks = () => {
          $.ajax({
            url: 'grid.php',
            data: {blocks: 'getBlocks'},
            type: 'get',
            success: function(output) {
              clearAndReplaceBlocks(output);
            }
          })
        }
        initBlocks();
      </script> 
    </body>
  </html>