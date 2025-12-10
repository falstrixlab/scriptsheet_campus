<?php

namespace App\Controllers;

use App\Models\Crud;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Site extends BaseController
{
    protected $crud;
    protected $session;
    protected $request;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        $this->crud = new Crud();
        $this->session = session();
        $this->request = service('request');
    }

    /**
     * Homepage
     */
    public function index()
    {
        // Get active news (latest)
        $data['getBerita'] = $this->crud->readData('*', 'berita', 
            ['berita_status' => 1], [], '', '', '', ['limit' => 5]);

        // Get hot news
        $data['getBeritaHot'] = $this->crud->readData('*', 'berita',
            ['berita_status' => 1, 'berita_hot' => 1], [], '', '', '', ['limit' => 5]);

        // Get latest events
        $data['getEventNew'] = $this->crud->readData('*', 'event',
            ['event_status' => 1], [], '', 'event_created', 'DESC', ['limit' => 5]);

        // Get highly rated studios (5 stars)
        $data['studioGood'] = $this->crud->readData('*', 'studio',
            ['studio_rating' => 5], [], '', 'studio_created', 'DESC', ['limit' => 5]);

        // Get latest studios
        $data['studioNew'] = $this->crud->readData('*', 'studio',
            [], [], '', 'studio_created', 'DESC', ['limit' => 5]);

        // Get recommended studios
        $data['studioRek'] = $this->crud->readData('*', 'studio',
            ['studio_rekomendasi' => 1], [], '', 'studio_created', 'DESC', ['limit' => 5]);

        // Get gallery
        $data['galeri'] = $this->crud->readData('*', 'galeri',
            ['galeri_status' => 1], [], '', '', '', ['limit' => 12]);

        // Get hot events
        $data['getEventHot'] = $this->crud->readData('*', 'event',
            ['event_status' => 1, 'event_hot' => 1], [], '', '', '', ['limit' => 5]);

        $data['contents'] = "Front/Site/index";
        return view('BASE_WEBSITE', $data);
    }

    /**
     * Content channel pages
     */
    public function kanal($fileParameter)
    {
        if ($fileParameter == "beranda") {
            // Get gallery
            $data['galeri'] = $this->crud->readData('*', 'galeri',
                ['galeri_status' => 1], [], '', '', '', ['limit' => 12]);

            // Get latest studios
            $data['studioNew'] = $this->crud->readData('*', 'studio',
                [], [], '', 'studio_created', 'DESC', ['limit' => 5]);

            // Get recommended studios
            $data['studioRek'] = $this->crud->readData('*', 'studio',
                ['studio_rekomendasi' => 1], [], '', 'studio_created', 'DESC', ['limit' => 5]);

            // Get active news
            $getBerita = $this->crud->readData('*', 'berita', ['berita_status' => 1], [], '', '', '', ['limit' => 5]);
            if (!empty($getBerita)) {
                $data['getBerita'] = $getBerita;
            } else {
                $data['noContent'] = 'No Content !!';
            }

            // Get hot news
            $getBeritaHot = $this->crud->readData('*', 'berita',
                ['berita_status' => 1, 'berita_hot' => 1], [], '', '', '', ['limit' => 5]);
            if (!empty($getBeritaHot)) {
                $data['getBeritaHot'] = $getBeritaHot;
            } else {
                $data['noContent'] = 'No Content !!';
            }

            // Get latest events
            $data['getEventNew'] = $this->crud->readData('*', 'event',
                ['event_status' => 1], [], '', 'event_created', 'DESC', ['limit' => 5]);

            // Get hot events
            $getEventHot = $this->crud->readData('*', 'event',
                ['event_status' => 1, 'event_hot' => 1], [], '', '', '', ['limit' => 5]);
            if (!empty($getEventHot)) {
                $data['getEventHot'] = $getEventHot;
            } else {
                $data['noContent'] = 'No Content !!';
            }

            // Get highly rated studios
            $data['studioGood'] = $this->crud->readData('*', 'studio',
                ['studio_rating' => 5], [], '', 'studio_created', 'DESC', ['limit' => 5]);

            $data['contents'] = "Front/Site/index";

        } elseif ($fileParameter == "galeri") {
            $data['getGaleri'] = $this->crud->readData('*', 'galeri',
                ['galeri_status' => 1], [], '', 'galeri_id', 'DESC', ['limit' => 12]);

            $data['contents'] = "Front/Site/galeri";

        } elseif ($fileParameter == "tentang") {
            $data['getTentang'] = $this->crud->readData('*', 'tentang');

            $data['contents'] = "Front/Site/about";

        } elseif ($fileParameter == "event") {
            // Get all active events
            $getEvent = $this->crud->readData('*', 'event', ['event_status' => 1]);
            if (!empty($getEvent)) {
                $data['getEvent'] = $getEvent;
            } else {
                $data['noContent'] = 'No Content !!';
            }

            // Get hot events
            $getEventHot = $this->crud->readData('*', 'event',
                ['event_status' => 1, 'event_hot' => 1]);
            if (!empty($getEventHot)) {
                $data['getEventHot'] = $getEventHot;
            } else {
                $data['noContent'] = 'No Content !!';
            }

            $data['contents'] = "Front/Site/event";

        } elseif ($fileParameter == "studio") {
            // Get all active studios
            $getStudio = $this->crud->readData('*', 'studio', ['studio_status' => 1]);
            if (!empty($getStudio)) {
                $data['getStudio'] = $getStudio;
            } else {
                $data['noContent'] = 'No Content !!';
            }

            // Get highly rated studios
            $getStudioRat = $this->crud->readData('*', 'studio',
                ['studio_status' => 1, 'studio_rating' => 5]);
            if (!empty($getStudioRat)) {
                $data['getStudioRat'] = $getStudioRat;
            } else {
                $data['noContent'] = 'No Content !!';
            }

            $data['contents'] = "Front/Site/studio";

        } elseif ($fileParameter == 'keluhan') {
            if ($this->request->getPost('kirim_keluhan')) {
                try {
                    $keluhanData = [
                        'keluhan_email' => $this->request->getPost('email'),
                        'keluhan_nama'  => $this->request->getPost('nama'),
                        'keluhan_isi'   => $this->request->getPost('isi')
                    ];

                    $this->crud->createData('keluhan', $keluhanData);

                    $this->session->setFlashdata('sukses_insert',
                        '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di Kirim.</div>'
                    );
                    return redirect()->to('site/kanal/keluhan');

                } catch (\Exception $e) {
                    $this->session->setFlashdata('gagal_insert',
                        '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal di Kirim.</div>'
                    );
                    return redirect()->to('site/kanal/keluhan');
                }
            }

            $data['contents'] = "Front/Site/keluhan";
        }

        return view('BASE_WEBSITE', $data);
    }

    /**
     * Detail page for events and news
     */
    public function detail($id, $parameter)
    {
        if ($parameter == "event") {
            $data['detail'] = $this->crud->readData('*', 'event',
                ['event_id' => $id], [], '', '', '', ['limit' => 1]);

        } elseif ($parameter == "berita") {
            $data['detail'] = $this->crud->readData('*', 'berita',
                ['berita_id' => $id], [], '', '', '', ['limit' => 1]);
        }

        $data['parameter'] = $parameter;
        $data['contents'] = "Front/Site/konten_detail";
        return view('BASE_WEBSITE', $data);
    }

    /**
     * Studio detail page with schedule and creator events
     */
    public function studio_detail($id)
    {
        // Get studio details
        $studioData = $this->crud->readData('*', 'studio',
            ['studio_id' => $id, 'studio_status' => 1], [], '', '', '', ['limit' => 1]);

        if (empty($studioData)) {
            return redirect()->to('site/kanal/studio');
        }

        $data['getStudioDetail'] = $studioData;

        // Get studio owner's user_id
        $studioOwner = $studioData[0]['user_id'];

        // Get events created by studio owner
        $data['d'] = $this->crud->readData('*', 'event',
            ['event_status' => 1, 'event_pembuat' => $studioOwner]);

        // Get schedules for this studio
        $data['getJadwal'] = $this->crud->readData('*', 'jadwal',
            ['user_id' => $studioOwner]);

        $data['contents'] = "Front/Site/studio_detail";
        return view('BASE_WEBSITE', $data);
    }
}
