<?php

namespace App\Controllers;

use App\Models\AssessmentModel;
use App\Models\ClinicModel;
use App\Models\EmployeeAllModel;
use App\Models\GenerateIdModel;
use App\Models\PasienModel;
use App\Models\PasienVisitationModel;
use CodeIgniter\I18n\Time;

class Home extends BaseController
{
    public function index()
    {
        $p = new AssessmentModel;
        $pasien = ($p->find('202311201254360110BD9'));

        // return json_encode(base64_encode($pasien['ttd']));

        return view('welcome_message', [
            'imgsource' => ($pasien['TTD'])
        ]);
    }
    public function homebase()
    {
        $consId = '30659';
        $consSecret = 'rsud766wates38';
        $userKey = '70b62d70a50f4866e8484a065a0de1bb';
        $current_timestamp = Time::now()->timestamp;
        $db = db_connect('default');
        $builder = $db->query("DECLARE  @return_value int,
        @h64 varchar(max)

    EXEC    @return_value = [dbo].[SP_H002]
            @CONS = N'$consId',
            @TIMESTMP = N'$current_timestamp',
            @MESSAGES = N'$consSecret',
            @h64 = @h64 OUTPUT
    SELECT  @h64 as N'h64'");
        $rKBulanan = $builder->getResultArray();
        return json_encode($rKBulanan);
    }
}
