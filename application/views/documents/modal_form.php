 

<?php echo form_open_multipart('Documents/upload', array("id" => "documents-form", "class" => "general-form", "role" => "form"));?>
<div class="modal-body clearfix">
 <div class="form-group">
        <div class="col-md-12">
            <?php
            echo form_input(array(
                "id" => "title",
                "name" => "title",
                "value" => $model_info->title,
                "class" => "form-control notepad-title",
                "placeholder" => lang('title'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-md-12">
            <?php
            echo form_input(array(
                "id" => "description",
                "name" => "description",
                "value" => $model_info->description,
                "class" => "form-control notepad-title",
                "placeholder" => lang('description'),
                "autofocus" => true,
                "data-rule-required" => true,
                "data-msg-required" => lang("field_required"),
            ));
            ?>
        </div>
    </div>
    
    
<?php echo "<input type='file' name='userfile' size='20' />"; ?>

</div>
<div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal"><span class="fa fa-close"></span> <?php echo lang('close'); ?></button>
    <?php echo "<button type='submit' class='btn btn-primary'  name='submit' value='upload' ><span class='fa fa-check-circle'></span>".lang('save')."  </button>";?>

</div>
<?php echo "</form>"?>


