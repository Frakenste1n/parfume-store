<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';

class Payment_methods extends Base_api
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Payment_method_model');
    }

    public function index_get()
    {
        $all = $this->get('all');

        $data = $all
            ? $this->Payment_method_model->get_all_admin()
            : $this->Payment_method_model->get_all();

        return $this->success_response(
            'Data metode pembayaran berhasil diambil',
            $data
        );
    }

    public function show_get($id)
    {
        $payment = $this->Payment_method_model->find($id);

        if (!$payment)
        {
            return $this->error_response('Data tidak ditemukan');
        }

        return $this->success_response('Detail metode pembayaran', $payment);
    }

    public function store_post()
    {
        $data = [
            'name'           => $this->post('name'),
            'account_name'   => $this->post('account_name'),
            'account_number' => $this->post('account_number'),
            'is_active'      => $this->post('is_active') ?: 1
        ];

        if (!empty($_FILES['logo']['name']))
        {
            $upload = upload_image('logo', './uploads/payments/');

            if (!$upload['success'])
            {
                return $this->error_response($upload['message']);
            }

            $data['logo'] = $upload['file_name'];
        }

        $this->Payment_method_model->create($data);

        return $this->success_response('Metode pembayaran berhasil ditambahkan');
    }

    public function update_put($id)
    {
        $payment = $this->Payment_method_model->find($id);

        if (!$payment)
        {
            return $this->error_response('Data tidak ditemukan');
        }

        $data = [
            'name'           => $this->put('name'),
            'account_name'   => $this->put('account_name'),
            'account_number' => $this->put('account_number'),
            'is_active'      => $this->put('is_active')
        ];

        $this->Payment_method_model->update($id, $data);

        return $this->success_response('Metode pembayaran berhasil diupdate');
    }

    public function update_post($id)
    {
        $payment = $this->Payment_method_model->find($id);

        if (!$payment)
        {
            return $this->error_response('Data tidak ditemukan');
        }

        $data = [
            'name'           => $this->post('name'),
            'account_name'   => $this->post('account_name'),
            'account_number' => $this->post('account_number'),
            'is_active'      => $this->post('is_active')
        ];

        if (!empty($_FILES['logo']['name']))
        {
            $upload = upload_image('logo', './uploads/payments/');

            if (!$upload['success'])
            {
                return $this->error_response($upload['message']);
            }

            $this->delete_payment_file($payment->logo);
            $data['logo'] = $upload['file_name'];
        }

        $this->Payment_method_model->update($id, $data);

        return $this->success_response('Metode pembayaran berhasil diupdate');
    }

    public function delete_delete($id)
    {
        $payment = $this->Payment_method_model->find($id);

        if (!$payment)
        {
            return $this->error_response('Data tidak ditemukan');
        }

        $this->delete_payment_file($payment->logo);
        $this->Payment_method_model->delete($id);

        return $this->success_response('Metode pembayaran berhasil dihapus');
    }

    private function delete_payment_file($filename)
    {
        if (empty($filename))
        {
            return;
        }

        $path = './uploads/payments/' . $filename;

        if (file_exists($path))
        {
            unlink($path);
        }
    }
}
