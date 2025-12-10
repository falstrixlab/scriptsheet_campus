<?php

namespace App\Libraries;

use App\Models\Crud;
use Config\Database;

class Bridges
{
    protected $crud;
    protected $db;

    public function __construct()
    {
        // Load Model
        $this->crud = new Crud();

        // Load DB
        $this->db = Database::connect();
    }

    public function data_aktivasi($akses = '')
    {
        $where = [
            ['user_status' => 0],
            ['user_akses'  => $akses],
        ];

        return $this->crud->countFiltered('*', 'user', $where, [], [], []);
    }

    public function aktivasi_berita()
    {
        $where = [
            ['berita_status' => 0]
        ];

        return $this->crud->countFiltered('*', 'berita', $where, [], [], []);
    }

    public function aktivasi_event()
    {
        $where = [
            ['event_status' => 0]
        ];

        return $this->crud->countFiltered('*', 'event', $where, [], [], []);
    }

    public function count_users($status)
    {
        $where = [];

        if ($status === 'active') {
            $where[] = ['user_status' => 1];
        } elseif ($status === 'no_active') {
            $where[] = ['user_status' => 0];
        }

        // Tambahkan orderBy dengan cara CI4
        $where[] = function ($builder) {
            $builder->orderBy('user_id', 'DESC');
        };

        return $this->crud->countFiltered('*', 'user', $where, [], [], []);
    }

    public function count_studio($rating)
    {
        $where = [
            ['studio_rating' => $rating],
            ['studio_status' => 1]
        ];

        return $this->crud->countFiltered('*', 'studio', $where, [], [], []);
    }

    public function count_studio_wilayah($wilayah)
    {
        $where = [
            ['studio_area' => $wilayah],
            ['studio_status' => 1]
        ];

        return $this->crud->countFiltered('*', 'studio', $where, [], [], []);
    }

    public function count_keluhan()
    {
        return $this->crud->countFiltered('*', 'keluhan', [], [], [], []);
    }

    public function count_galeri()
    {
        $where = [
            ['galeri_status' => 1]
        ];

        return $this->crud->countFiltered('*', 'galeri', $where, [], [], []);
    }
}
