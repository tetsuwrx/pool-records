<?php
  require_once '/library/DataUtils.php';

  function getMemberTest()
  {
    $dataUtils = new DataUtils();

    $members = $dataUtils->getMemberListFromText();

    print_r($members);
  }

?>
