<div class="panel">
    <div class="tab-title clearfix">
        <h4><?php echo lang('files'); ?></h4>
        <div class="title-button-group">
            <?php
            echo modal_anchor(get_uri("clients/add_new_file_modal_form"), "<i class='fa fa-plus-circle'></i> " . lang('add_file'), array("class" => "btn btn-default", "title" => lang('add_file'), "data-post-client_id" => $client_id));
            ?>
        </div>
    </div>

    <div class="table-responsive">
        <table id="files-table" class="display" width="100%">            
        </table>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#files-table").appTable({
            source: '<?php echo_uri("clients/files_list_data/" . $client_id) ?>',
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
