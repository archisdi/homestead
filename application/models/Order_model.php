<?php

class Order_model extends CI_Model
{

    public function __construct()
    {
        $this->load->database();
    }

    public function get_order_admin($id = FALSE)
    {
        if ($id === FALSE) {
            $this->get_joined_orders();
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->get_joined_orders();
        $this->db->where('id' , $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_order_customer($customer_id, $id = FALSE)
    {
        if ($id === FALSE) {
            $this->get_joined_orders();
            $this->db->where('username' , $customer_id);
            $query = $this->db->get();
            return $query->result_array();
        }

        $this->get_joined_orders();
        $this->db->where('customer_id' , $customer_id);
        $this->db->where('id' , $id);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function set_order()
    {
        $property = $this->property_model->get_property('customer',$this->input->post('property_id'));

        if (empty($property)) {
            show_404();
        } elseif ($property['available'] == 0) {
            return false;
        } else {
            $property['available'] = 0;
        }

        $data = [
            'property_id' => $this->input->post('property_id'),
            'user_id' => $this->input->post('user_id')
        ];
        $this->db->insert('orders', $data);

        $this->db->where('id', $data['property_id']);
        $this->db->update('properties', $property);

        return true;
    }

    public function delete_order($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('properties');
        return true;
    }

    private function get_joined_orders(){
        $this->db->select('orders.id, users.username,properties.address, orders.created_at');
        $this->db->from('orders');
        $this->db->join('users', 'orders.user_id = users.user_id');
        $this->db->join('properties', 'orders.property_id = properties.id');
    }

}