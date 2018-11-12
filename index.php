<!DOCTYPE html>
<html lang="ja">
    <?php require_once("index_function.php");?>
    <head>
        <meta name="viewport" content="width=device-width" >
        <link rel="stylesheet" type="text/css" href="index.css">
        <script type="text/javascript" src="index.js"></script>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    </head>
    <body>
        <a href="<?php basename(__FILE__);?>">Goto top</a></div>
        </div>
        <?php      if($_POST['GologinPage'] || $_POST['loginbtn']){ //ログイン画面 ?>
            <form name="login" method="POST" action="<?php basename(__FILE__);?>">
                <?php if($_POST['GologinPage']){ ?>
                    <div style="text-align:center;">パスワードを入力してください。</div>
                    <div style="text-align:center;"><input name="password" type="momber"></div>
                    <div style="text-align:center;"><input name="loginbtn" type="submit" value="ログイン"></div>
                <?php };?>
                <?php if($_POST['loginbtn']){;?>
                    <?php $c = Start_Login_Session($_POST['password']);echo $c;?>
                <?php };?>
            </form>
        <?php exit; ?>
        <?php } ?>
        <?php      if($_POST['a0'] or $debug=="0" or $_POST['JSPOST']=="a0"){ $n=$_POST["ax0"]; //ボーラード ?> 
            <title><?php echo $menu[$n]['title'];?></title>
            <form name="f0" method="POST" action="<?php basename(__FILE__);?>">
            <input type="hidden" name="ax0" value="<?php echo $n;?>">
            <div><?php echo $menu[$n]['title'];?></div> 
            <img src="kojicyu.gif" width="90%" height="90%" alt="工事ちゅう">
            <div style="text-align:center;"></div>
            <?php exit;?>
                <input class="a0sub" type="submit" name="a0submit" value="あああ" onclick="a0datacheck()"></div>
            </form>       
            <!-- ここから適当-->
            <?php for($n=1;$n<=9;$n++){ ?>
                <div class="brd">
                    <div class="fbrd">
                        <div class="fram"><p class="text0"><?php echo $n;?></p></div>
                    </div>              
                    <div class="fbrd">  
                        <div class="abrd"><input onchange="x<?php echo $n;?>_Change()" class="abrd" typle="number" name="a<?php echo $n;?>"></div>
                        <div class="bbrd"><input onchange="x<?php echo $n;?>_Change()" class="bbrd" typle="number" name="b<?php echo $n;?>"></div>
                    </div>
                    <div class="fbrd">
                        <div class="Sbrd"><input class="Sbrd" type="number" name="S<?php echo $n;?>"></div>
                    </div>
                </div>
            <?php } ?>
            <div class="brd">
                <div class="fbrd">
                    <div class="fram10"><p class="text0"><?php echo "10";?></p></div>
                </div>              
                <div class="fbrd">  
                    <div class="abrd10"><input class="abrd10" typle="number"></div>
                    <div class="bbrd10"><input class="bbrd10" typle="number"></div>
                    <div class="cbrd10"><input class="cbrd10" typle="number"></div>
                </div>
                <div class="fbrd">
                    <div class="Sbrd10"><input class="Sbrd10" type="number"></div>
                </div>
            </div>    
            </form>
        <?php }elseif($_POST['a1'] or $debug=="1" or $_POST['JSPOST']=="a1"){ $n=$_POST["ax1"]; //リーグ戦入力 ?>
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
        <?php }elseif($_POST['a2'] or $debug=="2" or $_POST['JSPOST']=="a2"){ $n=$_POST["ax2"]; //ボーラード結果 ?> 
            <title><?php echo $menu[$n]['title'];?></title>
            <form name="f2" method="POST" action="<?php basename(__FILE__);?>">
            <input type="hidden" name="ax2" value="<?php echo $n;?>">
            <div><?php echo $menu[$n]['title'];?></div> 
            <img src="kojicyu.gif" width="90%" height="90%" alt="工事ちゅう">
            <div style="text-align:center;"></div>
            <?php exit;?>
                <input class="a2sub" type="submit" name="a2submit" value="あああ" onclick="a0datacheck()"></div>
            </form>  
        <?php }elseif($_POST['a3'] or $debug=="3" or $_POST['JSPOST']=="a3"){ $n=$_POST["ax3"]; //リーグ戦ランキング ?>
            <?php if($_POST['a3date']){ ?>
                <?php  $sd = Mk_end_date($_POST["a3date"],$_POST['a3radio']);?>
                <?php  //$_POST["a3date"] = $sd[1];?>
                <?php $battleSEt = Sum_battle_result($sd[0],$sd[1]); ?>
            <?php } ?>
            <title><?php echo $menu[$n]['title'];?></title>
            <form name="f3" method="POST" action="<?php basename(__FILE__);?>">
                <input type="hidden" name="ax3" value="<?php echo $n;?>">
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
                <input type="hidden" name="JSPOST" value="a3">
            </form>
        <?php }elseif($_POST['a4'] or $debug=="4" or $_POST['JSPOST']=="a4"){ $n=$_POST["ax4"]; //メンバー登録 ?> 
            <title><?php echo $menu[$n]['title'];?></title>
            <?php
                if($_POST['a4name']<>Null){
                    $memberData = a4nameCheck($_POST['a4No'],$_POST['a4name'],$_POST['a4Rank'],$_POST['a4sex']);
                    $_POST['a4No'] = $memberData['No'];
                    $_POST['a4name'] = $memberData['name'];
                    $_POST['a4Rank'] = $memberData['Rank'];
                    $_POST['a4sex'] = $memberData['sex'];
                    $_POST['btnval'] = $memberData['btnval'];
                }
                if($_POST['btnval']==Null){$_POST['btnval'] = "登　録";}
                ?>
                <form name="f4" method="POST" action="<?php basename(__FILE__);?>">
                <input type="hidden" name="ax4" value="<?php echo $n;?>">
                    <div class="a4menu"><?php echo $menu[$n]['title'];?></div>
                    <div class="a4ttl">
                        <div class="a4main">
                            <div class="a4r0">                       
                            <input class="a4No" type="text" name="a4hidden" value="<?php if($_POST['a4No']<>Null){echo $_POST['a4No'];}else{echo "No";};?>" disabled="disabled">
                            <input type="hidden" name="a4No" value="<?php if($_POST['a4No']<>Null){echo $_POST['a4No'];}else{echo "No";};?>">
                            </div>
                        </div>
                        <div class="a4main">
                            <div class="a4r1">                       
                            <input class="a4name" onclick="a4nameckick()" onchange="a4namechange()" type="text" name="a4name" value="<?php if($_POST['a4name']<>Null){echo $_POST['a4name'];}else{echo "ニックネーム";};?>">
                            </div>
                        </div>
                        <div class="a4main">
                            <div class="a4r2">                       
                            <select class="a4Rank" name="a4Rank">
                                <?php if($_POST['a4Rank']<>Null){?>
                                    <option value="<?php echo $_POST['a4Rank'];?>" selected><?php echo $_POST['a4Rank'];?></option>
                                <?php } ?>
                                <option value="class"><p name="a4Rnak">class</p></option>
                                <?php for($n=0;$n<=count($RankPoints)-1;$n++){ ?>
                                    <option value="<?php echo $RankPoints[$n]['Rank']; ?>"><p name="a4Rnak"><?php echo $RankPoints[$n]['Rank']; ?></p></option>
                                <?php }?>
                            </select>
                            </div>
                        </div>
                        <div class="a4main">
                            <div class="a4r3">                       
                            <select class="a4sex" name="a4sex">
                                <?php if($_POST['a4sex']<>Null){?>
                                    <option value="<?php echo $_POST['a4sex'];?>" selected><?php echo $_POST['a4sex'];?></option>
                                <?php } ?>
                                <option value="sex"><p name="a4sex">sex</p></option>
                                <option value="男"><p name="a4sex">男</p></option>
                                <option value="女"><p name="a4sex">女</p></option>
                            </select>
                            </div>
                        </div>
                        <div class="a4main">
                            <div class="a4r4">                       
                            <input class="a4submit" type="submit" name="a4submit" value="<?php echo $_POST['btnval'];?>">
                            </div>
                        </div>
                    </div>  
                    <input type="hidden" name="JSPOST" value="a4">
                </form>
        <?php }elseif($_POST['a5'] or $debug=="5" or $_POST['JSPOST']=="a5"){ $n=$_POST["ax5"]; //対戦分析 ?> 
            <title><?php echo $menu[$n]['title'];?></title>
            <form name="f5" method="POST" action="<?php basename(__FILE__);?>">
            <input type="hidden" name="ax5" value="<?php echo $n;?>">
            <div><?php echo $menu[$n]['title'];?></div> 
            <img src="kojicyu.gif" width="90%" height="90%" alt="工事ちゅう">
            <div style="text-align:center;"></div>
            <?php exit;?>
                <input class="a2sub" type="submit" name="a2submit" value="あああ" onclick="a0datacheck()"></div>
            </form>   
        <?php }else{ //<!--メインメニュー--> ?>
            <title><?php echo $mainmenu;?></title>
            <div class="mainttl">
                <div class="mainbase"><?php echo $mainmenu;?></div>
                <form method="POST" action="<?php basename(_FILE__);?>">
                <input type="hidden" name="ax0" value="<?php echo $n;?>">
                    <?php for($n=0;$n<=count($menu)-1;$n++){?>
                        <div class="mains<?php echo $n;?>">
                        <div class="main">
                            <input type="hidden" name="ax<?php echo $menu[$n]['menuNo'];?>" value="<?php echo $n;?>">
                            <input class="mainsubmit" type="submit" name="a<?php echo $menu[$n]['menuNo'];?>" value="<?php echo $menu[$n]['title'];?>">                         
                            </div>
                            <div class="mainball<?php echo $n;?>">
                                <div class="ballNomber"><?php echo $n+1;?></div>
                            </div>                 
                        </div>
                    <?php } ?>
                </form>
            </div>
        <?php } ?>
        <div class="c">(c)2018 KAZU & Kamisama</div>
        <div class="c">
            <form name="login" method="POST" action="<?php basename(__FILE__);?>">
                <div style="text-align:center;"><input name="GologinPage" type="submit" value="ログイン"></div>
            </form>
        </div>
    </body>
</html>

<?php exit; ?>

