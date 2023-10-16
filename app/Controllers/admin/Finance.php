<?php

namespace App\Controllers\Admin;

use App\Models\CaraKeluarModel;
use App\Models\ClassRoomModel;
use App\Models\ClinicModel;
use App\Models\DiagnosaModel;
use App\Models\DoctorScheduleModel;
use App\Models\EmployeeAllModel;
use App\Models\FollowUpModel;
use App\Models\InasisFaskesModel;
use App\Models\IsattendedsModel;
use App\Models\KalurahanModel;
use App\Models\KotaModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienVisitationModel;
use App\Models\RujukanModel;
use App\Models\SexModel;
use App\Models\StatusPasienModel;
use App\Models\SufferModel;
use App\Models\TreatmentAkomodasiModel;
use App\Models\TreatmentBillModel;
use CodeIgniter\I18n\Time;

class Finance extends \App\Controllers\BaseController
{
    protected $session;

    public function __construct()
    {
        $this->session = session();
        $this->session->set(['selectedMenu' => '']);
    }
    private function getOrgCode()
    {
        $org = new OrganizationunitModel();
        return $org->find('1771014');
    }
    private function getImgTime()
    {
        $img_time = new Time('now');
        return $img_time->getTimestamp();
    }

    private function getClinic($stype)
    {
        $clinicModel = new ClinicModel();
        $clinic = $this->lowerKey($clinicModel->whereIn('stype_id', $stype)->findAll());
        return $clinic;
    }

    private function getSex()
    {
        $sexModel = new SexModel();
        return $this->lowerKey($sexModel->findAll());
    }
    private function getEmployee()
    {
        $employeeModel = new DoctorScheduleModel();
        return $this->lowerKey($employeeModel->findAll());
    }
    private function getKeluar()
    {
        $statusPasien = new CaraKeluarModel();
        return $this->lowerKey($statusPasien->findAll());
    }
    private function getStatusPasien()
    {
        $statusPasien = new StatusPasienModel();
        return $this->lowerKey($statusPasien->where("name_of_status_pasien<>'' ")->findAll());
    }
    private function getIsnew()
    {
        return ['Lama', 'Baru'];
    }

    private function getKota($kotaList)
    {
        $kotaModel = new KotaModel();
        return $this->lowerKey($kotaModel->whereIn('province_code', $kotaList)->findAll());
    }
    private function getSuffer()
    {
        $sufferModel = new SufferModel();
        $suffer = $this->lowerKey($sufferModel->findAll());
        return $suffer;
    }
}
