<div class="modal fade" tabindex="-1" role="dialog" id="belanja">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
              <form action="prosesForm.php" method="POST" id="registerForm" class="form-horizontal">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Judul</h4>
            </div>
            <div class="modal-body">
              <h5 class="modal-menu-harga"></h5>
              <p class="modal-menu-diskripsi"></p>
              <img class="modal-menu-gambar img-thumbnail img-responsive" src="" alt="" style="max-width:200px;">
                <?php
                $form = new form();
                $form->formInput("jumlah","text","Jumlah","2","1",true,1);
                $form->formHidden('item','');
                ?>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
              <input type="submit" name="submitOrder" value="Beli" class="btn btn-primary">
            </div>
              </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->