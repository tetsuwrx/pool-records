<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" >
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <script type="text/javascript" src="js/index.js"></script>
  <title>リーグ戦結果入力</title>
</head>
<body>
  <?php
      if($_POST['a1submit']){
          $a1result = inputbattleData($_POST['a1memberA'],$_POST['a1memberB'],$_POST['a1scoreA'],$_POST['a1scoreB'],$_POST['a1winner'],$_POST['a1Date'],$_POST['a1masuA'],$_POST['a1masuB'],$PointList);
          $_POST['a1Date'] = $a1result['battledate'];
          $_POST['a1memberA'] = $a1result['nameA'];
          $_POST['a1memberB'] = $a1result['nameB'];
          $_POST['a1scoreA'] = $a1result['scoreA'];
          $_POST['a1scoreB'] = $a1result['scoreB'];
          $_POST['a1winner'] = $a1result['winner'];
          $_POST['a1masuA'] = $a1result['masuA'];
          $_POST['a1masuB'] = $a1result['masuB'];
      }
  ?>
  <?php $members = Get_textDataSet('member.txt');//対戦者のデータを取得(No,Name,Rank,date) ?>
  <?php $WinUser = Calculation_WL($_POST['a1memberA'],$_POST['a1scoreA'],$_POST['a1memberB'],$_POST['a1scoreB'],$_POST['a1winner'],$RankPoints);//対戦成績から勝者を自動判定?>
  <?php foreach($members as $key => $value){$sort_keys[$key] = 5;} array_multisort($sort_keys, SORT_DESC, $members); //最近の人から並び替え　?>
  <?php $pl[0] = Srch_AryDta_toArycol('member.txt',$_POST['a1memberA'],1,2); ?>
  <?php $pl[1] = Srch_AryDta_toArycol('member.txt',$_POST['a1memberB'],1,2); ?>
  <title><?php echo $menu[$n]['title'];?></title>
  <form name="f1" method="POST" action="<?php basename(__FILE__);?>">
  <input type="hidden" name="ax1" value="<?php echo $n;?>">
      <div class="a1ttl"><?php echo $menu[$n]['title'];?></div>
      <div class="a1main">
          <div class="a1Date">
              <input class="a1Date" name="a1Date" type="date" value="<?php if($_POST['a1Date']<>Null){echo $_POST['a1Date'];}else{echo date('Y-m-d');}?>">
          </div>
          <div class="a1data">
              <div class="a1result">
                  <div class="a1name">
                      <select class="a1name" name="a1memberA" onchange="a1InputChange()">
                          <?php if($_POST['a1memberA']<>Null){?>
                              <option value="<?php echo $_POST['a1memberA'];?>" selected><?php echo $_POST['a1memberA'];?></option>
                          <?php }else{ ?>
                              <option value="name"><p class="a1member">name</p></option>
                          <?php } ?>
                          <?php for($n=0;$n<count($members);$n++){?><option value="<?php echo $members[$n][1];?>"><?php echo $members[$n][1];?></option><?php } ?>
                      </select>
                  </div>
                  <div class="a1Rank">
                      <input class="a1Rank" name="a1RankA" type="text" value="<?php if($pl[0]<>Null){echo $pl[0];}elseif($_POST['a1RankA']<>Null){echo $_POST['a1RankA'];}else{echo 'class';}?>" readonly="readonly">
                  </div>
                  <div class="a1score">
                      <input class="a1score" onchange="a1InputChange()" onclick="a1scorechangeA()" name="a1scoreA" type="text" value="<?php if($_POST['a1scoreA']<>Null){echo $_POST['a1scoreA'];}else{echo 'score';}?>">
                  </div>
                  <div class="a1masu">
                      <select class="a1masu" name="a1masuA" onchange="a1InputChange()">
                          <?php if($_POST['a1masuA']<>Null){?>
                              <option value="<?php echo $_POST['a1masuA'];?>" selected><?php echo $_POST['a1masuA'];?></option>
                          <?php }else{ ?>
                              <option value="◎"><p class="a1masu">◎</p></option>
                          <?php } ?>
                          <?php for($n=0;$n<=7;$n++){?><option value="◎-<?php echo $n;?>">◎-<?php echo $n;?></option><?php } ?>
                      </select>
                  </div>
                  <?php if($WinUser=="A"){ ?>
                      <div class="a1winnerWINNER">WINNER</div>
                  <?php }elseif($WinUser=="B"){ ?>
                      <div class="a1winnerLOSEER">LOSEER</div>
                  <?php }else{ ?>
                      <div class="a1winner"></div>
                  <?php } ?>
              </div>
              <div class="a1center">
                  <div class="a1VS"><p class="a1VS">VS</p></div>
              </div>
              <div class="a1result">
                  <div class="a1name">
                      <select class="a1name" name="a1memberB" onchange="a1InputChange()">
                          <?php if($_POST['a1memberB']<>Null){?>
                              <option value="<?php echo $_POST['a1memberB'];?>" selected><?php echo $_POST['a1memberB'];?></option>
                          <?php }else{ ?>
                              <option value="name"><p class="a1member">name</p></option>
                          <?php } ?>
                          <?php for($n=0;$n<count($members);$n++){?><option value="<?php echo $members[$n][1];?>"><?php echo $members[$n][1];?></option><?php } ?>
                      </select>
                  </div>
                  <div class="a1Rank">
                      <input class="a1Rank" name="a1RankB" type="text" value="<?php if($pl[1]<>Null){echo $pl[1];}elseif($_POST['a1RankB']<>Null){echo $_POST['a1RankB'];}else{echo 'class';}?>" readonly="readonly">
                  </div>
                  <div class="a1score">
                      <input class="a1score" onchange="a1InputChange()" onclick="a1scorechangeB()" name="a1scoreB" type="text" value="<?php if($_POST['a1scoreB']<>Null){echo $_POST['a1scoreB'];}else{echo 'score';}?>">
                  </div>
                  <div class="a1masu">
                      <select class="a1masu" name="a1masuB" onchange="a1InputChange()">
                          <?php if($_POST['a1masuB']<>Null){?>
                              <option value="<?php echo $_POST['a1masuB'];?>" selected><?php echo $_POST['a1masuB'];?></option>
                          <?php }else{ ?>
                              <option value="◎"><p class="a1masuB">◎</p></option>
                          <?php } ?>
                          <?php for($n=0;$n<=7;$n++){?><option value="◎-<?php echo $n;?>">◎-<?php echo $n;?></option><?php } ?>
                      </select>
                  </div>
                  <?php if($WinUser=="B"){ ?>
                      <div class="a1winnerWINNER">WINNER</div>
                  <?php }elseif($WinUser=="A"){ ?>
                      <div class="a1winnerLOSEER">LOSEER</div>
                  <?php }else{ ?>
                      <div class="a1winner"></div>
                  <?php } ?>
              </div>
          </div>
          <div class="a1btns">
              <input class="a1btns" type="submit" name="a1submit" value="結　果　登　録" onclick="a1datacheck()">
          </div>
      </div>
      <input class="a1winner"  name="a1winner" type="hidden" value="<?php echo $WinUser ?>">
      <input type="hidden" name="JSPOST" value="a1">
  </form>
</body>
</html>
