<?php

namespace App\Controllers\Admin;

use App\Models\CaraKeluarModel;
use App\Models\ClassModel;
use App\Models\ClassRoomModel;
use App\Models\ClinicModel;
use App\Models\EmployeeAllModel;
use App\Models\erm\RMJ21Model;
use App\Models\erm\RMJ26Model;
use App\Models\InasisKontrolModel;
use App\Models\InasisRujukanModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosasModel;
use App\Models\PasienLaboratModel;
use App\Models\PasienModel;
use App\Models\PasienRadiologiModel;
use App\Models\PasienVisitationModel;
use App\Models\StatusPasienModel;
use App\Models\TreatmentAkomodasiModel;
use App\Models\TreatTarifModel;
use CodeIgniter\Database\RawSql;

class RekamMedis extends \App\Controllers\BaseController
{
    public function getPeriksaFisik($visit_id)
    {
        $db = db_connect();
        $query = "select top 1
                'BB : ' + isnull(cast(WEIGHT as varchar(10)),'')  + 'Kg , ' +'TB : ' + isnull(cast(height as varchar(10)),'') + ' cm , ' +
                'IMT : ' +  isnull(cast( cast ( weight / ( (height /100) *(height /100)) as decimal(8,2)) as varchar(10)),'') + ' , ' +
                'Suhu : ' + isnull(cast(temperature as varchar(10)),'') + ' C , ' +
                'Tek.Darah : '+ isnull(cast(CAST(TENSION_UPPER AS DECIMAL(6,0)) as varchar(10)),'') + ' / ' + 
                isnull(cast(CAST(TENSION_BELOW AS DECIMAL(6,0) ) as varchar(10)),'') + ' mmHg , ' + 
                'Nadi : ' + isnull( cast(CAST(nadi AS DECIMAL(6,0) )as varchar(10)) , '') + ' /mnt , ' + 'Napas : ' + isnull(cast(CAST(NAFAS AS DECIMAL(4,0)) as varchar(10)),'') + ' /mnt , ' + ' SpO2 : ' + 
                isnull(cast(saturasi as varchar(10)),'') + ' % ' as periksafisik
                ,anamnase,
                weight, height, temperature, nadi, tension_upper, tension_below, saturasi, nafas, arm_diameter, saturasi, pemeriksaan, body_id
                from EXAMINATION_INFO where visit_id = '$visit_id'
                order by EXAMINATION_DATE desc";
        $select = $db->query($query)->getResultArray();

        return json_encode($select[0]);
    }
    public function getPeriksaFisikChoosed($visit_id, $body_id)
    {
        $db = db_connect();
        $query = "select top 1
                'BB : ' + isnull(cast(WEIGHT as varchar(10)),'')  + 'Kg , ' +'TB : ' + isnull(cast(height as varchar(10)),'') + ' cm , ' +
                'IMT : ' +  isnull(cast( cast ( weight / ( (height /100) *(height /100)) as decimal(8,2)) as varchar(10)),'') + ' , ' +
                'Suhu : ' + isnull(cast(temperature as varchar(10)),'') + ' C , ' +
                'Tek.Darah : '+ isnull(cast(CAST(TENSION_UPPER AS DECIMAL(6,0)) as varchar(10)),'') + ' / ' + 
                isnull(cast(CAST(TENSION_BELOW AS DECIMAL(6,0) ) as varchar(10)),'') + ' mmHg , ' + 
                'Nadi : ' + isnull( cast(CAST(nadi AS DECIMAL(6,0) )as varchar(10)) , '') + ' /mnt , ' + 'Napas : ' + isnull(cast(CAST(NAFAS AS DECIMAL(4,0)) as varchar(10)),'') + ' /mnt , ' + ' SpO2 : ' + 
                isnull(cast(saturasi as varchar(10)),'') + ' % ' as periksafisik
                ,anamnase,
                weight, height, temperature, nadi, tension_upper, tension_below, saturasi, nafas, arm_diameter, saturasi, pemeriksaan
                from EXAMINATION_INFO where visit_id = '$visit_id' and body_id = '$body_id'
                order by EXAMINATION_DATE desc";
        $select = $db->query($query)->getResultArray();

        return json_encode($select[0]);
    }
    public function getPeriksaLab($trans_id)
    {
        $db = db_connect();
        // $query = "select  STUFF(
        //      (SELECT ',' +  hl.tarif_name + ' : ' + cast(hasil as varchar(250))
        // 	 from sharelis.dbo.hasilLIS hl inner join  treatment_bill tb on 
        //       hl.KODE_TARIF COLLATE DATABASE_DEFAULT = tb.TARIF_ID  COLLATE DATABASE_DEFAULT
        // 	  and hl.nolab_rs COLLATE DATABASE_DEFAULT = tb.NOTA_NO COLLATE DATABASE_DEFAULT and
        // 	  tb.trans_id = '$trans_id'
        // 	  order by hl.reg_date
        //       FOR XML PATH (''))
        //      , 1, 1, '') periksalab
        //      from ORGANIZATIONUNIT;";
        $query = "select REPLACE(replace( STUFF(
             (SELECT ';' +  ' Pemeriksaan : ' + tr.treatment + '  '
			 from TREATMENT_BILL tr where
			  tr.TRANS_ID = '$trans_id'  and
              tr.CLINIC_ID = 'P013' 	 
			  order by tr.TREATMENT
              FOR XML PATH (''))
             , 1, 1, '') , ';',CHAR(13)) , '&#x0D','') periksalab
			 from ORGANIZATIONUNIT";
        $select = $db->query($query)->getResultArray();
        if (isset($select[0])) {
            return json_encode($select[0]);
        } else {
            return json_encode([]);
        }
        // return json_encode($select);
    }
    public function getPeriksaRad($trans_id)
    {
        $db = db_connect();
        // $query = " select REPLACE(replace( STUFF(
        //      (SELECT ';' +  ' Pemeriksaan : ' + tr.tarif_name + '  '
        // 	 + ' - '  + ' Kesimpulan : ' + CONCLUSION
        // 	 from TREAT_RESULTS tr where
        // 	  tr.visit_trans = '$trans_id'  and
        //       tr.CLINIC_ID = 'P016' 	 
        // 	  order by tr.PICKUP_DATE
        //       FOR XML PATH (''))
        //      , 1, 1, '') , ';',CHAR(13)) , '&#x0D','') periksarad
        // 	 from ORGANIZATIONUNIT";

        $query = "select REPLACE(replace( STUFF(
             (SELECT ';' +  ' Pemeriksaan : ' + tr.treatment + '  '
			 from TREATMENT_BILL tr where
			  tr.TRANS_ID = '$trans_id'  and
              tr.CLINIC_ID = 'P016' 	 
			  order by tr.TREATMENT
              FOR XML PATH (''))
             , 1, 1, '') , ';',CHAR(13)) , '&#x0D','') periksarad
			 from ORGANIZATIONUNIT";
        $select = $db->query($query)->getResultArray();
        if (isset($select[0])) {
            return json_encode($select[0]);
        } else {
            return json_encode([]);
        }
    }
    public function getTerapi($visit_id)
    {
        $db = db_connect();
        $query = "select  STUFF(
             (SELECT ', ' +  description + ' ( ' + isnull(description2,'') + ' ) '   from  treatment_obat where 
			  treatment_obat.visit_id  = '$visit_id' 
			  and DESCRIPTION <> '%jasa%' 
                group by description ,isnull(description2,'')
              FOR XML PATH (''))
             ,1, 2, '') terapi
			 from ORGANIZATIONUNIT ;";
        $select = $db->query($query)->getResultArray();

        return json_encode($select);
    }
    public function getdokterrujukan()
    {
        if (!$this->request->is('post')) {
            return $this->response->setJSON([
                'status' => 'error',
                'message' => 'Invalid request method'
            ])->setStatusCode(405); // Method Not Allowed
        }

        // return json_encode($this->request->getPost('clinicSelected'));

        $clinicSelected = $this->request->getPost('clinicSelected');
        $rujintvisitdate = $this->request->getPost('rujintvisitdate');


        $db = db_connect();
        $schedule = $db->query("select ea.fullname, ea.employee_id
                              from doctor_schedule ds,employee_all ea,clinic c
                              where ds.employee_id = ea.employee_id
                              and c.clinic_id = '$clinicSelected'
                              and ds.clinic_id = c.clinic_id
                              --and ds.day_id = DATEPART(dw,'$rujintvisitdate')
                              group by ea.fullname, ea.employee_id
                              order by ea.fullname")->getResultArray();


        return json_encode($schedule);
    }
    public function labOnlineRequest($visit)
    {
        $visit = base64_decode($visit);
        $visit = json_decode($visit, true);
        // return ($visit);


        $sp = new StatusPasienModel();
        $status = $this->lowerKey($sp->find($visit['status_pasien_id']));
        $p = new PasienModel();
        $pasien = $this->lowerKey($p->find($visit['no_registration']));
        // return json_encode($status);
        $visit['name_of_status_pasien'] = $status['name_of_status_pasien'];

        return view('admin\patient\profilemodul\subprofilemodul\labonline', ['visit' => $visit, 'pasien' => $pasien]);
    }
    public function postLabOnlineRequest()
    {
        $data['org_unit_code'] = $this->request->getPost('org_unit_code');
        $data['vactination_id'] = $this->request->getPost('vactination_id');
        $data['no_registration'] = $this->request->getPost('no_registration');
        $data['visit_id'] = $this->request->getPost('visit_id');
        $data['bill_id'] = $this->request->getPost('bill_id');
        $data['clinic_id'] = $this->request->getPost('clinic_id');
        $data['validation'] = $this->request->getPost('validation');
        $data['terlayani'] = $this->request->getPost('terlayani');
        $data['employee_id'] = $this->request->getPost('employee_id');
        $data['patient_category_id'] = $this->request->getPost('patient_category_id');
        $data['vactination_date'] = $this->request->getPost('vactination_date');
        $data['description'] = $this->request->getPost('description');
        $data['modified_date'] = $this->request->getPost('modified_date');
        $data['modified_by'] = $this->request->getPost('modified_by');
        $data['modified_from'] = $this->request->getPost('modified_from');
        $data['thename'] = $this->request->getPost('thename');
        $data['theaddress'] = $this->request->getPost('theaddress');
        $data['theid'] = $this->request->getPost('theid');
        $data['isrj'] = $this->request->getPost('isrj');
        $data['ageyear'] = $this->request->getPost('ageyear');
        $data['agemonth'] = $this->request->getPost('agemonth');
        $data['ageday'] = $this->request->getPost('ageday');
        $data['status_pasien_id'] = $this->request->getPost('status_pasien_id');
        $data['gender'] = $this->request->getPost('gender');
        $data['doctor'] = $this->request->getPost('doctor');
        $data['kal_id'] = $this->request->getPost('kal_id');
        $data['class_room_id'] = $this->request->getPost('class_room_id');
        $data['bed_id'] = $this->request->getPost('bed_id');
        $data['keluar_id'] = $this->request->getPost('keluar_id');
        $data['pl_001'] = $this->request->getPost('pl_001');
        $data['pl_002'] = $this->request->getPost('pl_002');
        $data['pl_003'] = $this->request->getPost('pl_003');
        $data['pl_004'] = $this->request->getPost('pl_004');
        $data['pl_005'] = $this->request->getPost('pl_005');
        $data['pl_006'] = $this->request->getPost('pl_006');
        $data['pl_007'] = $this->request->getPost('pl_007');
        $data['pl_008'] = $this->request->getPost('pl_008');
        $data['pl_009'] = $this->request->getPost('pl_009');
        $data['pl_010'] = $this->request->getPost('pl_010');
        $data['pl_011'] = $this->request->getPost('pl_011');
        $data['pl_012'] = $this->request->getPost('pl_012');
        $data['pl_013'] = $this->request->getPost('pl_013');
        $data['pl_014'] = $this->request->getPost('pl_014');
        $data['pl_015'] = $this->request->getPost('pl_015');
        $data['pl_016'] = $this->request->getPost('pl_016');
        $data['pl_017'] = $this->request->getPost('pl_017');
        $data['pl_018'] = $this->request->getPost('pl_018');
        $data['pl_019'] = $this->request->getPost('pl_019');
        $data['pl_020'] = $this->request->getPost('pl_020');
        $data['pl_021'] = $this->request->getPost('pl_021');
        $data['pl_022'] = $this->request->getPost('pl_022');
        $data['pl_023'] = $this->request->getPost('pl_023');
        $data['pl_024'] = $this->request->getPost('pl_024');
        $data['pl_025'] = $this->request->getPost('pl_025');
        $data['pl_026'] = $this->request->getPost('pl_026');
        $data['pl_027'] = $this->request->getPost('pl_027');
        $data['pl_028'] = $this->request->getPost('pl_028');
        $data['pl_029'] = $this->request->getPost('pl_029');
        $data['pl_030'] = $this->request->getPost('pl_030');
        $data['pl_031'] = $this->request->getPost('pl_031');
        $data['pl_032'] = $this->request->getPost('pl_032');
        $data['pl_033'] = $this->request->getPost('pl_033');
        $data['pl_034'] = $this->request->getPost('pl_034');
        $data['pl_035'] = $this->request->getPost('pl_035');
        $data['pl_036'] = $this->request->getPost('pl_036');
        $data['pl_037'] = $this->request->getPost('pl_037');
        $data['pl_038'] = $this->request->getPost('pl_038');
        $data['pl_039'] = $this->request->getPost('pl_039');
        $data['pl_040'] = $this->request->getPost('pl_040');
        $data['pl_041'] = $this->request->getPost('pl_041');
        $data['pl_042'] = $this->request->getPost('pl_042');
        $data['pl_043'] = $this->request->getPost('pl_043');
        $data['pl_044'] = $this->request->getPost('pl_044');
        $data['pl_045'] = $this->request->getPost('pl_045');
        $data['pl_046'] = $this->request->getPost('pl_046');
        $data['pl_047'] = $this->request->getPost('pl_047');
        $data['pl_048'] = $this->request->getPost('pl_048');
        $data['pl_049'] = $this->request->getPost('pl_049');
        $data['pl_050'] = $this->request->getPost('pl_050');
        $data['pl_051'] = $this->request->getPost('pl_051');
        $data['pl_052'] = $this->request->getPost('pl_052');
        $data['pl_053'] = $this->request->getPost('pl_053');
        $data['pl_054'] = $this->request->getPost('pl_054');
        $data['pl_055'] = $this->request->getPost('pl_055');
        $data['pl_056'] = $this->request->getPost('pl_056');
        $data['pl_057'] = $this->request->getPost('pl_057');
        $data['pl_058'] = $this->request->getPost('pl_058');
        $data['pl_059'] = $this->request->getPost('pl_059');
        $data['pl_060'] = $this->request->getPost('pl_060');
        $data['pl_061'] = $this->request->getPost('pl_061');
        $data['pl_062'] = $this->request->getPost('pl_062');
        $data['pl_063'] = $this->request->getPost('pl_063');
        $data['pl_064'] = $this->request->getPost('pl_064');
        $data['pl_065'] = $this->request->getPost('pl_065');
        $data['pl_066'] = $this->request->getPost('pl_066');
        $data['pl_067'] = $this->request->getPost('pl_067');
        $data['pl_068'] = $this->request->getPost('pl_068');
        $data['pl_069'] = $this->request->getPost('pl_069');
        $data['pl_070'] = $this->request->getPost('pl_070');
        $data['pl_071'] = $this->request->getPost('pl_071');
        $data['pl_072'] = $this->request->getPost('pl_072');
        $data['pl_073'] = $this->request->getPost('pl_073');
        $data['pl_074'] = $this->request->getPost('pl_074');
        $data['pl_075'] = $this->request->getPost('pl_075');
        $data['pl_076'] = $this->request->getPost('pl_076');
        $data['pl_077'] = $this->request->getPost('pl_077');
        $data['pl_078'] = $this->request->getPost('pl_078');
        $data['pl_079'] = $this->request->getPost('pl_079');
        $data['pl_080'] = $this->request->getPost('pl_080');
        $data['pl_081'] = $this->request->getPost('pl_081');
        $data['pl_082'] = $this->request->getPost('pl_082');
        $data['pl_083'] = $this->request->getPost('pl_083');
        $data['pl_084'] = $this->request->getPost('pl_084');
        $data['pl_085'] = $this->request->getPost('pl_085');
        $data['pl_086'] = $this->request->getPost('pl_086');
        $data['pl_087'] = $this->request->getPost('pl_087');
        $data['pl_088'] = $this->request->getPost('pl_088');
        $data['pl_089'] = $this->request->getPost('pl_089');
        $data['pl_090'] = $this->request->getPost('pl_090');
        $data['pl_091'] = $this->request->getPost('pl_091');
        $data['pl_092'] = $this->request->getPost('pl_092');
        $data['pl_093'] = $this->request->getPost('pl_093');
        $data['pl_094'] = $this->request->getPost('pl_094');
        $data['pl_095'] = $this->request->getPost('pl_095');
        $data['pl_096'] = $this->request->getPost('pl_096');
        $data['pl_097'] = $this->request->getPost('pl_097');
        $data['pl_098'] = $this->request->getPost('pl_098');
        $data['pl_099'] = $this->request->getPost('pl_099');
        $data['pl_100'] = $this->request->getPost('pl_100');
        $data['pl_101'] = $this->request->getPost('pl_101');
        $data['pl_102'] = $this->request->getPost('pl_102');
        $data['pl_103'] = $this->request->getPost('pl_103');
        $data['pl_104'] = $this->request->getPost('pl_104');
        $data['pl_105'] = $this->request->getPost('pl_105');
        $data['pl_106'] = $this->request->getPost('pl_106');
        $data['pl_107'] = $this->request->getPost('pl_107');
        $data['pl_108'] = $this->request->getPost('pl_108');
        $data['pl_109'] = $this->request->getPost('pl_109');
        $data['pl_110'] = $this->request->getPost('pl_110');
        $data['pl_111'] = $this->request->getPost('pl_111');
        $data['pl_112'] = $this->request->getPost('pl_112');
        $data['pl_113'] = $this->request->getPost('pl_113');
        $data['pl_114'] = $this->request->getPost('pl_114');
        $data['pl_115'] = $this->request->getPost('pl_115');
        $data['pl_116'] = $this->request->getPost('pl_116');
        $data['pl_117'] = $this->request->getPost('pl_117');
        $data['pl_118'] = $this->request->getPost('pl_118');
        $data['pl_119'] = $this->request->getPost('pl_119');
        $data['pl_120'] = $this->request->getPost('pl_120');
        $data['pl_121'] = $this->request->getPost('pl_121');
        $data['pl_122'] = $this->request->getPost('pl_122');
        $data['pl_123'] = $this->request->getPost('pl_123');
        $data['pl_124'] = $this->request->getPost('pl_124');
        $data['pl_125'] = $this->request->getPost('pl_125');
        $data['pl_126'] = $this->request->getPost('pl_126');
        $data['pl_127'] = $this->request->getPost('pl_127');
        $data['pl_128'] = $this->request->getPost('pl_128');
        $data['pl_129'] = $this->request->getPost('pl_129');
        $data['pl_130'] = $this->request->getPost('pl_130');
        $data['pl_131'] = $this->request->getPost('pl_131');
        $data['pl_132'] = $this->request->getPost('pl_132');
        $data['pl_133'] = $this->request->getPost('pl_133');
        $data['pl_134'] = $this->request->getPost('pl_134');
        $data['pl_135'] = $this->request->getPost('pl_135');
        $data['pl_136'] = $this->request->getPost('pl_136');
        $data['pl_137'] = $this->request->getPost('pl_137');
        $data['pl_138'] = $this->request->getPost('pl_138');
        $data['pl_139'] = $this->request->getPost('pl_139');
        $data['pl_140'] = $this->request->getPost('pl_140');
        $data['pl_141'] = $this->request->getPost('pl_141');
        $data['pl_142'] = $this->request->getPost('pl_142');
        $data['pl_143'] = $this->request->getPost('pl_143');
        $data['pl_144'] = $this->request->getPost('pl_144');
        $data['pl_145'] = $this->request->getPost('pl_145');
        $data['pl_146'] = $this->request->getPost('pl_146');
        $data['pl_147'] = $this->request->getPost('pl_147');
        $data['pl_148'] = $this->request->getPost('pl_148');
        $data['pl_149'] = $this->request->getPost('pl_149');
        $data['pl_150'] = $this->request->getPost('pl_150');
        $data['pl_151'] = $this->request->getPost('pl_151');
        $data['pl_152'] = $this->request->getPost('pl_152');
        $data['pl_153'] = $this->request->getPost('pl_153');
        $data['pl_154'] = $this->request->getPost('pl_154');
        $data['pl_155'] = $this->request->getPost('pl_155');
        $data['pl_156'] = $this->request->getPost('pl_156');
        $data['pl_157'] = $this->request->getPost('pl_157');
        $data['pl_158'] = $this->request->getPost('pl_158');
        $data['pl_159'] = $this->request->getPost('pl_159');
        $data['pl_160'] = $this->request->getPost('pl_160');
        $data['pl_161'] = $this->request->getPost('pl_161');
        $data['pl_162'] = $this->request->getPost('pl_162');
        $data['pl_163'] = $this->request->getPost('pl_163');
        $data['pl_164'] = $this->request->getPost('pl_164');
        $data['pl_165'] = $this->request->getPost('pl_165');
        $data['pl_166'] = $this->request->getPost('pl_166');
        $data['pl_167'] = $this->request->getPost('pl_167');
        $data['pl_168'] = $this->request->getPost('pl_168');
        $data['pl_169'] = $this->request->getPost('pl_169');
        $data['pl_170'] = $this->request->getPost('pl_170');
        $data['pl_171'] = $this->request->getPost('pl_171');
        $data['pl_172'] = $this->request->getPost('pl_172');
        $data['pl_173'] = $this->request->getPost('pl_173');
        $data['pl_174'] = $this->request->getPost('pl_174');
        $data['pl_175'] = $this->request->getPost('pl_175');
        $data['pl_176'] = $this->request->getPost('pl_176');
        $data['pl_177'] = $this->request->getPost('pl_177');
        $data['pl_178'] = $this->request->getPost('pl_178');
        $data['pl_179'] = $this->request->getPost('pl_179');
        $data['pl_180'] = $this->request->getPost('pl_180');
        $data['pl_181'] = $this->request->getPost('pl_181');
        $data['pl_182'] = $this->request->getPost('pl_182');
        $data['pl_183'] = $this->request->getPost('pl_183');
        $data['pl_184'] = $this->request->getPost('pl_184');
        $data['pl_185'] = $this->request->getPost('pl_185');
        $data['desc_1'] = $this->request->getPost('desc_1');
        $data['desc_2'] = $this->request->getPost('desc_2');
        $data['desc_3'] = $this->request->getPost('desc_3');
        $data['desc_4'] = $this->request->getPost('desc_4');
        $data['desc_5'] = $this->request->getPost('desc_5');
        $data['desc_6'] = $this->request->getPost('desc_6');
        $data['desc_7'] = $this->request->getPost('desc_7');
        $data['pl_188'] = $this->request->getPost('pl_188');
        $data['pl_189'] = $this->request->getPost('pl_189');
        $data['pl_190'] = $this->request->getPost('pl_190');
        $data['pl_191'] = $this->request->getPost('pl_191');
        $data['pl_192'] = $this->request->getPost('pl_192');
        $data['pl_193'] = $this->request->getPost('pl_193');
        $data['pl_194'] = $this->request->getPost('pl_194');
        $data['pl_195'] = $this->request->getPost('pl_195');
        $data['pl_196'] = $this->request->getPost('pl_196');
        $data['pl_197'] = $this->request->getPost('pl_197');
        $data['pl_198'] = $this->request->getPost('pl_198');
        $data['pl_199'] = $this->request->getPost('pl_199');
        $data['pl_200'] = $this->request->getPost('pl_200');
        $data['pl_201'] = $this->request->getPost('pl_201');
        $data['pl_202'] = $this->request->getPost('pl_202');
        $data['pl_203'] = $this->request->getPost('pl_203');
        $data['pl_204'] = $this->request->getPost('pl_204');
        $data['pl_205'] = $this->request->getPost('pl_205');
        $data['pl_206'] = $this->request->getPost('pl_206');
        $data['pl_207'] = $this->request->getPost('pl_207');
        $data['pl_208'] = $this->request->getPost('pl_208');
        $data['pl_209'] = $this->request->getPost('pl_209');
        $data['pl_210'] = $this->request->getPost('pl_210');
        $data['pl_211'] = $this->request->getPost('pl_211');
        $data['pl_212'] = $this->request->getPost('pl_212');
        $data['pl_213'] = $this->request->getPost('pl_213');
        $data['pl_214'] = $this->request->getPost('pl_214');
        $data['pl_215'] = $this->request->getPost('pl_215');
        $data['pl_216'] = $this->request->getPost('pl_216');
        $data['pl_217'] = $this->request->getPost('pl_217');
        $data['pl_218'] = $this->request->getPost('pl_218');
        $data['pl_219'] = $this->request->getPost('pl_219');
        $data['pl_220'] = $this->request->getPost('pl_220');
        $data['pl_221'] = $this->request->getPost('pl_221');
        $data['pl_222'] = $this->request->getPost('pl_222');
        $data['pl_223'] = $this->request->getPost('pl_223');
        $data['pl_224'] = $this->request->getPost('pl_224');
        $data['pl_225'] = $this->request->getPost('pl_225');
        $data['pl_226'] = $this->request->getPost('pl_226');
        $data['pl_227'] = $this->request->getPost('pl_227');
        $data['pl_228'] = $this->request->getPost('pl_228');
        $data['pl_229'] = $this->request->getPost('pl_229');
        $data['pl_230'] = $this->request->getPost('pl_230');
        $data['pl_231'] = $this->request->getPost('pl_231');
        $data['pl_232'] = $this->request->getPost('pl_232');
        $data['pl_233'] = $this->request->getPost('pl_233');
        $data['pl_234'] = $this->request->getPost('pl_234');
        $data['pl_235'] = $this->request->getPost('pl_235');
        $data['pl_236'] = $this->request->getPost('pl_236');
        $data['pl_237'] = $this->request->getPost('pl_237');
        $data['pl_238'] = $this->request->getPost('pl_238');
        $data['pl_239'] = $this->request->getPost('pl_239');
        $data['pl_240'] = $this->request->getPost('pl_240');
        $data['pl_241'] = $this->request->getPost('pl_241');
        $data['pl_242'] = $this->request->getPost('pl_242');
        $data['pl_243'] = $this->request->getPost('pl_243');
        $data['pl_244'] = $this->request->getPost('pl_244');
        $data['pl_245'] = $this->request->getPost('pl_245');
        $data['pl_246'] = $this->request->getPost('pl_246');
        $data['pl_247'] = $this->request->getPost('pl_247');
        $data['pl_248'] = $this->request->getPost('pl_248');
        $data['pl_249'] = $this->request->getPost('pl_249');
        $data['pl_250'] = $this->request->getPost('pl_250');
        $data['pl_186'] = $this->request->getPost('pl_186');
        $data['pl_187'] = $this->request->getPost('pl_187');
        $data['pl_251'] = $this->request->getPost('pl_251');
        $data['pl_252'] = $this->request->getPost('pl_252');
        $data['pl_253'] = $this->request->getPost('pl_253');
        $data['pl_254'] = $this->request->getPost('pl_254');
        $data['pl_255'] = $this->request->getPost('pl_255');
        $data['pl_256'] = $this->request->getPost('pl_256');
        $data['pl_257'] = $this->request->getPost('pl_257');
        $data['pl_258'] = $this->request->getPost('pl_258');
        $data['pl_259'] = $this->request->getPost('pl_259');
        $data['pl_260'] = $this->request->getPost('pl_260');
        $data['pl_261'] = $this->request->getPost('pl_261');
        $data['pl_262'] = $this->request->getPost('pl_262');
        $data['pl_263'] = $this->request->getPost('pl_263');
        $data['pl_264'] = $this->request->getPost('pl_264');
        $data['pl_265'] = $this->request->getPost('pl_265');
        $data['pl_266'] = $this->request->getPost('pl_266');
        $data['pl_267'] = $this->request->getPost('pl_267');
        $data['pl_268'] = $this->request->getPost('pl_268');
        $data['pl_269'] = $this->request->getPost('pl_269');
        $data['pl_270'] = $this->request->getPost('pl_270');

        $visit = $this->request->getPost('visit');
        $visit = json_decode((string)$visit, true);
        $pasien = $this->request->getPost('pasien');
        $pasien = json_decode((string)$pasien, true);

        // return json_encode($data['vactination_id']);
        $isNewKunj = false;
        if ($data['vactination_id'] == null) {
            $db = db_connect();
            $select = $db->query("select cast(year(getdate()) as varchar(4)) +
                right(cast((month(getdate()) + 100) as varchar(3)),2)+
                right(cast((day(getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3) as id")->getResultArray();
            // $vactination_id = $select[0]['id'];
            $data['vactination_id'] = $select[0]['id'];
            $isNewKunj = true;
        }



        // return json_encode($vactination_id);
        // $data['vactination_id'] = '202401121107123';

        $pl = new PasienLaboratModel();

        $pl->save($data);

        if ($isNewKunj) {
            $visitSave = $visit;
            $visitSave['clinic_id'] = 'P013';
            $select = $db->query("select cast(year(getdate()) as varchar(4)) +
                right(cast((month(getdate()) + 100) as varchar(3)),2)+
                right(cast((day(getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3) as id")->getResultArray();
            // $vactination_id = $select[0]['id'];
            $visitSave['visit_id'] = $select[0]['id'];
            $visitSave['visit_date'] = new RawSql("getdate()");
            $visitSave['booked_date'] = new RawSql("getdate()");
            $visitSave['clinic_id_from'] = $visitSave['clinic_id'];
            $visitSave['employee_id_from'] = $visit['employee_id'];
            $visitSave['way_id'] = '19';
            $visitSave['isnew'] = '0';
            $visitSave['class_room_id'] = null;

            $pv = new PasienVisitationModel();
            $pv->insert($visitSave);
        }

        return view('admin\patient\profilemodul\subprofilemodul\labonline', ['visit' => $visit, 'pasien' => $pasien, 'lab' => $data]);

        // return json_encode($return);
    }
    public function getListRequestLab()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visitId = $body["visit"];
        $noregistration = $body["nomor"];
        // $noregistration = $this->request->getPost("no_registration");
        // return json_encode($visitId);

        $pl = new PasienLaboratModel();
        $lab = $this->lowerKey($pl->where("visit_id", $visitId)->where("no_registration", $noregistration)->findAll());

        return json_encode($lab);
    }
    public function getLabOnlineRequest($visit, $vactinationId)
    {
        $pl = new PasienLaboratModel();
        $data = $this->lowerKey($pl->find($vactinationId));
        $visit = base64_decode($visit);
        $visit = json_decode($visit, true);
        $st = new StatusPasienModel();
        $status = $st->select("name_of_status_pasien")->find($visit['status_pasien_id']);
        $visit['name_of_status_pasien'] = $status['name_of_status_pasien'];
        $p = new PasienModel();
        $pasien = $this->lowerKey($p->find($visit['no_registration']));
        return view('admin\patient\profilemodul\subprofilemodul\labonline', ['visit' => $visit, 'pasien' => $pasien, 'lab' => $data]);
    }
    public function radOnlineRequest($visit)
    {
        $visit = base64_decode($visit);
        $visit = json_decode($visit, true);

        $sp = new StatusPasienModel();
        $status = $this->lowerKey($sp->find($visit['status_pasien_id']));
        $p = new PasienModel();
        $pasien = $this->lowerKey($p->find($visit['no_registration']));
        // return json_encode($status);
        $visit['name_of_status_pasien'] = $status['name_of_status_pasien'];

        return view('admin\patient\profilemodul\subprofilemodul\radonline', ['visit' => $visit, 'pasien' => $pasien]);
    }
    public function postRadOnlineRequest()
    {
        $data['org_unit_code'] = $this->request->getpost('org_unit_code');
        $data['vactination_id'] = $this->request->getpost('vactination_id');
        $data['no_registration'] = $this->request->getpost('no_registration');
        $data['visit_id'] = $this->request->getpost('visit_id');
        $data['bill_id'] = $this->request->getpost('bill_id');
        $data['clinic_id'] = $this->request->getpost('clinic_id');
        $data['validation'] = $this->request->getpost('validation');
        $data['terlayani'] = $this->request->getpost('terlayani');
        $data['employee_id'] = $this->request->getpost('employee_id');
        $data['patient_category_id'] = $this->request->getpost('patient_category_id');
        $data['vactination_date'] = $this->request->getpost('vactination_date');
        $data['description'] = $this->request->getpost('description');
        $data['modified_date'] = $this->request->getpost('modified_date');
        $data['modified_by'] = $this->request->getpost('modified_by');
        $data['modified_from'] = $this->request->getpost('modified_from');
        $data['thename'] = $this->request->getpost('thename');
        $data['theaddress'] = $this->request->getpost('theaddress');
        $data['theid'] = $this->request->getpost('theid');
        $data['isrj'] = $this->request->getpost('isrj');
        $data['ageyear'] = $this->request->getpost('ageyear');
        $data['agemonth'] = $this->request->getpost('agemonth');
        $data['ageday'] = $this->request->getpost('ageday');
        $data['status_pasien_id'] = $this->request->getpost('status_pasien_id');
        $data['gender'] = $this->request->getpost('gender');
        $data['doctor'] = $this->request->getpost('doctor');
        $data['kal_id'] = $this->request->getpost('kal_id');
        $data['class_room_id'] = $this->request->getpost('class_room_id');
        $data['bed_id'] = $this->request->getpost('bed_id');
        $data['keluar_id'] = $this->request->getpost('keluar_id');
        $data['pr_001'] = $this->request->getpost('pr_001');
        $data['pr_002'] = $this->request->getpost('pr_002');
        $data['pr_003'] = $this->request->getpost('pr_003');
        $data['pr_004'] = $this->request->getpost('pr_004');
        $data['pr_005'] = $this->request->getpost('pr_005');
        $data['pr_006'] = $this->request->getpost('pr_006');
        $data['pr_007'] = $this->request->getpost('pr_007');
        $data['pr_008'] = $this->request->getpost('pr_008');
        $data['pr_009'] = $this->request->getpost('pr_009');
        $data['pr_010'] = $this->request->getpost('pr_010');
        $data['pr_011'] = $this->request->getpost('pr_011');
        $data['pr_012'] = $this->request->getpost('pr_012');
        $data['pr_013'] = $this->request->getpost('pr_013');
        $data['pr_014'] = $this->request->getpost('pr_014');
        $data['pr_015'] = $this->request->getpost('pr_015');
        $data['pr_016'] = $this->request->getpost('pr_016');
        $data['pr_017'] = $this->request->getpost('pr_017');
        $data['pr_018'] = $this->request->getpost('pr_018');
        $data['pr_019'] = $this->request->getpost('pr_019');
        $data['pr_020'] = $this->request->getpost('pr_020');
        $data['pr_021'] = $this->request->getpost('pr_021');
        $data['pr_022'] = $this->request->getpost('pr_022');
        $data['pr_023'] = $this->request->getpost('pr_023');
        $data['pr_024'] = $this->request->getpost('pr_024');
        $data['pr_025'] = $this->request->getpost('pr_025');
        $data['pr_026'] = $this->request->getpost('pr_026');
        $data['pr_027'] = $this->request->getpost('pr_027');
        $data['pr_028'] = $this->request->getpost('pr_028');
        $data['pr_029'] = $this->request->getpost('pr_029');
        $data['pr_030'] = $this->request->getpost('pr_030');
        $data['pr_031'] = $this->request->getpost('pr_031');
        $data['pr_032'] = $this->request->getpost('pr_032');
        $data['pr_033'] = $this->request->getpost('pr_033');
        $data['pr_034'] = $this->request->getpost('pr_034');
        $data['pr_035'] = $this->request->getpost('pr_035');
        $data['pr_036'] = $this->request->getpost('pr_036');
        $data['pr_037'] = $this->request->getpost('pr_037');
        $data['pr_038'] = $this->request->getpost('pr_038');
        $data['pr_039'] = $this->request->getpost('pr_039');
        $data['pr_040'] = $this->request->getpost('pr_040');
        $data['pr_041'] = $this->request->getpost('pr_041');
        $data['pr_042'] = $this->request->getpost('pr_042');
        $data['pr_043'] = $this->request->getpost('pr_043');
        $data['pr_044'] = $this->request->getpost('pr_044');
        $data['pr_045'] = $this->request->getpost('pr_045');
        $data['pr_046'] = $this->request->getpost('pr_046');
        $data['pr_047'] = $this->request->getpost('pr_047');
        $data['pr_048'] = $this->request->getpost('pr_048');
        $data['pr_049'] = $this->request->getpost('pr_049');
        $data['pr_050'] = $this->request->getpost('pr_050');
        $data['pr_051'] = $this->request->getpost('pr_051');
        $data['pr_052'] = $this->request->getpost('pr_052');
        $data['pr_053'] = $this->request->getpost('pr_053');
        $data['pr_054'] = $this->request->getpost('pr_054');
        $data['pr_055'] = $this->request->getpost('pr_055');
        $data['pr_056'] = $this->request->getpost('pr_056');
        $data['pr_057'] = $this->request->getpost('pr_057');
        $data['pr_058'] = $this->request->getpost('pr_058');
        $data['pr_059'] = $this->request->getpost('pr_059');
        $data['pr_060'] = $this->request->getpost('pr_060');
        $data['pr_061'] = $this->request->getpost('pr_061');
        $data['pr_062'] = $this->request->getpost('pr_062');
        $data['pr_063'] = $this->request->getpost('pr_063');
        $data['pr_064'] = $this->request->getpost('pr_064');
        $data['pr_065'] = $this->request->getpost('pr_065');
        $data['pr_066'] = $this->request->getpost('pr_066');
        $data['pr_067'] = $this->request->getpost('pr_067');
        $data['pr_068'] = $this->request->getpost('pr_068');
        $data['pr_069'] = $this->request->getpost('pr_069');
        $data['pr_070'] = $this->request->getpost('pr_070');
        $data['pr_071'] = $this->request->getpost('pr_071');
        $data['pr_072'] = $this->request->getpost('pr_072');
        $data['pr_073'] = $this->request->getpost('pr_073');
        $data['pr_074'] = $this->request->getpost('pr_074');
        $data['pr_075'] = $this->request->getpost('pr_075');
        $data['pr_076'] = $this->request->getpost('pr_076');
        $data['pr_077'] = $this->request->getpost('pr_077');
        $data['pr_078'] = $this->request->getpost('pr_078');
        $data['pr_079'] = $this->request->getpost('pr_079');
        $data['pr_080'] = $this->request->getpost('pr_080');
        $data['pr_081'] = $this->request->getpost('pr_081');
        $data['pr_082'] = $this->request->getpost('pr_082');
        $data['pr_083'] = $this->request->getpost('pr_083');
        $data['pr_084'] = $this->request->getpost('pr_084');
        $data['pr_085'] = $this->request->getpost('pr_085');
        $data['pr_086'] = $this->request->getpost('pr_086');
        $data['pr_087'] = $this->request->getpost('pr_087');
        $data['pr_088'] = $this->request->getpost('pr_088');
        $data['pr_089'] = $this->request->getpost('pr_089');
        $data['pr_090'] = $this->request->getpost('pr_090');
        $data['pr_091'] = $this->request->getpost('pr_091');
        $data['pr_092'] = $this->request->getpost('pr_092');
        $data['pr_093'] = $this->request->getpost('pr_093');
        $data['pr_094'] = $this->request->getpost('pr_094');
        $data['pr_095'] = $this->request->getpost('pr_095');
        $data['pr_096'] = $this->request->getpost('pr_096');
        $data['pr_097'] = $this->request->getpost('pr_097');
        $data['pr_098'] = $this->request->getpost('pr_098');
        $data['pr_099'] = $this->request->getpost('pr_099');
        $data['pr_100'] = $this->request->getpost('pr_100');
        $data['pr_101'] = $this->request->getpost('pr_101');
        $data['pr_102'] = $this->request->getpost('pr_102');
        $data['pr_103'] = $this->request->getpost('pr_103');
        $data['pr_104'] = $this->request->getpost('pr_104');
        $data['pr_105'] = $this->request->getpost('pr_105');
        $data['pr_106'] = $this->request->getpost('pr_106');
        $data['pr_107'] = $this->request->getpost('pr_107');
        $data['pr_108'] = $this->request->getpost('pr_108');
        $data['pr_109'] = $this->request->getpost('pr_109');
        $data['pr_110'] = $this->request->getpost('pr_110');
        $data['pr_111'] = $this->request->getpost('pr_111');
        $data['pr_112'] = $this->request->getpost('pr_112');
        $data['pr_113'] = $this->request->getpost('pr_113');
        $data['pr_114'] = $this->request->getpost('pr_114');
        $data['pr_115'] = $this->request->getpost('pr_115');
        $data['pr_116'] = $this->request->getpost('pr_116');
        $data['pr_117'] = $this->request->getpost('pr_117');
        $data['pr_118'] = $this->request->getpost('pr_118');
        $data['pr_119'] = $this->request->getpost('pr_119');
        $data['pr_120'] = $this->request->getpost('pr_120');
        $data['pr_121'] = $this->request->getpost('pr_121');
        $data['pr_122'] = $this->request->getpost('pr_122');
        $data['pr_123'] = $this->request->getpost('pr_123');
        $data['pr_124'] = $this->request->getpost('pr_124');
        $data['pr_125'] = $this->request->getpost('pr_125');
        $data['pr_126'] = $this->request->getpost('pr_126');
        $data['pr_127'] = $this->request->getpost('pr_127');
        $data['pr_128'] = $this->request->getpost('pr_128');
        $data['pr_129'] = $this->request->getpost('pr_129');
        $data['pr_130'] = $this->request->getpost('pr_130');
        $data['perujuk'] = $this->request->getpost('perujuk');
        $data['alamat_perujuk'] = $this->request->getpost('alamat_perujuk');
        $data['pemeriksaan_lain'] = $this->request->getpost('pemeriksaan_lain');
        $data['iscito'] = $this->request->getpost('iscito');
        $data['pr_131'] = $this->request->getpost('pr_131');
        $data['pr_132'] = $this->request->getpost('pr_132');
        $data['pr_133'] = $this->request->getpost('pr_133');
        $data['pr_134'] = $this->request->getpost('pr_134');
        $data['pr_135'] = $this->request->getpost('pr_135');
        $data['pr_136'] = $this->request->getpost('pr_136');
        $data['pr_137'] = $this->request->getpost('pr_137');
        $data['pr_138'] = $this->request->getpost('pr_138');
        $data['pr_139'] = $this->request->getpost('pr_139');
        $data['pr_140'] = $this->request->getpost('pr_140');
        $data['pr_141'] = $this->request->getpost('pr_141');
        $data['pr_142'] = $this->request->getpost('pr_142');
        $data['pr_143'] = $this->request->getpost('pr_143');
        $data['pr_144'] = $this->request->getpost('pr_144');
        $data['pr_145'] = $this->request->getpost('pr_145');
        $data['pr_146'] = $this->request->getpost('pr_146');
        $data['pr_147'] = $this->request->getpost('pr_147');
        $data['pr_148'] = $this->request->getpost('pr_148');
        $data['pr_149'] = $this->request->getpost('pr_149');
        $data['pr_150'] = $this->request->getpost('pr_150');
        $data['pr_151'] = $this->request->getpost('pr_151');
        $data['pr_152'] = $this->request->getpost('pr_152');
        $data['pr_153'] = $this->request->getpost('pr_153');
        $data['pr_154'] = $this->request->getpost('pr_154');
        $data['pr_155'] = $this->request->getpost('pr_155');
        $data['pr_156'] = $this->request->getpost('pr_156');
        $data['pr_157'] = $this->request->getpost('pr_157');
        $data['pr_158'] = $this->request->getpost('pr_158');
        $data['pr_159'] = $this->request->getpost('pr_159');
        $data['pr_160'] = $this->request->getpost('pr_160');
        $data['pr_161'] = $this->request->getpost('pr_161');
        $data['pr_162'] = $this->request->getpost('pr_162');
        $data['pr_163'] = $this->request->getpost('pr_163');
        $data['pr_164'] = $this->request->getpost('pr_164');
        $data['pr_165'] = $this->request->getpost('pr_165');
        $data['pr_166'] = $this->request->getpost('pr_166');
        $data['pr_167'] = $this->request->getpost('pr_167');
        $data['pr_168'] = $this->request->getpost('pr_168');
        $data['pr_169'] = $this->request->getpost('pr_169');
        $data['pr_170'] = $this->request->getpost('pr_170');
        $data['pr_171'] = $this->request->getpost('pr_171');
        $data['pr_172'] = $this->request->getpost('pr_172');
        $data['pr_173'] = $this->request->getpost('pr_173');
        $data['pr_174'] = $this->request->getpost('pr_174');
        $data['pr_175'] = $this->request->getpost('pr_175');
        $data['pr_176'] = $this->request->getpost('pr_176');
        $data['pr_177'] = $this->request->getpost('pr_177');
        $data['pr_178'] = $this->request->getpost('pr_178');
        $data['pr_179'] = $this->request->getpost('pr_179');
        $data['pr_180'] = $this->request->getpost('pr_180');
        $data['pr_181'] = $this->request->getpost('pr_181');
        $data['pr_182'] = $this->request->getpost('pr_182');
        $data['pr_183'] = $this->request->getpost('pr_183');
        $data['pr_184'] = $this->request->getpost('pr_184');
        $data['pr_185'] = $this->request->getpost('pr_185');
        $data['pr_186'] = $this->request->getpost('pr_186');
        $data['pr_187'] = $this->request->getpost('pr_187');
        $data['pr_188'] = $this->request->getpost('pr_188');
        $data['pr_189'] = $this->request->getpost('pr_189');
        $data['pr_190'] = $this->request->getpost('pr_190');
        $data['pr_191'] = $this->request->getpost('pr_191');
        $data['pr_192'] = $this->request->getpost('pr_192');
        $data['pr_193'] = $this->request->getpost('pr_193');
        $data['pr_194'] = $this->request->getpost('pr_194');
        $data['pr_195'] = $this->request->getpost('pr_195');
        $data['pr_196'] = $this->request->getpost('pr_196');
        $data['pr_197'] = $this->request->getpost('pr_197');
        $data['pr_198'] = $this->request->getpost('pr_198');
        $data['pr_199'] = $this->request->getpost('pr_199');
        $data['pr_200'] = $this->request->getpost('pr_200');
        $data['no_specimen'] = $this->request->getpost('no_specimen');
        $data['pr_201'] = $this->request->getpost('pr_201');
        $data['pr_202'] = $this->request->getpost('pr_202');
        $data['pr_203'] = $this->request->getpost('pr_203');
        $data['pr_204'] = $this->request->getpost('pr_204');
        $data['pr_205'] = $this->request->getpost('pr_205');
        $data['pr_206'] = $this->request->getpost('pr_206');
        $data['pr_207'] = $this->request->getpost('pr_207');
        $data['pr_208'] = $this->request->getpost('pr_208');
        $data['pr_209'] = $this->request->getpost('pr_209');
        $data['pr_210'] = $this->request->getpost('pr_210');
        $data['pr_211'] = $this->request->getpost('pr_211');
        $data['pr_212'] = $this->request->getpost('pr_212');
        $data['pr_213'] = $this->request->getpost('pr_213');
        $data['pr_214'] = $this->request->getpost('pr_214');
        $data['pr_215'] = $this->request->getpost('pr_215');
        $data['pr_216'] = $this->request->getpost('pr_216');
        $data['pr_217'] = $this->request->getpost('pr_217');
        $data['pr_218'] = $this->request->getpost('pr_218');
        $data['pr_219'] = $this->request->getpost('pr_219');
        $data['pr_220'] = $this->request->getpost('pr_220');
        $data['pr_221'] = $this->request->getpost('pr_221');
        $data['pr_222'] = $this->request->getpost('pr_222');
        $data['pr_223'] = $this->request->getpost('pr_223');
        $data['pr_224'] = $this->request->getpost('pr_224');
        $data['pr_225'] = $this->request->getpost('pr_225');
        $data['pr_226'] = $this->request->getpost('pr_226');
        $data['pr_227'] = $this->request->getpost('pr_227');
        $data['pr_228'] = $this->request->getpost('pr_228');
        $data['pr_229'] = $this->request->getpost('pr_229');
        $data['pr_230'] = $this->request->getpost('pr_230');
        $data['pr_231'] = $this->request->getpost('pr_231');
        $data['pr_232'] = $this->request->getpost('pr_232');
        $data['pr_233'] = $this->request->getpost('pr_233');
        $data['pr_234'] = $this->request->getpost('pr_234');
        $data['pr_235'] = $this->request->getpost('pr_235');
        $data['pr_236'] = $this->request->getpost('pr_236');
        $data['pr_237'] = $this->request->getpost('pr_237');
        $data['pr_238'] = $this->request->getpost('pr_238');
        $data['pr_239'] = $this->request->getpost('pr_239');
        $data['pr_240'] = $this->request->getpost('pr_240');
        $data['pr_251'] = $this->request->getpost('pr_251');
        $data['pr_252'] = $this->request->getpost('pr_252');
        $data['pr_253'] = $this->request->getpost('pr_253');
        $data['pr_254'] = $this->request->getpost('pr_254');
        $data['pr_255'] = $this->request->getpost('pr_255');
        $data['pr_256'] = $this->request->getpost('pr_256');
        $data['pr_257'] = $this->request->getpost('pr_257');
        $data['pr_258'] = $this->request->getpost('pr_258');
        $data['pr_259'] = $this->request->getpost('pr_259');
        $data['pr_260'] = $this->request->getpost('pr_260');
        $data['pr_261'] = $this->request->getpost('pr_261');
        $data['pr_262'] = $this->request->getpost('pr_262');
        $data['pr_263'] = $this->request->getpost('pr_263');
        $data['pr_264'] = $this->request->getpost('pr_264');
        $data['pr_265'] = $this->request->getpost('pr_265');
        $data['pr_266'] = $this->request->getpost('pr_266');
        $data['pr_267'] = $this->request->getpost('pr_267');
        $data['pr_268'] = $this->request->getpost('pr_268');
        $data['pr_269'] = $this->request->getpost('pr_269');
        $data['pr_270'] = $this->request->getpost('pr_270');
        $data['pr_241'] = $this->request->getpost('pr_241');
        $data['pr_242'] = $this->request->getpost('pr_242');
        $data['pr_243'] = $this->request->getpost('pr_243');
        $data['pr_244'] = $this->request->getpost('pr_244');
        $data['pr_245'] = $this->request->getpost('pr_245');
        $data['pr_246'] = $this->request->getpost('pr_246');
        $data['pr_247'] = $this->request->getpost('pr_247');
        $data['pr_248'] = $this->request->getpost('pr_248');
        $data['pr_249'] = $this->request->getpost('pr_249');
        $data['pr_250'] = $this->request->getpost('pr_250');

        $visit = $this->request->getPost('visit');
        $visit = json_decode((string)$visit, true);
        $pasien = $this->request->getPost('pasien');
        $pasien = json_decode((string)$pasien, true);

        // return json_encode($pasien);


        if ($data['vactination_id'] == null) {
            $db = db_connect();
            $select = $db->query("select cast(year(getdate()) as varchar(4)) +
                right(cast((month(getdate()) + 100) as varchar(3)),2)+
                right(cast((day(getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3) as id")->getResultArray();
            // $vactination_id = $select[0]['id'];
            $data['vactination_id'] = $select[0]['id'];
        }

        // return json_encode($data['vactination_id']);
        // $data['vactination_id'] = '202401121107123';

        $pr = new PasienRadiologiModel();

        $pr->save($data, true);

        return view('admin\patient\profilemodul\subprofilemodul\radonline', ['visit' => $visit, 'pasien' => $pasien, 'rad' => $data]);
    }
    public function getListRequestRad()
    {
        $body = $this->request->getBody();
        $body = json_decode($body, true);
        $visitId = $body["visit"];
        $noregistration = $body["nomor"];
        // $noregistration = $this->request->getPost("no_registration");
        // return json_encode($visitId);

        $pl = new PasienRadiologiModel();
        $lab = $this->lowerKey($pl->where("visit_id", $visitId)->where("no_registration", $noregistration)->findAll());

        return json_encode($lab);
    }
    public function getRadOnlineRequest($visit, $vactinationId)
    {
        $pl = new PasienRadiologiModel();
        $data = $this->lowerKey($pl->find($vactinationId));
        $visit = base64_decode($visit);
        $visit = json_decode($visit, true);
        $st = new StatusPasienModel();
        $status = $st->select("name_of_status_pasien")->find($visit['status_pasien_id']);
        $visit['name_of_status_pasien'] = $status['name_of_status_pasien'];
        $p = new PasienModel();
        $pasien = $this->lowerKey($p->find($visit['no_registration']));
        return view('admin\patient\profilemodul\subprofilemodul\labonline', ['visit' => $visit, 'pasien' => $pasien, 'lab' => $data]);
    }

    public function rmj2($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rmj2_1($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {

            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            // return $visit;
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_asmed_anak where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            // return json_encode($select[0]['doctor']);
            if (isset($select[0])) {
                // Define the path to the signature image
                $signaturePathDokter = $select[0]['clinical_indication'];

                // Check if the signature image file exists
                if (file_exists($signaturePathDokter)) {
                    // Read the signature image
                    $signatureData = file_get_contents($signaturePathDokter);

                    // Convert the image data to base64 format
                    $signatureBase64 = base64_encode($signatureData);
                    $select[0]['clinical_indication'] = $signatureBase64;

                    // Load the display signature view with the signature data
                } else {
                    // If the signature image file doesn't exist, show an error message
                    // return "<p>Signature not found!</p>";
                }
                $signaturePathPasien = $select[0]['target_of_therapy'];

                // Check if the signature image file exists
                if (file_exists($signaturePathPasien)) {
                    // Read the signature image
                    $signatureData = file_get_contents($signaturePathPasien);

                    // Convert the image data to base64 format
                    $signatureBase64 = base64_encode($signatureData);
                    $select[0]['target_of_therapy'] = $signatureBase64;

                    // Load the display signature view with the signature data
                } else {
                    // If the signature image file doesn't exist, show an error message
                    // return "<p>Signature not found!</p>";
                }
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-1.php", [
                    "visit" => $visit,
                    "val" => $select[0],
                    'title' => 'ASSESMEN MEDIS PASIEN RAWAT JALAN ANAK'
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-1.php", [
                    "visit" => $visit,
                    'title' => 'ASSESMEN MEDIS PASIEN RAWAT JALAN ANAK'
                ]);
            }
        }
        if ($this->request->is('post')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $body = $this->request->getPost();


            $signatureDokter = $this->request->getPost("ttd");
            $data = explode(',', (string)$signatureDokter);
            $encodedDataDokter = $data[1];
            $decodedDataDokter = base64_decode($encodedDataDokter);
            $signaturePathDokter = WRITEPATH . 'uploads/signatures/';
            if (!is_dir($signaturePathDokter)) {
                mkdir($signaturePathDokter, 0777, true);
            }
            $filenameDokter = uniqid('signature_') . '.png';
            $fullPathDokter = $signaturePathDokter . $filenameDokter;
            if (file_put_contents($fullPathDokter, $decodedDataDokter)) {
                // Signature saved successfully
                // You can return any response as needed, for example, a success message
                // return $this->response->setJSON(['success' => true, 'filename' => $filename]);
            } else {
                // Failed to save the signature image
                // You can return any response as needed, for example, an error message
                return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
            }

            $signaturePasien = $this->request->getPost("ttd_1");
            $data = explode(',', (string)$signaturePasien);
            $encodedDataPasien = $data[1];
            $decodedDataPasien = base64_decode($encodedDataPasien);
            $signaturePathPasien = WRITEPATH . 'uploads/signatures/';
            if (!is_dir($signaturePathPasien)) {
                mkdir($signaturePathPasien, 0777, true);
            }
            $filenamePasien = uniqid('signature_') . '.png';
            $fullPathPasien = $signaturePathPasien . $filenamePasien;
            if (file_put_contents($fullPathPasien, $decodedDataPasien)) {
                // Signature saved successfully
                // You can return any response as needed, for example, a success message
                // return $this->response->setJSON(['success' => true, 'filename' => $filename]);
            } else {
                // Failed to save the signature image
                // You can return any response as needed, for example, an error message
                return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
            }
            // return json_encode($encodedData);
            $body_id = $this->request->getPost("body_id");
            $org_unit_code = $this->request->getPost("org_unit_code");
            $pasien_diagnosa_id = $this->request->getPost("pasien_diagnosa_id");
            $diagnosa_id = $this->request->getPost("diagnosa_id");
            $no_registration = $this->request->getPost("no_registration");
            $visit_id = $this->request->getPost("visit_id");
            $bill_id = $this->request->getPost("bill_id");
            $clinic_id = $this->request->getPost("clinic_id");
            $class_room_id = $this->request->getPost("class_room_id");
            $in_date = $this->request->getPost("in_date");
            $exit_date = $this->request->getPost("exit_date");
            $keluar_id = $this->request->getPost("keluar_id");
            $examination_date = $this->request->getPost("examination_date");
            $employee_id = $this->request->getPost("employee_id");
            $description = $this->request->getPost("description");
            $modified_date = $this->request->getPost("modified_date");
            $modified_by = $this->request->getPost("modified_by");
            $modified_from = $this->request->getPost("modified_from");
            $status_pasien_id = $this->request->getPost("status_pasien_id");
            $ageyear = $this->request->getPost("ageyear");
            $agemonth = $this->request->getPost("agemonth");
            $ageday = $this->request->getPost("ageday");
            $thename = $this->request->getPost("thename");
            $theaddress = $this->request->getPost("theaddress");
            $theid = $this->request->getPost("theid");
            $isrj = $this->request->getPost("isrj");
            $gender = $this->request->getPost("gender");
            $doctor = $this->request->getPost("doctor");
            $kal_id = $this->request->getPost("kal_id");
            $petugas_id = $this->request->getPost("petugas_id");
            $petugas = $this->request->getPost("petugas");
            $account_id = $this->request->getPost("account_id");
            $cpoe_emr_rel_id = $this->request->getPost("cpoe_emr_rel_id");
            $cpoe_id = $this->request->getPost("cpoe_id");
            $episode_categ = $this->request->getPost("episode_categ");
            $date_order = $this->request->getPost("date_order");
            $patient_id = $this->request->getPost("patient_id");
            $patient_code = $this->request->getPost("patient_code");
            $patient_age = $this->request->getPost("patient_age");
            $patient_gender = $this->request->getPost("patient_gender");
            $colorbar = $this->request->getPost("colorbar");
            $physician_id = $this->request->getPost("physician_id");
            $physician_speciality = $this->request->getPost("physician_speciality");
            $payment_method = $this->request->getPost("payment_method");
            $pricelist_id = $this->request->getPost("pricelist_id");
            $currency_id = $this->request->getPost("currency_id");
            $assessment_type = $this->request->getPost("assessment_type");
            $is_out_cppt = $this->request->getPost("is_out_cppt");
            $soap_subjective = $this->request->getPost("soap_subjective");
            $soap_objective = $this->request->getPost("soap_objective");
            $ana_main_complaint = $this->request->getPost("ana_main_complaint");
            $ana_auto_current_disease_history = $this->request->getPost("ana_auto_current_disease_history");
            $ana_past_disease_history = $this->request->getPost("ana_past_disease_history");
            $ana_family_disease_history = $this->request->getPost("ana_family_disease_history");
            $ana_allergy_history_non_drugs = $this->request->getPost("ana_allergy_history_non_drugs");
            $ana_allergy_history_drugs = $this->request->getPost("ana_allergy_history_drugs");
            $ana_pregnancy_childbirth_history = $this->request->getPost("ana_pregnancy_childbirth_history");
            $ana_diet_history = $this->request->getPost("ana_diet_history");
            $ana_imun_history = $this->request->getPost("ana_imun_history");
            $ana_drugs_consumed = $this->request->getPost("ana_drugs_consumed");
            $pf_vital_sign_bp = $this->request->getPost("pf_vital_sign_bp");
            $pf_vital_sign_n = $this->request->getPost("pf_vital_sign_n");
            $pf_vital_sign_s = $this->request->getPost("pf_vital_sign_s");
            $pf_vital_sign_rr = $this->request->getPost("pf_vital_sign_rr");
            $pf_vital_sign_weight = $this->request->getPost("pf_vital_sign_weight");
            $pf_vital_sign_height = $this->request->getPost("pf_vital_sign_height");
            $pf_vital_sign_spo2 = $this->request->getPost("pf_vital_sign_spo2");
            $pf_vital_sign_bmi = $this->request->getPost("pf_vital_sign_bmi");
            $pf_vital_sign_hc = $this->request->getPost("pf_vital_sign_hc");
            $pf_gcs_type = $this->request->getPost("pf_gcs_type");
            $pf_gcs_e = $this->request->getPost("pf_gcs_e");
            $pf_gcs_v = $this->request->getPost("pf_gcs_v");
            $pf_gcs_m = $this->request->getPost("pf_gcs_m");
            $pf_pgcs_e = $this->request->getPost("pf_pgcs_e");
            $pf_pgcs_v_type = $this->request->getPost("pf_pgcs_v_type");
            $pf_pgcs_v = $this->request->getPost("pf_pgcs_v");
            $pf_pgcs_v_non = $this->request->getPost("pf_pgcs_v_non");
            $pf_pgcs_m = $this->request->getPost("pf_pgcs_m");
            $pf_general_condition = $this->request->getPost("pf_general_condition");
            $pf_cranium = $this->request->getPost("pf_cranium");
            $pf_eyes = $this->request->getPost("pf_eyes");
            $pf_nose = $this->request->getPost("pf_nose");
            $pf_mouth = $this->request->getPost("pf_mouth");
            $pf_tooth = $this->request->getPost("pf_tooth");
            $pf_neck = $this->request->getPost("pf_neck");
            $pf_thorax = $this->request->getPost("pf_thorax");
            $pf_thorax_image = $this->request->getPost("pf_thorax_image");
            $pf_heart = $this->request->getPost("pf_heart");
            $pf_heart_image = $this->request->getPost("pf_heart_image");
            $pf_lungs = $this->request->getPost("pf_lungs");
            $pf_abdomen = $this->request->getPost("pf_abdomen");
            $pf_abdomen_image = $this->request->getPost("pf_abdomen_image");
            $pf_hepar = $this->request->getPost("pf_hepar");
            $pf_lien = $this->request->getPost("pf_lien");
            $pf_kidney = $this->request->getPost("pf_kidney");
            $pf_genitalia = $this->request->getPost("pf_genitalia");
            $pf_upper_extremity = $this->request->getPost("pf_upper_extremity");
            $pf_lower_extremity = $this->request->getPost("pf_lower_extremity");
            $additional_physical_exam = $this->request->getPost("additional_physical_exam");
            $cause_of_injury_poisoning = $this->request->getPost("cause_of_injury_poisoning");
            $nursing_problem = $this->request->getPost("nursing_problem");
            $medical_problem = $this->request->getPost("medical_problem");
            $care_and_therapy_plan = $this->request->getPost("care_and_therapy_plan");
            $follow_up_plan = $this->request->getPost("follow_up_plan");
            $rtj_control = $this->request->getPost("rtj_control");
            $rtj_time_of_death_emergency = $this->request->getPost("rtj_time_of_death_emergency");
            $rtj_inpatient_indication = $this->request->getPost("rtj_inpatient_indication");
            $rtj_inpatient_dpjp = $this->request->getPost("rtj_inpatient_dpjp");
            $rtj_inpatient_classes = $this->request->getPost("rtj_inpatient_classes");
            $rtj_inpatient_ward = $this->request->getPost("rtj_inpatient_ward");
            $rtj_inpatient_room = $this->request->getPost("rtj_inpatient_room");
            $rtj_inpatient_bed = $this->request->getPost("rtj_inpatient_bed");
            $rtj_referenced = $this->request->getPost("rtj_referenced");
            $rtj_referenced_to = $this->request->getPost("rtj_referenced_to");
            $rtj_referenced_phys = $this->request->getPost("rtj_referenced_phys");
            $rtj_referenced_based_on = $this->request->getPost("rtj_referenced_based_on");
            $rtj_referenced_deliver_by = $this->request->getPost("rtj_referenced_deliver_by");
            $patient_education = $this->request->getPost("patient_education");
            $if_patient_family = $this->request->getPost("if_patient_family");
            $if_can_not_give_edu = $this->request->getPost("if_can_not_give_edu");
            $explanation_receipient_name = $this->request->getPost("explanation_receipient_name");
            $doctor_name = $this->request->getPost("doctor_name");
            $paraf_doctor = $this->request->getPost("paraf_doctor");
            $episode_id = $this->request->getPost("episode_id");
            $app_nmbr = $this->request->getPost("app_nmbr");
            $code = $this->request->getPost("code");
            $proc_order_id = $this->request->getPost("proc_order_id");
            $open_header_flag = $this->request->getPost("open_header_flag");
            $hide_action_button = $this->request->getPost("hide_action_button");
            $lab_order_id = $this->request->getPost("lab_order_id");
            $physio_order_id = $this->request->getPost("physio_order_id");
            $radio_order_id = $this->request->getPost("radio_order_id");
            $is_cppt_leads = $this->request->getPost("is_cppt_leads");
            $refphysician_id = $this->request->getPost("refphysician_id");
            $inpatient_physician_speciality = $this->request->getPost("inpatient_physician_speciality");
            $is_fast_track = $this->request->getPost("is_fast_track");
            $is_cito = $this->request->getPost("is_cito");
            $is_rad_pending = $this->request->getPost("is_rad_pending");
            $rad_pending_order = $this->request->getPost("rad_pending_order");
            $is_lab_pending = $this->request->getPost("is_lab_pending");
            $lab_pending_order = $this->request->getPost("lab_pending_order");
            $is_phy_pending = $this->request->getPost("is_phy_pending");
            $phy_pending_order = $this->request->getPost("phy_pending_order");
            $has_drug_allergy = $this->request->getPost("has_drug_allergy");
            $state = $this->request->getPost("state");
            $is_signed = $this->request->getPost("is_signed");
            $standing_order = $this->request->getPost("standing_order");
            $is_locked = $this->request->getPost("is_locked");
            $text_diagnosis = $this->request->getPost("text_diagnosis");
            $last_notebook = $this->request->getPost("last_notebook");
            $inv_vendor_lab_id = $this->request->getPost("inv_vendor_lab_id");
            $lab_medical_checkup = $this->request->getPost("lab_medical_checkup");
            $inv_vendor_radio_id = $this->request->getPost("inv_vendor_radio_id");
            $inv_vendor_phy_id = $this->request->getPost("inv_vendor_phy_id");
            $inv_vendor_id = $this->request->getPost("inv_vendor_id");
            $inv_vendor_nurse_id = $this->request->getPost("inv_vendor_nurse_id");
            $inv_vendor_midwife_id = $this->request->getPost("inv_vendor_midwife_id");
            $has_pain_scale = $this->request->getPost("has_pain_scale");
            $pain_scale_type = $this->request->getPost("pain_scale_type");
            $numeric_scale = $this->request->getPost("numeric_scale");
            $wong_baker_scale = $this->request->getPost("wong_baker_scale");
            $cpot_ekspresi_wajah = $this->request->getPost("cpot_ekspresi_wajah");
            $cpot_gerakan_tubuh = $this->request->getPost("cpot_gerakan_tubuh");
            $cpot_options = $this->request->getPost("cpot_options");
            $cpot_aktivasi_ventilator = $this->request->getPost("cpot_aktivasi_ventilator");
            $cpot_berbicara = $this->request->getPost("cpot_berbicara");
            $cpot_ketegangan_otot = $this->request->getPost("cpot_ketegangan_otot");
            $nips_ekspresi_wajah = $this->request->getPost("nips_ekspresi_wajah");
            $nips_tangisan = $this->request->getPost("nips_tangisan");
            $nips_pola_nafas = $this->request->getPost("nips_pola_nafas");
            $nips_tungkai = $this->request->getPost("nips_tungkai");
            $nips_tingkat_kesadaran = $this->request->getPost("nips_tingkat_kesadaran");
            $painad_pernafasan = $this->request->getPost("painad_pernafasan");
            $painad_vokalisasi_negatif = $this->request->getPost("painad_vokalisasi_negatif");
            $painad_ekspresi_wajah = $this->request->getPost("painad_ekspresi_wajah");
            $painad_bahasa_tubuh = $this->request->getPost("painad_bahasa_tubuh");
            $painad_konsabilitas = $this->request->getPost("painad_konsabilitas");
            $flacc_wajah = $this->request->getPost("flacc_wajah");
            $flacc_kaki = $this->request->getPost("flacc_kaki");
            $flacc_aktivitas = $this->request->getPost("flacc_aktivitas");
            $flacc_menangis = $this->request->getPost("flacc_menangis");
            $flacc_konsabilitas = $this->request->getPost("flacc_konsabilitas");
            $has_fall_risk = $this->request->getPost("has_fall_risk");
            $fall_risk_desc = $this->request->getPost("fall_risk_desc");
            $fall_risk_type = $this->request->getPost("fall_risk_type");
            $hd_usia = $this->request->getPost("hd_usia");
            $hd_jenis_kelamin = $this->request->getPost("hd_jenis_kelamin");
            $hd_diagnosa = $this->request->getPost("hd_diagnosa");
            $hd_gangguan_kognitif = $this->request->getPost("hd_gangguan_kognitif");
            $hd_faktor_lingkungan = $this->request->getPost("hd_faktor_lingkungan");
            $hd_respon_pembedahan_sedasi_anestesi = $this->request->getPost("hd_respon_pembedahan_sedasi_anestesi");
            $hd_respon_penggunaan_medikamentosa = $this->request->getPost("hd_respon_penggunaan_medikamentosa");
            $fm_riwayat_jatuh = $this->request->getPost("fm_riwayat_jatuh");
            $fm_diagnosis_sekunder = $this->request->getPost("fm_diagnosis_sekunder");
            $fm_menggunakan_alat_bantu = $this->request->getPost("fm_menggunakan_alat_bantu");
            $fm_menggunakan_infuse_heparine = $this->request->getPost("fm_menggunakan_infuse_heparine");
            $fm_gaya_berjalan = $this->request->getPost("fm_gaya_berjalan");
            $fm_status_mental = $this->request->getPost("fm_status_mental");
            $fm_medikasi = $this->request->getPost("fm_medikasi");
            $note_subjective = $this->request->getPost("note_subjective");
            $note_objective = $this->request->getPost("note_objective");
            $note_obat_confirmed = $this->request->getPost("note_obat_confirmed");
            $note_lab_confirmed = $this->request->getPost("note_lab_confirmed");
            $note_rad_confirmed = $this->request->getPost("note_rad_confirmed");
            $note_phy_confirmed = $this->request->getPost("note_phy_confirmed");
            $note_proc_confirmed = $this->request->getPost("note_proc_confirmed");
            $additional_note = $this->request->getPost("additional_note");
            $final_note = $this->request->getPost("final_note");
            $create_uid = $this->request->getPost("create_uid");
            $create_date = $this->request->getPost("create_date");
            $write_uid = $this->request->getPost("write_uid");
            $write_date = $this->request->getPost("write_date");
            $patient_family_name = $this->request->getPost("patient_family_name");
            $is_applicant_signed = $this->request->getPost("is_applicant_signed");
            $applicant_sign = $this->request->getPost("applicant_sign");
            $rtj_inpatient_location = $this->request->getPost("rtj_inpatient_location");
            $rtj_referenced_dept = $this->request->getPost("rtj_referenced_dept");
            $rtj_inpatient_standing_order = $this->request->getPost("rtj_inpatient_standing_order");
            $rtj_is_control = $this->request->getPost("rtj_is_control");
            $rtj_control_date = $this->request->getPost("rtj_control_date");
            $rtj_control_reason = $this->request->getPost("rtj_control_reason");
            $age_category = $this->request->getPost("age_category");
            $month_count = $this->request->getPost("month_count");
            $rtj_outpatient_type = $this->request->getPost("rtj_outpatient_type");
            $rtj_referenced_based_other = $this->request->getPost("rtj_referenced_based_other");
            $rtj_rujuk_type = $this->request->getPost("rtj_rujuk_type");
            $pf_ears = $this->request->getPost("pf_ears");
            $coass_residence_sign = $this->request->getPost("coass_residence_sign");
            $is_coas_signed = $this->request->getPost("is_coas_signed");
            $coas_signed_datetime = $this->request->getPost("coas_signed_datetime");
            $rtj_internal_ref_pysician_id = $this->request->getPost("rtj_internal_ref_pysician_id");
            $rtj_internal_ref_notes = $this->request->getPost("rtj_internal_ref_notes");
            $soap_planning = $this->request->getPost("soap_planning");
            $is_consul_discount = $this->request->getPost("is_consul_discount");
            $sign_datetime = $this->request->getPost("sign_datetime");
            $clinical_indication = $this->request->getPost("clinical_indication");
            $target_of_therapy = $this->request->getPost("target_of_therapy");
            $rtj_out_instruction = $this->request->getPost("rtj_out_instruction");
            $set_all_dbn = $this->request->getPost("set_all_dbn");
            $education_material = $this->request->getPost("education_material");
            $message_main_attachment_id = $this->request->getPost("message_main_attachment_id");
            $rtj_inpatient_service_needs = $this->request->getPost("rtj_inpatient_service_needs");
            $trial437 = $this->request->getPost("trial437");


            $isNewKunj = false;
            if ($body['body_id'] == null || $body['body_id'] == '') {
                $db = db_connect();
                $select = $db->query("select cast(year(getdate()) as varchar(4)) +
                right(cast((month(getdate()) + 100) as varchar(3)),2)+
                right(cast((day(getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3) as id")->getResultArray();
                // $vactination_id = $select[0]['id'];
                $body_id = $select[0]['id'];
                $isNewKunj = true;
            }
            // return json_encode($body_id);

            $db = new RMJ21Model();
            $data = [
                "body_id" => $body_id,
                "org_unit_code" => $org_unit_code,
                "pasien_diagnosa_id" => $pasien_diagnosa_id,
                "diagnosa_id" => $diagnosa_id,
                "no_registration" => $no_registration,
                "visit_id" => $visit_id,
                "bill_id" => $bill_id,
                "clinic_id" => $clinic_id,
                "class_room_id" => $class_room_id,
                "in_date" => $in_date,
                "exit_date" => $exit_date,
                "keluar_id" => $keluar_id,
                "examination_date" => $examination_date,
                "employee_id" => $employee_id,
                "description" => $description,
                "modified_date" => $modified_date,
                "modified_by" => $modified_by,
                "modified_from" => $modified_from,
                "status_pasien_id" => $status_pasien_id,
                "ageyear" => $ageyear,
                "agemonth" => $agemonth,
                "ageday" => $ageday,
                "thename" => $thename,
                "theaddress" => $theaddress,
                "theid" => $theid,
                "isrj" => $isrj,
                "gender" => $gender,
                "doctor" => $doctor,
                "kal_id" => $kal_id,
                "petugas_id" => $petugas_id,
                "petugas" => $petugas,
                "account_id" => $account_id,
                "cpoe_emr_rel_id" => $cpoe_emr_rel_id,
                "cpoe_id" => $cpoe_id,
                "episode_categ" => $episode_categ,
                "date_order" => $date_order,
                "patient_id" => $patient_id,
                "patient_code" => $patient_code,
                "patient_age" => $patient_age,
                "patient_gender" => $patient_gender,
                "colorbar" => $colorbar,
                "physician_id" => $physician_id,
                "physician_speciality" => $physician_speciality,
                "payment_method" => $payment_method,
                "pricelist_id" => $pricelist_id,
                "currency_id" => $currency_id,
                "assessment_type" => $assessment_type,
                "is_out_cppt" => $is_out_cppt,
                "soap_subjective" => $soap_subjective,
                "soap_objective" => $soap_objective,
                "ana_main_complaint" => $ana_main_complaint,
                "ana_auto_current_disease_history" => $ana_auto_current_disease_history,
                "ana_past_disease_history" => $ana_past_disease_history,
                "ana_family_disease_history" => $ana_family_disease_history,
                "ana_allergy_history_non_drugs" => $ana_allergy_history_non_drugs,
                "ana_allergy_history_drugs" => $ana_allergy_history_drugs,
                "ana_pregnancy_childbirth_history" => $ana_pregnancy_childbirth_history,
                "ana_diet_history" => $ana_diet_history,
                "ana_imun_history" => $ana_imun_history,
                "ana_drugs_consumed" => $ana_drugs_consumed,
                "pf_vital_sign_bp" => $pf_vital_sign_bp,
                "pf_vital_sign_n" => $pf_vital_sign_n,
                "pf_vital_sign_s" => $pf_vital_sign_s,
                "pf_vital_sign_rr" => $pf_vital_sign_rr,
                "pf_vital_sign_weight" => $pf_vital_sign_weight,
                "pf_vital_sign_height" => $pf_vital_sign_height,
                "pf_vital_sign_spo2" => $pf_vital_sign_spo2,
                "pf_vital_sign_bmi" => $pf_vital_sign_bmi,
                "pf_vital_sign_hc" => $pf_vital_sign_hc,
                "pf_gcs_type" => $pf_gcs_type,
                "pf_gcs_e" => $pf_gcs_e,
                "pf_gcs_v" => $pf_gcs_v,
                "pf_gcs_m" => $pf_gcs_m,
                "pf_pgcs_e" => $pf_pgcs_e,
                "pf_pgcs_v_type" => $pf_pgcs_v_type,
                "pf_pgcs_v" => $pf_pgcs_v,
                "pf_pgcs_v_non" => $pf_pgcs_v_non,
                "pf_pgcs_m" => $pf_pgcs_m,
                "pf_general_condition" => $pf_general_condition,
                "pf_cranium" => $pf_cranium,
                "pf_eyes" => $pf_eyes,
                "pf_nose" => $pf_nose,
                "pf_mouth" => $pf_mouth,
                "pf_tooth" => $pf_tooth,
                "pf_neck" => $pf_neck,
                "pf_thorax" => $pf_thorax,
                "pf_thorax_image" => $pf_thorax_image,
                "pf_heart" => $pf_heart,
                "pf_heart_image" => $pf_heart_image,
                "pf_lungs" => $pf_lungs,
                "pf_abdomen" => $pf_abdomen,
                "pf_abdomen_image" => $pf_abdomen_image,
                "pf_hepar" => $pf_hepar,
                "pf_lien" => $pf_lien,
                "pf_kidney" => $pf_kidney,
                "pf_genitalia" => $pf_genitalia,
                "pf_upper_extremity" => $pf_upper_extremity,
                "pf_lower_extremity" => $pf_lower_extremity,
                "additional_physical_exam" => $additional_physical_exam,
                "cause_of_injury_poisoning" => $cause_of_injury_poisoning,
                "nursing_problem" => $nursing_problem,
                "medical_problem" => $medical_problem,
                "care_and_therapy_plan" => $care_and_therapy_plan,
                "follow_up_plan" => $follow_up_plan,
                "rtj_control" => $rtj_control,
                "rtj_time_of_death_emergency" => $rtj_time_of_death_emergency,
                "rtj_inpatient_indication" => $rtj_inpatient_indication,
                "rtj_inpatient_dpjp" => $rtj_inpatient_dpjp,
                "rtj_inpatient_classes" => $rtj_inpatient_classes,
                "rtj_inpatient_ward" => $rtj_inpatient_ward,
                "rtj_inpatient_room" => $rtj_inpatient_room,
                "rtj_inpatient_bed" => $rtj_inpatient_bed,
                "rtj_referenced" => $rtj_referenced,
                "rtj_referenced_to" => $rtj_referenced_to,
                "rtj_referenced_phys" => $rtj_referenced_phys,
                "rtj_referenced_based_on" => $rtj_referenced_based_on,
                "rtj_referenced_deliver_by" => $rtj_referenced_deliver_by,
                "patient_education" => $patient_education,
                "if_patient_family" => $if_patient_family,
                "if_can_not_give_edu" => $if_can_not_give_edu,
                "explanation_receipient_name" => $explanation_receipient_name,
                "doctor_name" => $doctor_name,
                "paraf_doctor" => $paraf_doctor,
                "episode_id" => $episode_id,
                "app_nmbr" => $app_nmbr,
                "code" => $code,
                "proc_order_id" => $proc_order_id,
                "open_header_flag" => $open_header_flag,
                "hide_action_button" => $hide_action_button,
                "lab_order_id" => $lab_order_id,
                "physio_order_id" => $physio_order_id,
                "radio_order_id" => $radio_order_id,
                "is_cppt_leads" => $is_cppt_leads,
                "refphysician_id" => $refphysician_id,
                "inpatient_physician_speciality" => $inpatient_physician_speciality,
                "is_fast_track" => $is_fast_track,
                "is_cito" => $is_cito,
                "is_rad_pending" => $is_rad_pending,
                "rad_pending_order" => $rad_pending_order,
                "is_lab_pending" => $is_lab_pending,
                "lab_pending_order" => $lab_pending_order,
                "is_phy_pending" => $is_phy_pending,
                "phy_pending_order" => $phy_pending_order,
                "has_drug_allergy" => $has_drug_allergy,
                "state" => $state,
                "is_signed" => $is_signed,
                "standing_order" => $standing_order,
                "is_locked" => $is_locked,
                "text_diagnosis" => $text_diagnosis,
                "last_notebook" => $last_notebook,
                "inv_vendor_lab_id" => $inv_vendor_lab_id,
                "lab_medical_checkup" => $lab_medical_checkup,
                "inv_vendor_radio_id" => $inv_vendor_radio_id,
                "inv_vendor_phy_id" => $inv_vendor_phy_id,
                "inv_vendor_id" => $inv_vendor_id,
                "inv_vendor_nurse_id" => $inv_vendor_nurse_id,
                "inv_vendor_midwife_id" => $inv_vendor_midwife_id,
                "has_pain_scale" => $has_pain_scale,
                "pain_scale_type" => $pain_scale_type,
                "numeric_scale" => $numeric_scale,
                "wong_baker_scale" => $wong_baker_scale,
                "cpot_ekspresi_wajah" => $cpot_ekspresi_wajah,
                "cpot_gerakan_tubuh" => $cpot_gerakan_tubuh,
                "cpot_options" => $cpot_options,
                "cpot_aktivasi_ventilator" => $cpot_aktivasi_ventilator,
                "cpot_berbicara" => $cpot_berbicara,
                "cpot_ketegangan_otot" => $cpot_ketegangan_otot,
                "nips_ekspresi_wajah" => $nips_ekspresi_wajah,
                "nips_tangisan" => $nips_tangisan,
                "nips_pola_nafas" => $nips_pola_nafas,
                "nips_tungkai" => $nips_tungkai,
                "nips_tingkat_kesadaran" => $nips_tingkat_kesadaran,
                "painad_pernafasan" => $painad_pernafasan,
                "painad_vokalisasi_negatif" => $painad_vokalisasi_negatif,
                "painad_ekspresi_wajah" => $painad_ekspresi_wajah,
                "painad_bahasa_tubuh" => $painad_bahasa_tubuh,
                "painad_konsabilitas" => $painad_konsabilitas,
                "flacc_wajah" => $flacc_wajah,
                "flacc_kaki" => $flacc_kaki,
                "flacc_aktivitas" => $flacc_aktivitas,
                "flacc_menangis" => $flacc_menangis,
                "flacc_konsabilitas" => $flacc_konsabilitas,
                "has_fall_risk" => $has_fall_risk,
                "fall_risk_desc" => $fall_risk_desc,
                "fall_risk_type" => $fall_risk_type,
                "hd_usia" => $hd_usia,
                "hd_jenis_kelamin" => $hd_jenis_kelamin,
                "hd_diagnosa" => $hd_diagnosa,
                "hd_gangguan_kognitif" => $hd_gangguan_kognitif,
                "hd_faktor_lingkungan" => $hd_faktor_lingkungan,
                "hd_respon_pembedahan_sedasi_anestesi" => $hd_respon_pembedahan_sedasi_anestesi,
                "hd_respon_penggunaan_medikamentosa" => $hd_respon_penggunaan_medikamentosa,
                "fm_riwayat_jatuh" => $fm_riwayat_jatuh,
                "fm_diagnosis_sekunder" => $fm_diagnosis_sekunder,
                "fm_menggunakan_alat_bantu" => $fm_menggunakan_alat_bantu,
                "fm_menggunakan_infuse_heparine" => $fm_menggunakan_infuse_heparine,
                "fm_gaya_berjalan" => $fm_gaya_berjalan,
                "fm_status_mental" => $fm_status_mental,
                "fm_medikasi" => $fm_medikasi,
                "note_subjective" => $note_subjective,
                "note_objective" => $note_objective,
                "note_obat_confirmed" => $note_obat_confirmed,
                "note_lab_confirmed" => $note_lab_confirmed,
                "note_rad_confirmed" => $note_rad_confirmed,
                "note_phy_confirmed" => $note_phy_confirmed,
                "note_proc_confirmed" => $note_proc_confirmed,
                "additional_note" => $additional_note,
                "final_note" => $final_note,
                "create_uid" => $create_uid,
                "create_date" => $create_date,
                "write_uid" => $write_uid,
                "write_date" => $write_date,
                "patient_family_name" => $patient_family_name,
                "is_applicant_signed" => $is_applicant_signed,
                "applicant_sign" => $applicant_sign,
                "rtj_inpatient_location" => $rtj_inpatient_location,
                "rtj_referenced_dept" => $rtj_referenced_dept,
                "rtj_inpatient_standing_order" => $rtj_inpatient_standing_order,
                "rtj_is_control" => $rtj_is_control,
                "rtj_control_date" => $rtj_control_date,
                "rtj_control_reason" => $rtj_control_reason,
                "age_category" => $age_category,
                "month_count" => $month_count,
                "rtj_outpatient_type" => $rtj_outpatient_type,
                "rtj_referenced_based_other" => $rtj_referenced_based_other,
                "rtj_rujuk_type" => $rtj_rujuk_type,
                "pf_ears" => $pf_ears,
                "coass_residence_sign" => $coass_residence_sign,
                "is_coas_signed" => $is_coas_signed,
                "coas_signed_datetime" => $coas_signed_datetime,
                "rtj_internal_ref_pysician_id" => $rtj_internal_ref_pysician_id,
                "rtj_internal_ref_notes" => $rtj_internal_ref_notes,
                "soap_planning" => $soap_planning,
                "is_consul_discount" => $is_consul_discount,
                "sign_datetime" => $sign_datetime,
                "clinical_indication" => $fullPathDokter,
                "target_of_therapy" => $fullPathPasien,
                "rtj_out_instruction" => $rtj_out_instruction,
                "set_all_dbn" => $set_all_dbn,
                "education_material" => $education_material,
                "message_main_attachment_id" => $message_main_attachment_id,
                "rtj_inpatient_service_needs" => $rtj_inpatient_service_needs,
                "trial437" => $trial437,
            ];
            if ($isNewKunj) {
                $coba = $db->insert($data);
            } else {
                $coba = $db->save($data);
            }



            $select = $this->lowerKey($db->where("body_id = '" . $body_id . "'")->findAll());
            // return json_encode($select);

            $select[0]['clinical_indication'] =  $encodedDataDokter;
            $select[0]['target_of_therapy'] =  $encodedDataPasien;


            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-1.php", [
                "visit" => $visit,
                "val" => $select[0]
            ]);
        }
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-1.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rmj2_2($visit, $vactination_id = null)
    {
        $title = "ASSESMEN MEDIS PASIEN RAWAT JALAN KANDUNGAN";
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bidan_kandung where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            // $select = $this->lowerKey($db->query("hosnic_emr_rj_bidan_kandung")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-2.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-2.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function rmj2_3($visit, $vactination_id = null)
    {
        $title = "ASSESMEN MEDIS PASIEN PENYAKIT DALAM"; //hosnic_emr_rj_pny_dalam
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_pny_dalam where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-3.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-3.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function rmj2_4($visit, $vactination_id = null)
    {
        $title = "ASSESMEN MEDIS PASIEN BEDAH"; //hosnic_emr_rj_bedah
        if ($this->request->is('get')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_bedah where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-4.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-4.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }

    public function rmj2_5($visit, $vactination_id = null)
    {
        $title = "ASESMEN AWAL MEDIS PASIEN KULIT DAN KELAMIN"; //hosnic_emr_rj_kulit
        $visit = base64_decode($visit);
        $visit = json_decode($visit, true);
        $db = db_connect();
        $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_kulit where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
        if ($this->request->is('get')) {
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-5.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-5.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function rmj2_6($visit, $vactination_id = null)
    {
        $title = 'ASESMEN MEDIS NEUROLOGI RAWAT JALAN';
        if ($this->request->is('get')) {

            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            // return $visit;
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_asmed_saraf where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
            // return json_encode($select[0]['doctor']);
            if (isset($select[0])) {
                // Define the path to the signature image
                $signaturePathDokter = $select[0]['clinical_indication'];

                // Check if the signature image file exists
                if (file_exists($signaturePathDokter)) {
                    // Read the signature image
                    $signatureData = file_get_contents($signaturePathDokter);

                    // Convert the image data to base64 format
                    $signatureBase64 = base64_encode($signatureData);
                    $select[0]['clinical_indication'] = $signatureBase64;

                    // Load the display signature view with the signature data
                } else {
                    // If the signature image file doesn't exist, show an error message
                    // return "<p>Signature not found!</p>";
                }
                $signaturePathPasien = $select[0]['target_of_therapy'];

                // Check if the signature image file exists
                if (file_exists($signaturePathPasien)) {
                    // Read the signature image
                    $signatureData = file_get_contents($signaturePathPasien);

                    // Convert the image data to base64 format
                    $signatureBase64 = base64_encode($signatureData);
                    $select[0]['target_of_therapy'] = $signatureBase64;

                    // Load the display signature view with the signature data
                } else {
                    // If the signature image file doesn't exist, show an error message
                    // return "<p>Signature not found!</p>";
                }
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-6.php", [
                    "visit" => $visit,
                    "val" => $select[0],
                    'title' => $title
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-6.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
        if ($this->request->is('post')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $body = $this->request->getPost();


            $signatureDokter = $this->request->getPost("ttd");
            $data = explode(',', (string)$signatureDokter);
            $encodedDataDokter = $data[1];
            $decodedDataDokter = base64_decode($encodedDataDokter);
            $signaturePathDokter = WRITEPATH . 'uploads/signatures/';
            if (!is_dir($signaturePathDokter)) {
                mkdir($signaturePathDokter, 0777, true);
            }
            $filenameDokter = uniqid('signature_') . '.png';
            $fullPathDokter = $signaturePathDokter . $filenameDokter;
            if (file_put_contents($fullPathDokter, $decodedDataDokter)) {
                // Signature saved successfully
                // You can return any response as needed, for example, a success message
                // return $this->response->setJSON(['success' => true, 'filename' => $filename]);
            } else {
                // Failed to save the signature image
                // You can return any response as needed, for example, an error message
                return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
            }

            $signaturePasien = $this->request->getPost("ttd_1");
            $data = explode(',', (string)$signaturePasien);
            $encodedDataPasien = $data[1];
            $decodedDataPasien = base64_decode($encodedDataPasien);
            $signaturePathPasien = WRITEPATH . 'uploads/signatures/';
            if (!is_dir($signaturePathPasien)) {
                mkdir($signaturePathPasien, 0777, true);
            }
            $filenamePasien = uniqid('signature_') . '.png';
            $fullPathPasien = $signaturePathPasien . $filenamePasien;
            if (file_put_contents($fullPathPasien, $decodedDataPasien)) {
                // Signature saved successfully
                // You can return any response as needed, for example, a success message
                // return $this->response->setJSON(['success' => true, 'filename' => $filename]);
            } else {
                // Failed to save the signature image
                // You can return any response as needed, for example, an error message
                return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
            }
            // return json_encode($encodedData);
            $body_id = $this->request->getPost('body_id');
            $org_unit_code = $this->request->getPost('org_unit_code');
            $pasien_diagnosa_id = $this->request->getPost('pasien_diagnosa_id');
            $diagnosa_id = $this->request->getPost('diagnosa_id');
            $no_registration = $this->request->getPost('no_registration');
            $visit_id = $this->request->getPost('visit_id');
            $bill_id = $this->request->getPost('bill_id');
            $clinic_id = $this->request->getPost('clinic_id');
            $class_room_id = $this->request->getPost('class_room_id');
            $in_date = $this->request->getPost('in_date');
            $exit_date = $this->request->getPost('exit_date');
            $keluar_id = $this->request->getPost('keluar_id');
            $examination_date = $this->request->getPost('examination_date');
            $employee_id = $this->request->getPost('employee_id');
            $description = $this->request->getPost('description');
            $modified_date = $this->request->getPost('modified_date');
            $modified_by = $this->request->getPost('modified_by');
            $modified_from = $this->request->getPost('modified_from');
            $status_pasien_id = $this->request->getPost('status_pasien_id');
            $ageyear = $this->request->getPost('ageyear');
            $agemonth = $this->request->getPost('agemonth');
            $ageday = $this->request->getPost('ageday');
            $thename = $this->request->getPost('thename');
            $theaddress = $this->request->getPost('theaddress');
            $theid = $this->request->getPost('theid');
            $isrj = $this->request->getPost('isrj');
            $gender = $this->request->getPost('gender');
            $doctor = $this->request->getPost('doctor');
            $kal_id = $this->request->getPost('kal_id');
            $petugas_id = $this->request->getPost('petugas_id');
            $petugas = $this->request->getPost('petugas');
            $account_id = $this->request->getPost('account_id');
            $cpoe_emr_rel_id = $this->request->getPost('cpoe_emr_rel_id');
            $cpoe_id = $this->request->getPost('cpoe_id');
            $episode_categ = $this->request->getPost('episode_categ');
            $date_order = $this->request->getPost('date_order');
            $patient_id = $this->request->getPost('patient_id');
            $patient_code = $this->request->getPost('patient_code');
            $patient_age = $this->request->getPost('patient_age');
            $patient_gender = $this->request->getPost('patient_gender');
            $colorbar = $this->request->getPost('colorbar');
            $physician_id = $this->request->getPost('physician_id');
            $physician_speciality = $this->request->getPost('physician_speciality');
            $payment_method = $this->request->getPost('payment_method');
            $pricelist_id = $this->request->getPost('pricelist_id');
            $currency_id = $this->request->getPost('currency_id');
            $is_out_cppt = $this->request->getPost('is_out_cppt');
            $soap_subjective = $this->request->getPost('soap_subjective');
            $soap_objective = $this->request->getPost('soap_objective');
            $ana_main_complaint = $this->request->getPost('ana_main_complaint');
            $ana_auto_current_disease_history = $this->request->getPost('ana_auto_current_disease_history');
            $ana_past_disease_history = $this->request->getPost('ana_past_disease_history');
            $ana_family_disease_history = $this->request->getPost('ana_family_disease_history');
            $ana_allergy_history_non_drugs = $this->request->getPost('ana_allergy_history_non_drugs');
            $ana_allergy_history_drugs = $this->request->getPost('ana_allergy_history_drugs');
            $ana_pregnancy_childbirth_history = $this->request->getPost('ana_pregnancy_childbirth_history');
            $ana_diet_history = $this->request->getPost('ana_diet_history');
            $ana_imun_history = $this->request->getPost('ana_imun_history');
            $ana_drugs_consumed = $this->request->getPost('ana_drugs_consumed');
            $pf_vital_sign_bp = $this->request->getPost('pf_vital_sign_bp');
            $pf_vital_sign_n = $this->request->getPost('pf_vital_sign_n');
            $pf_vital_sign_s = $this->request->getPost('pf_vital_sign_s');
            $pf_vital_sign_rr = $this->request->getPost('pf_vital_sign_rr');
            $pf_vital_sign_weight = $this->request->getPost('pf_vital_sign_weight');
            $pf_vital_sign_height = $this->request->getPost('pf_vital_sign_height');
            $pf_vital_sign_spo2 = $this->request->getPost('pf_vital_sign_spo2');
            $pf_vital_sign_bmi = $this->request->getPost('pf_vital_sign_bmi');
            $pf_gcs_type = $this->request->getPost('pf_gcs_type');
            $pf_gcs_e = $this->request->getPost('pf_gcs_e');
            $pf_gcs_v = $this->request->getPost('pf_gcs_v');
            $pf_gcs_m = $this->request->getPost('pf_gcs_m');
            $pf_pgcs_e = $this->request->getPost('pf_pgcs_e');
            $pf_pgcs_v_type = $this->request->getPost('pf_pgcs_v_type');
            $pf_pgcs_v = $this->request->getPost('pf_pgcs_v');
            $pf_pgcs_v_non = $this->request->getPost('pf_pgcs_v_non');
            $pf_pgcs_m = $this->request->getPost('pf_pgcs_m');
            $pf_general_condition = $this->request->getPost('pf_general_condition');
            $pf_cranium = $this->request->getPost('pf_cranium');
            $pf_eyes = $this->request->getPost('pf_eyes');
            $pf_nose = $this->request->getPost('pf_nose');
            $pf_mouth = $this->request->getPost('pf_mouth');
            $pf_tooth = $this->request->getPost('pf_tooth');
            $pf_neck = $this->request->getPost('pf_neck');
            $pf_thorax = $this->request->getPost('pf_thorax');
            $pf_thorax_image = $this->request->getPost('pf_thorax_image');
            $pf_heart = $this->request->getPost('pf_heart');
            $pf_heart_image = $this->request->getPost('pf_heart_image');
            $pf_lungs = $this->request->getPost('pf_lungs');
            $pf_abdomen = $this->request->getPost('pf_abdomen');
            $pf_abdomen_image = $this->request->getPost('pf_abdomen_image');
            $pf_hepar = $this->request->getPost('pf_hepar');
            $pf_lien = $this->request->getPost('pf_lien');
            $pf_kidney = $this->request->getPost('pf_kidney');
            $pf_genitalia = $this->request->getPost('pf_genitalia');
            $pf_upper_extremity = $this->request->getPost('pf_upper_extremity');
            $pf_lower_extremity = $this->request->getPost('pf_lower_extremity');
            $general_condition = $this->request->getPost('general_condition');
            $gcs = $this->request->getPost('gcs');
            $vas_nrs = $this->request->getPost('vas_nrs');
            $left_diameter = $this->request->getPost('left_diameter');
            $left_light_reflex = $this->request->getPost('left_light_reflex');
            $left_cornea = $this->request->getPost('left_cornea');
            $left_isokor_anisokor = $this->request->getPost('left_isokor_anisokor');
            $right_diameter = $this->request->getPost('right_diameter');
            $right_light_reflex = $this->request->getPost('right_light_reflex');
            $right_cornea = $this->request->getPost('right_cornea');
            $right_isokor_anisokor = $this->request->getPost('right_isokor_anisokor');
            $stiff_neck = $this->request->getPost('stiff_neck');
            $meningeal_sign = $this->request->getPost('meningeal_sign');
            $brudzinki_i_iv = $this->request->getPost('brudzinki_i_iv');
            $kernig_sign = $this->request->getPost('kernig_sign');
            $dolls_eye_phenomenon = $this->request->getPost('dolls_eye_phenomenon');
            $vertebra = $this->request->getPost('vertebra');
            $extremity = $this->request->getPost('extremity');
            $motion_upper_left = $this->request->getPost('motion_upper_left');
            $motion_upper_right = $this->request->getPost('motion_upper_right');
            $motion_lower_left = $this->request->getPost('motion_lower_left');
            $motion_lower_right = $this->request->getPost('motion_lower_right');
            $strength_upper_left = $this->request->getPost('strength_upper_left');
            $strength_upper_right = $this->request->getPost('strength_upper_right');
            $strength_lower_left = $this->request->getPost('strength_lower_left');
            $strength_lower_right = $this->request->getPost('strength_lower_right');
            $physiological_reflex_upper_left = $this->request->getPost('physiological_reflex_upper_left');
            $physiological_reflex_upper_right = $this->request->getPost('physiological_reflex_upper_right');
            $physiological_reflex_lower_left = $this->request->getPost('physiological_reflex_lower_left');
            $physiological_reflex_lower_right = $this->request->getPost('physiological_reflex_lower_right');
            $pathologycal_reflex_upper_left = $this->request->getPost('pathologycal_reflex_upper_left');
            $pathologycal_reflex_upper_right = $this->request->getPost('pathologycal_reflex_upper_right');
            $pathologycal_reflex_lower_left = $this->request->getPost('pathologycal_reflex_lower_left');
            $pathologycal_reflex_lower_right = $this->request->getPost('pathologycal_reflex_lower_right');
            $clonus = $this->request->getPost('clonus');
            $sensibility = $this->request->getPost('sensibility');
            $cause_of_injury_poisoning = $this->request->getPost('cause_of_injury_poisoning');
            $nursing_problem = $this->request->getPost('nursing_problem');
            $medical_problem = $this->request->getPost('medical_problem');
            $care_and_therapy_plan = $this->request->getPost('care_and_therapy_plan');
            $follow_up_plan = $this->request->getPost('follow_up_plan');
            $rtj_control = $this->request->getPost('rtj_control');
            $rtj_time_of_death_emergency = $this->request->getPost('rtj_time_of_death_emergency');
            $rtj_inpatient_indication = $this->request->getPost('rtj_inpatient_indication');
            $rtj_inpatient_dpjp = $this->request->getPost('rtj_inpatient_dpjp');
            $rtj_inpatient_classes = $this->request->getPost('rtj_inpatient_classes');
            $rtj_inpatient_ward = $this->request->getPost('rtj_inpatient_ward');
            $rtj_inpatient_room = $this->request->getPost('rtj_inpatient_room');
            $rtj_inpatient_bed = $this->request->getPost('rtj_inpatient_bed');
            $rtj_referenced = $this->request->getPost('rtj_referenced');
            $rtj_referenced_to = $this->request->getPost('rtj_referenced_to');
            $rtj_referenced_phys = $this->request->getPost('rtj_referenced_phys');
            $rtj_referenced_based_on = $this->request->getPost('rtj_referenced_based_on');
            $rtj_referenced_deliver_by = $this->request->getPost('rtj_referenced_deliver_by');
            $patient_education = $this->request->getPost('patient_education');
            $if_patient_family = $this->request->getPost('if_patient_family');
            $if_can_not_give_edu = $this->request->getPost('if_can_not_give_edu');
            $explanation_receipient_name = $this->request->getPost('explanation_receipient_name');
            $doctor_name = $this->request->getPost('doctor_name');
            $paraf_doctor = $this->request->getPost('paraf_doctor');
            $episode_id = $this->request->getPost('episode_id');
            $app_nmbr = $this->request->getPost('app_nmbr');
            $code = $this->request->getPost('code');
            $proc_order_id = $this->request->getPost('proc_order_id');
            $open_header_flag = $this->request->getPost('open_header_flag');
            $hide_action_button = $this->request->getPost('hide_action_button');
            $lab_order_id = $this->request->getPost('lab_order_id');
            $physio_order_id = $this->request->getPost('physio_order_id');
            $radio_order_id = $this->request->getPost('radio_order_id');
            $is_cppt_leads = $this->request->getPost('is_cppt_leads');
            $refphysician_id = $this->request->getPost('refphysician_id');
            $inpatient_physician_speciality = $this->request->getPost('inpatient_physician_speciality');
            $is_fast_track = $this->request->getPost('is_fast_track');
            $is_cito = $this->request->getPost('is_cito');
            $is_rad_pending = $this->request->getPost('is_rad_pending');
            $rad_pending_order = $this->request->getPost('rad_pending_order');
            $is_lab_pending = $this->request->getPost('is_lab_pending');
            $lab_pending_order = $this->request->getPost('lab_pending_order');
            $is_phy_pending = $this->request->getPost('is_phy_pending');
            $phy_pending_order = $this->request->getPost('phy_pending_order');
            $has_drug_allergy = $this->request->getPost('has_drug_allergy');
            $state = $this->request->getPost('state');
            $standing_order = $this->request->getPost('standing_order');
            $is_locked = $this->request->getPost('is_locked');
            $text_diagnosis = $this->request->getPost('text_diagnosis');
            $is_signed = $this->request->getPost('is_signed');
            $last_notebook = $this->request->getPost('last_notebook');
            $inv_vendor_lab_id = $this->request->getPost('inv_vendor_lab_id');
            $lab_medical_checkup = $this->request->getPost('lab_medical_checkup');
            $inv_vendor_radio_id = $this->request->getPost('inv_vendor_radio_id');
            $inv_vendor_phy_id = $this->request->getPost('inv_vendor_phy_id');
            $inv_vendor_id = $this->request->getPost('inv_vendor_id');
            $inv_vendor_nurse_id = $this->request->getPost('inv_vendor_nurse_id');
            $inv_vendor_midwife_id = $this->request->getPost('inv_vendor_midwife_id');
            $has_pain_scale = $this->request->getPost('has_pain_scale');
            $pain_scale_type = $this->request->getPost('pain_scale_type');
            $numeric_scale = $this->request->getPost('numeric_scale');
            $wong_baker_scale = $this->request->getPost('wong_baker_scale');
            $cpot_ekspresi_wajah = $this->request->getPost('cpot_ekspresi_wajah');
            $cpot_gerakan_tubuh = $this->request->getPost('cpot_gerakan_tubuh');
            $cpot_options = $this->request->getPost('cpot_options');
            $cpot_aktivasi_ventilator = $this->request->getPost('cpot_aktivasi_ventilator');
            $cpot_berbicara = $this->request->getPost('cpot_berbicara');
            $cpot_ketegangan_otot = $this->request->getPost('cpot_ketegangan_otot');
            $nips_ekspresi_wajah = $this->request->getPost('nips_ekspresi_wajah');
            $nips_tangisan = $this->request->getPost('nips_tangisan');
            $nips_pola_nafas = $this->request->getPost('nips_pola_nafas');
            $nips_tungkai = $this->request->getPost('nips_tungkai');
            $nips_tingkat_kesadaran = $this->request->getPost('nips_tingkat_kesadaran');
            $painad_pernafasan = $this->request->getPost('painad_pernafasan');
            $painad_vokalisasi_negatif = $this->request->getPost('painad_vokalisasi_negatif');
            $painad_ekspresi_wajah = $this->request->getPost('painad_ekspresi_wajah');
            $painad_bahasa_tubuh = $this->request->getPost('painad_bahasa_tubuh');
            $painad_konsabilitas = $this->request->getPost('painad_konsabilitas');
            $flacc_wajah = $this->request->getPost('flacc_wajah');
            $flacc_kaki = $this->request->getPost('flacc_kaki');
            $flacc_aktivitas = $this->request->getPost('flacc_aktivitas');
            $flacc_menangis = $this->request->getPost('flacc_menangis');
            $flacc_konsabilitas = $this->request->getPost('flacc_konsabilitas');
            $has_fall_risk = $this->request->getPost('has_fall_risk');
            $fall_risk_desc = $this->request->getPost('fall_risk_desc');
            $fall_risk_type = $this->request->getPost('fall_risk_type');
            $hd_usia = $this->request->getPost('hd_usia');
            $hd_jenis_kelamin = $this->request->getPost('hd_jenis_kelamin');
            $hd_diagnosa = $this->request->getPost('hd_diagnosa');
            $hd_gangguan_kognitif = $this->request->getPost('hd_gangguan_kognitif');
            $hd_faktor_lingkungan = $this->request->getPost('hd_faktor_lingkungan');
            $hd_respon_pembedahan_sedasi_anestesi = $this->request->getPost('hd_respon_pembedahan_sedasi_anestesi');
            $hd_respon_penggunaan_medikamentosa = $this->request->getPost('hd_respon_penggunaan_medikamentosa');
            $fm_riwayat_jatuh = $this->request->getPost('fm_riwayat_jatuh');
            $fm_diagnosis_sekunder = $this->request->getPost('fm_diagnosis_sekunder');
            $fm_menggunakan_alat_bantu = $this->request->getPost('fm_menggunakan_alat_bantu');
            $fm_menggunakan_infuse_heparine = $this->request->getPost('fm_menggunakan_infuse_heparine');
            $fm_gaya_berjalan = $this->request->getPost('fm_gaya_berjalan');
            $fm_status_mental = $this->request->getPost('fm_status_mental');
            $fm_medikasi = $this->request->getPost('fm_medikasi');
            $note_subjective = $this->request->getPost('note_subjective');
            $note_objective = $this->request->getPost('note_objective');
            $note_obat_confirmed = $this->request->getPost('note_obat_confirmed');
            $note_lab_confirmed = $this->request->getPost('note_lab_confirmed');
            $note_rad_confirmed = $this->request->getPost('note_rad_confirmed');
            $note_phy_confirmed = $this->request->getPost('note_phy_confirmed');
            $note_proc_confirmed = $this->request->getPost('note_proc_confirmed');
            $additional_note = $this->request->getPost('additional_note');
            $final_note = $this->request->getPost('final_note');
            $create_uid = $this->request->getPost('create_uid');
            $create_date = $this->request->getPost('create_date');
            $write_uid = $this->request->getPost('write_uid');
            $write_date = $this->request->getPost('write_date');
            $patient_family_name = $this->request->getPost('patient_family_name');
            $is_applicant_signed = $this->request->getPost('is_applicant_signed');
            $applicant_sign = $this->request->getPost('applicant_sign');
            $rtj_inpatient_location = $this->request->getPost('rtj_inpatient_location');
            $rtj_referenced_dept = $this->request->getPost('rtj_referenced_dept');
            $rtj_inpatient_standing_order = $this->request->getPost('rtj_inpatient_standing_order');
            $rtj_is_control = $this->request->getPost('rtj_is_control');
            $rtj_control_date = $this->request->getPost('rtj_control_date');
            $rtj_control_reason = $this->request->getPost('rtj_control_reason');
            $rtj_outpatient_type = $this->request->getPost('rtj_outpatient_type');
            $rtj_referenced_based_other = $this->request->getPost('rtj_referenced_based_other');
            $rtj_rujuk_type = $this->request->getPost('rtj_rujuk_type');
            $pf_ears = $this->request->getPost('pf_ears');
            $coass_residence_sign = $this->request->getPost('coass_residence_sign');
            $is_coas_signed = $this->request->getPost('is_coas_signed');
            $coas_signed_datetime = $this->request->getPost('coas_signed_datetime');
            $month_count = $this->request->getPost('month_count');
            $rtj_internal_ref_pysician_id = $this->request->getPost('rtj_internal_ref_pysician_id');
            $rtj_internal_ref_notes = $this->request->getPost('rtj_internal_ref_notes');
            $soap_planning = $this->request->getPost('soap_planning');
            $is_consul_discount = $this->request->getPost('is_consul_discount');
            $sign_datetime = $this->request->getPost('sign_datetime');
            $clinical_indication = $fullPathDokter;
            $target_of_therapy = $fullPathPasien;
            $rtj_out_instruction = $this->request->getPost('rtj_out_instruction');
            $set_all_dbn = $this->request->getPost('set_all_dbn');
            $education_material = $this->request->getPost('education_material');
            $message_main_attachment_id = $this->request->getPost('message_main_attachment_id');
            $rtj_inpatient_service_needs = $this->request->getPost('rtj_inpatient_service_needs');
            $trial194 = $this->request->getPost('trial194');


            $isNewKunj = false;
            if ($body['body_id'] == null || $body['body_id'] == '') {
                $db = db_connect();
                $select = $db->query("select cast(year(getdate()) as varchar(4)) +
                right(cast((month(getdate()) + 100) as varchar(3)),2)+
                right(cast((day(getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3) as id")->getResultArray();
                // $vactination_id = $select[0]['id'];
                $body_id = $select[0]['id'];
                $isNewKunj = true;
            }
            // return json_encode($body_id);

            $db = new RMJ26Model();
            $data = [
                "body_id" => $body_id,
                "org_unit_code" => $org_unit_code,
                "pasien_diagnosa_id" => $pasien_diagnosa_id,
                "diagnosa_id" => $diagnosa_id,
                "no_registration" => $no_registration,
                "visit_id" => $visit_id,
                "bill_id" => $bill_id,
                "clinic_id" => $clinic_id,
                "class_room_id" => $class_room_id,
                "in_date" => $in_date,
                "exit_date" => $exit_date,
                "keluar_id" => $keluar_id,
                "examination_date" => $examination_date,
                "employee_id" => $employee_id,
                "description" => $description,
                "modified_date" => $modified_date,
                "modified_by" => $modified_by,
                "modified_from" => $modified_from,
                "status_pasien_id" => $status_pasien_id,
                "ageyear" => $ageyear,
                "agemonth" => $agemonth,
                "ageday" => $ageday,
                "thename" => $thename,
                "theaddress" => $theaddress,
                "theid" => $theid,
                "isrj" => $isrj,
                "gender" => $gender,
                "doctor" => $doctor,
                "kal_id" => $kal_id,
                "petugas_id" => $petugas_id,
                "petugas" => $petugas,
                "account_id" => $account_id,
                "cpoe_emr_rel_id" => $cpoe_emr_rel_id,
                "cpoe_id" => $cpoe_id,
                "episode_categ" => $episode_categ,
                "date_order" => $date_order,
                "patient_id" => $patient_id,
                "patient_code" => $patient_code,
                "patient_age" => $patient_age,
                "patient_gender" => $patient_gender,
                "colorbar" => $colorbar,
                "physician_id" => $physician_id,
                "physician_speciality" => $physician_speciality,
                "payment_method" => $payment_method,
                "pricelist_id" => $pricelist_id,
                "currency_id" => $currency_id,
                "is_out_cppt" => $is_out_cppt,
                "soap_subjective" => $soap_subjective,
                "soap_objective" => $soap_objective,
                "ana_main_complaint" => $ana_main_complaint,
                "ana_auto_current_disease_history" => $ana_auto_current_disease_history,
                "ana_past_disease_history" => $ana_past_disease_history,
                "ana_family_disease_history" => $ana_family_disease_history,
                "ana_allergy_history_non_drugs" => $ana_allergy_history_non_drugs,
                "ana_allergy_history_drugs" => $ana_allergy_history_drugs,
                "ana_pregnancy_childbirth_history" => $ana_pregnancy_childbirth_history,
                "ana_diet_history" => $ana_diet_history,
                "ana_imun_history" => $ana_imun_history,
                "ana_drugs_consumed" => $ana_drugs_consumed,
                "pf_vital_sign_bp" => $pf_vital_sign_bp,
                "pf_vital_sign_n" => $pf_vital_sign_n,
                "pf_vital_sign_s" => $pf_vital_sign_s,
                "pf_vital_sign_rr" => $pf_vital_sign_rr,
                "pf_vital_sign_weight" => $pf_vital_sign_weight,
                "pf_vital_sign_height" => $pf_vital_sign_height,
                "pf_vital_sign_spo2" => $pf_vital_sign_spo2,
                "pf_vital_sign_bmi" => $pf_vital_sign_bmi,
                "pf_gcs_type" => $pf_gcs_type,
                "pf_gcs_e" => $pf_gcs_e,
                "pf_gcs_v" => $pf_gcs_v,
                "pf_gcs_m" => $pf_gcs_m,
                "pf_pgcs_e" => $pf_pgcs_e,
                "pf_pgcs_v_type" => $pf_pgcs_v_type,
                "pf_pgcs_v" => $pf_pgcs_v,
                "pf_pgcs_v_non" => $pf_pgcs_v_non,
                "pf_pgcs_m" => $pf_pgcs_m,
                "pf_general_condition" => $pf_general_condition,
                "pf_cranium" => $pf_cranium,
                "pf_eyes" => $pf_eyes,
                "pf_nose" => $pf_nose,
                "pf_mouth" => $pf_mouth,
                "pf_tooth" => $pf_tooth,
                "pf_neck" => $pf_neck,
                "pf_thorax" => $pf_thorax,
                "pf_thorax_image" => $pf_thorax_image,
                "pf_heart" => $pf_heart,
                "pf_heart_image" => $pf_heart_image,
                "pf_lungs" => $pf_lungs,
                "pf_abdomen" => $pf_abdomen,
                "pf_abdomen_image" => $pf_abdomen_image,
                "pf_hepar" => $pf_hepar,
                "pf_lien" => $pf_lien,
                "pf_kidney" => $pf_kidney,
                "pf_genitalia" => $pf_genitalia,
                "pf_upper_extremity" => $pf_upper_extremity,
                "pf_lower_extremity" => $pf_lower_extremity,
                "general_condition" => $general_condition,
                "gcs" => $gcs,
                "vas_nrs" => $vas_nrs,
                "left_diameter" => $left_diameter,
                "left_light_reflex" => $left_light_reflex,
                "left_cornea" => $left_cornea,
                "left_isokor_anisokor" => $left_isokor_anisokor,
                "right_diameter" => $right_diameter,
                "right_light_reflex" => $right_light_reflex,
                "right_cornea" => $right_cornea,
                "right_isokor_anisokor" => $right_isokor_anisokor,
                "stiff_neck" => $stiff_neck,
                "meningeal_sign" => $meningeal_sign,
                "brudzinki_i_iv" => $brudzinki_i_iv,
                "kernig_sign" => $kernig_sign,
                "dolls_eye_phenomenon" => $dolls_eye_phenomenon,
                "vertebra" => $vertebra,
                "extremity" => $extremity,
                "motion_upper_left" => $motion_upper_left,
                "motion_upper_right" => $motion_upper_right,
                "motion_lower_left" => $motion_lower_left,
                "motion_lower_right" => $motion_lower_right,
                "strength_upper_left" => $strength_upper_left,
                "strength_upper_right" => $strength_upper_right,
                "strength_lower_left" => $strength_lower_left,
                "strength_lower_right" => $strength_lower_right,
                "physiological_reflex_upper_left" => $physiological_reflex_upper_left,
                "physiological_reflex_upper_right" => $physiological_reflex_upper_right,
                "physiological_reflex_lower_left" => $physiological_reflex_lower_left,
                "physiological_reflex_lower_right" => $physiological_reflex_lower_right,
                "pathologycal_reflex_upper_left" => $pathologycal_reflex_upper_left,
                "pathologycal_reflex_upper_right" => $pathologycal_reflex_upper_right,
                "pathologycal_reflex_lower_left" => $pathologycal_reflex_lower_left,
                "pathologycal_reflex_lower_right" => $pathologycal_reflex_lower_right,
                "clonus" => $clonus,
                "sensibility" => $sensibility,
                "cause_of_injury_poisoning" => $cause_of_injury_poisoning,
                "nursing_problem" => $nursing_problem,
                "medical_problem" => $medical_problem,
                "care_and_therapy_plan" => $care_and_therapy_plan,
                "follow_up_plan" => $follow_up_plan,
                "rtj_control" => $rtj_control,
                "rtj_time_of_death_emergency" => $rtj_time_of_death_emergency,
                "rtj_inpatient_indication" => $rtj_inpatient_indication,
                "rtj_inpatient_dpjp" => $rtj_inpatient_dpjp,
                "rtj_inpatient_classes" => $rtj_inpatient_classes,
                "rtj_inpatient_ward" => $rtj_inpatient_ward,
                "rtj_inpatient_room" => $rtj_inpatient_room,
                "rtj_inpatient_bed" => $rtj_inpatient_bed,
                "rtj_referenced" => $rtj_referenced,
                "rtj_referenced_to" => $rtj_referenced_to,
                "rtj_referenced_phys" => $rtj_referenced_phys,
                "rtj_referenced_based_on" => $rtj_referenced_based_on,
                "rtj_referenced_deliver_by" => $rtj_referenced_deliver_by,
                "patient_education" => $patient_education,
                "if_patient_family" => $if_patient_family,
                "if_can_not_give_edu" => $if_can_not_give_edu,
                "explanation_receipient_name" => $explanation_receipient_name,
                "doctor_name" => $doctor_name,
                "paraf_doctor" => $paraf_doctor,
                "episode_id" => $episode_id,
                "app_nmbr" => $app_nmbr,
                "code" => $code,
                "proc_order_id" => $proc_order_id,
                "open_header_flag" => $open_header_flag,
                "hide_action_button" => $hide_action_button,
                "lab_order_id" => $lab_order_id,
                "physio_order_id" => $physio_order_id,
                "radio_order_id" => $radio_order_id,
                "is_cppt_leads" => $is_cppt_leads,
                "refphysician_id" => $refphysician_id,
                "inpatient_physician_speciality" => $inpatient_physician_speciality,
                "is_fast_track" => $is_fast_track,
                "is_cito" => $is_cito,
                "is_rad_pending" => $is_rad_pending,
                "rad_pending_order" => $rad_pending_order,
                "is_lab_pending" => $is_lab_pending,
                "lab_pending_order" => $lab_pending_order,
                "is_phy_pending" => $is_phy_pending,
                "phy_pending_order" => $phy_pending_order,
                "has_drug_allergy" => $has_drug_allergy,
                "state" => $state,
                "standing_order" => $standing_order,
                "is_locked" => $is_locked,
                "text_diagnosis" => $text_diagnosis,
                "is_signed" => $is_signed,
                "last_notebook" => $last_notebook,
                "inv_vendor_lab_id" => $inv_vendor_lab_id,
                "lab_medical_checkup" => $lab_medical_checkup,
                "inv_vendor_radio_id" => $inv_vendor_radio_id,
                "inv_vendor_phy_id" => $inv_vendor_phy_id,
                "inv_vendor_id" => $inv_vendor_id,
                "inv_vendor_nurse_id" => $inv_vendor_nurse_id,
                "inv_vendor_midwife_id" => $inv_vendor_midwife_id,
                "has_pain_scale" => $has_pain_scale,
                "pain_scale_type" => $pain_scale_type,
                "numeric_scale" => $numeric_scale,
                "wong_baker_scale" => $wong_baker_scale,
                "cpot_ekspresi_wajah" => $cpot_ekspresi_wajah,
                "cpot_gerakan_tubuh" => $cpot_gerakan_tubuh,
                "cpot_options" => $cpot_options,
                "cpot_aktivasi_ventilator" => $cpot_aktivasi_ventilator,
                "cpot_berbicara" => $cpot_berbicara,
                "cpot_ketegangan_otot" => $cpot_ketegangan_otot,
                "nips_ekspresi_wajah" => $nips_ekspresi_wajah,
                "nips_tangisan" => $nips_tangisan,
                "nips_pola_nafas" => $nips_pola_nafas,
                "nips_tungkai" => $nips_tungkai,
                "nips_tingkat_kesadaran" => $nips_tingkat_kesadaran,
                "painad_pernafasan" => $painad_pernafasan,
                "painad_vokalisasi_negatif" => $painad_vokalisasi_negatif,
                "painad_ekspresi_wajah" => $painad_ekspresi_wajah,
                "painad_bahasa_tubuh" => $painad_bahasa_tubuh,
                "painad_konsabilitas" => $painad_konsabilitas,
                "flacc_wajah" => $flacc_wajah,
                "flacc_kaki" => $flacc_kaki,
                "flacc_aktivitas" => $flacc_aktivitas,
                "flacc_menangis" => $flacc_menangis,
                "flacc_konsabilitas" => $flacc_konsabilitas,
                "has_fall_risk" => $has_fall_risk,
                "fall_risk_desc" => $fall_risk_desc,
                "fall_risk_type" => $fall_risk_type,
                "hd_usia" => $hd_usia,
                "hd_jenis_kelamin" => $hd_jenis_kelamin,
                "hd_diagnosa" => $hd_diagnosa,
                "hd_gangguan_kognitif" => $hd_gangguan_kognitif,
                "hd_faktor_lingkungan" => $hd_faktor_lingkungan,
                "hd_respon_pembedahan_sedasi_anestesi" => $hd_respon_pembedahan_sedasi_anestesi,
                "hd_respon_penggunaan_medikamentosa" => $hd_respon_penggunaan_medikamentosa,
                "fm_riwayat_jatuh" => $fm_riwayat_jatuh,
                "fm_diagnosis_sekunder" => $fm_diagnosis_sekunder,
                "fm_menggunakan_alat_bantu" => $fm_menggunakan_alat_bantu,
                "fm_menggunakan_infuse_heparine" => $fm_menggunakan_infuse_heparine,
                "fm_gaya_berjalan" => $fm_gaya_berjalan,
                "fm_status_mental" => $fm_status_mental,
                "fm_medikasi" => $fm_medikasi,
                "note_subjective" => $note_subjective,
                "note_objective" => $note_objective,
                "note_obat_confirmed" => $note_obat_confirmed,
                "note_lab_confirmed" => $note_lab_confirmed,
                "note_rad_confirmed" => $note_rad_confirmed,
                "note_phy_confirmed" => $note_phy_confirmed,
                "note_proc_confirmed" => $note_proc_confirmed,
                "additional_note" => $additional_note,
                "final_note" => $final_note,
                "create_uid" => $create_uid,
                "create_date" => $create_date,
                "write_uid" => $write_uid,
                "write_date" => $write_date,
                "patient_family_name" => $patient_family_name,
                "is_applicant_signed" => $is_applicant_signed,
                "applicant_sign" => $applicant_sign,
                "rtj_inpatient_location" => $rtj_inpatient_location,
                "rtj_referenced_dept" => $rtj_referenced_dept,
                "rtj_inpatient_standing_order" => $rtj_inpatient_standing_order,
                "rtj_is_control" => $rtj_is_control,
                "rtj_control_date" => $rtj_control_date,
                "rtj_control_reason" => $rtj_control_reason,
                "rtj_outpatient_type" => $rtj_outpatient_type,
                "rtj_referenced_based_other" => $rtj_referenced_based_other,
                "rtj_rujuk_type" => $rtj_rujuk_type,
                "pf_ears" => $pf_ears,
                "coass_residence_sign" => $coass_residence_sign,
                "is_coas_signed" => $is_coas_signed,
                "coas_signed_datetime" => $coas_signed_datetime,
                "month_count" => $month_count,
                "rtj_internal_ref_pysician_id" => $rtj_internal_ref_pysician_id,
                "rtj_internal_ref_notes" => $rtj_internal_ref_notes,
                "soap_planning" => $soap_planning,
                "is_consul_discount" => $is_consul_discount,
                "sign_datetime" => $sign_datetime,
                "clinical_indication" => $fullPathDokter,
                "target_of_therapy" => $fullPathPasien,
                "rtj_out_instruction" => $rtj_out_instruction,
                "set_all_dbn" => $set_all_dbn,
                "education_material" => $education_material,
                "message_main_attachment_id" => $message_main_attachment_id,
                "rtj_inpatient_service_needs" => $rtj_inpatient_service_needs,
                "trial194" => $trial194,
            ];
            if ($isNewKunj) {
                $coba = $db->insert($data);
            } else {
                $coba = $db->save($data);
            }



            $select = $this->lowerKey($db->where("body_id = '" . $body_id . "'")->findAll());
            // return json_encode($select);

            $select[0]['clinical_indication'] =  $encodedDataDokter;
            $select[0]['target_of_therapy'] =  $encodedDataPasien;


            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-6.php", [
                "visit" => $visit,
                "val" => $select[0],
                'title' => $title
            ]);
        }
    }
    public function rmj2_7($visit, $vactination_id = null)
    {
        $title = 'ASSESMEN MEDIS PASIEN THT';
        if ($this->request->is('get')) {

            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            // return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-7.php", [
            //     "visit" => $visit,
            // ]);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_ases_tht where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-7.php", [
                    "visit" => $visit,
                    "val" => $select[0],
                    'title' => $title
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-7.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
        if ($this->request->is('post')) {
            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            $body = $this->request->getPost();


            $signatureDokter = $this->request->getPost("ttd");
            $data = explode(',', (string)$signatureDokter);
            $encodedDataDokter = $data[1];
            $decodedDataDokter = base64_decode($encodedDataDokter);
            $signaturePathDokter = WRITEPATH . 'uploads/signatures/';
            if (!is_dir($signaturePathDokter)) {
                mkdir($signaturePathDokter, 0777, true);
            }
            $filenameDokter = uniqid('signature_') . '.png';
            $fullPathDokter = $signaturePathDokter . $filenameDokter;
            if (file_put_contents($fullPathDokter, $decodedDataDokter)) {
                // Signature saved successfully
                // You can return any response as needed, for example, a success message
                // return $this->response->setJSON(['success' => true, 'filename' => $filename]);
            } else {
                // Failed to save the signature image
                // You can return any response as needed, for example, an error message
                return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
            }

            $signaturePasien = $this->request->getPost("ttd_1");
            $data = explode(',', (string)$signaturePasien);
            $encodedDataPasien = $data[1];
            $decodedDataPasien = base64_decode($encodedDataPasien);
            $signaturePathPasien = WRITEPATH . 'uploads/signatures/';
            if (!is_dir($signaturePathPasien)) {
                mkdir($signaturePathPasien, 0777, true);
            }
            $filenamePasien = uniqid('signature_') . '.png';
            $fullPathPasien = $signaturePathPasien . $filenamePasien;
            if (file_put_contents($fullPathPasien, $decodedDataPasien)) {
                // Signature saved successfully
                // You can return any response as needed, for example, a success message
                // return $this->response->setJSON(['success' => true, 'filename' => $filename]);
            } else {
                // Failed to save the signature image
                // You can return any response as needed, for example, an error message
                return $this->response->setJSON(['success' => false, 'error' => 'Failed to save signature']);
            }
            // return json_encode($encodedData);
            $body_id = $this->request->getPost("body_id");
            $org_unit_code = $this->request->getPost("org_unit_code");
            $pasien_diagnosa_id = $this->request->getPost("pasien_diagnosa_id");
            $diagnosa_id = $this->request->getPost("diagnosa_id");
            $no_registration = $this->request->getPost("no_registration");
            $visit_id = $this->request->getPost("visit_id");
            $bill_id = $this->request->getPost("bill_id");
            $clinic_id = $this->request->getPost("clinic_id");
            $class_room_id = $this->request->getPost("class_room_id");
            $in_date = $this->request->getPost("in_date");
            $exit_date = $this->request->getPost("exit_date");
            $keluar_id = $this->request->getPost("keluar_id");
            $examination_date = $this->request->getPost("examination_date");
            $employee_id = $this->request->getPost("employee_id");
            $description = $this->request->getPost("description");
            $modified_date = $this->request->getPost("modified_date");
            $modified_by = $this->request->getPost("modified_by");
            $modified_from = $this->request->getPost("modified_from");
            $status_pasien_id = $this->request->getPost("status_pasien_id");
            $ageyear = $this->request->getPost("ageyear");
            $agemonth = $this->request->getPost("agemonth");
            $ageday = $this->request->getPost("ageday");
            $thename = $this->request->getPost("thename");
            $theaddress = $this->request->getPost("theaddress");
            $theid = $this->request->getPost("theid");
            $isrj = $this->request->getPost("isrj");
            $gender = $this->request->getPost("gender");
            $doctor = $this->request->getPost("doctor");
            $kal_id = $this->request->getPost("kal_id");
            $petugas_id = $this->request->getPost("petugas_id");
            $petugas = $this->request->getPost("petugas");
            $account_id = $this->request->getPost("account_id");
            $cpoe_emr_rel_id = $this->request->getPost("cpoe_emr_rel_id");
            $cpoe_id = $this->request->getPost("cpoe_id");
            $episode_categ = $this->request->getPost("episode_categ");
            $date_order = $this->request->getPost("date_order");
            $patient_id = $this->request->getPost("patient_id");
            $patient_code = $this->request->getPost("patient_code");
            $patient_age = $this->request->getPost("patient_age");
            $patient_gender = $this->request->getPost("patient_gender");
            $colorbar = $this->request->getPost("colorbar");
            $physician_id = $this->request->getPost("physician_id");
            $physician_speciality = $this->request->getPost("physician_speciality");
            $payment_method = $this->request->getPost("payment_method");
            $pricelist_id = $this->request->getPost("pricelist_id");
            $currency_id = $this->request->getPost("currency_id");
            $is_out_cppt = $this->request->getPost("is_out_cppt");
            $soap_subjective = $this->request->getPost("soap_subjective");
            $soap_objective = $this->request->getPost("soap_objective");
            $ana_main_complaint = $this->request->getPost("ana_main_complaint");
            $ana_auto_current_disease_history = $this->request->getPost("ana_auto_current_disease_history");
            $ana_past_disease_history = $this->request->getPost("ana_past_disease_history");
            $ana_family_disease_history = $this->request->getPost("ana_family_disease_history");
            $ana_allergy_history_non_drugs = $this->request->getPost("ana_allergy_history_non_drugs");
            $ana_allergy_history_drugs = $this->request->getPost("ana_allergy_history_drugs");
            $ana_pregnancy_childbirth_history = $this->request->getPost("ana_pregnancy_childbirth_history");
            $ana_diet_history = $this->request->getPost("ana_diet_history");
            $ana_imun_history = $this->request->getPost("ana_imun_history");
            $ana_drugs_consumed = $this->request->getPost("ana_drugs_consumed");
            $pf_vital_sign_bp = $this->request->getPost("pf_vital_sign_bp");
            $pf_vital_sign_n = $this->request->getPost("pf_vital_sign_n");
            $pf_vital_sign_s = $this->request->getPost("pf_vital_sign_s");
            $pf_vital_sign_rr = $this->request->getPost("pf_vital_sign_rr");
            $pf_vital_sign_weight = $this->request->getPost("pf_vital_sign_weight");
            $pf_vital_sign_height = $this->request->getPost("pf_vital_sign_height");
            $pf_vital_sign_spo2 = $this->request->getPost("pf_vital_sign_spo2");
            $pf_vital_sign_bmi = $this->request->getPost("pf_vital_sign_bmi");
            $pf_gcs_type = $this->request->getPost("pf_gcs_type");
            $pf_gcs_e = $this->request->getPost("pf_gcs_e");
            $pf_gcs_v = $this->request->getPost("pf_gcs_v");
            $pf_gcs_m = $this->request->getPost("pf_gcs_m");
            $pf_pgcs_e = $this->request->getPost("pf_pgcs_e");
            $pf_pgcs_v_type = $this->request->getPost("pf_pgcs_v_type");
            $pf_pgcs_v = $this->request->getPost("pf_pgcs_v");
            $pf_pgcs_v_non = $this->request->getPost("pf_pgcs_v_non");
            $pf_pgcs_m = $this->request->getPost("pf_pgcs_m");
            $pf_general_condition = $this->request->getPost("pf_general_condition");
            $pf_cranium = $this->request->getPost("pf_cranium");
            $pf_eyes = $this->request->getPost("pf_eyes");
            $pf_nose = $this->request->getPost("pf_nose");
            $pf_mouth = $this->request->getPost("pf_mouth");
            $pf_tooth = $this->request->getPost("pf_tooth");
            $pf_neck = $this->request->getPost("pf_neck");
            $pf_thorax = $this->request->getPost("pf_thorax");
            $pf_thorax_image = $this->request->getPost("pf_thorax_image");
            $pf_heart = $this->request->getPost("pf_heart");
            $pf_heart_image = $this->request->getPost("pf_heart_image");
            $pf_lungs = $this->request->getPost("pf_lungs");
            $pf_abdomen = $this->request->getPost("pf_abdomen");
            $pf_abdomen_image = $this->request->getPost("pf_abdomen_image");
            $pf_hepar = $this->request->getPost("pf_hepar");
            $pf_lien = $this->request->getPost("pf_lien");
            $pf_kidney = $this->request->getPost("pf_kidney");
            $pf_genitalia = $this->request->getPost("pf_genitalia");
            $pf_upper_extremity = $this->request->getPost("pf_upper_extremity");
            $pf_lower_extremity = $this->request->getPost("pf_lower_extremity");
            $pf_ls_ear = $this->request->getPost("pf_ls_ear");
            $pf_ls_nose = $this->request->getPost("pf_ls_nose");
            $pf_ls_throat = $this->request->getPost("pf_ls_throat");
            $cause_of_injury_poisoning = $this->request->getPost("cause_of_injury_poisoning");
            $nursing_problem = $this->request->getPost("nursing_problem");
            $medical_problem = $this->request->getPost("medical_problem");
            $care_and_therapy_plan = $this->request->getPost("care_and_therapy_plan");
            $follow_up_plan = $this->request->getPost("follow_up_plan");
            $rtj_control = $this->request->getPost("rtj_control");
            $rtj_time_of_death_emergency = $this->request->getPost("rtj_time_of_death_emergency");
            $rtj_inpatient_indication = $this->request->getPost("rtj_inpatient_indication");
            $rtj_inpatient_dpjp = $this->request->getPost("rtj_inpatient_dpjp");
            $rtj_inpatient_classes = $this->request->getPost("rtj_inpatient_classes");
            $rtj_inpatient_ward = $this->request->getPost("rtj_inpatient_ward");
            $rtj_inpatient_room = $this->request->getPost("rtj_inpatient_room");
            $rtj_inpatient_bed = $this->request->getPost("rtj_inpatient_bed");
            $rtj_referenced = $this->request->getPost("rtj_referenced");
            $rtj_referenced_to = $this->request->getPost("rtj_referenced_to");
            $rtj_referenced_phys = $this->request->getPost("rtj_referenced_phys");
            $rtj_referenced_based_on = $this->request->getPost("rtj_referenced_based_on");
            $rtj_referenced_deliver_by = $this->request->getPost("rtj_referenced_deliver_by");
            $patient_education = $this->request->getPost("patient_education");
            $if_patient_family = $this->request->getPost("if_patient_family");
            $if_can_not_give_edu = $this->request->getPost("if_can_not_give_edu");
            $explanation_receipient_name = $this->request->getPost("explanation_receipient_name");
            $doctor_name = $this->request->getPost("doctor_name");
            $paraf_doctor = $this->request->getPost("paraf_doctor");
            $episode_id = $this->request->getPost("episode_id");
            $app_nmbr = $this->request->getPost("app_nmbr");
            $code = $this->request->getPost("code");
            $proc_order_id = $this->request->getPost("proc_order_id");
            $open_header_flag = $this->request->getPost("open_header_flag");
            $hide_action_button = $this->request->getPost("hide_action_button");
            $lab_order_id = $this->request->getPost("lab_order_id");
            $physio_order_id = $this->request->getPost("physio_order_id");
            $radio_order_id = $this->request->getPost("radio_order_id");
            $is_cppt_leads = $this->request->getPost("is_cppt_leads");
            $refphysician_id = $this->request->getPost("refphysician_id");
            $inpatient_physician_speciality = $this->request->getPost("inpatient_physician_speciality");
            $is_fast_track = $this->request->getPost("is_fast_track");
            $is_cito = $this->request->getPost("is_cito");
            $is_rad_pending = $this->request->getPost("is_rad_pending");
            $rad_pending_order = $this->request->getPost("rad_pending_order");
            $is_lab_pending = $this->request->getPost("is_lab_pending");
            $lab_pending_order = $this->request->getPost("lab_pending_order");
            $is_phy_pending = $this->request->getPost("is_phy_pending");
            $phy_pending_order = $this->request->getPost("phy_pending_order");
            $has_drug_allergy = $this->request->getPost("has_drug_allergy");
            $state = $this->request->getPost("state");
            $standing_order = $this->request->getPost("standing_order");
            $is_locked = $this->request->getPost("is_locked");
            $text_diagnosis = $this->request->getPost("text_diagnosis");
            $is_signed = $this->request->getPost("is_signed");
            $last_notebook = $this->request->getPost("last_notebook");
            $inv_vendor_lab_id = $this->request->getPost("inv_vendor_lab_id");
            $lab_medical_checkup = $this->request->getPost("lab_medical_checkup");
            $inv_vendor_radio_id = $this->request->getPost("inv_vendor_radio_id");
            $inv_vendor_phy_id = $this->request->getPost("inv_vendor_phy_id");
            $inv_vendor_id = $this->request->getPost("inv_vendor_id");
            $inv_vendor_nurse_id = $this->request->getPost("inv_vendor_nurse_id");
            $inv_vendor_midwife_id = $this->request->getPost("inv_vendor_midwife_id");
            $has_pain_scale = $this->request->getPost("has_pain_scale");
            $pain_scale_type = $this->request->getPost("pain_scale_type");
            $numeric_scale = $this->request->getPost("numeric_scale");
            $wong_baker_scale = $this->request->getPost("wong_baker_scale");
            $cpot_ekspresi_wajah = $this->request->getPost("cpot_ekspresi_wajah");
            $cpot_gerakan_tubuh = $this->request->getPost("cpot_gerakan_tubuh");
            $cpot_options = $this->request->getPost("cpot_options");
            $cpot_aktivasi_ventilator = $this->request->getPost("cpot_aktivasi_ventilator");
            $cpot_berbicara = $this->request->getPost("cpot_berbicara");
            $cpot_ketegangan_otot = $this->request->getPost("cpot_ketegangan_otot");
            $nips_ekspresi_wajah = $this->request->getPost("nips_ekspresi_wajah");
            $nips_tangisan = $this->request->getPost("nips_tangisan");
            $nips_pola_nafas = $this->request->getPost("nips_pola_nafas");
            $nips_tungkai = $this->request->getPost("nips_tungkai");
            $nips_tingkat_kesadaran = $this->request->getPost("nips_tingkat_kesadaran");
            $painad_pernafasan = $this->request->getPost("painad_pernafasan");
            $painad_vokalisasi_negatif = $this->request->getPost("painad_vokalisasi_negatif");
            $painad_ekspresi_wajah = $this->request->getPost("painad_ekspresi_wajah");
            $painad_bahasa_tubuh = $this->request->getPost("painad_bahasa_tubuh");
            $painad_konsabilitas = $this->request->getPost("painad_konsabilitas");
            $flacc_wajah = $this->request->getPost("flacc_wajah");
            $flacc_kaki = $this->request->getPost("flacc_kaki");
            $flacc_aktivitas = $this->request->getPost("flacc_aktivitas");
            $flacc_menangis = $this->request->getPost("flacc_menangis");
            $flacc_konsabilitas = $this->request->getPost("flacc_konsabilitas");
            $has_fall_risk = $this->request->getPost("has_fall_risk");
            $fall_risk_desc = $this->request->getPost("fall_risk_desc");
            $fall_risk_type = $this->request->getPost("fall_risk_type");
            $hd_usia = $this->request->getPost("hd_usia");
            $hd_jenis_kelamin = $this->request->getPost("hd_jenis_kelamin");
            $hd_diagnosa = $this->request->getPost("hd_diagnosa");
            $hd_gangguan_kognitif = $this->request->getPost("hd_gangguan_kognitif");
            $hd_faktor_lingkungan = $this->request->getPost("hd_faktor_lingkungan");
            $hd_respon_pembedahan_sedasi_anestesi = $this->request->getPost("hd_respon_pembedahan_sedasi_anestesi");
            $hd_respon_penggunaan_medikamentosa = $this->request->getPost("hd_respon_penggunaan_medikamentosa");
            $fm_riwayat_jatuh = $this->request->getPost("fm_riwayat_jatuh");
            $fm_diagnosis_sekunder = $this->request->getPost("fm_diagnosis_sekunder");
            $fm_menggunakan_alat_bantu = $this->request->getPost("fm_menggunakan_alat_bantu");
            $fm_menggunakan_infuse_heparine = $this->request->getPost("fm_menggunakan_infuse_heparine");
            $fm_gaya_berjalan = $this->request->getPost("fm_gaya_berjalan");
            $fm_status_mental = $this->request->getPost("fm_status_mental");
            $fm_medikasi = $this->request->getPost("fm_medikasi");
            $note_subjective = $this->request->getPost("note_subjective");
            $note_objective = $this->request->getPost("note_objective");
            $note_obat_confirmed = $this->request->getPost("note_obat_confirmed");
            $note_lab_confirmed = $this->request->getPost("note_lab_confirmed");
            $note_rad_confirmed = $this->request->getPost("note_rad_confirmed");
            $note_phy_confirmed = $this->request->getPost("note_phy_confirmed");
            $note_proc_confirmed = $this->request->getPost("note_proc_confirmed");
            $additional_note = $this->request->getPost("additional_note");
            $final_note = $this->request->getPost("final_note");
            $create_uid = $this->request->getPost("create_uid");
            $create_date = $this->request->getPost("create_date");
            $write_uid = $this->request->getPost("write_uid");
            $write_date = $this->request->getPost("write_date");
            $patient_family_name = $this->request->getPost("patient_family_name");
            $is_applicant_signed = $this->request->getPost("is_applicant_signed");
            $applicant_sign = $this->request->getPost("applicant_sign");
            $rtj_inpatient_location = $this->request->getPost("rtj_inpatient_location");
            $rtj_referenced_dept = $this->request->getPost("rtj_referenced_dept");
            $rtj_inpatient_standing_order = $this->request->getPost("rtj_inpatient_standing_order");
            $rtj_is_control = $this->request->getPost("rtj_is_control");
            $rtj_control_date = $this->request->getPost("rtj_control_date");
            $rtj_control_reason = $this->request->getPost("rtj_control_reason");
            $rtj_outpatient_type = $this->request->getPost("rtj_outpatient_type");
            $rtj_referenced_based_other = $this->request->getPost("rtj_referenced_based_other");
            $rtj_rujuk_type = $this->request->getPost("rtj_rujuk_type");
            $pf_ears = $this->request->getPost("pf_ears");
            $coass_residence_sign = $this->request->getPost("coass_residence_sign");
            $is_coas_signed = $this->request->getPost("is_coas_signed");
            $coas_signed_datetime = $this->request->getPost("coas_signed_datetime");
            $month_count = $this->request->getPost("month_count");
            $rtj_internal_ref_pysician_id = $this->request->getPost("rtj_internal_ref_pysician_id");
            $rtj_internal_ref_notes = $this->request->getPost("rtj_internal_ref_notes");
            $soap_planning = $this->request->getPost("soap_planning");
            $is_consul_discount = $this->request->getPost("is_consul_discount");
            $sign_datetime = $this->request->getPost("sign_datetime");
            $pf_ls_eardrum = $this->request->getPost("pf_ls_eardrum");
            $pf_ls_ear_desc = $this->request->getPost("pf_ls_ear_desc");
            $pf_ls_nose_desc = $this->request->getPost("pf_ls_nose_desc");
            $pf_ls_throat_desc = $this->request->getPost("pf_ls_throat_desc");
            $clinical_indication = $this->request->getPost("clinical_indication");
            $target_of_therapy = $this->request->getPost("target_of_therapy");
            $rtj_out_instruction = $this->request->getPost("rtj_out_instruction");
            $set_all_dbn = $this->request->getPost("set_all_dbn");
            $education_material = $this->request->getPost("education_material");
            $outer_ear = $this->request->getPost("outer_ear");
            $earlobe = $this->request->getPost("earlobe");
            $ear_canal = $this->request->getPost("ear_canal");
            $middle_ear = $this->request->getPost("middle_ear");
            $tympanic_membrane = $this->request->getPost("tympanic_membrane");
            $audiometry = $this->request->getPost("audiometry");
            $outer_cavum_nasi = $this->request->getPost("outer_cavum_nasi");
            $inner_cavum_nasi = $this->request->getPost("inner_cavum_nasi");
            $concae = $this->request->getPost("concae");
            $septum_nasi = $this->request->getPost("septum_nasi");
            $concae_inferior = $this->request->getPost("concae_inferior");
            $tonsil = $this->request->getPost("tonsil");
            $farinx_posterior_region = $this->request->getPost("farinx_posterior_region");
            $epiglottis = $this->request->getPost("epiglottis");
            $larinx = $this->request->getPost("larinx");
            $vocal_cords = $this->request->getPost("vocal_cords");
            $message_main_attachment_id = $this->request->getPost("message_main_attachment_id");
            $rtj_inpatient_service_needs = $this->request->getPost("rtj_inpatient_service_needs");
            $trial118 = $this->request->getPost("trial118");


            $isNewKunj = false;
            if ($body['body_id'] == null || $body['body_id'] == '') {
                $db = db_connect();
                $select = $db->query("select cast(year(getdate()) as varchar(4)) +
                right(cast((month(getdate()) + 100) as varchar(3)),2)+
                right(cast((day(getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
                right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3) as id")->getResultArray();
                // $vactination_id = $select[0]['id'];
                $body_id = $select[0]['id'];
                $isNewKunj = true;
            }
            // return json_encode($body_id);

            $db = new RMJ26Model();
            $data = [
                'body_id' => $body_id,
                'org_unit_code' => $org_unit_code,
                'pasien_diagnosa_id' => $pasien_diagnosa_id,
                'diagnosa_id' => $diagnosa_id,
                'no_registration' => $no_registration,
                'visit_id' => $visit_id,
                'bill_id' => $bill_id,
                'clinic_id' => $clinic_id,
                'class_room_id' => $class_room_id,
                'in_date' => $in_date,
                'exit_date' => $exit_date,
                'keluar_id' => $keluar_id,
                'examination_date' => $examination_date,
                'employee_id' => $employee_id,
                'description' => $description,
                'modified_date' => $modified_date,
                'modified_by' => $modified_by,
                'modified_from' => $modified_from,
                'status_pasien_id' => $status_pasien_id,
                'ageyear' => $ageyear,
                'agemonth' => $agemonth,
                'ageday' => $ageday,
                'thename' => $thename,
                'theaddress' => $theaddress,
                'theid' => $theid,
                'isrj' => $isrj,
                'gender' => $gender,
                'doctor' => $doctor,
                'kal_id' => $kal_id,
                'petugas_id' => $petugas_id,
                'petugas' => $petugas,
                'account_id' => $account_id,
                'cpoe_emr_rel_id' => $cpoe_emr_rel_id,
                'cpoe_id' => $cpoe_id,
                'episode_categ' => $episode_categ,
                'date_order' => $date_order,
                'patient_id' => $patient_id,
                'patient_code' => $patient_code,
                'patient_age' => $patient_age,
                'patient_gender' => $patient_gender,
                'colorbar' => $colorbar,
                'physician_id' => $physician_id,
                'physician_speciality' => $physician_speciality,
                'payment_method' => $payment_method,
                'pricelist_id' => $pricelist_id,
                'currency_id' => $currency_id,
                'is_out_cppt' => $is_out_cppt,
                'soap_subjective' => $soap_subjective,
                'soap_objective' => $soap_objective,
                'ana_main_complaint' => $ana_main_complaint,
                'ana_auto_current_disease_history' => $ana_auto_current_disease_history,
                'ana_past_disease_history' => $ana_past_disease_history,
                'ana_family_disease_history' => $ana_family_disease_history,
                'ana_allergy_history_non_drugs' => $ana_allergy_history_non_drugs,
                'ana_allergy_history_drugs' => $ana_allergy_history_drugs,
                'ana_pregnancy_childbirth_history' => $ana_pregnancy_childbirth_history,
                'ana_diet_history' => $ana_diet_history,
                'ana_imun_history' => $ana_imun_history,
                'ana_drugs_consumed' => $ana_drugs_consumed,
                'pf_vital_sign_bp' => $pf_vital_sign_bp,
                'pf_vital_sign_n' => $pf_vital_sign_n,
                'pf_vital_sign_s' => $pf_vital_sign_s,
                'pf_vital_sign_rr' => $pf_vital_sign_rr,
                'pf_vital_sign_weight' => $pf_vital_sign_weight,
                'pf_vital_sign_height' => $pf_vital_sign_height,
                'pf_vital_sign_spo2' => $pf_vital_sign_spo2,
                'pf_vital_sign_bmi' => $pf_vital_sign_bmi,
                'pf_gcs_type' => $pf_gcs_type,
                'pf_gcs_e' => $pf_gcs_e,
                'pf_gcs_v' => $pf_gcs_v,
                'pf_gcs_m' => $pf_gcs_m,
                'pf_pgcs_e' => $pf_pgcs_e,
                'pf_pgcs_v_type' => $pf_pgcs_v_type,
                'pf_pgcs_v' => $pf_pgcs_v,
                'pf_pgcs_v_non' => $pf_pgcs_v_non,
                'pf_pgcs_m' => $pf_pgcs_m,
                'pf_general_condition' => $pf_general_condition,
                'pf_cranium' => $pf_cranium,
                'pf_eyes' => $pf_eyes,
                'pf_nose' => $pf_nose,
                'pf_mouth' => $pf_mouth,
                'pf_tooth' => $pf_tooth,
                'pf_neck' => $pf_neck,
                'pf_thorax' => $pf_thorax,
                'pf_thorax_image' => $pf_thorax_image,
                'pf_heart' => $pf_heart,
                'pf_heart_image' => $pf_heart_image,
                'pf_lungs' => $pf_lungs,
                'pf_abdomen' => $pf_abdomen,
                'pf_abdomen_image' => $pf_abdomen_image,
                'pf_hepar' => $pf_hepar,
                'pf_lien' => $pf_lien,
                'pf_kidney' => $pf_kidney,
                'pf_genitalia' => $pf_genitalia,
                'pf_upper_extremity' => $pf_upper_extremity,
                'pf_lower_extremity' => $pf_lower_extremity,
                'pf_ls_ear' => $pf_ls_ear,
                'pf_ls_nose' => $pf_ls_nose,
                'pf_ls_throat' => $pf_ls_throat,
                'cause_of_injury_poisoning' => $cause_of_injury_poisoning,
                'nursing_problem' => $nursing_problem,
                'medical_problem' => $medical_problem,
                'care_and_therapy_plan' => $care_and_therapy_plan,
                'follow_up_plan' => $follow_up_plan,
                'rtj_control' => $rtj_control,
                'rtj_time_of_death_emergency' => $rtj_time_of_death_emergency,
                'rtj_inpatient_indication' => $rtj_inpatient_indication,
                'rtj_inpatient_dpjp' => $rtj_inpatient_dpjp,
                'rtj_inpatient_classes' => $rtj_inpatient_classes,
                'rtj_inpatient_ward' => $rtj_inpatient_ward,
                'rtj_inpatient_room' => $rtj_inpatient_room,
                'rtj_inpatient_bed' => $rtj_inpatient_bed,
                'rtj_referenced' => $rtj_referenced,
                'rtj_referenced_to' => $rtj_referenced_to,
                'rtj_referenced_phys' => $rtj_referenced_phys,
                'rtj_referenced_based_on' => $rtj_referenced_based_on,
                'rtj_referenced_deliver_by' => $rtj_referenced_deliver_by,
                'patient_education' => $patient_education,
                'if_patient_family' => $if_patient_family,
                'if_can_not_give_edu' => $if_can_not_give_edu,
                'explanation_receipient_name' => $explanation_receipient_name,
                'doctor_name' => $doctor_name,
                'paraf_doctor' => $paraf_doctor,
                'episode_id' => $episode_id,
                'app_nmbr' => $app_nmbr,
                'code' => $code,
                'proc_order_id' => $proc_order_id,
                'open_header_flag' => $open_header_flag,
                'hide_action_button' => $hide_action_button,
                'lab_order_id' => $lab_order_id,
                'physio_order_id' => $physio_order_id,
                'radio_order_id' => $radio_order_id,
                'is_cppt_leads' => $is_cppt_leads,
                'refphysician_id' => $refphysician_id,
                'inpatient_physician_speciality' => $inpatient_physician_speciality,
                'is_fast_track' => $is_fast_track,
                'is_cito' => $is_cito,
                'is_rad_pending' => $is_rad_pending,
                'rad_pending_order' => $rad_pending_order,
                'is_lab_pending' => $is_lab_pending,
                'lab_pending_order' => $lab_pending_order,
                'is_phy_pending' => $is_phy_pending,
                'phy_pending_order' => $phy_pending_order,
                'has_drug_allergy' => $has_drug_allergy,
                'state' => $state,
                'standing_order' => $standing_order,
                'is_locked' => $is_locked,
                'text_diagnosis' => $text_diagnosis,
                'is_signed' => $is_signed,
                'last_notebook' => $last_notebook,
                'inv_vendor_lab_id' => $inv_vendor_lab_id,
                'lab_medical_checkup' => $lab_medical_checkup,
                'inv_vendor_radio_id' => $inv_vendor_radio_id,
                'inv_vendor_phy_id' => $inv_vendor_phy_id,
                'inv_vendor_id' => $inv_vendor_id,
                'inv_vendor_nurse_id' => $inv_vendor_nurse_id,
                'inv_vendor_midwife_id' => $inv_vendor_midwife_id,
                'has_pain_scale' => $has_pain_scale,
                'pain_scale_type' => $pain_scale_type,
                'numeric_scale' => $numeric_scale,
                'wong_baker_scale' => $wong_baker_scale,
                'cpot_ekspresi_wajah' => $cpot_ekspresi_wajah,
                'cpot_gerakan_tubuh' => $cpot_gerakan_tubuh,
                'cpot_options' => $cpot_options,
                'cpot_aktivasi_ventilator' => $cpot_aktivasi_ventilator,
                'cpot_berbicara' => $cpot_berbicara,
                'cpot_ketegangan_otot' => $cpot_ketegangan_otot,
                'nips_ekspresi_wajah' => $nips_ekspresi_wajah,
                'nips_tangisan' => $nips_tangisan,
                'nips_pola_nafas' => $nips_pola_nafas,
                'nips_tungkai' => $nips_tungkai,
                'nips_tingkat_kesadaran' => $nips_tingkat_kesadaran,
                'painad_pernafasan' => $painad_pernafasan,
                'painad_vokalisasi_negatif' => $painad_vokalisasi_negatif,
                'painad_ekspresi_wajah' => $painad_ekspresi_wajah,
                'painad_bahasa_tubuh' => $painad_bahasa_tubuh,
                'painad_konsabilitas' => $painad_konsabilitas,
                'flacc_wajah' => $flacc_wajah,
                'flacc_kaki' => $flacc_kaki,
                'flacc_aktivitas' => $flacc_aktivitas,
                'flacc_menangis' => $flacc_menangis,
                'flacc_konsabilitas' => $flacc_konsabilitas,
                'has_fall_risk' => $has_fall_risk,
                'fall_risk_desc' => $fall_risk_desc,
                'fall_risk_type' => $fall_risk_type,
                'hd_usia' => $hd_usia,
                'hd_jenis_kelamin' => $hd_jenis_kelamin,
                'hd_diagnosa' => $hd_diagnosa,
                'hd_gangguan_kognitif' => $hd_gangguan_kognitif,
                'hd_faktor_lingkungan' => $hd_faktor_lingkungan,
                'hd_respon_pembedahan_sedasi_anestesi' => $hd_respon_pembedahan_sedasi_anestesi,
                'hd_respon_penggunaan_medikamentosa' => $hd_respon_penggunaan_medikamentosa,
                'fm_riwayat_jatuh' => $fm_riwayat_jatuh,
                'fm_diagnosis_sekunder' => $fm_diagnosis_sekunder,
                'fm_menggunakan_alat_bantu' => $fm_menggunakan_alat_bantu,
                'fm_menggunakan_infuse_heparine' => $fm_menggunakan_infuse_heparine,
                'fm_gaya_berjalan' => $fm_gaya_berjalan,
                'fm_status_mental' => $fm_status_mental,
                'fm_medikasi' => $fm_medikasi,
                'note_subjective' => $note_subjective,
                'note_objective' => $note_objective,
                'note_obat_confirmed' => $note_obat_confirmed,
                'note_lab_confirmed' => $note_lab_confirmed,
                'note_rad_confirmed' => $note_rad_confirmed,
                'note_phy_confirmed' => $note_phy_confirmed,
                'note_proc_confirmed' => $note_proc_confirmed,
                'additional_note' => $additional_note,
                'final_note' => $final_note,
                'create_uid' => $create_uid,
                'create_date' => $create_date,
                'write_uid' => $write_uid,
                'write_date' => $write_date,
                'patient_family_name' => $patient_family_name,
                'is_applicant_signed' => $is_applicant_signed,
                'applicant_sign' => $applicant_sign,
                'rtj_inpatient_location' => $rtj_inpatient_location,
                'rtj_referenced_dept' => $rtj_referenced_dept,
                'rtj_inpatient_standing_order' => $rtj_inpatient_standing_order,
                'rtj_is_control' => $rtj_is_control,
                'rtj_control_date' => $rtj_control_date,
                'rtj_control_reason' => $rtj_control_reason,
                'rtj_outpatient_type' => $rtj_outpatient_type,
                'rtj_referenced_based_other' => $rtj_referenced_based_other,
                'rtj_rujuk_type' => $rtj_rujuk_type,
                'pf_ears' => $pf_ears,
                'coass_residence_sign' => $coass_residence_sign,
                'is_coas_signed' => $is_coas_signed,
                'coas_signed_datetime' => $coas_signed_datetime,
                'month_count' => $month_count,
                'rtj_internal_ref_pysician_id' => $rtj_internal_ref_pysician_id,
                'rtj_internal_ref_notes' => $rtj_internal_ref_notes,
                'soap_planning' => $soap_planning,
                'is_consul_discount' => $is_consul_discount,
                'sign_datetime' => $sign_datetime,
                'pf_ls_eardrum' => $pf_ls_eardrum,
                'pf_ls_ear_desc' => $pf_ls_ear_desc,
                'pf_ls_nose_desc' => $pf_ls_nose_desc,
                'pf_ls_throat_desc' => $pf_ls_throat_desc,
                'clinical_indication' => $clinical_indication,
                'target_of_therapy' => $target_of_therapy,
                'rtj_out_instruction' => $rtj_out_instruction,
                'set_all_dbn' => $set_all_dbn,
                'education_material' => $education_material,
                'outer_ear' => $outer_ear,
                'earlobe' => $earlobe,
                'ear_canal' => $ear_canal,
                'middle_ear' => $middle_ear,
                'tympanic_membrane' => $tympanic_membrane,
                'audiometry' => $audiometry,
                'outer_cavum_nasi' => $outer_cavum_nasi,
                'inner_cavum_nasi' => $inner_cavum_nasi,
                'concae' => $concae,
                'septum_nasi' => $septum_nasi,
                'concae_inferior' => $concae_inferior,
                'tonsil' => $tonsil,
                'farinx_posterior_region' => $farinx_posterior_region,
                'epiglottis' => $epiglottis,
                'larinx' => $larinx,
                'vocal_cords' => $vocal_cords,
                'message_main_attachment_id' => $message_main_attachment_id,
                'rtj_inpatient_service_needs' => $rtj_inpatient_service_needs,
                'trial118' => $trial118,
            ];
            if ($isNewKunj) {
                $coba = $db->insert($data);
            } else {
                $coba = $db->save($data);
            }



            $select = $this->lowerKey($db->where("body_id = '" . $body_id . "'")->findAll());
            // return json_encode($select);

            $select[0]['clinical_indication'] =  $encodedDataDokter;
            $select[0]['target_of_therapy'] =  $encodedDataPasien;


            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-7.php", [
                "visit" => $visit,
                "val" => $select[0],
                'title' => $title
            ]);
        }
    }
    public function rmj2_8($visit, $vactination_id = null)
    {
        $title = 'ASSESMEN MEDIS PASIEN GIGI DAN MULUT';
        $visit = base64_decode($visit);
        $visit = json_decode($visit, true);
        $db = db_connect();
        $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_kulit where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());
        if ($this->request->is('get')) {
            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-8.php", [
                    "visit" => $visit,
                    'title' => $title,
                    "val" => $select[0]
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-8.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function rmj2_9($visit, $vactination_id = null)
    {
        $title = 'ASSESMEN MEDIS PASIEN RAWAT JALAN MATA';
        if ($this->request->is('get')) {

            $visit = base64_decode($visit);
            $visit = json_decode($visit, true);
            // return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-7.php", [
            //     "visit" => $visit,
            // ]);
            $db = db_connect();
            $select = $this->lowerKey($db->query("select * from hosnic_emr_rj_mata where visit_id = '" . $visit['visit_id'] . "'")->getResultArray());

            if (isset($select[0])) {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-9.php", [
                    "visit" => $visit,
                    "val" => $select[0],
                    'title' => $title
                ]);
            } else {
                return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-9.php", [
                    "visit" => $visit,
                    'title' => $title
                ]);
            }
        }
    }
    public function rmj2_10($visit, $vactination_id = null)
    {
        $title = 'ASESMEN AWAL MEDIS PASIEN BEDAH ORTHOPEDI RAWAT JALAN';
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rmj/RMJ2/RMJ-2-10.php", [
                "visit" => $visit,
                'title' => $title
            ]);
        }
    }
    public function rmj2_11($visit, $vactination_id = null)
    {
        $title = 'ASESMEN RAWAT JALAN GERIATRI';
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-11.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rmj2_12($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-12.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rmj2_13($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-13.php", [
                "visit" => $visit
            ]);
        }
    }
    public function rmj2_14($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-2-14.php", [
                "visit" => $visit
            ]);
        }
    }









    public function rm3_2_1($visit, $vactination_id = null)
    {
        if ($this->request->is('get')) {
            return view("admin/patient/profilemodul/formrm/rmj/RMJ2//RMJ-3-2-1.php", [
                "visit" => $visit
            ]);
        }
    }

    public function rm_cppt($visit)
    {
        $visit = base64_decode($visit);
        $visit = json_decode($visit, true);
        $db = db_connect();
        $select = $this->lowerKey($db->query("select examination_date from hosnic_emr_rj_mata where examination_info = '" . $visit['no_registration'] . "'")->getResultArray());
    }
}
