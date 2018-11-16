<?php
  require_once '../DataUtils.php';

  function getMemberTest()
  {
    $dataUtils = new DataUtils();

    $members = $dataUtils->getMemberListFromText();

    print_r($members);
  }

?>
