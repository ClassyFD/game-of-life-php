<?php
  class Grid {
    public function initGrid() {
      $grid = array();
      for ($i = 0; $i <= 32; $i++) {
        for ($j = 0; $j <= 32; $j++) {
          $random = rand(0, 10);
          if ($random < 9) {
            $num = 0;
          } else {
            $num = 1;
          }
          $grid[$i][$j] = $num;
        };
      };
      return json_encode($grid);
    }
    
    public function updateBlocks($blocks) {
      foreach($blocks as $xKey=>$xValue) {
        foreach($xValue as $jKey => $jValue) {
          $count = 0;
          $count += $blocks[intval($xKey) -1][intval($jKey)] ?? 0;
          $count += $blocks[intval($xKey)][intval($jKey) - 1] ?? 0;
          $count += $blocks[intval($xKey) + 1][intval($jKey)] ?? 0;
          $count += $blocks[intval($xKey)][intval($jKey) + 1] ?? 0;
          $count += $blocks[intval($xKey) - 1][intval($jKey) - 1] ?? 0;
          $count += $blocks[intval($xKey) - 1][intval($jKey) + 1] ?? 0;
          $count += $blocks[intval($xKey) + 1][intval($jKey) - 1] ?? 0;
          $count += $blocks[intval($xKey) + 1][intval($jKey) + 1] ?? 0;

          $currentCell = $blocks[intval($xKey)][intval($jKey)];
          if ($currentCell && ($count < 2 || $count > 3)) {
            $newGrid[intval($xKey)][intval($jKey)] = 0;
          } else if ($currentCell && ($count === 2 || $count === 3)) {
            $newGrid[intval($xKey)][intval($jKey)] = 1;
          } else if (!$currentCell && $count === 3) {
            $newGrid[intval($xKey)][intval($jKey)] = 1;
          } else if (!$currentCell) {
            $newGrid[intval($xKey)][intval($jKey)] = 0;
          }
        };
      };
      return json_encode($newGrid);
    }
  }

  $grid = new Grid;

  if (isset($_POST['blocks'])) {
    $blocks = $_POST['blocks'];
    echo $grid->updateBlocks($blocks);
  }
  if (isset($_GET['blocks'])) {
    echo $grid->initGrid();
  }
?>