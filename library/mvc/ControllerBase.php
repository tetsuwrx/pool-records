<?php
//base_Array_data & .txtData_info
    //member.txt(key,Name,Class,Sex,登録日,更新日)
    //battledata.txt(key1,scoreA,pointA,key2,scoreB,pointB,winner,date,masuA,$masuB)
    //mb_language("Japanese");
    //mb_internal_encoding("EUC-JP");
    //mb_internal_encoding("UTF-8");
    date_default_timezone_set('Asia/Tokyo');
    $mainmenu = "メインメニュー";
    $menu = array(
        array("title" => "メンバー登録","menuNo" => "4"),
        array("title" => "リーグ戦ランキング","menuNo" => "3"),
        array("title" => "対戦分析","menuNo" => "5"),
        array("title" => "ボーラードに挑戦","menuNo" => "0"),
        array("title" => "ボーラード結果","menuNo" => "2"),
        array("title" => "リーグ戦結果入力(店員用)","menuNo" => "1")
        );
    $RankPoints = array(
        array('Rank' => 'SA' ,'Point' => 7),
        array('Rank' => 'AA' ,'Point' => 6),
        array('Rank' => 'A' ,'Point' => 5),
        array('Rank' => 'SB' ,'Point' => 5),
        array('Rank' => 'B' ,'Point' => 4),
        array('Rank' => 'C' ,'Point' => 5),
        array('Rank' => 'UC' ,'Point' => 2),
        );
    $PointList = array(
        '1stWinner' => '7',
        '1stLoseerMax' => '2',
        'Winner' => '1',
        'Loseer' => '0'
        );
//PHP
    //SESSION
        function Start_Login_Session($PW){

        }
    //マス割りの◎を削除
        function maru_Henkan($data){
            $result =str_replace("◎-","",$data);
            return $result;
            }
    //並び替えとかにつかう Array_Column
    //    function array_column ($target_data, $column_key, $index_key = null) {
    //        if (is_array($target_data) === FALSE || count($target_data) === 0) return FALSE;
    //        $result = array();
    //        foreach ($target_data as $array) {
    //            if (array_key_exists($column_key, $array) === FALSE) continue;
    //            if (is_null($index_key) === FALSE && array_key_exists($index_key, $array) === TRUE) {
    //                $result[$array[$index_key]] = $array[$column_key];
    //                continue;
    //            }
    //            $result[] = $array[$column_key];
    //        }
    //        if (count($result) === 0) return FALSE;
    //        return $result;
    //        }
    //テキストデータ全体を引っ張ってくるやつ
        function Get_textDataSet($fileNm){
            $fp=fopen($fileNm,'r');
            $n=0;
            while(!feof($fp)){
                $List[$n] = fgets($fp);
                $List[$n] = str_replace("\n","",$List[$n]);
                $Lists[$n] = explode(",",$List[$n]);
                $n++;
            }
            fclose($fp);
            return $Lists;
            }
    //テキストのarray番号からデータ呼び出してくれるやつ
        function Srch_AryDta_toArycol($fileNm,$SearchData,$ScerchColumnNo,$OutcolumnNo){
            $Lists = Get_textDataSet($fileNm);
            for($n=0;$n<=count($Lists)-1;$n++){
                if($SearchData == $Lists[$n][$ScerchColumnNo]){
                    return str_replace("\n,","",$Lists[$n][$OutcolumnNo]);
                    exit;
                }
            }
            return Null;
        }
    //textデータの一部を修正する(複数) $SetDataS[$n] = array(データ順番重要);
        function Change_TXT_data($keyColum,$SetDataS,$TXTdata){
            $DBTEXT = Get_textDataSet($TXTdata);
                for($m=0;$m<count($SetDataS);$m++){                       //変更したいデータROW
                    for($n=0;$n<count($DBTEXT);$n++){                      //textデータのROW
                        if($DBTEXT[$n][$keyColum]==$SetDataS[$m][$keyColum]){
                            for($x=0;$x<count($SetDataS[$m]);$x++){              //RowSrray内のColumnで修正したいもののみ修正
                                if($SetDataS[$m][$x] <> Null){                  //Nullの時は変更しない(Nullに変更はできない)
                                    $Lists[$n][$x] = $SetDataS[$m][$x];
                                }else{
                                    $Lists[$n][$x] = $DBTEXT[$n][$x];
                                }
                            }
                        }else{
                            $Lists[$n] = $DBTEXT[$n];
                        }
                    }
                }
            $a = fopen($TXTdata, "w");
            for($n=0;$n<count($Lists);$n++){
                if($n==0){
                    @fwrite($a, implode(",",$Lists[$n]));
                }else{
                    @fwrite($a, "\n".implode(",",$Lists[$n]));
                }
            }
            fclose($a);
            return true;
        }
    //txtデータの追記(1個ずつ)
        function TEXT_DATA_add_to($textFile,$DataAry){
            $a = fopen($textFile, "a");
            if(count(file($textFile))==0){
                @fwrite($a,implode(",",$DataAry));  //データベースが空の時
            }else{
                @fwrite($a,"\n".implode(",",$DataAry));
            }
            fclose($a);
            return true;
        }
//a1 リーグ戦入力
    //獲得勝利数がclassのMAXになっていたらWINをつける
        function Calculation_WL($ynameA,$scoreA,$ynameB,$scoreB,$winnerData,$RankPoints){
            $RankA = Srch_AryDta_toArycol('/controllers/member.txt',$ynameA,1,2);
            $RankB = Srch_AryDta_toArycol('/controllers/member.txt',$ynameB,1,2);
            $x=0;
                for($n=0;$n<=count($RankPoints)-1;$n++){
                    if($RankA==$RankPoints[$n]['Rank']){$WinScore[0]=$RankPoints[$n]['Point'];$x++;break;}
                }
                if($x==0){$WinUser=Null;}elseif($WinScore[0]==$scoreA){$WinUser="A";}
                for($n=0;$n<=count($RankPoints)-1;$n++){
                    if($RankB==$RankPoints[$n]['Rank']){$WinScore[1]=$RankPoints[$n]['Point'];$x++;break;}
                }
                if($x==0){$WinUser=Null;}elseif($WinScore[1]==$scoreB){$WinUser="B";}
            return $WinUser;
            }
    //勝敗データを登録する
        function inputbattleData($ynameA,$ynameB,$scoreA,$scoreB,$winner,$battledate,$masuA,$masuB,$PointList){
            //入力チェック
                if($battledate==Null || $battledate==""){echo "<script>alert('対戦日が選択されていません。');</script>";goto repage;}
                if($ynameA==Null || $ynameA=="" || $ynameA=="name"){echo "<script>alert('対戦者Aが選択されていません。');</script>";goto repage;}
                if($ynameB==Null || $ynameB=="" || $ynameB=="name"){echo "<script>alert('対戦者Bが選択されていません。');</script>";goto repage;}
                if($ynameA==$ynameB){echo "<script>alert('対戦者Aと対戦者Bが同名です。');</script>";goto repage;}
                if($scoreA==Null || $scoreA=="" || $scoreA=="score"){echo "<script>alert('得点Aが入力されていません。');</script>";goto repage;}
                if($masuA==Null || $masuA=="" || $masuA=="◎"){echo "<script>alert('Aのマス割り数が選択されていません。');</script>";goto repage;}
                if($scoreB==Null || $scoreB=="" || $scoreB=="score"){echo "<script>alert('得点Bが入力されていません。');</script>";goto repage;}
                if($masuB==Null || $masuB=="" || $masuB=="◎"){echo "<script>alert('Bのマス割り数が選択されていません。');</script>";goto repage;}
                if($winner==Null || $winner==""){echo "<script>alert('勝者が選択されていません。');</script>";goto repage;}
            //テキストデータ取得
                $bdset = Get_textDataSet('/controllers/battledata.txt');
            //ユーザー名→Key取得
                $yNomberA = Srch_AryDta_toArycol('/controllers/member.txt',$ynameA,1,0);
                $yNomberB = Srch_AryDta_toArycol('/controllers/member.txt',$ynameB,1,0);

            //リーグ戦期間中の初戦・２戦目か判定
                $nmSet[0] = $ynameA."-VS-".$ynameB;
                $nmSet[1] = $ynameB."-VS-".$ynameA;
                $ed = date('Y-m-d',strtotime($battledate));
                $sd = date('Y-m-01',strtotime($battledate)); //31日問題回避用
                if(date('m',strtotime($sd))%2 == 0){
                    $sd = date('Y-m-01', strtotime($sd.'-1 month')); //偶数月
                }else{
                    $sd = date('Y-m-01',strtotime($sd)); //奇数月
                }
                $p=0;
                for($n=0;$n<=count($bdset)-1;$n++){
                    if($bdset[$n][0]."-VS-".$bdset[$n][3]==$nmSet[0] or $bdset[$n][0]."-VS-".$bdset[$n][3]==$nmSet[1]){  //対戦者が同じか判定しなきゃ
                        $cd = date('Y-m-d',strtotime(date($bdset[$n][7])));
                        if($sd <= $cd && $cd <= $ed){ //以前に対戦している
                            $p++;
                        }
                    }
                }
            //初戦か2戦目(勝者７ポイント、敗者は勝利数（MAX２ポイントまで)
                if($p<2){
                    if($winner == "A"){$pointA = $PointList['1stWinner'];
                        if($scoreB > "2"){$pointB = $PointList['1stLoseerMax'];}
                        else{$pointB = $scoreB;}
                    }
                    if($winner == "B"){$pointB = $PointList['1stWinner'];
                        if($scoreA > "2"){$pointA = $PointList['1stLoseerMax'];}
                        else{$pointA = $scoreA;}
                    }
                }else{
                    if($winner == "A"){$pointA = $PointList['Winner'];$pointB = $PointList['Loseer'];}
                    if($winner == "B"){$pointA = $PointList['Loseer'];$pointB = $PointList['Winner'];}
                }
            //テキストデータへ追記
                $masuA = maru_Henkan($masuA);
                $masuB = maru_Henkan($masuB);
                $DataAry = array($yNomberA,$scoreA,$pointA,$yNomberB,$scoreB,$pointB,$winner,$battledate,$masuA,$masuB);
                $C = TEXT_DATA_add_to('/controllers/battledata.txt',$DataAry);
            //member.txt の日付を変更
                $SetDataS[0] =Array(Null,$yNomberA,Null,Null,Null,$ed);
                $SetDataS[1] =Array(Null,$yNomberB,Null,Null,Null,$ed);
                $Comment = Change_TXT_data('1',$SetDataS,'/controllers/member.txt');
            //最終処理
                echo "<script>alert('対戦成績を登録しました。');</script>"; //ここ成功したらにすべき？
                $rtnval = array('nameA' => Null,'nameB' => Null,'scoreA' => Null,'scoreB' => Null,'winner' => Null,'masuA' => Null,'masuB' => Null);
                return $rtnval;
                exit;
            //入力エラー
                repage:
                $rtnval = array(
                    'nameA' => $ynameA,
                    'nameB' => $ynameB,
                    'scoreA' => $scoreA,
                    'scoreB' => $scoreB,
                    'winner' => $winner,
                    'battledate' => $battledate,
                    'masuA' => $masuA,
                    'masuB' => $masuB
                    );
                return $rtnval;
                exit;
        }
//a2

//a3 リーグ戦ランキング
    function Mk_end_date($chdate,$redioDT){
        if($redioDT=="B"){
            if(date('m',strtotime($chdate)%2) == '0'){
                $sd[0] = date('Y-m-01', strtotime(date(date('Y-m-01',strtotime($chdate)))."-1 month"));
                $sd[1] = date('Y-m-t', strtotime(date($chdate)));
            }else{
                $sd[0] = date('Y-m-01', strtotime(date($chdate )));
                $sd[1] = date('Y-m-t',strtotime(date(date('Y-m-01',strtotime($chdate))).'+1 month'));
            }
        }else{
            if((date('m',strtotime($chdate))%2) == '0'){
                $sd[0] = date('Y-m-01', strtotime(date(date('Y-m-01',strtotime($chdate))).'-1 month'));
                $sd[1] = date('Y-m-d', strtotime(date($chdate)));
            }else{
                $sd[0] = date('Y-m-01', strtotime(date($chdate )));
                $sd[1] = date('Y-m-d', strtotime(date($chdate)));
            }
        }
        echo '期間('.$sd[0].'～'.$sd[1].')';
        return $sd;
        }
    function Sum_battle_result($sd,$ed){
        $bd = Get_textDataSet('/controllers/battledata.txt');
        $user = array();$m=1;
        $user[0] = array('yname' => Null,'ttlscore' => Null);
        for($n=0;$n<=count($bd)-1;$n++){
            $cd = date('Y-m-01', strtotime(date($bd[$n][7])));
            if($sd <= $cd && $cd <= $ed){
                $R= false; $R = array_search($bd[$n][0], array_column($user,'yname'), true);
                if ($R==false){
                    $user[$m] = array('yname' => $bd[$n][0],'ttlscore' => $bd[$n][2]);$m++;
                }else{
                    $user[$R]['ttlscore'] = $user[$R]['ttlscore'] + $bd[$n][2];
                }
                $R= false; $R = array_search($bd[$n][3], array_column($user,'yname'), true);
                if ($R==false){
                    $user[$m] = array('yname' => $bd[$n][3],'ttlscore' => $bd[$n][5]);$m++;
                }else{
                    $user[$R]['ttlscore'] = $user[$R]['ttlscore'] + $bd[$n][5];
                }
            }
        }
        //array[0]排除 userNo を名前に変換
            for($n=1;$n<=count($user)-1;$n++){
                $yname = Srch_AryDta_toArycol('member.txt',$user[$n]['yname'],0,1);
                $userset[$n-1] = array('yname' => $yname,'ttlscore' => $user[$n]['ttlscore']);
            }
        //並び替え
            if($userset<>Null){
                foreach($userset as $key => $value){$sort_keys[$key] = $value['ttlscore'];}
                array_multisort($sort_keys, SORT_DESC, $userset);
            }
        return $userset;
        exit;
        }
//a4　ユーザー登録　デバッグスミ(mySQL用もつくる？)
    function a4nameCheck($No,$yname,$yclass,$sex){
        $members = Get_textDataSet('member.txt');
        if($No==Null || $No=="No"){ //ナンバーが入っていない
            for($n=0;$n<=count($members);$n++){
                if($members[$n][1]==$yname){
                    echo "<script>alert('ニックネーム「".$yname."」は既に使われています。');</script>";
                    echo "<script>alert('「".$yname."」のデータを表示します。');</script>";
                    $rtnval = array('No' => $members[$n][0],'name' => $members[$n][1],'Rank' => $members[$n][2],'sex' => $members[$n][3],'btnval' => "変　更");
                    return $rtnval;
                    exit;
                }
            }
        }
        //データチェック(名前が被らないとか)
        if($yname=="ニックネーム" || $yname==Null || $yname==""){echo "<script>alert('ニックネームが入力されていません。');</script>";goto repage;}
        if($yclass=="class" || $yclass==Null || $yclass==""){echo "<script>alert('クラスが入力されていません。');</script>";goto repage;}
        if($sex=="sex" || $sex==Null || $sex==""){echo "<script>alert('性別が入力されていません。');</script>";goto repage;}
            if($No==Null || $No=="No"){  //ナンバーが入っていない
                $comment = a4newinp($No,$yname,$yclass,$sex);   //新規登録(追加登録)
            }else{  //ナンバーが入っている
                $comment = a4saveinp($No,$yname,$yclass,$sex);  //内容変更
            }
            return $comment;
        exit;
        repage:
        $rtnval = array('No' => $No,'name' => $yname,'Rank' => $yclass,'sex' => $sex,'btnval' => Null);
        return $rtnval;
        exit;
        }
    function a4newinp($No,$yname,$yclass,$sex){

        $DataAry = array(count(file('member.txt')),$yname,$yclass,$sex,date('Y-m-d'),date('Y-m-d'));
        $C = TEXT_DATA_add_to('member.txt',$DataAry);
        if($C == true){
            echo "<script>alert('新規登録しました。');</script>";
        }else{
            echo "<script>alert('失敗しました。');</script>";
        }
        $rtnval = array('No' => Null,'name' => Null,'Rank' => Null,'sex' => Null,'btnval' => Null);
        return $rtnval;
        }
    function a4saveinp($No,$yname,$yclass,$sex){
        $SetDataS[0] =Array($No,$yname,$yclass,$sex,Null,date('Y-m-d'));
        $C = Change_TXT_data('0',$SetDataS,'/controllers/member.txt');
        if($C == true){
            echo "<script>alert('登録内容を変更しました。');</script>";
        }else{
            echo "<script>alert('失敗しました。');</script>";
        }
        $rtnval = array('No' => Null,'name' => Null,'Rank' => Null,'sex' => Null,'btnval' => Null);
        return $rtnval;
        }

?>
