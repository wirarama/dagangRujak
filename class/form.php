<?php
class form{
    function formInput($name,$type,$label,$size,$min=null,$req=null,$val=null){
        ?>
            <div class="form-group">
                <label for="<?php echo $name; ?>" class="control-label col-sm-2"><?php echo $label; ?></label>
                <div class="col-sm-10"><input type="<?php echo $type; ?>" id="<?php echo $name; ?>" name="<?php echo $name; ?>" size="<?php echo $size; ?>" maxlength="<?php echo $size; ?>" <?php if(!empty($min)){ ?>minlength="<?php echo $min; ?>"<?php } ?> <?php if(!empty($req)){ ?>required=""<?php } ?> <?php if($type!='password'){ ?>placeholder="<?php echo $label; ?>"<?php } ?> <?php if(!empty($val)){ ?>value="<?php echo $val; ?>"<?php } ?>></div>
            </div>
        <?php
    }
    function formRadio($name,$label,$value=array(),$req=null,$val=null){
        ?>
            <div class="form-group">
                <label for="<?php echo $name; ?>" class="control-label col-sm-2"><?php echo $label; ?></label>
                <div class="col-sm-10">
                    <?php
                    foreach($value AS $value1){
                    ?>
                    <input type="radio" name="<?php echo $name; ?>" value="<?php echo $value1; ?>" <?php if(!empty($req)){ ?>required=""<?php } ?> <?php if($val==$value1){ ?>checked=""<?php } ?>><?php echo ucfirst($value1); ?><br>
                    <?php } ?>
                </div>
            </div>
        <?php
    }
    function formSelect($name,$label,$value=array(),$req=null,$val=null){
        ?>
            <div class="form-group">
                <label for="<?php echo $name; ?>" class="control-label col-sm-2"><?php echo $label; ?></label>
                <div class="col-sm-10">
                    <select name="<?php echo $name; ?>" id="<?php echo $name; ?>" <?php if(!empty($req)){ ?>required=""<?php } ?>>
                    <?php
                    foreach($value AS $value1){
                    ?>
                        <option value="<?php echo $value1; ?>" <?php if($val==$value1){ ?>selected=""<?php } ?>><?php echo ucfirst($value1); ?></option>
                    <?php } ?>
                    </select>
                </div>
            </div>
        <?php
    }
    function formCheckbox($name,$label,$value=array(),$min=null,$max=null,$req=null,$val=array()){
        ?>
            <div class="form-group">
                <label for="<?php echo $name; ?>" class="control-label col-sm-2"><?php echo $label; ?></label>
                <div class="col-sm-10">
                    <?php
                    foreach($value AS $value1){
                    ?>
                    <input type="checkbox" name="<?php echo $name; ?>[]" value="<?php echo $value1; ?>" <?php if(!empty($min)){ ?>minlength="<?php echo $min; ?>"<?php } ?> <?php if(!empty($max)){ ?>maxlength="<?php echo $max; ?>"<?php } ?> <?php if(!empty($req)){ ?>required=""<?php } ?> <?php if(in_array($value1,$val)){ ?>checked<?php } ?>><?php echo ucfirst($value1); ?><br>
                    <?php } ?>
                </div>
            </div>
        <?php
    }
    function formCheckboxSingle($name,$label,$value,$req=null,$val=false){
        ?>
            <div class="form-group">
                <label for="<?php echo $name; ?>" class="control-label col-sm-2"><?php echo $label; ?></label>
                <div class="col-sm-10">
                    <input type="checkbox" name="<?php echo $name; ?>" value="<?php echo $value; ?>" <?php if(!empty($req)){ ?>required=""<?php } ?> <?php if($val==true){ ?>checked=""<?php } ?>>
                </div>
            </div>
        <?php
    }
    function formArea($name,$label,$cols,$rows,$req=null,$val=null){
        ?>
            <div class="form-group">
                <label for="<?php echo $name; ?>" class="control-label col-sm-2"><?php echo $label; ?></label>
                <div class="col-sm-10"><textarea id="<?php echo $name; ?>" name="<?php echo $name; ?>" cols="<?php echo $cols; ?>" rows="<?php echo $rows; ?>" <?php if(!empty($req)){ ?>required=""<?php } ?>><?php if(!empty($val)){ echo $val; } ?></textarea></div>
            </div>
        <?php
    }
    function formSubmit($name,$label){
        ?>
            <div class="form-group">
                <label for="<?php echo $name; ?>" class="control-label col-sm-2">&nbsp;</label>
                <div class="col-sm-10"><input type="submit" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $label; ?>" class="btn btn-primary"></div>
            </div>
        <?php
    }
    function formFile($name,$label,$multiple=null){
        ?>
            <div class="form-group">
                <label for="<?php echo $name; ?>" class="control-label col-sm-2"><?php echo $label; ?></label>
                <div class="col-sm-10"><input type="file" id="<?php echo $name; ?>" name="<?php echo $name; if(!empty($multiple)){ echo '[]'; } ?>" <?php if(!empty($multiple)){ echo 'multiple=""'; } ?>></div>
            </div>
        <?php
    }
    function formHidden($name,$val){
        ?>
            <input type="hidden" id="<?php echo $name; ?>" name="<?php echo $name; ?>" value="<?php echo $val; ?>">
        <?php
    }
}
