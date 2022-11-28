<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Contact_model extends CI_Model{
  function __construct() {
    parent::__construct();
  }
  /*
  * Return all contact
  */
  function return_all_contact(){
    $query = $this->db->from('contact')->get();
    return $query->result_array();
  }
  /*
  * Update contact
  */
  function update_contact($contact_id, $contact_name, $phone_number){
    $contact_data = array(
      'name' => $contact_name,
      'phone' => $phone_number
    );
    $update = $this->db->where('id', $contact_id)->update('contact', $contact_data);
    return $update ? true : false;
  }
  /*
  * Add contact
  */
  function add_contact($contact_name, $phone_number){
    $contact_data = array(
      'name' => $contact_name,
      'phone' => $phone_number
    );
    $insert = $this->db->insert('contact', $contact_data);
    return $insert ? true : false;
  }
  /*
  * Delete contact
  */
  function delete_contact($contact_id){
    $delete = $this->db->where('id', $contact_id)->delete('contact');
    return $delete ? true : false;
  }
}
