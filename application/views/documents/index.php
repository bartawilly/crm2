<div id="page-content" class="p20 clearfix">
    <div class="panel panel-default">
        <div class="page-title clearfix">
            <h1> <?php echo lang('documents'); ?></h1>
            <div class="title-button-group">
                <?php echo modal_anchor(get_uri("documents/modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_document'), array("class" => "btn btn-default", "title" => lang('add_document'))); ?>
            </div>
        </div>
        <div class="table-responsive">
            <table id="document-table" class="display" cellspacing="0" width="100%">            
            </table>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).ready(function() {
        $("#document-table").appTable({
            source: '<?php echo_uri("documents/list_data") ?>',
            order: [[0, 'desc']],
            columns: [
                 {title: "<?php echo lang("id") ?>", "class": "text-center w50"},
                {title: "<?php echo lang("title") ?>"},
                {title: "<?php echo lang("description") ?>"},
               {title: '<i class="fa fa-bars"></i>', "class": "text-center option w100"}
            ]
        });
    });
</script>
