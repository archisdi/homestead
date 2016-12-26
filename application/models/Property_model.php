<?php

class Property_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    public function get_property($id = FALSE)
    {
        if ($id === FALSE) {
            $query = $this->db->get('properties');
            return $query->result_array();
        }

        $query = $this->db->get_where('properties', array('id' => $id));
        return $query->row_array();
    }

//    public function set_post()
//    {
//        $slug = url_title($this->input->post('title'));
//
//        $data = [
//            'title' => $this->input->post('title'),
//            'slug' => $slug,
//            'body' => $this->input->post('body')
//        ];
//
//        return $this->db->insert('posts', $data);
//    }
//
//    public function update_post()
//    {
//        $slug = url_title($this->input->post('title'));
//
//        $data = [
//            'title' => $this->input->post('title'),
//            'slug' => $slug,
//            'body' => $this->input->post('body')
//        ];
//
//        $this->db->where('id', $this->input->post('id'));
//        return $this->db->update('posts', $data);
//    }
//
//    public function delete_post($id)
//    {
//        $this->db->where('id', $id);
//        $this->db->delete('posts');
//        return true;
//    }
}