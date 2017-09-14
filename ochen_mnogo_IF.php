<?php
function send_pm()
{
	$data = array();
	$this->load->model('user_model', 'userManager');
	$this->load->model('site_model');
	
	$settings = $this->site_model->get_website_settings()->result_array();
	$settings = $settings[0];
	
	$user_lng = $this->userManager->get_user_language($this->session->userdata('user_id'))->result_array();
	
	if(sizeof($user_lng) > 0) {
		$lng_opt = $user_lng[0]["language"];
	} else {
		$lng_opt = $settings["default_language"];
	}
	
	$this->lang->load('pm_lang', $lng_opt);
	$this->lang->load('site_lang', $lng_opt);
	
	if(DEMO_MODE == 1) {
	    $data["result"] = 500;
    } else {

	    if ($this->session->userdata("user_id")) {	
	    		
	    		
	    		
	    	$this->load->model('pm_model', 'pmManager');
	    	
	    	$user_id = $this->input->post('user_id');
	    	$form_message = $this->security->xss_clean(strip_tags($this->input->post('message')));
	    	
	    	if($form_message != "")
	    	{
		    	if($user_id != $this->session->userdata('user_id'))
		    	{
		    	
		    		if($this->session->userdata("user_firstform") == 0) {
				    	$data["result"] = 995;
			    	} else {
				    	$receiver = $this->userManager->get($user_id)->result_array();
				    	
				    	if($receiver != NULL)
						{
							if(!$this->userManager->check_blocked($user_id, $this->session->userdata('user_id'))) {
								// Check if the conversation already exists
								$conv = $this->pmManager->get_conv($user_id, $this->session->userdata('user_id'));
								
								if($conv != NULL) {
									$this->pmManager->new_message_to_conv($conv->id, $form_message, $this->session->userdata('user_id'));
									
									// Make conv as unread for the receiver user
									if($conv->sender_id == $this->session->userdata('user_id'))
									{
										$this->pmManager->update_conv($conv->id, array("is_read_recipient" => 0, "last_answer_user_id" => $this->session->userdata('user_id')));
									} else {
										$this->pmManager->update_conv($conv->id, array("is_read_sender" => 0, "last_answer_user_id" => $this->session->userdata('user_id')));
									}
									
									$datauser = $this->userManager->get($this->session->userdata('user_id'))->result_array();
									$datauser = $datauser[0];
									
									$data["user"] = $datauser;
									
								} else {
									$new_conv = $this->pmManager->new_conv($this->session->userdata('user_id'), $user_id);
									$this->pmManager->new_message_to_conv($new_conv, $form_message, $this->session->userdata('user_id'));
								}
									
								if(!$this->pmManager->check_daily_notif($receiver[0]["uid"])) {
									$message = "You have received some new private messages.";
	
									$title_email = "New private message";
		
									$this->send_mail($title_email, $receiver[0]["email"], $message, $title_email, $receiver[0]["username"]);
									$this->pmManager->add_daily_notif($receiver[0]["uid"]);
								}

								$data["result"] = 1;
							} else {
								$data["result"] = 994;
							}
						} else {
							$data["result"] = 996;
						}
					
					}
		    	}
		    	else
				{
					$data["result"] = 997;
				}
			
			} else {
				$data["result"] = 998;
			}
	    
	    } else {
		    $data["result"] = 999;
	    }
    }
    
    header('Content-type: application/json;');
	echo json_encode($data);
}