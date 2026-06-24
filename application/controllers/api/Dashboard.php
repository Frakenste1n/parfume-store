<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';

class Dashboard extends Base_api
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('Dashboard_model');
    }

    public function index_get()
    {
        $data = [
            'total_users'      => $this->Dashboard_model->total_users(),
            'total_brands'     => $this->Dashboard_model->total_brands(),
            'total_categories' => $this->Dashboard_model->total_categories(),
            'total_products'   => $this->Dashboard_model->total_products(),
            'total_orders'     => $this->Dashboard_model->total_orders(),
            'total_revenue'    => $this->Dashboard_model->total_revenue(),
            'latest_orders'    => $this->Dashboard_model->latest_orders()
        ];

        return $this->success_response(
            'Dashboard berhasil diambil',
            $data
        );
    }
}