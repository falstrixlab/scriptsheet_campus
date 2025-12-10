<?php

namespace App\Controllers;

use App\Models\Crud;

class Configs extends BaseController
{
    protected $crud;
    protected $session;
    protected $request;
    protected $filePath;
    protected $galeriPath;
    protected $gambarPath;
    protected $eventPath;
    protected $beritaPath;
    protected $logoPath;
    protected $buktiPath;

    public function __construct()
    {        
        $this->crud = new Crud();
        $this->session = session();
        $this->request = service('request');
        
        // Set file upload paths
        $this->filePath = WRITEPATH . 'uploads/user';
        $this->galeriPath = WRITEPATH . 'uploads/galeri';
        $this->gambarPath = WRITEPATH . 'uploads/gambar';
        $this->eventPath = WRITEPATH . 'uploads/event';
        $this->beritaPath = WRITEPATH . 'uploads/berita';
        $this->logoPath = WRITEPATH . 'uploads/logo';
        $this->buktiPath = WRITEPATH . 'uploads/bukti';
        
        // Create directories if they don't exist
        $dirs = [$this->filePath, $this->galeriPath, $this->gambarPath, $this->eventPath, $this->beritaPath, $this->logoPath, $this->buktiPath];
        foreach ($dirs as $dir) {
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }
        }
    }

    /**
     * Process user registration
     */
    public function proses_registrasi()
    {
        if ($this->request->getPost('registrasi')) {
            try {
                $file = $this->request->getFile('image');
                
                if (!$file->isValid()) {
                    $this->session->setFlashdata('gagal_register', 
                        '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>File upload gagal</div>'
                    );
                    return redirect()->to('auth/registrasi');
                }

                $fileName = $file->getRandomName();
                $file->move($this->filePath, $fileName);

                $username = $this->request->getPost('username');
                $password = md5($this->request->getPost('password'));

                $profileData = [
                    'profile_firstname'  => $this->request->getPost('firstname'),
                    'profile_lastname'   => $this->request->getPost('lastname'),
                    'profile_alamat'     => $this->request->getPost('alamat'),
                    'profile_email'      => $this->request->getPost('email'),
                    'profile_hp'         => $this->request->getPost('hp'),
                    'profile_foto'       => $fileName,
                    'profile_ktp'        => $this->request->getPost('ktp'),
                    'profile_tempat'     => $this->request->getPost('tempat_lahir'),
                    'profile_tanggal'    => $this->request->getPost('tgl_lahir'),
                    'profile_status'     => 0,
                    'profile_created'    => date('Y-m-d H:i:s')
                ];

                $this->crud->createData('profile', $profileData);

                $userData = [
                    'user_fullname'  => $this->request->getPost('firstname') . ' ' . $this->request->getPost('lastname'),
                    'user_name'      => $username,
                    'user_pwd'       => $password,
                    'user_akses'     => $this->request->getPost('akses'),
                    'user_status'    => 0,
                    'user_created'   => date('Y-m-d H:i:s')
                ];

                $this->crud->createData('user', $userData);

                $this->session->setFlashdata('sukses_register',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data Registrasi berhasil di simpan. Silahkan Menunggu Administrator Untuk Aktivasi</div>'
                );
                return redirect()->to('auth/index');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_register',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal disimpan: ' . $e->getMessage() . '</div>'
                );
                return redirect()->to('auth/registrasi');
            }
        }
    }

    /**
     * Add gallery
     */
    public function add_galeri()
    {
        $bridge = new Bridges();
        if ($this->request->getPost('simpan')) {
            try {
                $file = $this->request->getFile('image');
                
                if (!$file->isValid()) {
                    $this->session->setFlashdata('gagal_tambah',
                        '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>File upload gagal</div>'
                    );
                    return redirect()->to('administrator/gallery');
                }

                $fileName = $file->getRandomName();
                $file->move($this->galeriPath, $fileName);

                $galeriData = [
                    'galeri_nama'   => $this->request->getPost('galeri_nama'),
                    'galeri_file'   => $fileName,
                    'galeri_status' => 1
                ];

                $this->crud->createData('galeri', $galeriData);

                $this->session->setFlashdata('sukses_tambah',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di tambahkan</div>'
                );
                return redirect()->to('administrator/gallery');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_tambah',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal ditambahkan</div>'
                );
                return redirect()->to('administrator/gallery');
            }
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Tambah Galeri';
        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();
        $data['contents'] = 'Back/Insert/add_galeri';
        
        return view('BASE_ADMIN', $data);
    }

    /**
     * Delete gallery
     */
    public function delete_galeri($param)
    {
        $this->crud->updateData('galeri', ['galeri_status' => 0], ['galeri_id' => $param]);

        $this->session->setFlashdata('sukses_delete',
            '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di Hapus</div>'
        );
        return redirect()->to('administrator/gallery');
    }

    /**
     * Edit gallery
     */
    public function edit_galeri($param)
    {
        $bridge = new Bridges();
        if ($this->request->getPost('update')) {
            try {
                $id = $this->request->getPost('galeri_id');
                $lastGambar = $this->request->getPost('last_gambar');
                $file = $this->request->getFile('image');

                $data = ['galeri_nama' => $this->request->getPost('galeri_nama')];

                // Check if new image is uploaded
                if ($file && $file->isValid()) {
                    // Delete old file
                    $oldPath = $this->galeriPath . '/' . $lastGambar;
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }

                    $fileName = $file->getRandomName();
                    $file->move($this->galeriPath, $fileName);
                    $data['galeri_file'] = $fileName;
                }

                $this->crud->updateData('galeri', $data, ['galeri_id' => $id]);

                $this->session->setFlashdata('sukses_edit',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di edit</div>'
                );
                return redirect()->to('administrator/gallery');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_edit',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal di edit</div>'
                );
                return redirect()->to('administrator/gallery');
            }
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Edit Galeri';
        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();
        $data['get_galeri'] = $this->crud->readData('*', 'galeri', ['galeri_id' => $param]);
        $data['contents'] = 'Back/Update/update_galeri';
        
        return view('BASE_ADMIN', $data);
    }

    /**
     * Add news
     */
    public function add_berita()
    {
        $bridge = new Bridges();
        if ($this->request->getPost('simpan')) {
            try {
                $file = $this->request->getFile('image');
                
                if (!$file->isValid()) {
                    $this->session->setFlashdata('gagal_tambah',
                        '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>File upload gagal</div>'
                    );
                    return redirect()->to('administrator/add_news');
                }

                $fileName = $file->getRandomName();
                $file->move($this->beritaPath, $fileName);

                $beritaData = [
                    'berita_judul'    => $this->request->getPost('berita_judul'),
                    'berita_konten'   => $this->request->getPost('berita_konten'),
                    'berita_gambar'   => $fileName,
                    'berita_status'   => 0,
                    'berita_hot'      => $this->request->getPost('berita_hot'),
                    'kategori_id'     => $this->request->getPost('kategori_id'),
                    'berita_pembuat'  => $this->request->getPost('berita_pembuat'),
                    'berita_created'  => date('Y-m-d H:i:s')
                ];

                $this->crud->createData('berita', $beritaData);

                $this->session->setFlashdata('sukses_tambah',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di tambahkan</div>'
                );
                return redirect()->to('administrator/news');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_tambah',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal ditambahkan</div>'
                );
                return redirect()->to('administrator/add_news');
            }
        }
    }

    /**
     * Delete news
     */
    public function delete_berita($id)
    {
        $this->crud->deleteData('berita', ['berita_id' => $id]);

        $this->session->setFlashdata('sukses_hapus',
            '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di hapus</div>'
        );
        return redirect()->to('administrator/news');
    }

    /**
     * Update news
     */
    public function update_berita()
    {
        $bridge = new Bridges();
        if ($this->request->getPost('update')) {
            try {
                $id = $this->request->getPost('berita_id');
                $lastGambar = $this->request->getPost('berita_gambar');
                $file = $this->request->getFile('image');

                $data = [
                    'berita_judul'   => $this->request->getPost('berita_judul'),
                    'berita_konten'  => $this->request->getPost('berita_konten'),
                    'berita_hot'     => $this->request->getPost('berita_hot'),
                    'kategori_id'    => $this->request->getPost('kategori_id')
                ];

                // Check if new image is uploaded
                if ($file && $file->isValid()) {
                    $oldPath = $this->beritaPath . '/' . $lastGambar;
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }

                    $fileName = $file->getRandomName();
                    $file->move($this->beritaPath, $fileName);
                    $data['berita_gambar'] = $fileName;
                }

                $this->crud->updateData('berita', $data, ['berita_id' => $id]);

                $this->session->setFlashdata('sukses_edit',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di edit</div>'
                );
                return redirect()->to('administrator/news');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_edit',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal di edit</div>'
                );
                return redirect()->to('administrator/news');
            }
        }
    }

    /**
     * Delete event
     */
    public function delete_event($id)
    {
        $this->crud->deleteData('event', ['event_id' => $id]);

        $this->session->setFlashdata('sukses_hapus',
            '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di hapus</div>'
        );
        return redirect()->to('administrator/event');
    }

    /**
     * Add event
     */
    public function add_event()
    {
        $bridge = new Bridges();
        if ($this->request->getPost('simpan')) {
            try {
                $file = $this->request->getFile('image');
                
                if (!$file->isValid()) {
                    $this->session->setFlashdata('gagal_tambah',
                        '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>File upload gagal</div>'
                    );
                    return redirect()->to('administrator/tambah_event');
                }

                $fileName = $file->getRandomName();
                $file->move($this->eventPath, $fileName);

                $eventData = [
                    'event_judul'     => $this->request->getPost('event_judul'),
                    'event_konten'    => $this->request->getPost('event_konten'),
                    'event_gambar'    => $fileName,
                    'event_status'    => 0,
                    'katm_id'         => $this->request->getPost('katm_id'),
                    'event_hot'       => $this->request->getPost('event_hot'),
                    'event_created'   => date('Y-m-d H:i:s'),
                    'kategori_id'     => 1,
                    'event_pembuat'   => $this->request->getPost('event_pembuat')
                ];

                $this->crud->createData('event', $eventData);

                $this->session->setFlashdata('sukses_tambah',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di tambahkan</div>'
                );
                return redirect()->to('administrator/event');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_tambah',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal ditambahkan</div>'
                );
                return redirect()->to('administrator/tambah_event');
            }
        }
    }

    /**
     * Update event
     */
    public function update_event()
    {
        $bridge = new Bridges();
        if ($this->request->getPost('update')) {
            try {
                $id = $this->request->getPost('event_id');
                $lastImage = $this->request->getPost('event_gambar');
                $file = $this->request->getFile('image');

                $data = [
                    'event_judul'   => $this->request->getPost('event_judul'),
                    'event_konten'  => $this->request->getPost('event_konten'),
                    'katm_id'       => $this->request->getPost('katm_id'),
                    'event_hot'     => $this->request->getPost('event_hot'),
                    'kategori_id'   => $this->request->getPost('kategori_id')
                ];

                // Check if new image is uploaded
                if ($file && $file->isValid()) {
                    $oldPath = $this->eventPath . '/' . $lastImage;
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }

                    $fileName = $file->getRandomName();
                    $file->move($this->eventPath, $fileName);
                    $data['event_gambar'] = $fileName;
                }

                $this->crud->updateData('event', $data, ['event_id' => $id]);

                $this->session->setFlashdata('sukses_update',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di edit</div>'
                );
                return redirect()->to('administrator/event');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_update',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal diedit</div>'
                );
                return redirect()->to('administrator/update_event');
            }
        }
    }

    /**
     * Add complaint
     */
    public function add_keluhan()
    {
        if ($this->request->getPost('submit')) {
            $keluhanData = [
                'keluhan_email' => $this->request->getPost('keluhan_email'),
                'keluhan_nama'  => $this->request->getPost('keluhan_nama'),
                'keluhan_is'    => $this->request->getPost('keluhan_isi')
            ];

            $this->crud->createData('keluhan', $keluhanData);

            $this->session->setFlashdata('sukses_insert',
                '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di simpan.</div>'
            );
            return redirect()->to('administrator/pengaduan');
        }
    }

    /**
     * Delete complaint
     */
    public function delete_keluhan($id)
    {
        $this->crud->deleteData('keluhan', ['keluhan_id' => $id]);

        $this->session->setFlashdata('sukses_hapus',
            '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di hapus.</div>'
        );
        return redirect()->to('administrator/pengaduan');
    }

    /**
     * Add equipment
     */
    public function add_alat()
    {
        if ($this->request->getPost('submit')) {
            $alatData = [
                'alat_nama'   => $this->request->getPost('alat_nama'),
                'alat_status' => 1
            ];

            $this->crud->createData('alat', $alatData);

            $this->session->setFlashdata('sukses_insert',
                '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di simpan.</div>'
            );
            return redirect()->to('administrator/alat');
        }
    }

    /**
     * Update equipment
     */
    public function update_alat()
    {
        if ($this->request->getPost('update')) {
            $id = $this->request->getPost('id');
            $data = [
                'alat_nama'   => $this->request->getPost('alat_nama'),
                'alat_status' => $this->request->getPost('alat_status')
            ];

            $this->crud->updateData('alat', $data, ['alat_id' => $id]);

            $this->session->setFlashdata('sukses_update',
                '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di update.</div>'
            );
            return redirect()->to('administrator/alat');
        }
    }

    /**
     * Delete equipment
     */
    public function delete_alat($id)
    {
        $this->crud->deleteData('alat', ['alat_id' => $id]);

        $this->session->setFlashdata('sukses_delete',
            '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di hapus.</div>'
        );
        return redirect()->to('administrator/alat');
    }

    /**
     * Add studio
     */
    public function add_studio()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        if ($this->request->getPost('simpan')) {
            try {
                $file = $this->request->getFile('image');
                
                if (!$file->isValid()) {
                    $this->session->setFlashdata('gagal_delete',
                        '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>File upload gagal</div>'
                    );
                    return redirect()->to('configs/add_studio');
                }

                $fileName = $file->getRandomName();
                $file->move($this->logoPath, $fileName);

                $studioData = [
                    'studio_nama'     => $this->request->getPost('studio_nama'),
                    'studio_alamat'   => $this->request->getPost('studio_alamat'),
                    'studio_fasilitas'=> $this->request->getPost('studio_fasilitas'),
                    'studio_event'    => $this->request->getPost('studio_event'),
                    'studio_logo'     => $fileName,
                    'studio_status'   => 1,
                    'studio_area'     => $this->request->getPost('studio_area'),
                    'studio_harga'    => $this->request->getPost('studio_harga'),
                    'studio_created'  => date('Y-m-d H:i:s'),
                    'studio_rating'   => 5,
                    'user_id'         => $this->session->get('is_id')
                ];

                $this->crud->createData('studio', $studioData);

                $this->session->setFlashdata('sukses_delete',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di tambah.</div>'
                );
                return redirect()->to('administrator/studio');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_delete',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal di tambah</div>'
                );
                return redirect()->to('configs/add_studio');
            }
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
        $data['contents'] = 'Back/Insert/add_studio';
        
        return view('BASE_ADMIN', $data);
    }

    /**
     * Update studio
     */
    public function update_studio()
    {
        $bridge = new Bridges();
        if ($this->request->getPost('update')) {
            try {
                $id = $this->request->getPost('studio_id');
                $lastLogo = $this->request->getPost('last_logo');
                $file = $this->request->getFile('image');

                $data = [
                    'studio_nama'      => $this->request->getPost('studio_nama'),
                    'studio_alamat'    => $this->request->getPost('studio_alamat'),
                    'studio_fasilitas' => $this->request->getPost('studio_fasilitas'),
                    'studio_event'     => $this->request->getPost('studio_event'),
                    'studio_harga'     => $this->request->getPost('studio_harga')
                ];

                // Check if new image is uploaded
                if ($file && $file->isValid()) {
                    $oldPath = $this->logoPath . '/' . $lastLogo;
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }

                    $fileName = $file->getRandomName();
                    $file->move($this->logoPath, $fileName);
                    $data['studio_logo'] = $fileName;
                }

                $this->crud->updateData('studio', $data, ['studio_id' => $id]);

                $this->session->setFlashdata('sukses_update',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di edit.</div>'
                );
                return redirect()->to('administrator/studio');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_update',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal di edit</div>'
                );
                return redirect()->to('administrator/update_studio');
            }
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
        $data['contents'] = 'Back/Update/update_studio';
        
        return view('BASE_ADMIN', $data);
    }

    /**
     * Activate user account
     */
    public function aktivasi_akun($parameter, $id)
    {
        $this->crud->updateData('user', ['user_status' => 1], ['user_id' => $id]);
        $this->crud->updateData('profile', ['profile_status' => 1], ['profile_id' => $id]);

        $this->session->setFlashdata('sukses_aktivasi',
            '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data Berhasil di Aktivasi !</div><br/>'
        );

        $redirectMap = ['pemilik' => 2, 'penyewa' => 3, 'author' => 4];
        $akses = $redirectMap[$parameter] ?? 0;

        return redirect()->to('administrator/activation_account/' . $akses);
    }

    /**
     * Activate content (news/event)
     */
    public function aktivasi_konten($parameter, $id)
    {
        $this->crud->updateData($parameter, [$parameter . '_status' => 1], [$parameter . '_id' => $id]);

        $this->session->setFlashdata('sukses_aktivasi',
            '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data Berhasil di Aktivasi !</div><br/>'
        );

        $redirectMap = ['berita' => 'activation_news', 'event' => 'activation_event'];
        $redirect = $redirectMap[$parameter] ?? 'dashboard';

        return redirect()->to('administrator/' . $redirect);
    }

    /**
     * Add about content
     */
    public function add_tentang()
    {
        if ($this->request->getPost('insert')) {
            $tentangData = ['tentang_konten' => $this->request->getPost('tentang_konten')];

            $this->crud->createData('tentang', $tentangData);

            $this->session->setFlashdata('sukses_insert',
                '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di tambah.</div>'
            );
            return redirect()->to('administrator/about');
        }
    }

    /**
     * Update about content
     */
    public function update_tentang()
    {
        if ($this->request->getPost('update')) {
            $id = $this->request->getPost('tentang_id');
            $data = ['tentang_konten' => $this->request->getPost('tentang_konten')];

            $this->crud->updateData('tentang', $data, ['tentang_id' => $id]);

            $this->session->setFlashdata('sukses_update',
                '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di update.</div>'
            );
            return redirect()->to('administrator/about');
        }
    }

    /**
     * Update user
     */
    public function update_user()
    {
        if ($this->request->getPost('update')) {
            $id = $this->request->getPost('user_id');
            $data = [
                'user_fullname' => $this->request->getPost('user_fullname'),
                'user_name'     => $this->request->getPost('user_name'),
                'user_pwd'      => md5($this->request->getPost('user_pwd')),
                'user_akses'    => $this->request->getPost('user_akses'),
                'user_status'   => $this->request->getPost('user_status')
            ];

            $this->crud->updateData('user', $data, ['user_id' => $id]);

            $this->session->setFlashdata('sukses_update',
                '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di update.</div>'
            );
            return redirect()->to('administrator/user');
        }
    }

    /**
     * Add schedule
     */
    public function add_jadwal()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        if ($this->request->getPost('simpan')) {
            $jadwalData = [
                'jadwal_jam'  => $this->request->getPost('jadwal_jam'),
                'jadwal_status' => 0,
                'user_id'     => $this->session->get('is_id')
            ];

            $this->crud->createData('jadwal', $jadwalData);

            $this->session->setFlashdata('sukses_insert',
                '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di insert.</div>'
            );
            return redirect()->to('administrator/jadwal');
        }

        $data['profile'] = $this->crud->readData('*', 'profile', ['profile_id' => $this->session->get('is_id')], [], '', '', '', ['limit' => 1]);
        $data['akses'] = $this->session->get('is_akses');
        $data['navigation'] = 'Tambah Jadwal';
        $data['aktivasi_pemilik'] = $bridge->data_aktivasi(2);
        $data['aktivasi_penyewa'] = $bridge->data_aktivasi(3);
        $data['aktivasi_author'] = $bridge->data_aktivasi(4);
        $data['aktivasi_berita'] = $bridge->aktivasi_berita();
        $data['aktivasi_event'] = $bridge->aktivasi_event();
        $data['contents'] = 'Back/Insert/add_jadwal';
        
        return view('BASE_ADMIN', $data);
    }

    /**
     * Update schedule
     */
    public function update_jadwal($id)
    {
        $this->crud->updateData('jadwal', ['jadwal_status' => 0], ['jadwal_id' => $id]);

        $this->session->setFlashdata('sukses_update',
            '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di Update.</div>'
        );
        return redirect()->to('administrator/jadwal');
    }

    /**
     * Process booking
     */
    public function proses_booking()
    {
        $bridge = new Bridges();
        if (!$this->session->get('is_login')) {
            return redirect()->to('auth');
        }

        if ($this->request->getPost('booking')) {
            $harga = $this->request->getPost('harga_studio') * $this->request->getPost('jam_bermain');
            $bookingData = [
                'book_nama_depan'    => $this->request->getPost('nama_depan'),
                'book_nama_belakang' => $this->request->getPost('nama_belakang'),
                'book_alamat'        => $this->request->getPost('alamat'),
                'book_ktp'           => $this->request->getPost('ktp'),
                'book_telepon'       => $this->request->getPost('telepon'),
                'book_harga'         => $harga,
                'jadwal_id'          => $this->request->getPost('jadwal_id'),
                'user_id'            => $this->request->getPost('user_id'),
                'book_status'        => 1
            ];

            $this->crud->createData('booking', $bookingData);
        }

        if ($this->request->getPost('update_bukti')) {
            try {
                $file = $this->request->getFile('image');
                
                if (!$file->isValid()) {
                    throw new \Exception('File upload failed');
                }

                $fileName = $file->getRandomName();
                $file->move($this->buktiPath, $fileName);

                $bookData = [
                    'book_nama_depan'       => $this->request->getPost('book_nama_depan'),
                    'book_nama_belakang'    => $this->request->getPost('book_nama_belakang'),
                    'book_alamat'           => $this->request->getPost('book_alamat'),
                    'book_ktp'              => $this->request->getPost('book_ktp'),
                    'book_telepon'          => $this->request->getPost('book_telepon'),
                    'book_bukti_pembayaran' => $fileName,
                    'jadwal_id'             => $this->request->getPost('jadwal_id'),
                    'user_id'               => $this->request->getPost('user_id'),
                    'book_status'           => 0
                ];

                $this->crud->createData('booking', $bookData);

                $this->crud->updateData('jadwal', 
                    ['jadwal_status' => 1], 
                    ['jadwal_id' => $this->request->getPost('jadwal_id')]
                );

                $this->session->setFlashdata('sukses_delete',
                    '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di tambah.</div>'
                );
                return redirect()->to('site/kanal/booking');

            } catch (\Exception $e) {
                $this->session->setFlashdata('gagal_delete',
                    '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a>Data gagal di tambah</div>'
                );
                return redirect()->to('site/kanal/booking');
            }
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
        $data['contents'] = 'Front/Site/booking';
        
        return view('BASE_ADMIN', $data);
    }

    /**
     * Book approval
     */
    public function book_persetujuan($bookId)
    {
        $booking = $this->crud->readData('*', 'booking', ['book_id' => $bookId], [], '', '', '', ['limit' => 1]);
        
        if (!empty($booking)) {
            $jadwalId = $booking[0]['jadwal_id'];

            $this->crud->updateData('booking', ['book_status' => 1], ['book_id' => $bookId]);
            $this->crud->updateData('jadwal', ['jadwal_status' => 2], ['jadwal_id' => $jadwalId]);
        }

        return redirect()->to('administrator/booking');
    }

    /**
     * Recommend studio
     */
    public function rekomendasi_studio($id)
    {
        $this->crud->updateData('studio', ['studio_rekomendasi' => 1], ['studio_id' => $id]);

        $this->session->setFlashdata('sukses_rekomendasi',
            '<div class="alert alert-success"><a class="close" data-dismiss="alert">×</a>Data berhasil di rekomendasi.</div>'
        );
        return redirect()->to('administrator/advertise');
    }
}
