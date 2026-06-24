<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';

class Banners extends Base_api
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Banner_model');
    }

    public function index_get()
    {
        return $this->success_response(
            'Data banner berhasil diambil',
            $this->Banner_model->get_all()
        );
    }

    public function show_get($id)
    {
        $banner = $this->Banner_model->find($id);

        if (!$banner)
        {
            return $this->error_response('Data tidak ditemukan');
        }

        return $this->success_response('Detail banner', $banner);
    }

    public function store_post()
    {
        $upload = upload_image('image', './uploads/banners/');

        if (!$upload['success'])
        {
            return $this->error_response($upload['message']);
        }

        $data = [
            'title'       => $this->post('title'),
            'subtitle'    => $this->post('subtitle'),
            'image'       => $upload['file_name'],
            'button_text' => $this->post('button_text'),
            'button_link' => $this->post('button_link'),
            'sort_order'  => $this->post('sort_order') ?: 0,
            'is_active'   => $this->post('is_active') ?: 1
        ];

        $this->Banner_model->create($data);

        return $this->success_response('Banner berhasil ditambahkan');
    }

    public function update_put($id)
    {
        $banner = $this->Banner_model->find($id);

        if (!$banner)
        {
            return $this->error_response('Data tidak ditemukan');
        }

        $data = [
            'title'       => $this->put('title'),
            'subtitle'    => $this->put('subtitle'),
            'button_text' => $this->put('button_text'),
            'button_link' => $this->put('button_link'),
            'sort_order'  => $this->put('sort_order'),
            'is_active'   => $this->put('is_active')
        ];

        $this->Banner_model->update($id, $data);

        return $this->success_response('Banner berhasil diupdate');
    }

    public function update_post($id)
    {
        $banner = $this->Banner_model->find($id);

        if (!$banner)
        {
            return $this->error_response('Data tidak ditemukan');
        }

        $data = [
            'title'       => $this->post('title'),
            'subtitle'    => $this->post('subtitle'),
            'button_text' => $this->post('button_text'),
            'button_link' => $this->post('button_link'),
            'sort_order'  => $this->post('sort_order'),
            'is_active'   => $this->post('is_active')
        ];

        if (!empty($_FILES['image']['name']))
        {
            $upload = upload_image('image', './uploads/banners/');

            if (!$upload['success'])
            {
                return $this->error_response($upload['message']);
            }

            $this->delete_banner_file($banner->image);
            $data['image'] = $upload['file_name'];
        }

        $this->Banner_model->update($id, $data);

        return $this->success_response('Banner berhasil diupdate');
    }

    public function delete_delete($id)
    {
        $banner = $this->Banner_model->find($id);

        if (!$banner)
        {
            return $this->error_response('Data tidak ditemukan');
        }

        $this->delete_banner_file($banner->image);
        $this->Banner_model->delete($id);

        return $this->success_response('Banner berhasil dihapus');
    }

    private function delete_banner_file($filename)
    {
        if (empty($filename))
        {
            return;
        }

        $path = './uploads/banners/' . $filename;

        if (file_exists($path))
        {
            unlink($path);
        }
    }
}
