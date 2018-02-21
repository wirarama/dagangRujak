<form action="prosesForm.php" method="POST" id="registerForm" class="form-horizontal">
    <?php
    $form = new form();
    $form->formInput("jumlah","text","Jumlah","2","1",true,1);
    $form->formHidden('item', $d['MenuID']);
    $form->formSubmit("submitOrder","Beli!");
    ?>
</form>

