<?php
include 'class/connect.php';
if(!empty(filter_input(0,'submitRegister'))){
    $q = $pdo->prepare("INSERT INTO member "
                . "(MemberNama,MemberPassword,MemberAlamat,MemberNoTelp) "
                . "VALUES("
                . "'".filter_input(0,"MemberNama")."',"
                . "MD5('".filter_input(0,"MemberPassword")."'),"
                . "'".filter_input(0,"MemberAlamat")."',"
                . "'".filter_input(0,"MemberNoTelp")."'"
                . ")");
    $q->execute();
    setcookie("loginMember",filter_input(0,"MemberNama"));
    //header('location:index.php?sudahReg=1');
    echo '<span class="success">sukses terdaftar bro!</span>';
}else if(!empty(filter_input(0,'submitLogin'))){
    $q = $pdo->query("SELECT MemberNama FROM member "
            . "WHERE MemberNama='".filter_input(0,"username")."' "
            . "AND MemberPassword=MD5('".filter_input(0,"password")."')");
    if($q->rowCount()!=0){
        setcookie("loginMember",filter_input(0,"username"));
        header("location:index.php");
    }else{
        header("location:index.php?gagal=1");
    }
}else if(!empty(filter_input(0,'submitOrder'))){
    $qmember = $pdo->prepare("SELECT MemberID FROM member "
            . "WHERE MemberNama='".filter_input(2,"loginMember")."'");
    $qmember->execute();
    $dmember = $qmember->fetch();
    $q = $pdo->query("SELECT ID FROM keranjang "
            . "WHERE member='".$dmember['MemberID']."' "
            . "AND status='lagiBelanja'");
    $idKeranjang = 0;
    if($q->rowCount()==0){
        
        $q1 = $pdo->prepare("INSERT INTO keranjang "
                . "(member,status) "
                . "VALUES("
                . "'".$dmember['MemberID']."',"
                . "'lagiBelanja'"
                . ")");
        $q1->execute();
        $qkeranjang = $pdo->prepare("SELECT ID FROM keranjang "
            . "WHERE member='".$dmember['MemberID']."' "
            . "AND status='lagiBelanja'");
        $qkeranjang->execute();
        $dkeranjang = $qkeranjang->fetch();
        $idKeranjang = $dkeranjang['ID'];
        
    }else{
        $q->execute();
        $d = $q->fetch();
        $idKeranjang = $d['ID'];
    }
    $qitem = $pdo->prepare("INSERT INTO item "
            . "(keranjang,jumlah,item) "
            . "VALUES("
            . "'".$idKeranjang."',"
            . "'".filter_input(0,'jumlah')."',"
            . "'".filter_input(0,'item')."'"
            . ")");
    $qitem->execute();
    header('location:index.php');
    
}else if(!empty(filter_input(1,'logout'))){
    setcookie("loginMember",'');
    header('location:index.php?sudahLogout=1');
    
}

