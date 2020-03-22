<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Rental extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('id');
        if ($id == '') {
            $rental = $this->db->get('mobil')->result();
        } else {
            $this->db->where('id', $id);
            $rrental = $this->db->get('mobil')->result();
        }
        $this->response($rental, 200);
    }

    function index_post() {
        $data = array(
                    'id'           => $this->post('id'),
                    'namambl'          => $this->post('Nama Mobil'),
                    'mrkmbl'    => $this->post('Merek Mobil'));
        $insert = $this->db->insert('mobil', $data);
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('id');
        $data = array(
                    'id'       => $this->put('id'),
                    'namambl'          => $this->put('Nama Mobil'),
                    'mrkmbl'    => $this->put('Merek Mobil'));
        $this->db->where('id', $id);
        $update = $this->db->update('mobil', $data);
        if ($update) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_delete() {
        $id = $this->delete('id');
        $this->db->where('id', $id);
        $delete = $this->db->delete('mobil');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>