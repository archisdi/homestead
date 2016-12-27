<?php

Class Properties extends MY_Controller
{

    public function index()
    {

        $this->is_logged_in();

        if ($this->is_role('admin')) {

            $data['properties'] = $this->property_model->get_property('admin');
            $this->render_view('index_admin', $data);

        } elseif ($this->is_role('customer')) {

            $data['properties'] = $this->property_model->get_property('customer');
            $this->render_view('index_customer', $data);

        } else {
            redirect('/');
        }
    }

    public function view($id)
    {
        $this->is_logged_in();

        if ($this->is_role('admin')) {
            $data['property'] = $this->property_model->get_property('admin', $id);
        } elseif ($this->is_role('customer')) {
            $data['property'] = $this->property_model->get_property('customer', $id);
        } else {
            redirect('/');
        }

        if (empty($data['property'])) {
            show_404();
        }

        $data['title'] = 'Property Details';
        $this->render_view('view', $data);
    }

    public function create()
    {
        $this->role_must('admin');
        $data['title'] = 'Create Property';
        $this->property_validation();

        if ($this->form_validation->run() === FALSE) {
            $this->render_view('create', $data);
        } else {
            $this->property_model->set_property();
            redirect('properties');
        }
    }

    public function edit($id)
    {
        $this->role_must('admin');
        $data['property'] = $this->property_model->get_property('admin', $id);
        if (empty($data['property'])) {
            show_404();
        }

        $data['title'] = 'Edit Property';
        $this->render_view('edit', $data);
    }

    public function update()
    {
        $this->role_must('admin');
        $this->property_validation();
        if ($this->form_validation->run() === FALSE) {

            $data['title'] = 'Edit Property';
            $data['property'] = $this->property_model->get_property('admin',$this->input->post('id'));
            $this->render_view('edit', $data);

        } else {
            $this->property_model->update_property();
            redirect('properties/');
        }
    }

    public function destroy($id)
    {
        $this->role_must('admin');
        $this->property_model->delete_property($id);
        redirect('properties/');
    }

    private function render_view($page, $data = NULL)
    {
        $this->load->view('templates/header');
        $this->load->view('properties/' . $page, $data);
        $this->load->view('templates/footer');
    }

    private function property_validation()
    {
        $this->form_validation->set_rules('type', 'Type', 'required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        $this->form_validation->set_rules('price', 'price', 'required');
    }

    private function role_must($role)
    {
        if (!$this->verify_role($role)) {
            redirect('/');
        }
    }
}