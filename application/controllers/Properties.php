<?php

Class Properties extends CI_Controller
{

    public function index()
    {
        $data['title'] = ucfirst('Properties');
        $data['properties'] = $this->property_model->get_property();

        $this->render_view('index', $data);
    }

    public function view($id)
    {
        $data['property'] = $this->property_model->get_property($id);

        if (empty($data['property'])) {
            show_404();
        }

        $data['title'] = 'Property Details';

        $this->render_view('view', $data);
    }
//
//    public function create()
//    {
//
//        $data['title'] = 'Create Post';
//
//        $this->form_validation->set_rules('title', 'Title', 'required');
//        $this->form_validation->set_rules('body', 'Body', 'required');
//
//        if ($this->form_validation->run() === FALSE) {
//
//            $this->render_view('create', $data);
//
//        } else {
//            $this->post_model->set_post();
//
//            redirect('posts/');
//        }
//
//    }
//
//    public function edit($slug){
//        $data['post'] = $this->post_model->get_post($slug);
//
//        if (empty($data['post'])) {
//            show_404();
//        }
//
//        $data['title'] = 'Edit Post';
//
//        $this->render_view('edit', $data);
//    }
//
//    public function update(){
//        $this->post_model->update_post();
//
//        redirect('posts/');
//    }
//
//    public function destroy($id){
//        $this->post_model->delete_post($id);
//
//        redirect('posts/');
//    }

    private function render_view($page, $data = NULL)
    {
        $this->load->view('templates/header');
        $this->load->view('properties/' . $page, $data);
        $this->load->view('templates/footer');
    }
}