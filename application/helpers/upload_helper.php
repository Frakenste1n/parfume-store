<?php

function upload_image($field_name, $path = './uploads/')
{
    $CI =& get_instance();

    if (!is_dir($path)) {
        mkdir($path, 0777, true);
    }

    $config['upload_path'] = $path;
    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['encrypt_name'] = TRUE;
    $config['max_size'] = 4096;

    $CI->load->library('upload', $config);

    if (!$CI->upload->do_upload($field_name)) {
        return [
            'success' => false,
            'message' => strip_tags($CI->upload->display_errors())
        ];
    }

    return [
        'success' => true,
        'file_name' => $CI->upload->data('file_name')
    ];
}