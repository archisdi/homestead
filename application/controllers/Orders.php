<?php

Class Orders extends MY_Controller
{

    public function index()
    {
        $this->is_logged_in();

        if ($this->is_role('admin')) {

            $data['orders'] = $this->order_model->get_order_admin();
            $this->render_view('order_admin',$data);

        } elseif ($this->is_role('customer')) {

            $data['orders'] = $this->order_model->get_order_customer($this->auth_username);
            $this->render_view('order_customer',$data);

        } else {
            redirect('/');
        }

    }

//    public function view($id)
//    {
//        $data['order'] = $this->order_model->get_order($id);
//        $this->is_logged_in();
//
//        if (empty($data['order'])) {
//            show_404();
//        }
//
//        $data['title'] = 'Order Details';
//        $this->render_view('view', $data);
//    }
//
//    public function destroy($id)
//    {
//        $this->role_must('admin');
//        $this->order_model->delete_order($id);
//        redirect('properties/');
//    }

    public function create()
    {
        $this->role_must('customer');
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $this->order_validation();
            if ($this->form_validation->run() === FALSE) {
                redirect('properties');
            } else {

                if ($this->order_model->set_order()) {
                    $data['success'] = 'Order Success';
                    $this->render_view('order_status', $data);
                } else {
                    $data['fail'] = 'Order Fail, property that you wish to order is not available';
                    $this->render_view('order_status', $data);
                }
            }

        } else {
            redirect('/');
        }
    }

    private function render_view($page, $data = NULL)
    {
        $this->load->view('templates/header');
        $this->load->view('orders/' . $page, $data);
        $this->load->view('templates/footer');
    }

    private function order_validation()
    {
        $this->form_validation->set_rules('property_id', 'property_id', 'required');
        $this->form_validation->set_rules('user_id', 'user_id', 'required');
    }

    private function role_must($role)
    {
        if (!$this->verify_role($role)) {
            redirect('/');
        }
    }

}