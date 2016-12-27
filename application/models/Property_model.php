<?php

class Property_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_property($role, $id = FALSE)
    {

        if ($role == 'admin') {

            if ($id === FALSE) {
                $query = $this->db->get('properties');
                return $query->result_array();
            }
            $query = $this->db->get_where('properties', array('id' => $id));
            return $query->row_array();

        } else {

            if ($id === FALSE) {
                $this->get_property_customer();
                $query = $this->db->get();
                return $query->result_array();
            }
            $this->get_property_customer();
            $this->db->where('id', $id);
            $query = $this->db->get();
            return $query->row_array();

        }

    }

    public function set_property()
    {

        $data = [
            'type' => $this->input->post('type'),
            'address' => $this->input->post('address'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'price' => $this->input->post('price')
        ];

        return $this->db->insert('properties', $data);
    }

    public function update_property()
    {
        $data = [
            'type' => $this->input->post('type'),
            'address' => $this->input->post('address'),
            'latitude' => $this->input->post('latitude'),
            'longitude' => $this->input->post('longitude'),
            'price' => $this->input->post('price')
        ];

        $this->db->where('id', $this->input->post('id'));
        return $this->db->update('properties', $data);
    }

    public function delete_property($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('properties');
        return true;
    }

    private function get_property_customer()
    {
        $this->db->select('*');
        $this->db->from('properties');
        $this->db->where('available', 1);
    }
}