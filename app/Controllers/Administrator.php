<?php

namespace App\Controllers;

use App\Models\Crud;
use CodeIgniter\Controller;
use App\Libraries\Bridges;

class Administrator extends BaseController
{
    protected $crud;
    protected $session;
    protected $request;
    protected $bridges;

    public function __construct()
    {        
        $this->crud = new Crud();
        $this->session = session();
        $this->request = service('request');
        
    }

    /**
     * Dashboard / Index
     */
    public function index()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        
        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Dashboard';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        if ($this->session->get('is_akses') == 1) { // Super admin
            $data['countStudio'] = $this->crud->countFiltered('*', 'studio', ['studio_status' => 1]);
            $data['goodRate'] = $this->crud->countFiltered('*', 'studio', ['studio_status' => 1, 'studio_rating' => 5]);
            $data['getUser'] = $this->crud->countFiltered('*', 'user', ['user_status' => 1]);
        } elseif ($this->session->get('is_akses') == 4) { // Content author
            $data['newsAct'] = $this->crud->countFiltered('*', 'berita', ['berita_status' => 1, 'berita_hot' => 1]);
            $data['eventAct'] = $this->crud->countFiltered('*', 'event', ['event_status' => 1, 'event_hot' => 1]);
        }

        $data['contents'] = 'Back/index';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Account activation management
     */
    public function activation_account($hakAkses)
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Aktivasi Akun';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $where = ['user_status' => 0, 'user_akses' => $hakAkses];
        $data['getData'] = $this->crud->readData('*', 'user', $where, [
            [
                'table' => 'profile',
                'on'    => 'profile.profile_id = user.user_id',
                'type'  => 'INNER'
            ]
        ]);
        

        if ($hakAkses == 2) { $data['nav'] = 'pemilik'; }
        elseif ($hakAkses == 3) { $data['nav'] = 'penyewa'; }
        elseif ($hakAkses == 4) { $data['nav'] = 'author'; }

        $data['contents'] = 'Back/act_account';
        return view('BASE_ADMIN', $data);
    }

    /**
     * News activation
     */
    public function activation_news()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $where = ['berita_status' => 0];
        $joins = [
            ['table' => 'user', 'on' => 'user.user_id = berita.berita_pembuat', 'type' => 'INNER'],
            ['table' => 'kategori_musik', 'on' => 'kategori_musik.katm_id = berita.kategori_id', 'type' => 'INNER']
        ];

        $data['actNews'] = $this->crud->readData('*', 'berita', $where, $joins);
        $data['getData'] = $this->crud->readData('*', 'berita', $where);

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Aktivasi Berita';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/act_news';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Get news data by ID (API)
     */
    public function activation_news_api($id)
    {
        $where = ['berita_id' => $id];
        $joins = [
            ['table' => 'user', 'on' => 'user.user_id = berita.berita_pembuat', 'type' => 'INNER'],
            ['table' => 'kategori_musik', 'on' => 'kategori_musik.katm_id = berita.kategori_id', 'type' => 'INNER']
        ];

        $getNews = $this->crud->readData('*', 'berita', $where, $joins);
        return $this->response->setJSON(array_values($getNews));
    }

    /**
     * Event activation
     */
    public function activation_event()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $where = ['event_status' => 0];
        $joins = [
            ['table' => 'user', 'on' => 'user.user_id = event.event_pembuat', 'type' => 'INNER'],
            ['table' => 'kategori_musik', 'on' => 'kategori_musik.katm_id = event.kategori_id', 'type' => 'INNER']
        ];

        $data['actEvent'] = $this->crud->readData('*', 'event', $where, $joins);
        $data['getData'] = $this->crud->readData('*', 'event', $where);

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Aktivasi Event';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/act_event';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Get event data by ID (API)
     */
    public function activation_event_api($id)
    {
        $where = ['event_id' => $id];
        $joins = [
            ['table' => 'user', 'on' => 'user.user_id = event.event_pembuat', 'type' => 'INNER'],
            ['table' => 'kategori_musik', 'on' => 'kategori_musik.katm_id = event.kategori_id', 'type' => 'INNER']
        ];

        $getEvent = $this->crud->readData('*', 'event', $where, $joins);
        return $this->response->setJSON(array_values($getEvent));
    }

    /**
     * Studio management
     */
    public function studio()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Studio Band';

        $data['getStudio'] = $this->crud->readData('*', 'studio', ['user_id' => $this->session->get('is_id')]);

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/studio';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Schedule management
     */
    public function jadwal()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Studio Band';

        $data['getJadwal'] = $this->crud->readData('*', 'jadwal', ['user_id' => $this->session->get('is_id')]);

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/jadwal';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Booking approval
     */
    public function booking()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Persetujuan Pemesanan';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $where = ['book_status' => 0, 'booking.user_id' => $this->session->get('is_id')];
        $joins = [
            ['table' => 'jadwal', 'on' => 'jadwal.jadwal_id = booking.jadwal_id', 'type' => 'INNER']
        ];

        $data['dataBooking'] = $this->crud->readData('*', 'booking', $where, $joins, '', 'book_tanggal', 'DESC');

        $data['contents'] = 'Back/booking';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Booking history
     */
    public function booking_history()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'History Pemesanan';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $where = ['book_status' => 1, 'booking.user_id' => $this->session->get('is_id')];
        $joins = [
            ['table' => 'jadwal', 'on' => 'jadwal.jadwal_id = booking.jadwal_id', 'type' => 'INNER']
        ];

        $data['dataBooking'] = $this->crud->readData('*', 'booking', $where, $joins, '', 'book_tanggal', 'DESC');

        $data['contents'] = 'Back/booking_history';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Event management
     */
    public function event()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $where = ['event_status' => 1];
        if ($this->session->get('is_akses') == 2) {
            $where['event_pembuat'] = $this->session->get('is_id');
        }

        $joins = [
            ['table' => 'user', 'on' => 'user.user_id = event.event_pembuat', 'type' => 'INNER'],
            ['table' => 'kategori_musik', 'on' => 'kategori_musik.katm_id = event.kategori_id', 'type' => 'INNER']
        ];

        $data['actEvent'] = $this->crud->readData('*', 'event', $where, $joins);
        $data['getData'] = $this->crud->readData('*', 'event', $where);

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data Event';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/event';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Add new event
     */
    public function add_event()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Tambah Event';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['kat_musik'] = $this->crud->readData('*', 'kategori_musik');

        $data['contents'] = 'Back/Insert/add_event';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Edit event
     */
    public function edit_event($id)
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Edit Event';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['event'] = $this->crud->readData('*', 'event', ['event_id' => $id]);

        $data['contents'] = 'Back/Insert/update_event';
        return view('BASE_ADMIN', $data);
    }

    /**
     * News management
     */
    public function news()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $where = ['berita_status' => 1];
        $joins = [
            ['table' => 'user', 'on' => 'user.user_id = berita.berita_pembuat', 'type' => 'INNER'],
            ['table' => 'kategori_musik', 'on' => 'kategori_musik.katm_id = berita.kategori_id', 'type' => 'INNER']
        ];

        $data['actNews'] = $this->crud->readData('*', 'berita', $where, $joins);
        $data['getData'] = $this->crud->readData('*', 'berita', $where);

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data Berita';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/news';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Add new news
     */
    public function add_news()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Tambah Berita';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['kat_musik'] = $this->crud->readData('*', 'kategori_musik');

        $data['contents'] = 'Back/Insert/add_news';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Edit news
     */
    public function edit_news($id)
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Edit Berita';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['news'] = $this->crud->readData('*', 'berita', ['berita_id' => $id]);

        $data['contents'] = 'Back/Insert/update_berita';
        return view('BASE_ADMIN', $data);
    }

    /**
     * User profile
     */
    public function profile($user_id)
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data Profil';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/profile';
        return view('BASE_ADMIN', $data);
    }

    /**
     * About page management
     */
    public function about()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Konfigurasi Tentang';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['tentang'] = $this->crud->readData('*', 'tentang');

        $data['contents'] = 'Back/about';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Get about data (API)
     */
    public function about_api()
    {
        $getTentang = $this->crud->readData('*', 'tentang');
        return $this->response->setJSON(array_values($getTentang));
    }

    /**
     * Edit about
     */
    public function edit_about($id)
    {
        $bridge = new Bridges();
        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Konfigurasi Tentang';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['update_tentang'] = $this->crud->readData('*', 'tentang', ['tentang_id' => $id]);

        $data['contents'] = 'Back/Update/update_about';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Gallery management
     */
    public function gallery()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data Galeri';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['get_galeri'] = $this->crud->readData('*', 'galeri', ['galeri_status' => 1]);
        $data['galeri'] = $data['get_galeri'];

        $data['contents'] = 'Back/gallery';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Advertisement management
     */
    public function advertise()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Manajemen Iklan';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['studio'] = $this->crud->readData('*', 'studio');

        $data['contents'] = 'Back/advertise';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Profile report
     */
    public function report_profile()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data Report';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $where = ['profile_status' => 1];
        $data['profile'] = $this->crud->readData('*', 'profile', $where, [], '', 'profile_created', 'DESC');

        $data['contents'] = 'Back/report_profile';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Studio report
     */
    public function report_studio()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data Report';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $where = ['studio_status' => 1];
        $data['studio'] = $this->crud->readData('*', 'studio', $where, [], '', 'studio_created', 'DESC');

        $data['contents'] = 'Back/report_studio';
        return view('BASE_ADMIN', $data);
    }

    /**
     * News report
     */
    public function report_berita()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data Report';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $where = ['berita_status' => 1];
        $data['berita'] = $this->crud->readData('*', 'berita', $where, [], '', 'berita_created', 'DESC');

        $data['contents'] = 'Back/report_berita';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Event report
     */
    public function report_event()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data Report';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $where = ['event_status' => 1];
        $data['event'] = $this->crud->readData('*', 'event', $where, [], '', 'event_created', 'DESC');

        $data['contents'] = 'Back/report_event';
        return view('BASE_ADMIN', $data);
    }

    /**
     * User management
     */
    public function user()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data User';

        $where = ['user_status' => 1];
        $data['user'] = $this->crud->readData('*', 'user', $where, [], '', 'user_created', 'DESC');
        $data['getData'] = $data['user'];

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/user';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Music category management
     */
    public function category()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Kategori Musik';

        $data['category'] = $this->crud->readData('*', 'kategori_musik');
        $data['getData'] = $data['category'];

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/music_category';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Chart/Statistics by category
     */
    public function chart($catChart = '')
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        if ($catChart === 'rating') {

            $data['navigation'] = 'Data Rating';

            // Count by rating
            $data['terbaik'] = $this->crud->countFiltered('*', 'studio', ['studio_rating' => 5]);
            $data['baik']    = $this->crud->countFiltered('*', 'studio', ['studio_rating' => 4]);
            $data['cukup']   = $this->crud->countFiltered('*', 'studio', ['studio_rating' => 3]);
            $data['buruk']   = 
                $this->crud->countFiltered('*', 'studio', ['studio_rating' => 1]) +
                $this->crud->countFiltered('*', 'studio', ['studio_rating' => 2]);

            // Last 10 data each category
            $data['data_terbaik'] = $this->crud->readData(
                '*', 'studio',
                ['studio_rating' => 5],
                [],
                '', 'studio_created', 'DESC',
                ['limit' => 10]
            );

            $data['data_baik'] = $this->crud->readData(
                '*', 'studio',
                ['studio_rating' => 4],
                [],
                '', 'studio_created', 'DESC',
                ['limit' => 10]
            );

            $data['data_cukup'] = $this->crud->readData(
                '*', 'studio',
                ['studio_rating' => 3],
                [],
                '', 'studio_created', 'DESC',
                ['limit' => 10]
            );

            // Rating 1 atau 2
            $data['data_buruk'] = $this->crud->readData(
                '*', 'studio',
                ['studio_rating IN' => [1, 2]],  // Correct format for CI4 whereIn
                [],
                '', 'studio_created', 'DESC',
                ['limit' => 10]
            );

        }
        elseif ($catChart === 'area') {

            $data['navigation'] = 'Data Area Studio';

            // Count area
            $data['beji']      = $this->crud->countFiltered('*', 'studio', ['studio_area' => 'beji']);
            $data['cilodong']  = $this->crud->countFiltered('*', 'studio', ['studio_area' => 'cilodong']);
            $data['cimanggis'] = $this->crud->countFiltered('*', 'studio', ['studio_area' => 'cimanggis']);
            $data['cinere']    = $this->crud->countFiltered('*', 'studio', ['studio_area' => 'cinere']);

            // Get last 10 each area
            $data['data_beji'] = $this->crud->readData(
                '*', 'studio',
                ['studio_area' => 'beji'],
                [],
                '', 'studio_created', 'DESC',
                ['limit' => 10]
            );

            $data['data_cilodong'] = $this->crud->readData(
                '*', 'studio',
                ['studio_area' => 'cilodong'],
                [],
                '', 'studio_created', 'DESC',
                ['limit' => 10]
            );

            $data['data_cimanggis'] = $this->crud->readData(
                '*', 'studio',
                ['studio_area' => 'cimanggis'],
                [],
                '', 'studio_created', 'DESC',
                ['limit' => 10]
            );

            $data['data_cinere'] = $this->crud->readData(
                '*', 'studio',
                ['studio_area' => 'cinere'],
                [],
                '', 'studio_created', 'DESC',
                ['limit' => 10]
            );
        }
        $data['contents'] = 'Back/chart';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Complaints/Pengaduan management
     */
    public function pengaduan()
    {
        $bridge = new Bridges();
        $data['navigation'] = 'Data Pengaduan';
        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['pengaduan'] = $this->crud->readData('*', 'keluhan');

        $data['contents'] = 'Back/pengaduan';
        return view('BASE_ADMIN', $data);
    }

    /**
     * Get complaint data by ID (API)
     */
    public function pengaduan_api($id)
    {
        $complaint = $this->crud->readData('*', 'keluhan', ['keluhan_id' => $id]);
        return $this->response->setJSON(array_values($complaint));
    }

    /**
     * User booking management
     */
    public function user_booking()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Data User Booking';

        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();

        $data['contents'] = 'Back/user_booking';
        return view('BASE_ADMIN', $data);
    }
}
