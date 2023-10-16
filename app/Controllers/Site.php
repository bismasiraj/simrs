<?php

namespace App\Controllers;


class Site extends BaseController
{
    protected $session;
    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->session->start();
    }


    private function check_installation()
    {
        if ($this->uri->segment(1) !== 'install') {
            $this->load->config('migration');
            if ($this->config->item('installed') == false && $this->config->item('migration_enabled') == false) {
                redirect(base_url() . 'install/start');
            } else {
                if (is_dir(APPPATH . 'controllers/install')) {
                    echo '<h3>Delete the install folder from application/controllers/install</h3>';
                    die;
                }
            }
        }
    }
    public function index()
    {
        return view('welcome_message');
    }
    public function homebase()
    {
        $locale = $this->request->getLocale();
        $db = db_connect();
        $data['session'] = $this->session;
        return view('admin/login', $data);
    }
}
