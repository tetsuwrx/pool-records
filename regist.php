<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <meta name="viewport" content="width=device-width" >
  <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
  <link rel="stylesheet" type="text/css" href="css/index.css">
  <script type="text/javascript" src="js/index.js"></script>
  <title>メンバー登録</title>
</head>
<body>
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
</body>
</html>
