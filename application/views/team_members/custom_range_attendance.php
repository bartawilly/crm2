<table id="custom-range-attendance-table" class="display" cellspacing="0" width="100%">            
    <tfoot>
        <tr>
            <th colspan="5" class="text-right"><?php echo lang("total") ?>:</th>
            <th data-current-page="5"></th>
            <th> </th>
        </tr>
        <tr data-section="all_pages">
            <th colspan="5" class="text-right"><?php echo lang("total_of_all_pages") ?>:</th>
            <th data-all-page="5"></th>
            <th> </th>
        </tr>
    </tfoot>
</table>
<script type="text/javascript">
    $(document).ready(function() {
        loadMembersAttendanceTable("#custom-range-attendance-table", "custom_range");
    });
</script>