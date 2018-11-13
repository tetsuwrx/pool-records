<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" >
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <script type="text/javascript" src="js/index.js"></script>
  <title>ランキング</title>
</head>
<body>
  <?php if($_POST['a3date']){
      $sd = Mk_end_date($_POST["a3date"],$_POST['a3radio']);
      //$_POST["a3date"] = $sd[1];
      $battleSEt = Sum_battle_result($sd[0],$sd[1]);
  }
  ?>
  <form name="f3" method="POST" action="<?php basename(__FILE__);?>">
      <div class="a3menu"><?php echo $menu[$n]['title'];?></div>
      <div class="a3ttl">
          <div class="a3main">
              <div class="a3date">
              <input type="date" name="a3date" class="a3date" value="<?php if($_POST['a3date']<>Null){echo $_POST['a3date'];}else{echo date('Y-m-d');}?>">
              </div>
              <div class="a3date">
              <input type="submit" name="a3submit" class="a3submit" value="検索">
              </div>
              <div class="a3radio">
                  <input type="radio" name="a3radio" class="a3radio" value="A" <?php if($_POST['a3radio']=="A"){ ?> checked <?php } ?>>検索日まで
                  <input type="radio" name="a3radio" class="a3radio" value="B" <?php if($_POST['a3radio']=="B"){ ?> checked <?php } ?>>検索日を含む
              </div>
          </div>
          <?php if($_POST['a3submit']){ ?>
              <?php for($n=0;$n<=count($battleSEt)-1;$n++){?>
                  <div class="a3result">
                      <div class="a3rank"><?php $x=$n+1; echo $x."位";?></div>
                      <div class="a3name"><?php echo $battleSEt[$n]['yname'];?></div>
                      <div class="a3point"><?php echo $battleSEt[$n]['ttlscore']."pt.";?></div>
                  </div>
              <?php } ?>
          <?php } ?>
      </div>
  </form>
</body>
</html>
