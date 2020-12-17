<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends CI_Controller
{

    function __construct()
    {
        parent:: __construct();
    }

    /* manage game view */

    public function manage_game()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                     $data['fetch_game'] = $this->Game_model->fetch_game();
                     $data['select_subscription'] = $this->Game_model->fetch_all_subscription();
                $this->load->view('admin/game/view_game', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* insert game */

    public function add_game()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                if ($this->input->post('btn_save')) { 
                     $this->form_validation->set_rules('txt_game_name', 'Game Name', 'trim|required|callback_fullname_check');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("message", 'Please Enter Valid Game Name!');
                        // $this->session->set_flashdata('game_name', $this->input->post('txt_game_name').'is invalid game name');    
                        redirect('admin_controller/Game/manage_game');
                    } else { 
                        $this->form_validation->set_rules('select_subsc', 'Subscription', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("sub_message", 'Please select any one Subscription!');
                            redirect('admin_controller/Game/manage_game');
                        } else {
                            $game_name = $this->input->post('txt_game_name');
                            $subs_id = $this->input->post('select_subsc');
                            $add_game = array(
                            'game_name' => $game_name,
                            'subs_id' => $subs_id
                            );
                            $user_id = $this->Game_model->insert_game($add_game);
                            ($user_id > 0) 
                            ? $this->session->set_flashdata("add_message", "true")
                            : $this->session->set_flashdata("add_message", "false");
                            redirect('admin_controller/Game/manage_game');
                        }
                    }
                } else if ($this->input->post('btn_cancel')) { 
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

    /**
     * Check valid name
     */
    public function fullname_check($str)
    {
        if (! preg_match("/^([a-z0-9 ])+$/i", $str)) {
            $this->form_validation->set_message('fullname_check', 'The %s field can only be alpha numeric');
            return false;
        } else {
            return true;
        }
    }

    /* edit game */

    public function edit_game()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $segment_url = $this->uri->segment(4); 
                $segment_url == '' ? $segment_url = $this->session->userdata('game_id') : null;
                $decrypt = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                    array
                        ('game_id' => $segment_url)
                );
                     $data['edit_game'] = $this->Game_model->fetch_game_by_id($decrypt);
                     $data['fetch_game'] = $this->Game_model->fetch_game();
                     $data['select_subscription'] = $this->Game_model->fetch_all_subscription();
                $this->load->view('admin/game/edit_game', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

    /* update game */

    public function update_game()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                if ($this->input->post('update_btn')) {
                    $this->form_validation->set_rules('txt_game_name', 'Game Name', 'trim|required|callback_fullname_check');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata('game_name', 'Please Enter Valid Game Name!');    
                        redirect('admin_controller/Game/edit_game');
                    } else {
                        $this->form_validation->set_rules('select_subsc', 'Subscription', 'trim|required');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("sel_message", 'Please select any one Subscription!');
                            redirect('admin_controller/Game/edit_game');
                        } else { 
                            $segment_url = $this->session->userdata('game_id');
                            $game_id = rawurldecode($this->encrypt->decode($segment_url));
                            $game_name = $this->input->post('txt_game_name');
                            $subs_id = $this->input->post('select_subsc');
                            $update_game = array(
                            'game_name' => $game_name,
                            'subs_id' => $subs_id
                            );
                            ($this->Game_model->update_game($update_game, $game_id)) 
                            ? ($this->session->set_flashdata("add_message", "update")) 
                            : $this->session->set_flashdata("add_message", "false");
                            redirect('admin_controller/Game/edit_game');
                        }
                    }
                } elseif ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Game/manage_game');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('error', $e->getMessage());
            return;
        }
    }

}
