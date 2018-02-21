<form action="prosesForm.php" method="POST" id="registerForm" class="form-horizontal">
    <?php
    $form = new form();
    $form->formInput("username","text","Username","40","2",true);
    $form->formInput("password","password","Password","40","2",true);
    $form->formCheckboxSingle("ingat","Ingat Saya","1");
    $form->formSubmit("submitLogin","login");
    ?>
</form>

