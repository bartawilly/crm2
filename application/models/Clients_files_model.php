<?php

class Clients_files_model extends Crud_model {

    private $table = null;

    function __construct() {
        $this->table = 'clients_file';
        parent::__construct($this->table);
    }
    function insert_file($data)
    {
        $this->db->insert('clients_file', $data);
        return $this->db->insert_id();
    }
    function get_details($client) {
        $files_table = $this->db->dbprefix('clients_file');
        $sql = "SELECT $files_table.*
        FROM $files_table
        WHERE $files_table.deleted=0 AND $files_table.client=$client";
        return $this->db->query($sql);
    }
   function get_details_id($id) {
        $files_table = $this->db->dbprefix('clients_file');
        $sql = "SELECT $files_table.*
        FROM $files_table
        WHERE $files_table.deleted=0 AND $files_table.id=$id";
        return $this->db->query($sql);
    }


}
