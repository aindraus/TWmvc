<?php
// Pages Controller
  class Pages extends Controller{
    public function __construct() {

    }
    public function index(){
      $data = [
        'title' => 'Index Home'
      ];
      $this->view('pages/index', $data);
    }
    public function about(){
      $this->view('pages/about');
    }
  }
