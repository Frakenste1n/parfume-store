<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function index()
    {
        $this->render_page('Beranda', 'home.css', 'home.js', 'customer/v_home');
    }

    public function katalog()
    {
        $this->render_page('Katalog', 'katalog.css', 'katalog.js', 'customer/v_katalog');
    }

    public function brands()
    {
        $this->render_page('Brand', 'brands.css', 'brands.js', 'customer/v_brands');
    }

    public function tentang()
    {
        $this->render_page('Tentang Kami', 'tentang.css', 'tentang.js', 'customer/v_tentang');
    }

    public function search()
    {
        $this->render_page('Pencarian', 'search.css', 'search.js', 'customer/v_search');
    }

    public function cart()
    {
        $this->render_page('Keranjang', 'cart.css', 'cart.js', 'customer/v_cart');
    }

    public function checkout()
    {
        $this->render_page('Checkout', 'checkout.css', 'checkout.js', 'customer/v_checkout');
    }

    public function checkout_success($order_id = null)
    {
        $this->render_page('Checkout Success', 'checkout-success.css', 'checkout-success.js', 'customer/v_checkout_success');
    }

    public function orders()
    {
        $this->render_page('Riwayat Pesanan', 'orders.css', 'orders.js', 'customer/v_orders');
    }

    private function render_page($title, $css, $js, $content)
    {
        $this->load->model('Setting_model');
        $setting = $this->Setting_model->get_setting();

        $data = [
            'page_title' => ($setting && $setting->site_name) ? $setting->site_name . ' — ' . $title : $title,
            'page_css'   => $css,
            'page_js'    => $js,
            'content'    => $content,
            'site_name'  => ($setting && $setting->site_name) ? $setting->site_name : 'Parfume Store',
            'site_logo'  => ($setting && !empty($setting->logo))
                ? base_url('uploads/settings/' . $setting->logo)
                : '',
            'site_favicon' => ($setting && !empty($setting->favicon))
                ? base_url('uploads/settings/' . $setting->favicon)
                : ''
        ];

        $this->load->view('customer/layouts/app', $data);
    }
}
