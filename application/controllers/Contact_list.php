<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_list extends CI_Controller {
	function __construct() {
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('contact_model');
	}
	public function index(){
		$data['contact'] = $this->contact_model->return_all_contact();

		$this->load->view('header');
		$this->load->view('contact_list', $data);
		$this->load->view('footer');
	}

	/*
	* Ajax edit contact
	*/
	public function edit_contact(){
		$json = array();
		$error_message = '';
		$success_message = '';
		$contact_name_error = '';
		$phone_number_error = '';
		$result = false;

		$this->form_validation->set_rules('contact_name', 'contact name', 'required');
		$this->form_validation->set_rules('phone_number', 'phone number', 'required|regex_match[/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/]',
		array('regex_match' => 'The phone number is not valid'));

		if($this->form_validation->run() == true){
			$contact_id = $this->input->post('contact_id');
			$contact_name = $this->input->post('contact_name');
			$phone_number = $this->input->post('phone_number');

			$update = $this->contact_model->update_contact($contact_id, $contact_name, $phone_number);

			if($update){
				$result = true;
				$success_message = 'Contact has been successfully updated';
			}else{
				$error_message = 'Some problems occured, please try again.';
			}
		}else{
			$error_message = 'Please correct the errors in the form.';
			$contact_name_error = form_error('contact_name');
			$phone_number_error = form_error('phone_number');
		}

		$json = array(
			'error_message' => $error_message,
			'success_message' => $success_message,
			'contact_name_error' => $contact_name_error,
			'phone_number_error' => $phone_number_error,
			'result' => $result
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	/*
	* Ajax add contact
	*/
	public function add_contact(){
		$json = array();
		$error_message = '';
		$success_message = '';
		$contact_name_error = '';
		$phone_number_error = '';
		$result = false;

		$this->form_validation->set_rules('contact_name', 'contact name', 'required');
		$this->form_validation->set_rules('phone_number', 'phone number', 'required|regex_match[/^(\+?6?01)[0|1|2|3|4|6|7|8|9]\-*[0-9]{7,8}$/]',
		array('regex_match' => 'The phone number is not valid'));

		if($this->form_validation->run() == true){
			$contact_name = $this->input->post('contact_name');
			$phone_number = $this->input->post('phone_number');

			$add = $this->contact_model->add_contact($contact_name, $phone_number);

			if($add){
				$result = true;
				$success_message = 'Contact has been successfully added';
			}else{
				$error_message = 'Some problems occured, please try again.';
			}
		}else{
			$error_message = 'Please correct the errors in the form.';
			$contact_name_error = form_error('contact_name');
			$phone_number_error = form_error('phone_number');
		}

		$json = array(
			'error_message' => $error_message,
			'success_message' => $success_message,
			'contact_name_error' => $contact_name_error,
			'phone_number_error' => $phone_number_error,
			'result' => $result
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}

	/*
	* Ajax delete contact
	*/
	public function delete_contact(){
		$json = array();
		$error_message = '';
		$result = false;

		$contact_id = $this->input->post('selected_contact');

		$delete = $this->contact_model->delete_contact($contact_id);

		if($delete){
			$result = true;
		}else{
			$error_message = 'Some problems occured, please try again.';
		}

		$json = array(
			'error_message' => $error_message,
			'result' => $result
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($json));
	}
}
