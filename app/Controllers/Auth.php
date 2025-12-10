<?php

namespace App\Controllers;

use App\Models\Crud;
use CodeIgniter\Files\File;

class Auth extends BaseController
{
    protected $crud;
    protected $session;
    protected $request;
    protected $ktpPath;
    protected $buktiPath;

    public function __construct()
    {        
        $this->crud = new Crud();
        $this->session = session();
        $this->request = service('request');
        
        // Set file upload paths
        $this->ktpPath = WRITEPATH . 'uploads/ktp';
        $this->buktiPath = WRITEPATH . 'uploads/bukti';
        
        // Create directories if they don't exist
        if (!is_dir($this->ktpPath)) {
            mkdir($this->ktpPath, 0755, true);
        }
        if (!is_dir($this->buktiPath)) {
            mkdir($this->buktiPath, 0755, true);
        }
    }

    /**
     * Login page
     */
    public function index()
    {
        return view('SITE_LOGIN');
    }

    /**
     * Registration page
     */
    public function registrasi()
    {
        return view('SITE_REGISTRASI');
    }

    /**
     * Waiting list page
     */
    public function waiting_list()
    {
        // Get users waiting for activation
        $where = ['user_status' => 0];
        $data['userWait'] = $this->crud->readData('*', 'user', $where);

        // Get recently activated users (studio owner or author from last week)
        $db = \Config\Database::connect();
        $where = [
            'user_status' => 1,
            'user_created >' => strtotime("-1 week")
        ];
        
        // Build query with OR condition
        $builder = $db->table('user')->where($where);
        $builder->where("user_akses IN (2, 4)", null, false);
        $data['userDone'] = $builder->get()->getResultArray();

        return view('SITE_WAITING_LIST', $data);
    }

    /**
     * Process login
     */
    public function login()
    {
        if ($this->request->getPost('login')) {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            // Check credentials
            $where = [
                'user_name'   => $username,
                'user_pwd'    => md5($password),
                'user_status' => 1
            ];
            
            $user = $this->crud->readData('*', 'user', $where);
            
            if (!empty($user)) {
                // Login successful
                $userData = $user[0];
                
                $this->session->set([
                    'is_login' => true,
                    'is_akses' => $userData['user_akses'],
                    'is_nama'  => $userData['user_fullname'],
                    'is_id'    => $userData['user_id']
                ]);
                
                return redirect()->to('administrator');
            } else {
                // Login failed
                $this->session->setFlashdata('gagal_login', 
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Username & Password Tidak Valid</div>'
                );
                return redirect()->to('auth/index');
            }
        }
    }

    /**
     * Process logout
     */
    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('auth/index');
    }

    /**
     * Booking page
     */
    public function booking($jadwalId = null, $confirmation = null)
    {
        // Get schedule details with related data
        $where = ['jadwal_id' => $jadwalId];
        $joins = [
            ['table' => 'user', 'on' => 'user.user_id = jadwal.user_id', 'type' => 'INNER'],
            ['table' => 'studio', 'on' => 'studio.user_id = jadwal.user_id', 'type' => 'INNER']
        ];
        
        $data['getJdl'] = $this->crud->readData('*', 'jadwal', $where, $joins);

        // Handle booking submission
        if ($this->request->getPost('booking')) {
            return $this->processBooking($data);
        }

        // Show confirmation or booking form
        if ($confirmation == 'confirmation') {
            $where = ['book_id' => $jadwalId];
            $data['dataBooking'] = $this->crud->readData('*', 'booking', $where);
            return view('SITE_CONFIRMATION', $data);
        } else {
            return view('SITE_BOOKING', $data);
        }
    }

    /**
     * Process booking request
     */
    private function processBooking(&$data)
    {
        try {
            // Update jadwal status
            $jadwalId = $this->request->getPost('jadwal_id');
            $this->crud->updateData('jadwal', ['jadwal_status' => 1], ['jadwal_id' => $jadwalId]);

            // Handle file upload
            $file = $this->request->getFile('image');
            
            if (!$file->isValid()) {
                throw new \Exception('File upload failed');
            }

            $fileName = $file->getRandomName();
            $file->move($this->ktpPath, $fileName);

            // Get next booking number
            $lastBooking = $this->crud->readData('book_id', 'booking', [], [], '', 'book_id', 'DESC', ['limit' => 1]);
            $bookNumber = (!empty($lastBooking) && isset($lastBooking[0]['book_id'])) 
                ? $lastBooking[0]['book_id'] + 1 
                : 1;

            // Prepare booking data
            $bookingData = [
                'book_nama_depan'    => $this->request->getPost('book_nama_depan'),
                'book_nama_belakang' => $this->request->getPost('book_nama_belakang'),
                'book_alamat'        => $this->request->getPost('book_alamat'),
                'book_ktp'           => $fileName,
                'book_telepon'       => $this->request->getPost('book_telepon'),
                'book_harga'         => $this->request->getPost('book_harga'),
                'jadwal_id'          => $jadwalId,
                'user_id'            => $this->request->getPost('user_id'),
                'book_nomor'         => 'ALTO' . date('Y') . $bookNumber,
                'book_status'        => 0,
                'book_tanggal'       => date('Y-m-d')
            ];

            // Create booking
            $this->crud->createData('booking', $bookingData);

            // Get created booking
            $where = ['book_nomor' => 'ALTO' . date('Y') . $bookNumber];
            $bookings = $this->crud->readData('*', 'booking', $where, [], '', '', '', ['limit' => 1]);

            if (!empty($bookings)) {
                $booking = $bookings[0];
                $this->session->setFlashdata('sukses_booking',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Anda Sudah Berhasil Melakukan Pemesanan, Silahkan Cek Invoice <a href="' . site_url('auth/invoice/' . $booking['book_id']) . '">Disini !</a></div>'
                );
            }

            return redirect()->to('auth/booking/' . $jadwalId);

        } catch (\Exception $e) {
            $this->session->setFlashdata('gagal_booking',
                '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a>Anda Gagal Melakukan Pemesanan: ' . $e->getMessage() . '</div>'
            );
            return redirect()->to('auth/booking/' . $this->request->getPost('jadwal_id'));
        }
    }

    /**
     * Invoice page
     */
    public function invoice($bookingId)
    {
        $where = [
            'book_id'     => $bookingId,
            'book_status' => 0
        ];
        
        $joins = [
            ['table' => 'user', 'on' => 'user.user_id = booking.user_id', 'type' => 'INNER'],
            ['table' => 'studio', 'on' => 'studio.user_id = booking.user_id', 'type' => 'INNER'],
            ['table' => 'jadwal', 'on' => 'jadwal.jadwal_id = booking.jadwal_id', 'type' => 'INNER']
        ];
        
        $data['getBook'] = $this->crud->readData('*', 'booking', $where, $joins);

        return view('SITE_INVOICE', $data);
    }

    /**
     * Process payment confirmation
     */
    public function proses_konfirmasi()
    {
        if ($this->request->getPost('konfirmasi_invoice')) {
            try {
                // Handle file upload for payment proof
                $file = $this->request->getFile('image');
                
                if (!$file->isValid()) {
                    throw new \Exception('File upload failed');
                }

                $fileName = $file->getRandomName();
                $file->move($this->buktiPath, $fileName);

                $jadwalId = $this->request->getPost('jadwal_id');

                // Update jadwal status
                $this->crud->updateData('jadwal', 
                    ['jadwal_status' => 3], 
                    ['jadwal_id' => $jadwalId]
                );

                // Update booking with payment proof
                $this->crud->updateData('booking',
                    [
                        'book_bukti_pembayaran' => $fileName,
                        'book_status'          => 2
                    ],
                    ['jadwal_id' => $jadwalId]
                );

                $this->session->setFlashdata('sukses_konfirmasi',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Anda Sudah Berhasil Melakukan Konfirmasi, <a href="' . site_url('site') . '">Kembali ke Halaman Utama</a></div>'
                );
                
                return redirect()->to('auth/booking/' . $jadwalId . '/confirmation');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_konfirmasi',
                    '<div class="alert alert-danger"><a class="close" data-dismiss="alert">×</a>Anda Gagal Melakukan Konfirmasi: ' . $e->getMessage() . '</div>'
                );
                return redirect()->to('auth/booking/' . $this->request->getPost('jadwal_id') . '/confirmation');
            }
        }
    }
}
