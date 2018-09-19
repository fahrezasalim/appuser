<?php
	$this->load->view('index/header');
	$this->load->view('index/navbar');
	$this->load->view('index/sidebar');
	$this->load->view($content);
	$this->load->view('index/footer');
?>