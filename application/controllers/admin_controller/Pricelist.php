<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Pricelist extends CI_Controller {

    /**
     * Calling constructer
     */
    function __construct() {
        parent:: __construct();
        $this->load->model('admin_model/Pricelist_model');
    }

    /* add pricelist */

    public function inventory_price_list() {
        try {
            if ($this->session->userdata('admin_name') != '') {

                $data['select_game'] = $this->Pricelist_model->select_game();
                $game_id = $this->input->post('select_game');
                $user_game = '';
                $game_id == '' ? $game_id = 1 : null;
                $this->session->set_userdata(
                        array(
                            'pricelist_game_id' => $game_id
                        )
                );
                $data['user_game'] = $this->Game_model->fetch_user_game($game_id);
                $data['select_game'] = $this->Game_model->fetch_all_game();
                $data['get_pricelist'] = $this->Pricelist_model->get_pricelist($game_id);
                $data['game_name'] = $this->Game_model->fetch_one_game($game_id);
                foreach ($data['game_name'] as $row) {
                    $user_game = $row->game_name;
                }
                $data['sel_game'] = $user_game;
                $this->load->view('admin/inventory/pricelist', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /**
     * Check valid name 
     */
    function alpha_dash($fullname) {
        if (!preg_match('/^[a-zA-Z ]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash', 'The %s field may only contain alpha characters');
            return false;
        } else {
            return true;
        }
    }

    /**
     * Select brand
     */
    public function select_brand() {
        try {
            $this->session->userdata('admin_name') != '' ? $this->load->view('admin/inventory/pricelist_select_brand') : redirect('Admin/index');
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /**
     * Select brand
     */
    public function select_car_model() {
        try {
            $this->session->userdata('admin_name') != '' ? $this->load->view('admin/inventory/pricelist_select_model') : redirect('Admin/index');
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert pricelist */

    public function insert_pricelist() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_save')) {
                    $this->form_validation->set_rules('select_game', 'Select Game', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("select_game", 'Please select game!');
                        redirect('admin_controller/Pricelist/inventory_price_list');
                    } else {
                        $this->form_validation->set_rules('product_no', 'Product No', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("product_no", 'Please Enter Product No!');
                            redirect('admin_controller/Pricelist/inventory_price_list');
                        } else {
                            $this->form_validation->set_rules('select_brand', 'Select Brand', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("select_brand", 'Please Select Brand !');
                                redirect('admin_controller/Pricelist/inventory_price_list');
                            } else {
                                $this->form_validation->set_rules('type', 'Type', 'trim|required');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("type", 'Please Enter Type !');
                                    redirect('admin_controller/Pricelist/inventory_price_list');
                                } else {
                                    $this->form_validation->set_rules('select_car_model', 'Car Model', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("select_car_model", 'Please Enter Car Model !');
                                        redirect('admin_controller/Pricelist/inventory_price_list');
                                    } else {
                                        $this->form_validation->set_rules('price', 'Price', 'trim|required|greater_than[0]');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("price", 'Please Enter Price !');
                                            redirect('admin_controller/Pricelist/inventory_price_list');
                                        } else {
                                            $this->form_validation->set_rules('year', 'Year', 'trim|numeric|greater_than[0]');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("year", 'Please Enter valid Year !');
                                                redirect('admin_controller/Pricelist/inventory_price_list');
                                            } else {
                                                $game_id = $this->session->userdata('pricelist_game_id');
                                                $brand = '';
                                                $car_model = '';
                                                if ($this->input->post("select_brand") == 'Others') {
                                                    $brand = $this->input->post('new_brand');
                                                    $this->form_validation->set_rules('new_brand', 'New Brand', 'trim|required');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("new_brand", 'Please Enter New Brand!');
                                                        redirect('admin_controller/Pricelist/inventory_price_list');
                                                    }
                                                } elseif ($this->input->post("select_brand") != 'Others') {
                                                    $brand = $this->input->post('select_brand');
                                                }
                                                if ($this->input->post("select_car_model") == 'Other_model') {
                                                    $car_model = $this->input->post('new_model');
                                                    $this->form_validation->set_rules('new_model', ' New Model', 'trim|required');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("new_model", 'Please Enter New Model !');
                                                        redirect('admin_controller/Pricelist/inventory_price_list');
                                                    }
                                                } elseif ($this->input->post("select_car_model") != 'Other_model') {
                                                    $car_model = $this->input->post('select_car_model');
                                                }
                                                $product = $this->input->post('product_no');
                                                $type = $this->input->post('type');
                                                $price = $this->input->post('price');
                                                $year = $this->input->post('year');
                                                $insert_pricelist = array(
                                                    'product_no' => $product,
                                                    'brand' => $brand,
                                                    'type' => $type,
                                                    'car_model' => $car_model,
                                                    'price' => $price,
                                                    'year' => $year
                                                );

                                                $user_id = $this->Pricelist_model->add_pricelist($insert_pricelist, $game_id);
                                                ($user_id > 0) ? ($this->session->set_flashdata("add_message", "true")) : $this->session->set_flashdata("add_message", "true");
                                                redirect('admin_controller/Pricelist/inventory_price_list');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } elseif ($this->input->post('btn_cancel')) {
                    redirect('Admin/home');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view pricelist by id */

    public function get_pricelist_by_id() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('pricelist_game_id');
                $segment_url = $this->uri->segment(4);
                $id = rawurldecode($this->encrypt->decode($segment_url));
                $data['get_pricelist_by_id'] = $this->Pricelist_model->get_pricelist_by_id($id, $game_id);
                $this->load->view('admin/inventory/view_one_pricelist', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view pricelist by id for edit */

    public function edit_pricelist() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $segment_url = $this->uri->segment(4);
                $segment_url == '' ? $segment_url = $this->session->userdata('price_id') : null;
                $id = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                        array
                            ('price_id' => $segment_url)
                );
                $data['select_game'] = $this->Pricelist_model->select_game();
                $game_id = $this->session->userdata('pricelist_game_id');
                $data['get_game_name'] = $this->Pricelist_model->get_game_name($game_id);
                $data['select_brand'] = $this->Pricelist_model->select_brand($game_id);
                $data['select_model'] = $this->Pricelist_model->select_model($game_id);
                $data['get_pricelist_by_id'] = $this->Pricelist_model->get_pricelist_by_id($id, $game_id);
                $this->load->view('admin/inventory/edit_pricelist', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update pricelist */

    public function update_pricelist() {
        try {
            if ($this->session->userdata('admin_name') != '') {
                if ($this->input->post('btn_update')) {
                    $this->form_validation->set_rules('select_game', 'Select Game', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("select_game", 'Please select game!');
                        redirect('admin_controller/Pricelist/edit_pricelist');
                    } else {
                        $this->form_validation->set_rules('product_no', 'Product No', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("product_no", 'Please Enter Product No!');
                            redirect('admin_controller/Pricelist/edit_pricelist');
                        } else {
                            $this->form_validation->set_rules('select_brand', 'Select Brand', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("select_brand", 'Please Select Brand !');
                                redirect('admin_controller/Pricelist/edit_pricelist');
                            } else {
                                $this->form_validation->set_rules('type', 'Type', 'trim|required');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("type", 'Please Enter Type !');
                                    redirect('admin_controller/Pricelist/edit_pricelist');
                                } else {
                                    $this->form_validation->set_rules('select_car_model', 'Car Model', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("select_car_model", 'Please Enter Car Model !');
                                        redirect('admin_controller/Pricelist/edit_pricelist');
                                    } else {
                                        $this->form_validation->set_rules('price', 'Price', 'trim|required|greater_than[0]');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("price", 'Please Enter Price !');
                                            redirect('admin_controller/Pricelist/edit_pricelist');
                                        } else {
                                            $brand = '';
                                            $car_model = '';
                                            if ($this->input->post("select_brand") == 'Others') {
                                                $brand = $this->input->post('new_brand');
                                                $this->form_validation->set_rules('new_brand', 'New Brand', 'trim|required');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("new_brand", 'Please Enter New Brand!');
                                                    redirect('admin_controller/Pricelist/edit_pricelist');
                                                }
                                            } elseif ($this->input->post("select_brand") != 'Others') {
                                                $brand = $this->input->post('select_brand');
                                            }
                                            if ($this->input->post("select_car_model") == 'Other_model') {
                                                $car_model = $this->input->post('new_model');
                                                $this->form_validation->set_rules('new_model', ' New Model', 'trim|required');
                                                if ($this->form_validation->run() == false) {
                                                    $this->session->set_flashdata("new_model", 'Please Enter New Model !');
                                                    redirect('admin_controller/Pricelist/edit_pricelist');
                                                }
                                            } elseif ($this->input->post("select_car_model") != 'Other_model') {
                                                $car_model = $this->input->post('select_car_model');
                                            }
                                            $game_id = $this->session->userdata('pricelist_game_id');
                                            $segment_url = $this->session->userdata('price_id');
                                            $id = rawurldecode($this->encrypt->decode($segment_url));
                                            $product = $this->input->post('product_no');
                                            $type = $this->input->post('type');
                                            $price = $this->input->post('price');
                                            $year = $this->input->post('year');
                                            $update_pricelist = array(
                                                'product_no' => $product,
                                                'brand' => $brand,
                                                'type' => $type,
                                                'car_model' => $car_model,
                                                'price' => $price,
                                                'year' => $year
                                            );

                                            $user_id = $this->Pricelist_model->update_pricelist($update_pricelist, $game_id, $id);
                                            ($user_id > 0) ? ($this->session->set_flashdata("add_message", "update")) : $this->session->set_flashdata("add_message", "false");
                                            redirect('admin_controller/Pricelist/edit_pricelist');
                                        }
                                    }
                                }
                            }
                        }
                    }
                } elseif ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Pricelist/inventory_price_list');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete pricelist */

    public function delete_pricelist($id) {
        try {
            if ($this->session->userdata('admin_name') != '') {
                $game_id = $this->session->userdata('pricelist_game_id');
                $id = rawurldecode($this->encrypt->decode($id));
                ($this->Pricelist_model->delete_pricelist($id, $game_id)) ? ($this->session->set_flashdata("add_message", "delete")) : $this->session->set_flashdata("add_message", "false");
                redirect('admin_controller/Pricelist/inventory_price_list');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

}
