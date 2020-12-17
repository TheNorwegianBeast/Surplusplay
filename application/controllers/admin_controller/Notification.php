<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller
{
    /* Calling Constructer */

    function __construct()
    {
        parent::__construct();
        $this->load->model('admin_model/Notification_model');
    }

    /* add inteval notification */

    public function add_inteval_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $game_id = $this->input->post('select_game');
                $user_game = '';
                $game_id == '' ? $game_id = 1 : null;
                $this->session->set_userdata(
                    array(
                    'notify_game_id' => $game_id,
                    )
                );
                    $data['user_game'] = $this->Game_model->fetch_user_game($game_id);
                    $data['notification'] = $this->Notification_model->fetch_notification_interval($game_id);
                    $data['game'] = $this->Game_model->fetch_all_game();
                    $data['game_name'] = $this->Game_model->fetch_one_game($game_id);
                foreach ($data['game_name'] as $row) {
                    $user_game = $row->game_name;
                }
                     $data['sel_game'] = $user_game;
                $this->load->view('admin/notification/add_interval_notification', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* inserting inteval notification */

    public function insert_inteval_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                if ($this->input->post('btn_save')) {
                    $this->form_validation->set_rules('select_game', 'Select Game', 'trim|required');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("sel_message", 'Please Select Game');
                        redirect('admin_controller/Notification/add_inteval_notify');
                    } else { 
                        $this->form_validation->set_rules('txt_subject', 'Subject', 'required|trim');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("sub_message", 'Please Enter Valid Subject');
                            redirect('admin_controller/Notification/add_inteval_notify');
                        } else { 
                            $this->form_validation->set_rules('txt_message', 'Message', 'required|trim');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("mes_message", 'Please Enter Valid Message for Notification');
                                redirect('admin_controller/Notification/add_inteval_notify');
                            } else {
                                $this->form_validation->set_rules('txt_date', 'Notification Date', 'required|trim');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("date_message", 'Please Select Valid Notification Date');
                                    redirect('admin_controller/Notification/add_inteval_notify');
                                } else { 
                                    $this->form_validation->set_rules('txt_time', 'Notification Time', 'required|trim');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("time_message", 'Please Select Valid Notification Time');
                                        redirect('admin_controller/Notification/add_inteval_notify');
                                    } else { 
                                        $this->form_validation->set_rules('sel_interval', 'Notification Interval', 'trim|required');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("int_message", 'Please Select Valid Notification Interval');
                                            redirect('admin_controller/Notification/add_inteval_notify');
                                        } else {
                                            $this->form_validation->set_rules('sel_zone', 'Time Zone', 'trim|required');
                                            if ($this->form_validation->run() == false) {
                                                $this->session->set_flashdata("zone_message", 'Please Select Valid Time Zone');
                                                redirect('admin_controller/Notification/add_inteval_notify');
                                            } else { 
                                                $subject = $this->input->post('txt_subject');
                                                $message = $this->input->post('txt_message');
                                                $txt_date = $this->input->post('txt_date');
                                                $txt_time = $this->input->post('txt_time');
                                                $sel_interval = $this->input->post('sel_interval');
                                                $sel_zone = $this->input->post('sel_zone');
                                                $game_id = $this->input->post('select_game');

                                                $data = array(
                                                'subject' => $subject,
                                                'message' => $message,
                                                'notification_date' => $txt_date,
                                                'notification_time' => $txt_time,
                                                'notification_interval' => $sel_interval,
                                                'time_zone' => $sel_zone
                                                );
                                                $res = $this->Notification_model->insert_notify_interval($data, $game_id);
                                                ($res) 
                                                ? ($this->session->set_flashdata("suc_message", "true")) 
                                                : $this->session->set_flashdata("suc_message", "false");
                                                redirect('admin_controller/Notification/add_inteval_notify');
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('Admin/home');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* view interval Notification */

    public function view_interval_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $game_id =  $this->session->userdata('notify_game_id');
                $segment_url = $this->uri->segment(4); 
                $notify_id = rawurldecode($this->encrypt->decode($segment_url));
                $data['notify'] = $this->Notification_model->view_notification_interval($game_id, $notify_id);
                $this->load->view('admin/notification/view_interval_notify', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* edit interval Notification */

    public function edit_interval_notify()
    {
        try {            
            if ($this->session->userdata('admin_name') != '') { 
                $game_id = $this->session->userdata('notify_game_id');
                $segment_url = $this->uri->segment(4); 
                $segment_url == '' ? $segment_url = $this->session->userdata('notify_id') : null;
                $notify_id = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                    array(
                    'notify_id' => $segment_url,
                    )
                );
                $data['notify'] = $this->Notification_model->view_notification_interval($game_id, $notify_id);
                $this->load->view('admin/notification/edit_interval_notify', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* update inteval notification */

    public function update_inteval_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                if ($this->input->post('btn_update')) { 
                        $this->form_validation->set_rules('txt_subject', 'Subject', 'required|trim');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("sub_message", 'Please Enter Valid Subject');
                        redirect('admin_controller/Notification/edit_interval_notify');
                    } else { 
                        $this->form_validation->set_rules('txt_message', 'Message', 'required|trim');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("mes_message", 'Please Enter Valid Message for Notification');
                            redirect('admin_controller/Notification/edit_interval_notify');
                        } else {
                            $this->form_validation->set_rules('txt_date', 'Notification Date', 'required|trim');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("date_message", 'Please Select Valid Notification Date');
                                 redirect('admin_controller/Notification/edit_interval_notify');
                            } else { 
                                $this->form_validation->set_rules('txt_time', 'Notification Time', 'required|trim');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("time_message", 'Please Select Valid Notification Time');
                                     redirect('admin_controller/Notification/edit_interval_notify');
                                } else { 
                                    $this->form_validation->set_rules('sel_interval', 'Notification Interval', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("int_message", 'Please Select Valid Notification Interval');
                                         redirect('admin_controller/Notification/edit_interval_notify');
                                    } else {
                                        $this->form_validation->set_rules('sel_zone', 'Time Zone', 'trim|required');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("zone_message", 'Please Select Valid Time Zone');
                                             redirect('admin_controller/Notification/edit_interval_notify');
                                        } else {  
                                            $segment_url = $this->session->userdata('notify_id');
                                            $notify_id = rawurldecode($this->encrypt->decode($segment_url));              
                                            $subject = $this->input->post('txt_subject');
                                            $message = $this->input->post('txt_message');
                                            $txt_date = $this->input->post('txt_date');
                                            $txt_time = $this->input->post('txt_time');
                                            $sel_interval = $this->input->post('sel_interval');
                                            $sel_zone = $this->input->post('sel_zone');
                                            $game_id = $this->session->userdata('notify_game_id');

                                            $data = array(
                                            'subject' => $subject,
                                            'message' => $message,
                                            'notification_date' => $txt_date,
                                            'notification_time' => $txt_time,
                                            'notification_interval' => $sel_interval,
                                            'time_zone' => $sel_zone
                                            );
                                            $res = $this->Notification_model->update_notify_interval($game_id, $notify_id, $data);
                                             ($res) 
                                                ? ($this->session->set_flashdata("suc_message", "update")) 
                                                : $this->session->set_flashdata("suc_message", "false");
                                                redirect('admin_controller/Notification/edit_interval_notify');
                                        } 
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Notification/add_inteval_notify');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* delete inteval Notification */

    public function delete_inteval_notify($segment_url)
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                     $game_id = $this->session->userdata('notify_game_id');
                     $notify_id = rawurldecode($this->encrypt->decode($segment_url));
                     $res = $this->Notification_model->delete_notify_interval($game_id, $notify_id);
                 ($res) 
                ? ($this->session->set_flashdata("suc_message", "delete")) 
                : $this->session->set_flashdata("suc_message", "false");
                redirect('admin_controller/Notification/add_inteval_notify');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* add activity notification */

    public function add_activity_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                     $game_id = $this->input->post('select_game');
                     $user_game = '';
                     $game_id == '' ? $game_id = 1 : null;
                $this->session->set_userdata(
                    array(
                    'act_notify_game_id' => $game_id,
                    )
                );
                     $data['user_game'] = $this->Game_model->fetch_user_game($game_id);
                     $data['game'] = $this->Game_model->fetch_all_game();
                     $data['notify'] = $this->Notification_model->fetch_activity_notification($game_id);
                     $data['game_name'] = $this->Game_model->fetch_one_game($game_id);
                foreach ($data['game_name'] as $row) {
                    $user_game = $row->game_name;
                }
                     $data['sel_game'] = $user_game;
                $this->load->view('admin/notification/add_activity_notification', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* inserting activity notification */

    public function insert_activity_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                if ($this->input->post('btn_save')) {
                     $this->form_validation->set_rules('select_game', 'Select Game', 'required|trim');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("sel_message", 'Please Select Game!');
                        redirect('admin_controller/Notification/add_activity_notify');
                    } else {   
                        $this->form_validation->set_rules('sel_type', 'Activity Type', 'required|trim');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("act_message", 'Please Select Activity Type!');
                             redirect('admin_controller/Notification/add_activity_notify');
                        } else { 
                            $this->form_validation->set_rules('txt_from_rank', 'From Rank', 'required|trim|numeric|greater_than[0.99]');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("frank_message", 'Please enter valid From Rank!');
                                redirect('admin_controller/Notification/add_activity_notify');
                            } else { 
                                $this->form_validation->set_rules('txt_to_rank', 'To Rank', 'required|trim|numeric|greater_than[0.99]');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("trank_message", 'Please enter valid To Rank!');
                                    redirect('admin_controller/Notification/add_activity_notify');
                                } else { 
                                                                                                                    $this->form_validation->set_rules('txt_subject', 'Subject', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("sub_message", 'Please Enter Valid Subject for Notification!');
                                        redirect('admin_controller/Notification/add_activity_notify');
                                    } else { 
                                        $this->form_validation->set_rules('txt_message', 'Message', 'trim|required');
                                        if ($this->form_validation->run() == false) {
                                            $this->session->set_flashdata("m_message", 'Please Enter Message for Notification!');
                                            redirect('admin_controller/Notification/add_activity_notify');
                                        } else { 
                                            $sel_type = $this->input->post('sel_type');
                                            $txt_from_rank = $this->input->post('txt_from_rank');
                                            $txt_to_rank = $this->input->post('txt_to_rank');
                                            $txt_subject = $this->input->post('txt_subject');
                                            $txt_message = $this->input->post('txt_message');
                                            $game_id = $this->input->post('select_game');

                                            $data = array(
                                            'type' => $sel_type,
                                            'from_rank' => $txt_from_rank,
                                            'to_rank' => $txt_to_rank,
                                            'subject' => $txt_subject,
                                            'message' => $txt_message
                                            );
                                            $res = $this->Notification_model->insert_activity_interval($data, $game_id);
                                             ($res) 
                                                ? ($this->session->set_flashdata("suc_message", "true")) 
                                                : $this->session->set_flashdata("suc_message", "false");
                                                redirect('admin_controller/Notification/add_activity_notify');
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('Admin/home');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* view activity notification */

    public function view_activity_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $game_id = $this->session->userdata('act_notify_game_id');
                $segment_url = $this->uri->segment(4); 
                $notify_id = rawurldecode($this->encrypt->decode($segment_url));
                $data['notify'] = $this->Notification_model->view_activity_notification($game_id, $notify_id);
                $this->load->view('admin/notification/view_activity_notify', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* edit activity notification */

    public function edit_activity_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $game_id = $this->session->userdata('act_notify_game_id');
                $segment_url = $this->uri->segment(4); 
                $segment_url == '' ? $segment_url = $this->session->userdata('act_notify_id') : null;
                $notify_id = rawurldecode($this->encrypt->decode($segment_url));
                $this->session->set_userdata(
                    array(
                    'act_notify_id' => $segment_url
                    )
                );
                $data['notify'] = $this->Notification_model->view_activity_notification($game_id, $notify_id);
                $this->load->view('admin/notification/edit_activity_notify', $data);
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* update activity notification */

    public function update_activity_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                if ($this->input->post('btn_update')) {
                     $this->form_validation->set_rules('sel_type', 'Activity Type', 'required|trim');
                    if ($this->form_validation->run() == false) {
                        $this->session->set_flashdata("act_message", 'Please Select Activity Type!');
                         redirect('admin_controller/Notification/edit_activity_notify');
                    } else { 
                        $this->form_validation->set_rules('txt_from_rank', 'From Rank', 'required|trim|numeric|greater_than[0.99]');
                        if ($this->form_validation->run() == false) {
                            $this->session->set_flashdata("frank_message", 'Please enter valid From Rank!');
                            redirect('admin_controller/Notification/edit_activity_notify');
                        } else { 
                            $this->form_validation->set_rules('txt_to_rank', 'To Rank', 'required|trim|numeric|greater_than[0.99]');
                            if ($this->form_validation->run() == false) {
                                $this->session->set_flashdata("trank_message", 'Please enter valid To Rank!');
                                redirect('admin_controller/Notification/edit_activity_notify');
                            } else { 
                                $this->form_validation->set_rules('txt_subject', 'Subject', 'trim|required');
                                if ($this->form_validation->run() == false) {
                                    $this->session->set_flashdata("sub_message", 'Please Enter Valid Subject for Notification!');
                                    redirect('admin_controller/Notification/edit_activity_notify');
                                } else { 
                                    $this->form_validation->set_rules('txt_message', 'Message', 'trim|required');
                                    if ($this->form_validation->run() == false) {
                                        $this->session->set_flashdata("m_message", 'Please Enter Message for Notification!');
                                        redirect('admin_controller/Notification/edit_activity_notify');
                                    } else { 
                                        $segment_url = $this->session->userdata('act_notify_id');
                                        $notify_id = rawurldecode($this->encrypt->decode($segment_url));
                                        $sel_type = $this->input->post('sel_type');
                                        $txt_from_rank = $this->input->post('txt_from_rank');
                                        $txt_to_rank = $this->input->post('txt_to_rank');
                                        $txt_subject = $this->input->post('txt_subject');
                                        $txt_message = $this->input->post('txt_message');
                                        $game_id = $this->session->userdata('act_notify_game_id');

                                        $data = array(
                                        'type' => $sel_type,
                                        'from_rank' => $txt_from_rank,
                                        'to_rank' => $txt_to_rank,
                                        'subject' => $txt_subject,
                                        'message' => $txt_message
                                        );
                                        $res = $this->Notification_model->update_notify_activity($game_id, $notify_id, $data);
                                        ($res) 
                                        ? ($this->session->set_flashdata("suc_message", "update")) 
                                        : $this->session->set_flashdata("suc_message", "false");
                                        redirect('admin_controller/Notification/edit_activity_notify');
                                    }
                                }
                            }
                        }
                    }
                } else if ($this->input->post('btn_cancel')) {
                    redirect('admin_controller/Notification/add_activity_notify');
                }
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }

    /* delete activity notification */

    public function delete_activity_notify()
    {
        try {
            if ($this->session->userdata('admin_name') != '') { 
                $game_id = $this->session->userdata('act_notify_game_id');
                $segment_url = $this->uri->segment(4); 
                $notify_id = rawurldecode($this->encrypt->decode($segment_url));
                 ($this->Notification_model->delete_notify_activity($game_id, $notify_id)) 
                ? ($this->session->set_flashdata("suc_message", "delete")) 
                : $this->session->set_flashdata("suc_message", "false");
                redirect('admin_controller/Notification/add_activity_notify');
            } else {
                redirect('Admin/index');
            }
        } catch (Exception $e) {
            log_message('Error ', $e->getMessage());
            return;
        }
    }
}
