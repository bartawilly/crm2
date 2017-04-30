<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Documents extends MY_Controller {
    function __construct() {
        parent::__construct();
        $this->access_only_team_members();

    }
    public function index() {

   $this->template->rander("documents/index");
    }



function delete_file() {
        $id = $this->input->post('id');
        if ($this->input->post('undo')) {   
            if ($this->Documents_model->delete($id, true)) {
                echo json_encode(array("success" => true, "data" => $this->_file_row_data($id), "message" => lang('record_undone')));
            } else {
                echo json_encode(array("success" => false, lang('error_occurred')));
            }
        } else {
            if ($this->Documents_model->delete($id)) {
                echo json_encode(array("success" => true, 'message' => lang('record_deleted').$id));
            } else {
                echo json_encode(array("success" => false, 'message' => lang('record_cannot_be_deleted')));
            }
        }
    }
       



    function list_data() {
        
        $list_data = $this->Documents_model->get_details()->result();
        $result = array();
        foreach ($list_data as $data) {
            $result[] = $this->_make_row($data);
        }
        echo json_encode(array("data" => $result));
            
    }

    private function _make_row($data) {
        $title = $data->title;
        $description = $data->description;
        $_id = $data->id;
        return array(
            $_id,
            $title,
            $description,
            js_anchor("<i class='fa fa-times fa-fw'></i>", array('title' => lang('delete_document'), "class" => "delete", "data-id" => $data->id, "data-action-url" => get_uri("Documents/delete_file"), "data-action" => "delete"))
            ."<a href='".$this->config->base_url()."/index.php/Documents/download_file?id=".$data->id."' target='_blank' class='edit'  title = 'download file' > <i class='fa fa-download fa-fw'></i></a>",
     
        );
    }


       function download_file() {
        $id =$this->input->get('id');
  
                     
        $file = $this->Documents_model->get_details_id($id)->row();
        $filename = $file->path;
        $data = file_get_contents($this->config->base_url().'/_/uploads/'.$filename);
        force_download($filename, $data);
    }
    


    public function upload(){ 
    $config = array(
        'upload_path' => "./_/uploads/",
        'allowed_types' => "png|PNG|pdf|jpg|jpeg|docx|dwg|dxf",
        'encrypt_name'=>true
    );
    $this->load->library('upload', $config);
    if($this->upload->do_upload())
    {
    
        $data = array('upload_data' => $this->upload->data());
        $last=explode(".",$data['upload_data']['client_name']);
         $data_details = array(
            "title" => $this->input->post('title'),
            "description" => $this->input->post('description'),
            "created_by" => $this->login_user->id,
            "path" => $data['upload_data']['file_name']  
            );
         echo"<script>console.log(".json_encode($data_details).");</script>";
            $save_id = $this->Documents_model->insert_file($data_details);
         echo"<script>console.log(".json_encode($save_id).");</script>";
            
    }else{
      $data['error'] = array('error' => $this->upload->display_errors());
     
    }
        if ($save_id){
             redirect('documents');
         }else {
            echo "<script>alert('Upload Failed please Try again with a vaild file');</script>";
              redirect('documents');
        }
}

    function modal_form() {
        $labels = explode(",", $this->Notes_model->get_label_suggestions($this->login_user->id));

        //check permission for saved note
        if ($view_data['model_info']->id) {
            $this->validate_access_to_note($view_data['model_info']);
        }

        $label_suggestions = array();
        foreach ($labels as $label) {
            if ($label && !in_array($label, $label_suggestions)) {
                $label_suggestions[] = $label;
            }
        }
        if (!count($label_suggestions)) {
            $label_suggestions = array("0" => "Important");
        }
        $view_data['label_suggestions'] = $label_suggestions;
        $this->load->view('documents/modal_form', $view_data);
    }


}
