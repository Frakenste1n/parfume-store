<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';

class Founders extends Base_api {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Founder_model');
        $this->load->library('form_validation');
    }

    public function index_get()
    {
        $active_only = $this->get('active_only') === 'true';

        $founders = $this->Founder_model->get_all($active_only);

        return $this->success_response('Data founder berhasil diambil', $founders);
    }

    public function detail_get($id)
    {
        $founder = $this->Founder_model->find($id);

        if (!$founder)
        {
            return $this->error_response('Founder tidak ditemukan', 404);
        }

        return $this->success_response('Data founder berhasil diambil', $founder);
    }

    public function store_post()
    {
        $this->form_validation->set_rules('name', 'Nama', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('position', 'Jabatan', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim|max_length[30]');
        $this->form_validation->set_rules('instagram', 'Instagram', 'trim|max_length[100]');

        if ($this->form_validation->run() == FALSE)
        {
            return $this->error_response('Validasi gagal', $this->form_validation->error_array(), 422);
        }

        $data = [
            'name' => $this->post('name'),
            'position' => $this->post('position'),
            'whatsapp' => $this->post('whatsapp'),
            'instagram' => $this->post('instagram'),
            'is_active' => $this->post('is_active') ? TRUE : FALSE
        ];

        // Handle photo upload
        if (!empty($_FILES['photo']['name']))
        {
            $upload = upload_image('photo', './uploads/founders/');

            if (!$upload['success'])
            {
                return $this->error_response('Gagal mengupload foto: ' . $upload['message'], 400);
            }

            $data['photo'] = $upload['file_name'];
        }

        $founder_id = $this->Founder_model->create($data);

        if (!$founder_id)
        {
            return $this->error_response('Gagal menambahkan founder');
        }

        $founder = $this->Founder_model->find($founder_id);

        return $this->success_response('Founder berhasil ditambahkan', $founder);
    }

    public function update_put($id)
    {
        return $this->do_update($id, $this->put());
    }

    public function update_post($id)
    {
        return $this->do_update($id, $this->post());
    }

    private function do_update($id, $input)
    {
        $founder = $this->Founder_model->find($id);

        if (!$founder)
        {
            return $this->error_response('Founder tidak ditemukan', 404);
        }

        $this->form_validation->set_data($input);
        $this->form_validation->set_rules('name', 'Nama', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('position', 'Jabatan', 'required|trim|max_length[100]');
        $this->form_validation->set_rules('whatsapp', 'WhatsApp', 'trim|max_length[30]');
        $this->form_validation->set_rules('instagram', 'Instagram', 'trim|max_length[100]');

        if ($this->form_validation->run() == FALSE)
        {
            return $this->error_response('Validasi gagal', $this->form_validation->error_array(), 422);
        }

        $is_active = isset($input['is_active'])
            ? ($input['is_active'] === 'true' || $input['is_active'] === TRUE || $input['is_active'] === '1' || $input['is_active'] === 'on')
            : FALSE;

        $data = [
            'name' => $input['name'] ?? null,
            'position' => $input['position'] ?? null,
            'whatsapp' => $input['whatsapp'] ?? null,
            'instagram' => $input['instagram'] ?? null,
            'is_active' => $is_active
        ];

        if (!empty($_FILES['photo']['name']))
        {
            $upload = upload_image('photo', './uploads/founders/');

            if (!$upload['success'])
            {
                return $this->error_response('Gagal mengupload foto: ' . $upload['message'], 400);
            }

            if ($founder->photo)
            {
                @unlink('./uploads/founders/' . $founder->photo);
            }

            $data['photo'] = $upload['file_name'];
        }

        $updated = $this->Founder_model->update($id, $data);

        if (!$updated)
        {
            return $this->error_response('Gagal mengupdate founder');
        }

        $founder = $this->Founder_model->find($id);

        return $this->success_response('Founder berhasil diupdate', $founder);
    }

    public function delete_delete($id)
    {
        $founder = $this->Founder_model->find($id);

        if (!$founder)
        {
            return $this->error_response('Founder tidak ditemukan', 404);
        }

        // Delete photo if exists
        if ($founder->photo)
        {
            @unlink('./uploads/founders/' . $founder->photo);
        }

        $deleted = $this->Founder_model->delete($id);

        if (!$deleted)
        {
            return $this->error_response('Gagal menghapus founder');
        }

        return $this->success_response('Founder berhasil dihapus');
    }

    public function toggle_put($id)
    {
        $founder = $this->Founder_model->find($id);

        if (!$founder)
        {
            return $this->error_response('Founder tidak ditemukan', 404);
        }

        $new_status = !$founder->is_active;
        $updated = $this->Founder_model->toggle_active($id, $new_status);

        if (!$updated)
        {
            return $this->error_response('Gagal mengupdate status founder');
        }

        $founder = $this->Founder_model->find($id);

        return $this->success_response('Status founder berhasil diupdate', $founder);
    }
}
