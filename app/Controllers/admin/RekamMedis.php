<?php

namespace App\Controllers\Admin;

use App\Models\CaraKeluarModel;
use App\Models\ClassModel;
use App\Models\ClassRoomModel;
use App\Models\ClinicModel;
use App\Models\EmployeeAllModel;
use App\Models\InasisKontrolModel;
use App\Models\InasisRujukanModel;
use App\Models\OrganizationunitModel;
use App\Models\PasienDiagnosasModel;
use App\Models\PasienLaboratModel;
use App\Models\PasienModel;
use App\Models\PasienVisitationModel;
use App\Models\StatusPasienModel;
use App\Models\TreatmentAkomodasiModel;
use App\Models\TreatTarifModel;
use CodeIgniter\Database\RawSql;

class RekamMedis extends \App\Controllers\BaseController
{
    public function getdokterrujukan()
    {
        if (!$this->request->is('post')) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
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
        // return json_encode($data);
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
        // $data['id'] = $this->request->getPost('id');
        // $data['perujuk'] = $this->request->getPost('perujuk');
        // $data['alamat_perujuk'] = $this->request->getPost('alamat_perujuk');
        // $data['no_specimen'] = $this->request->getPost('no_specimen');
        // $data['pemeriksaan_lain'] = $this->request->getPost('pemeriksaan_lain');
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

        if ($data['vactination_id'] == null) {
            $data['vactination_id'] = new RawSql("cast(year(getdate()) as varchar(4)) +
right(cast((month(getdate()) + 100) as varchar(3)),2)+
right(cast((day(getdate()) + 100) as varchar(3)),2)+
right(cast((datepart(hour,getdate()) + 100) as varchar(3)),2)+
right(cast((datepart(minute,getdate()) + 100) as varchar(3)),2)+
right(cast((datepart(second,getdate()) + 100) as varchar(3)),2)+
right(cast((datepart(millisecond,getdate()) + 10000) as varchar(5)),4)+right(newid(),3)");
        }

        // return json_encode($data['vactination_id']);
        // $data['vactination_id'] = '202401121107123';

        $pl = new PasienLaboratModel();

        $return = $pl->insert($data, true);


        return json_encode($return);
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
}
