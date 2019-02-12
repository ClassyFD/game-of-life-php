<?php
  class Grid {
    public $grid = array();
    public function initGrid() {
      $this->grid = array();
      for ($i = 0; $i <= 32; $i++) {
        $this->grid[$i] = array();
        for ($j = 0; $j <= 32; $j++) {
          $random = rand(0, 10);
          $num;
          if ($random < 9) {
            $num = 0;
          } else {
            $num = 1;
          }
          $this->grid[$i][$j] = $num;
        };
      };
      return $this->grid;
    }
    public function updateBlocks($blocks) {
      $newGrid = array();
      foreach($blocks as $xKey=>$xValue) {
        $newGrid[$xKey] = array();
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
  $newGrid = new Grid;
  $blocks = $newGrid->initGrid();

  if (isset($_POST['blocks']) && !empty($_POST['blocks'])) {
    $blocks = $_POST['blocks'];
    echo $newGrid->updateBlocks($blocks);
  }
  if (isset($_GET['blocks']) && !empty($_GET['blocks'])) {
    echo json_encode($newGrid->initGrid());
  }

?>