<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

    public function index()
    {
        $this->load->view('v_home');
    }

    // PINTU KAMAR KATALOG
    public function katalog()
    {
        $this->load->view('v_katalog');
    }

    // PINTU KAMAR BRANDS
    public function brands()
    {
        $this->load->view('v_brands');
    }

    // PINTU KAMAR TENTANG KAMI
    public function tentang()
    {
        $this->load->view('v_tentang');
    }

    // PINTU KAMAR PENCARIAN
    public function search()
    {
        // Pintu halaman search (sementara kosong dulu gapapa)
    }

    // PINTU KAMAR KERANJANG
    public function cart()
    {
        $this->load->view('v_cart');
    }
}