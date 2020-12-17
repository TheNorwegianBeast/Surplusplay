<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Inventory extends CI_Controller
{

    /**
     * Calling constructer
     */
    function __construct()
    {
        parent:: __construct();
        $this->load->model('admin_model/Inventory_model');
    }

    /* add inventory */

    public function manage_inventory()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $data['select_game'] = $this->Inventory_model->select_game();
                $game_id = $this->input->post('select_game');
                $user_game = '';
                $game_id == '' ? $game_id = 1 : null;
                $this->session->set_userdata(
                    array(
                    'inventory_game_id' => $game_id,
                    )
                );
                $data['user_game'] = $this->Game_model->fetch_user_game($game_id);
                $data['get_all_inventory'] = $this->Inventory_model->get_inventory($game_id);
                $data['game'] = $this->Game_model->fetch_all_game();
                $data['game_name'] = $this->Game_model->fetch_one_game($game_id);
                foreach ($data['game_name'] as $row) {
                    $user_game = $row->game_name;
                }
                $data['sel_game'] = $user_game;
                $this->load->view('admin/inventory/manage_inventory', $data);
            } else {
                redirect('Admin/index');
            }
           
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* select brand */

    public function select_brand()
    {
        try {
            $this->session->userdata('admin_name') != '' 
                ? $this->load->view('admin/inventory/inventory_select_brand') 
                : redirect('Admin/index');
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* select brand */

    public function select_car_model()
    {
        try {
            $this->session->userdata('admin_name') != '' 
                ? $this->load->view('admin/inventory/inventory_select_model') 
                : redirect('Admin/index');
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

            /**
             * Check valid name 
             */
    function alpha_dash($fullname)
    {
        if (! preg_match('/^[a-zA-Z ]+$/', $fullname)) {
            $this->form_validation->set_message('alpha_dash', 'The %s field may only contain alpha characters');
            return false;
        } else {
            return true;
        }
    }
        
    /* insert inventory */

    public function insert_inventory()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $game_id = $this->session->userdata('inventory_game_id');
                if ($this->input->post('btn_save')) {
                    $this->form_validation->set_rules('select_game', 'Select Game', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("select_game", 'Please Select Game!');
                        redirect('admin_controller/Inventory/manage_inventory');
                    } else {
                        $this->form_validation->set_rules('product_no', 'Product No', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("product_no_message", 'Please Enter Product No!');
                            redirect('admin_controller/Inventory/manage_inventory');
                        } else {
                            $this->form_validation->set_rules('select_brand', 'Select Brand', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("select_brand", 'Please Enter Brand!');
                                redirect('admin_controller/Inventory/manage_inventory');
                            } else {
                                $this->form_validation->set_rules('type', 'Type', 'trim|required');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("type", 'Please Enter Type!');
                                    redirect('admin_controller/Inventory/manage_inventory');
                                } else {
                                    $this->form_validation->set_rules('select_car_model', 'Car Model', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("select_car_model", 'Please Enter Car Model!');
                                        redirect('admin_controller/Inventory/manage_inventory');
                                    } else {
                                        $this->form_validation->set_rules('cost', 'Cost', 'trim|required|greater_than[0]');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("cost", 'Please Enter Cost!');
                                            redirect('admin_controller/Inventory/manage_inventory');
                                        } else {
                                            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|greater_than[0]');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("quantity", 'Please Enter Quantity!');
                                                redirect('admin_controller/Inventory/manage_inventory');
                                            } else {
                                                // $this->form_validation->set_rules('year', 'Year', 'trim|required|greater_than[0]');
                                                // if ($this->form_validation->run() == false) {
                                                //     $this->session->set_flashdata("year", 'Please Enter Year!');
                                                //     redirect('admin_controller/Inventory/manage_inventory');
                                                // } else {

                                                    $brand = '';
                                                    $car_model = '';
                                                if ($this->input->post("select_brand") == 'Others') {
                                                    $brand = $this->input->post('new_brand');
                                                    $this->form_validation->set_rules('new_brand', 'New Brand', 'trim|required');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("new_brand", 'Please Enter New Brand!');
                                                        redirect('admin_controller/Inventory/manage_inventory');
                                                    }
                                                } elseif ($this->input->post("select_brand") != 'Others') {
                                                    $brand = $this->input->post('select_brand');
                                                }
                                                if ($this->input->post("select_car_model") == 'Other_model') {
                                                    $car_model = $this->input->post('new_model');
                                                    $this->form_validation->set_rules('new_model', 'New Car Model', 'trim|required');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("new_model", 'Please Enter New Car Model!');
                                                        redirect('admin_controller/Inventory/manage_inventory');
                                                    }
                                                } elseif ($this->input->post("select_car_model") != 'Other_model') {
                                                    $car_model = $this->input->post('select_car_model');
                                                }
                                                    $product_no = $this->input->post('product_no');
                                                    $type = $this->input->post('type');
                                                    $cost = $this->input->post('cost');
                                                    $quantity = $this->input->post('quantity');
                                                    $is_new = $this->input->post('radio_is_new');
                                                    $year = $this->input->post('year');

                                                    $insert_inventory = array(
                                                    'product_no' => $product_no,
                                                    'brand_name' => $brand,
                                                    'type' => $type,
                                                    'car_model' => $car_model,
                                                    'cost' => $cost,
                                                    'quanity' => $quantity,
                                                    'is_new' => $is_new,
                                                    'year' => $year
                                                    );
                                                    $user_id = $this->Inventory_model->add_inventory($insert_inventory, $game_id);
                                                    ($user_id > 0) 
                                                    ? ($this->session->set_flashdata("suc_message", "true")) 
                                                    : $this->session->set_flashdata("suc_message", "false");
                                                    redirect('admin_controller/Inventory/manage_inventory');
                                                    // }
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

    /* view inventory by id */

    public function get_inventory_by_id()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $segment_url = $this->uri->segment(4); 
                $id = rawurldecode($this->encrypt->decode($segment_url));
                $game_id = $this->session->userdata('inventory_game_id');
                $data['get_game_name'] = $this->Inventory_model->get_game_name($game_id);
                $data['get_inventory_by_id'] = $this->Inventory_model->get_inventory_by_id($id, $game_id);
                $this->load->view('admin/inventory/view_one_inventory', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* view inventory by id for edit */

    public function edit_inventory()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                 $segment_url = $this->uri->segment(4); 
                 $segment_url == '' ? $segment_url = $this->session->userdata('inven_id') : null;
                $id = rawurldecode($this->encrypt->decode($segment_url));
                    $this->session->set_userdata(
                        array
                        ('inven_id' => $segment_url)
                    );
                $data['select_game'] = $this->Inventory_model->select_game();
                $game_id = $this->session->userdata('inventory_game_id');
                $data['get_game_name'] = $this->Inventory_model->get_game_name($game_id);
                $data['select_model'] = $this->Inventory_model->select_car_model($game_id);
                $data['select_brand'] = $this->Inventory_model->select_brand($game_id);
                $data['get_inventory_by_id'] = $this->Inventory_model->get_inventory_by_id($id, $game_id);
                $this->load->view('admin/inventory/edit_inventory', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update inventory */

    public function update_inventory()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $game_id = $this->session->userdata('inventory_game_id');
                if ($this->input->post('btn_update')) {
                    $this->form_validation->set_rules('select_game', 'Select Game', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("select_game", 'Please Select Game!');
                        redirect('admin_controller/Inventory/edit_inventory');
                    } else {
                        $this->form_validation->set_rules('product_no', 'Product No', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("product_no", 'Please Enter Product No!');
                            redirect('admin_controller/Inventory/edit_inventory');
                        } else {
                            $this->form_validation->set_rules('select_brand', 'Select Brand', 'trim|required');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("select_brand", 'Please Enter Brand!');
                                redirect('admin_controller/Inventory/edit_inventory');
                            } else {
                                $this->form_validation->set_rules('type', 'Type', 'trim|required');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("type", 'Please Enter Type!');
                                    redirect('admin_controller/Inventory/edit_inventory');
                                } else {
                                    $this->form_validation->set_rules('select_car_model', 'Car Model', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("select_car_model", 'Please Enter Car Model!');
                                        redirect('admin_controller/Inventory/edit_inventory');
                                    } else {
                                        $this->form_validation->set_rules('cost', 'Cost', 'trim|required|greater_than[0]');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("cost", 'Please Enter Cost!');
                                            redirect('admin_controller/Inventory/edit_inventory');
                                        } else {
                                            $this->form_validation->set_rules('quantity', 'Quantity', 'trim|required|greater_than[0]');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("quantity", 'Please Enter Quantity!');
                                                redirect('admin_controller/Inventory/edit_inventory');
                                            } else {
                                                    $segment_url = $this->session->userdata('inven_id');
                                                $id = rawurldecode($this->encrypt->decode($segment_url));
                                                    $brand = '';
                                                    $car_model = '';
                                                if ($this->input->post("select_brand") == 'Others') {
                                                    $brand = $this->input->post('new_brand');
                                                    $this->form_validation->set_rules('new_brand', 'Select New Brand', 'trim|required');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("new_brand", 'Please Enter New Brand!');
                                                        redirect('admin_controller/Inventory/edit_inventory');
                                                    }
                                                } elseif ($this->input->post("select_brand") != 'Others') {
                                                    $brand = $this->input->post('select_brand');
                                                }
                                                if ($this->input->post("select_car_model") == 'Other_model') {
                                                    $car_model = $this->input->post('new_model');
                                                    $this->form_validation->set_rules('new_model', 'New Car Model', 'trim|required');
                                                    if ($this->form_validation->run() == false) {
                                                        $this->session->set_flashdata("new_model", 'Please Enter New Car Model!');
                                                        redirect('admin_controller/Inventory/edit_inventory');
                                                    }
                                                } elseif ($this->input->post("select_car_model") != 'Other_model') {
                                                    $car_model = $this->input->post('select_car_model');
                                                }
                                                     $product_no = $this->input->post('product_no');
                                                    $type = $this->input->post('type');
                                                    $cost = $this->input->post('cost');
                                                    $quantity = $this->input->post('quantity');
                                                    $is_new = $this->input->post('radio_is_new');
                                                    $year = $this->input->post('year');

                                                    $update_inventory = array(
                                                    'product_no' => $product_no,
                                                    'brand_name' => $brand,
                                                    'type' => $type,
                                                    'car_model' => $car_model,
                                                    'cost' => $cost,
                                                    'quanity' => $quantity,
                                                    'is_new' => $is_new,
                                                    'year' => $year
                                                    );
                                                    $user_id = $this->Inventory_model->update_inventory($update_inventory, $game_id, $id);
                                                    ($user_id > 0) 
                                                    ? ($this->session->set_flashdata("suc_message", "update")) 
                                                    : $this->session->set_flashdata("suc_message", "false");
                                                    redirect('admin_controller/Inventory/edit_inventory');
                                            }
                                            // }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } elseif ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Inventory/manage_inventory');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* delete inventory */

    public function delete_inventory()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $game_id = $this->session->userdata('inventory_game_id');
                 $segment_url = $this->uri->segment(4); 
                $id = rawurldecode($this->encrypt->decode($segment_url));
                ($this->Inventory_model->delete_inventory($game_id, $id)) 
                ? ($this->session->set_flashdata("suc_message", "delete")) 
                : $this->session->set_flashdata("suc_message", "false");
                redirect('admin_controller/Inventory/manage_inventory');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

}
