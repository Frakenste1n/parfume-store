<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';

class Home extends Base_api
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Banner_model');
        $this->load->model('Brand_model');
        $this->load->model('Category_model');
        $this->load->model('Product_model');
        $this->load->model('Setting_model');
    }

    public function index_get()
    {
        $data = [
            'settings'          => $this->Setting_model->format_setting_response(
                $this->Setting_model->get_setting()
            ),
            'banners' =>            $this->Banner_model->get_active_banner(),
            'categories' =>         $this->Category_model->get_home_categories(),
            'brands' =>             $this->Brand_model->get_home_brands(),
            'featured_products' =>  $this->Product_model->get_featured_home()
        ];

        return $this->success_response(
            'Data homepage berhasil diambil',
            $data
        );
    }
}