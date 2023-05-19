<?php
session_start();
?>

<style>
    body{
        background-image:url('back.png');
    }
    input{
        text-align:center;
    }
    h1{
        font-size:45pt;
        font-family:'Gabriola';
        border:1px solid green;
        padding: 10px 15px;
        background-color:aquamarine;
        color:orange;
        border-radius:20px;
    }
    h2{
        color:white;
        font-family:'Geneva';
    }
    .tampil{
        background-color:gray;
        font-size:24pt;
        font-family:'Franklin Gothic Medium';
        width:30%;
        height:10%;
        padding-top:12px;
        color:white;
        border-radius:15px;
    }
    .kotak{
        width:50px;
        height:40px;
        background-color:rgb(255, 252, 91);
        border:1px solid yellow;
        border-radius:1px;
        color:blue;
    }
    input.kotak[type="text"]{
        font-size:24pt;
    }
    .cek{
        background-color:green;
        font-size:14pt;
        padding:10px 20px;
        color:white;
        border:none;
        border-radius:12px;
    }
    .cek:hover{
        cursor:pointer;
        background-color:darkgreen;
    }
    .jawaban{
        color:blue;
        border:2px solid green;
        border-radius:10px;
        padding:10px 30px;
    }
    .lulus{
        color:blue;
        font-family:Georgia;
        font-size:32pt;
    }
    .ulang{
        width:100px;
        height:50px;
        background-color:green;
        font-size:12pt;
        color:white;
        border:none;
        border-radius:15px;
    }
</style>

<html lang="en">
<head>
    <title>Level 1</title>
</head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.js"></script>
    <script type="text/javascript">
    function fokus(){
        var teks1 =document.form.form1.value.length;
        var teks2 =document.form.form2.value.length;
        var teks3 =document.form.form3.value.length;
        var teks4 =document.form.form4.value.length;
        var teks5 =document.form.form5.value.length;
        
        if(teks1==1){
            $('#form2').focus();
        }
        if(teks2==1){
            $('#form3').focus();
        }
        if(teks3==1){
            $('#form4').focus();
        }
        if(teks4==1){
            $('#form5').focus();
        }

    }
</script>
<body>
<center>

    <h1>Game Susun Kata</h1>
    <h2>Susunlah  Kata  Acak  Dibawah  Ini :</h2>

    <?php

    $semua_kata = array("0"=>"GAJAH","1"=>"PINTU","2"=>"JAKET","3"=>"LAMPU","4"=>"BECAK","5"=>"MOTOR","6"=>"GELAS","7"=>"KAPUR","8"=>"KECIL","9"=>"MOBIL","10"=>"BAMBU");

    shuffle($semua_kata);
    $kata=array();
    $acak=array();

    for($i=0;$i<count($semua_kata);$i++){
        $acak[$i] = str_shuffle($semua_kata[$i])."<br/>";
        $kata[$i]= $acak[$i];
    }
    $tampil=array_shift($semua_kata);
    /*if(is_string($tampil)){
        echo 'benar';
    }else{
        echo 'bukan string';
    }

    echo $tampil;*/
    $pecah=str_split($tampil);
    

    echo '<p class="tampil">'.$kata[0].'</p>';

    if(isset($_POST['submit'])){
        $huruf1= $_POST['kotak1'];
        $huruf2= $_POST['kotak2'];
        $huruf3= $_POST['kotak3'];
        $huruf4= $_POST['kotak4'];
        $huruf5= $_POST['kotak5'];
        $jawab=$huruf1.$huruf2.$huruf3.$huruf4.$huruf5;
        $jawaban =strtoupper($jawab);
        $cek = $_POST['cek'];
        if($jawaban==$cek){
            $_SESSION['hasil']="BENAR";
            $_SESSION['skor'] += 20;
        }else{
            $_SESSION['hasil']="SALAH";
            $_SESSION['skor'] -= 20;
        
        }
    }else{
        $_SESSION['skor'] = 0;
        $_SESSION['hasil']=" ";
    }

?>
    <form method="post" action="test.php" name="form">
        <input class="kotak" type="text" name="kotak1" id="form1" onKeyUp="fokus()" maxlength="1" autofocus>
        <input class="kotak" type="text" name="kotak2" id="form2" onKeyUp="fokus()" maxlength="1">
        <input class="kotak" type="text" name="kotak3" id="form3" onKeyUp="fokus()" maxlength="1">
        <input class="kotak" type="text" name="kotak4" id="form4" onKeyUp="fokus()" maxlength="1">
        <input class="kotak" type="text" name="kotak5" id="form5" onKeyUp="fokus()" maxlength="1"><br><br>
        <input type="hidden" name="cek" value="<?php echo $tampil; ?>">
        <button class="cek" type="submit" name="submit">CEK</button><br><br>
        <input type="button" name="skor" value="SKOR : <?php echo $_SESSION['skor']; ?>"><br><br>
        <input class="jawaban"type="text" name="jawaban" value="JAWABAN KAMU :<?php echo $_SESSION['hasil']; ?>"><br><br>
        
    </form><?php
if($_SESSION['skor']==100){
    echo '<p class="lulus">KAMU LULUS !</p>';
    ?>
    <form action="test.php">
        <button type="submit" class="ulang" >ULANG</button>
    </form><?php
}
    ?>
    
</center>
</body>
</html>