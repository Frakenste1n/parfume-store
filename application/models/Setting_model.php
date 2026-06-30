<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model
{
    private $table = 'settings';

    public function get_setting()
    {
        return $this->db
            ->limit(1)
            ->get($this->table)
            ->row();
    }

    public function update_setting($data)
    {
        $setting = $this->get_setting();

        if (!$setting)
        {
            return $this->db->insert($this->table, $data);
        }

        return $this->db
            ->where('id', $setting->id)
            ->update($this->table, $data);
    }

    public function parse_founders($setting)
    {
        $empty = [
            ['name' => '', 'photo' => ''],
            ['name' => '', 'photo' => ''],
            ['name' => '', 'photo' => ''],
            ['name' => '', 'photo' => ''],
            ['name' => '', 'photo' => '']
        ];

        if (!$setting)
        {
            return $empty;
        }

        if (!empty($setting->founder_name))
        {
            $decoded = json_decode($setting->founder_name, true);

            if (is_array($decoded))
            {
                foreach ($decoded as $i => $item)
                {
                    if ($i >= 5)
                    {
                        break;
                    }

                    $empty[$i] = [
                        'name'  => isset($item['name']) ? $item['name'] : '',
                        'photo' => isset($item['photo']) ? $item['photo'] : ''
                    ];
                }

                return $empty;
            }
        }

        if (!empty($setting->founder_name) || !empty($setting->founder_photo))
        {
            $empty[0] = [
                'name'  => $setting->founder_name ?? '',
                'photo' => $setting->founder_photo ?? ''
            ];
        }

        return $empty;
    }

    public function format_setting_response($setting)
    {
        if (!$setting)
        {
            return (object) [
                'founders' => $this->parse_founders(null)
            ];
        }

        $setting->founders = $this->parse_founders($setting);

        return $setting;
    }
}
