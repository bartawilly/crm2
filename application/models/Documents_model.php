<?php

class Documents_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'documents';
        parent::__construct($this->table);
    }
    function insert_file($data)
    {
         echo"<script>console.log(".json_encode($data).");</script>";
        $this->db->insert('documents', $data);
        return $this->db->insert_id();
    }

    function get_details() {
        $documents_table = $this->db->dbprefix('documents');

        $sql = "SELECT $documents_table.*
        FROM $documents_table
        WHERE $documents_table.deleted=0";
        return $this->db->query($sql);
    }

function get_details_id($id) {
        $documents_table = $this->db->dbprefix('documents');
        $sql = "SELECT $documents_table.*
        FROM $documents_table
        WHERE $documents_table.deleted=0 AND $documents_table.id=$id";
        return $this->db->query($sql);
    }

    function get_label_suggestions($user_id) {
        $notes_table = $this->db->dbprefix('notes');
        $sql = "SELECT GROUP_CONCAT(labels) as label_groups
        FROM $notes_table
        WHERE $notes_table.deleted=0 AND $notes_table.created_by=$user_id";
        return $this->db->query($sql)->row()->label_groups;
    }

}
