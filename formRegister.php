<form action="prosesForm.php" method="POST" id="registerForm" class="form-horizontal">
    <div id="sukses"></div>
    <?php
    $form = new form();
    $form->formInput("MemberNama","text","Nama",60,4,true);
    $form->formInput("MemberPassword","password","Password",40,4,true);
    $form->formInput("MemberPasswordConfirm","password","Password Lagi",40,4,true);
    $form->formInput("MemberAlamat","text","Alamat",60,4,true);
    $form->formInput("MemberNoTelp","number","No Telp",30,4,true);
    $form->formSubmit("submitRegister","Register");
    ?>
</form>

