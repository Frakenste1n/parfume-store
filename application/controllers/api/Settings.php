<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'core/Base_api.php';

class Settings extends Base_api
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Setting_model');
    }

    public function index_get()
    {
        return $this->success_response(
            'Data setting berhasil diambil',
            $this->Setting_model->format_setting_response(
                $this->Setting_model->get_setting()
            )
        );
    }

    public function update_put()
    {
        $data = $this->collect_update_data();

        if (empty($data))
        {
            return $this->error_response('Data setting tidak valid');
        }

        $this->Setting_model->update_setting($data);

        return $this->success_response(
            'Setting berhasil diupdate',
            $this->Setting_model->format_setting_response(
                $this->Setting_model->get_setting()
            )
        );
    }

    public function update_post()
    {
        $data = $this->collect_update_data();

        if (empty($data))
        {
            return $this->error_response('Data setting tidak valid');
        }

        $this->Setting_model->update_setting($data);

        return $this->success_response(
            'Setting berhasil diupdate',
            $this->Setting_model->format_setting_response(
                $this->Setting_model->get_setting()
            )
        );
    }

    private function collect_update_data()
    {
        $data = $this->collect_text_fields();
        $upload_fields = [
            'logo'    => './uploads/settings/',
            'favicon' => './uploads/settings/'
        ];

        foreach ($upload_fields as $field => $path)
        {
            if (empty($_FILES[$field]['name']))
            {
                continue;
            }

            $upload = upload_image($field, $path);

            if (!$upload['success'])
            {
                return $this->error_response($upload['message']);
            }

            $data[$field] = $upload['file_name'];
        }

        return $data;
    }

    private function collect_text_fields()
    {
        $fields = [
            'site_name',
            'about_us',
            'whatsapp',
            'instagram',
            'email',
            'google_maps_embed',
            'featured_title',
            'featured_subtitle'
        ];

        $data = [];

        foreach ($fields as $field)
        {
            $value = $this->input->post($field);

            if ($value === null)
            {
                $value = $this->put($field);
            }

            if ($value !== null && $value !== false)
            {
                $data[$field] = $value;
            }
        }

        return $data;
    }
}
