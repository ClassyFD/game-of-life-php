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
      </main>
     <script type="text/javascript">
        function getGrid(newGrid) {
          let blocks = newGrid || "<?php echo json_encode($blocks) ?>";
          const container = document.getElementById('game-container');
          blocks = JSON.parse(blocks);
          blocks.map((xEl, xIn)=>{
            xEl.map((jEl, jIn)=>{
              let newDiv = document.createElement('div');
              newDiv.id = `${xIn},${jIn}`;
              newDiv.className = `grid-block-${jEl} grid-block`;
              container.appendChild(newDiv);
            })
          })
          setTimeout(() => {
          $.ajax({
            url: 'grid.php',
            data: {blocks: blocks},
            type: 'post',
            success: function(output) {
              while (container.firstChild) {
                container.removeChild(container.firstChild);
              }
              getGrid(output);
            }
          })
          }, 10);
        }
        getGrid();
      </script> 
    </body>
  </html>