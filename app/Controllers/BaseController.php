<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'auth'];

    /**
     * Be sure to declare properties for any property fetch you initialized.
     * The creation of dynamic property is deprecated in PHP 8.2.
     */
    // protected $session;

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Add these lines
        $session = \Config\Services::session();
        $language = \Config\Services::language();
        $language->setLocale($session->lang);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }
    public function jenisPasien()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('status_pasien');
        $builder->select('status_pasien_id, name_of_status_pasien')
            ->where('NAME_OF_STATUS_PASIEN is not null')
            ->orderBy('status_pasien_id');
        $jenisPasien = $builder->get();
        // $jenisPasien = json_decode(json_encode($jenisPasien), true);
        return json_decode(json_encode($jenisPasien->getResult()), true);
    }
    function composePatientName($patient_name, $patient_id)
    {
        $name = "";
        if ($patient_name != "") {
            $name = ($patient_id != "") ? $patient_name . " (" . $patient_id . ")" : $patient_name;
        }

        return $name;
    }
    function getPatientAge($year, $month, $day)
    {

        $age = "";

        if ($year != 0) {
            $age .= $year . ' ' . lang('year') . ' ';
        }

        if ($month != 0) {
            $age .= $month . ' ' . lang('month') . ' ';
        }

        if ($day != 0) {
            $age .= $day . ' ' . lang('days');
        }

        return $age;
    }
    function lowerKey($array)
    {
        $result = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $key1 => $value1) {
                    $result[strtolower($key)][strtolower($key1)] = $value1;
                }
            } else {
                $result[strtolower($key)] = $value;
            }
        }
        return $result;
    }


    function checkMenuActive($menuname)
    {
        $actual_link = (empty($_SERVER['HTTPS']) ? 'http' : 'https') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $session = session();
        $selectedMenu = [];
        if (!empty($session->get('selectedMenu')))
            $selectedMenu = $session->get('selectedMenu');
        $selectedMenu[] = basename($actual_link);
        // dd($selectedMenu);
        foreach ($selectedMenu as $value) {
            if ($menuname == $value) {
                return 'active';
            }
        }
    }
}
