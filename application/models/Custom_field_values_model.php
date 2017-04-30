<?php

class Custom_field_values_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'custom_field_values';
        parent::__construct($this->table);
    }

    function get_details($options = array()) {
        $custom_field_values_table = $this->db->dbprefix('custom_field_values');
        $custom_fields_table = $this->db->dbprefix('custom_fields');

        $where = "";
        $id = get_array_value($options, "id");
        if ($id) {
            $where .= " AND $custom_fields_table.id=$id";
        }


        $related_to_type = get_array_value($options, "related_to_type");
        if ($related_to_type) {
            $where .= " AND $custom_field_values_table.related_to_type='$related_to_type'";
        }

        $related_to_id = get_array_value($options, "related_to_id");
        if ($related_to_id) {
            $where .= " AND $custom_field_values_table.related_to_id='$related_to_id'";
        }


        $sql = "SELECT $custom_field_values_table.*,
                $custom_fields_table.title AS custom_field_title, $custom_fields_table.field_type AS custom_field_type, $custom_fields_table.sort
        FROM $custom_field_values_table
        LEFT JOIN $custom_fields_table ON $custom_fields_table.id= $custom_field_values_table.custom_field_id
        WHERE $custom_field_values_table.deleted=0 $where 
        ORDER by $custom_fields_table.sort ASC";
        return $this->db->query($sql);
    }

    function upsert($data) {

        $existing = $this->get_one_where(
                array("related_to_type" => get_array_value($data, "related_to_type"),
                    "related_to_id" => get_array_value($data, "related_to_id"),
                    "custom_field_id" => get_array_value($data, "custom_field_id"),
                    "deleted" => 0)
        );

        if ($existing) {
            return $this->save($data, $existing->id); //update
        } else {
            return $this->save($data); //insert
        }
    }

}
