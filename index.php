<!DOCTYPE html>
  <html>
    <head>
      <title>PHP Playground</title>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <meta name="description" content="PHP Playground">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <style type="text/css"></style>
    </head>
    <style>
      <?php include('./index.css')?>
    </style>
    <body>
      <?php
        
        function createGrid() {
          define('$xAxis', array());
          for ($i = 0; $i <= 32; $i++) {
            $xAxis["column" . $i] = array();
            for ($j = 0; $j <= 32; $j++) {
              $xAxis[$i][$i . "," . $j] = 0;
            };
          };
          return $xAxis;
        }
        
        $grid = createGrid();
        // $GLOBALS['grid'] = createGrid();
        echo "
        <script type='text/javascript'>
          function clickBlock(key) {
            const key1 = parseInt(key.split(',')[0]);
            const key2 = parseInt(key.split(',')[1]);
            
            console.log(key1);
            console.log(key2);
          }
        </script>
      ";

        echo "
          <main class='game'>
            <div class='block-container'>
        ";
        foreach($grid as $key=>$value) {
          foreach($value as $key => $value) {
            $escapedString = json_encode($key);
            echo $value === 1? 
            // "<div onclick='clickBlock($escapedString)' class=\"grid-block-alive grid-block\"></div>" : 
            // "<div onclick='clickBlock($escapedString)' class=\"grid-block-dead grid-block\"></div>";
            "<a href=" class=\"grid-block-alive grid-block\"></a>" : 
            "<a href=" class=\"grid-block-dead grid-block\"></a>";
          };
        };
      ?>
    </body>
  </html>