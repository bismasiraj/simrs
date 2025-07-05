<?php

namespace App\Controllers;

class Aplicares extends \App\Controllers\BaseController
{
    public function updateTT($class_room_id)
    {
        $db = db_connect();
        $org = $db->query("select other_code as kodeppk from organizationunit")->getFirstRow('array');
        $url = $this->baseurlaplicares . "/rest/bed/update/" . $org['kodeppk'];
        $method = 'POST';



        $builder = $db->query("  SELECT class_room.*, c.name_of_clinic,
                    CLASS_ROOM.name_of_class as classroomname,
                    cl.name_of_class,   
                     (SELECT COUNT(BED_ID) FROM BEDS WHERE 
                    CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) capasity,
                    ( SELECT COUNT(no_registration)  
                        FROM TREATMENT_AKOMODASI pv
                            WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                                    AND pv.CLASS_ROOM_ID IS NOT NULL
                                    AND ( pv.KELUAR_ID in ( 0))
                                    AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) terisi,
                     (SELECT COUNT(BED_ID) FROM BEDS WHERE 
                    CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) - ( SELECT COUNT(no_registration)  
                        FROM TREATMENT_AKOMODASI pv
                            WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                                    AND pv.CLASS_ROOM_ID IS NOT NULL
                                    AND ( pv.KELUAR_ID in ( 0))
                                    AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) sisa,
                    tt.tarif_id,
                    tt.amount_paid,
                    tt.tarif_name

      
                FROM CLASS_ROOM ,CLINIC C  ,CLASS CL, treat_tarif tt
                WHERE CLASS_ROOM_ID <> '0' 
                and CLASS_ROOM.isactive LIKE '1'
                AND CL.CLASS_ID= CLASS_ROOM.CLASS_ID
                AND CAST(CL.OTHER_ID AS VARCHAR(10)) LIKE '%'
                AND ( CLASS_ROOM.CLINIC_ID LIKE '%' or  CLASS_ROOM.NAME_OF_CLASS like '%' or
                    C.NAME_OF_CLINIC like '%')   AND C.CLINIC_ID = CLASS_ROOM.CLINIC_ID
                AND CLASS_ROOM.TARIF_ID = tt.TARIF_ID
                AND CLASS_ROOM_ID = '$class_room_id'
            ");
        $bedInfo = $builder->getFirstRow('array');
        $bedInfo = $this->lowerKey($bedInfo);


        $body = [
            "kodekelas" => $bedInfo['kodekelas'],
            "koderuang" => $bedInfo['display'],
            "namaruang" => $bedInfo['classroomname'],
            "kapasitas" => $bedInfo['capacity'],
            "tersedia" => $bedInfo['capacity'] - $bedInfo['terisi'],
            "tersediapria" => "0",
            "tersediawanita" => "0",
            "tersediapriawanita" => $bedInfo['capacity'] - $bedInfo['terisi'],
        ];

        // return $bedInfo;
        $postdata = json_encode($body);

        unset($result);
        $headers = $this->AuthBridging('vclaim');
        // return json_encode($postdata);
        array_push($headers, "Content-length: " . strlen($postdata));
        // return $url;
        return $this->sendAplicares($url, $method, $postdata);
    }
    public function updateAllTT()
    {
        $db = db_connect();
        $org = $db->query("select other_code as kodeppk from organizationunit")->getFirstRow('array');
        $url = $this->baseurlaplicares . "/rest/bed/update/" . $org['kodeppk'];
        $method = 'POST';



        $builder = $db->query("  SELECT class_room.*, c.name_of_clinic,
                    CLASS_ROOM.name_of_class as classroomname,
                    cl.name_of_class,   
                     (SELECT COUNT(BED_ID) FROM BEDS WHERE 
                    CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) capasity,
                    ( SELECT COUNT(no_registration)  
                        FROM TREATMENT_AKOMODASI pv
                            WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                                    AND pv.CLASS_ROOM_ID IS NOT NULL
                                    AND ( pv.KELUAR_ID in ( 0))
                                    AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) terisi,
                     (SELECT COUNT(BED_ID) FROM BEDS WHERE 
                    CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) - ( SELECT COUNT(no_registration)  
                        FROM TREATMENT_AKOMODASI pv
                            WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                                    AND pv.CLASS_ROOM_ID IS NOT NULL
                                    AND ( pv.KELUAR_ID in ( 0))
                                    AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) sisa,
                    tt.tarif_id,
                    tt.amount_paid,
                    tt.tarif_name

      
                FROM CLASS_ROOM ,CLINIC C  ,CLASS CL, treat_tarif tt
                WHERE CLASS_ROOM_ID <> '0' 
                and CLASS_ROOM.isactive LIKE '1'
                AND CL.CLASS_ID= CLASS_ROOM.CLASS_ID
                AND CAST(CL.OTHER_ID AS VARCHAR(10)) LIKE '%'
                AND ( CLASS_ROOM.CLINIC_ID LIKE '%' or  CLASS_ROOM.NAME_OF_CLASS like '%' or
                    C.NAME_OF_CLINIC like '%')   AND C.CLINIC_ID = CLASS_ROOM.CLINIC_ID
                AND CLASS_ROOM.TARIF_ID = tt.TARIF_ID
            ");
        $bedInfo = $builder->getResultArray('array');
        $bedInfo = $this->lowerKey($bedInfo);

        foreach ($bedInfo as $key => $value) {
            if (!is_null($value['display'])) {
                $body = [
                    "kodekelas" => $value['kodekelas'],
                    "koderuang" => $value['display'],
                    "namaruang" => $value['classroomname'],
                    "kapasitas" => $value['capacity'],
                    "tersedia" => $value['capacity'] - $value['terisi'],
                    "tersediapria" => "0",
                    "tersediawanita" => "0",
                    "tersediapriawanita" => $value['capacity'] - $value['terisi'],
                ];

                // return $bedInfo;
                $postdata = json_encode($body);

                unset($result);
                $headers = $this->AuthBridging('vclaim');
                // return json_encode($postdata);
                array_push($headers, "Content-length: " . strlen($postdata));
                // return $url;
                $result = $this->sendAplicares($url, $method, $postdata);

                $data['body'] = $body;
                $data['result'] = $result;

                $return[] = $data;
            }
        }

        return $return;
    }
    public function getTT()
    {
        $db = db_connect();
        $org = $db->query("select other_code as kodeppk from organizationunit")->getFirstRow('array');
        $url = $this->baseurlaplicares . "/rest/bed/read/" . $org['kodeppk'] . "/1/42";
        $method = 'GET';
        $postdata = '';
        // return $url;
        return $this->sendAplicares($url, $method, $postdata);
    }
    public function removeTT($data)
    {
        $db = db_connect();
        $org = $db->query("select other_code as kodeppk from organizationunit")->getFirstRow('array');
        $url = $this->baseurlaplicares . "/rest/bed/delete/" . $org['kodeppk'];
        $method = 'POST';
        $body["kodekelas"] = $data['kodekelas'];
        $body["koderuang"] = $data['koderuang'];
        $postdata = json_encode($body);
        // return $body;
        return $this->sendAplicares($url, $method, $postdata);
    }
    public function insertTT()
    {
        $db = db_connect();
        $org = $db->query("select other_code as kodeppk from organizationunit")->getFirstRow('array');
        $url = $this->baseurlaplicares . "/rest/bed/create/" . $org['kodeppk'];
        $method = 'POST';
        $builder = $db->query("  SELECT class_room.*, c.name_of_clinic,
        CLASS_ROOM.name_of_class as classroomname,
        cl.name_of_class,   
         (SELECT COUNT(BED_ID) FROM BEDS WHERE 
        CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) capasity,
        ( SELECT COUNT(no_registration)  
            FROM TREATMENT_AKOMODASI pv
                WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                        AND pv.CLASS_ROOM_ID IS NOT NULL
                        AND ( pv.KELUAR_ID in ( 0))
                        AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) terisi,
         (SELECT COUNT(BED_ID) FROM BEDS WHERE 
        CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID AND ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE) - ( SELECT COUNT(no_registration)  
            FROM TREATMENT_AKOMODASI pv
                WHERE  pv.CLASS_ROOM_ID = CLASS_ROOM.CLASS_ROOM_ID
                        AND pv.CLASS_ROOM_ID IS NOT NULL
                        AND ( pv.KELUAR_ID in ( 0))
                        AND pv.ORG_UNIT_CODE = CLASS_ROOM.ORG_UNIT_CODE  ) sisa,
        tt.tarif_id,
        tt.amount_paid,
        tt.tarif_name


    FROM CLASS_ROOM ,CLINIC C  ,CLASS CL, treat_tarif tt
    WHERE CLASS_ROOM_ID <> '0' 
    and display = 'E-KAHFI-1113'
    and CLASS_ROOM.isactive LIKE '1'
    AND CL.CLASS_ID= CLASS_ROOM.CLASS_ID
    AND CAST(CL.OTHER_ID AS VARCHAR(10)) LIKE '%'
    AND ( CLASS_ROOM.CLINIC_ID LIKE '%' or  CLASS_ROOM.NAME_OF_CLASS like '%' or
        C.NAME_OF_CLINIC like '%')   AND C.CLINIC_ID = CLASS_ROOM.CLINIC_ID
    AND CLASS_ROOM.TARIF_ID = tt.TARIF_ID
");
        $bedInfo = $builder->getResultArray('array');
        $bedInfo = $this->lowerKey($bedInfo);

        foreach ($bedInfo as $key => $value) {
            if (!is_null($value['display'])) {
                $body = [
                    "kodekelas" => $value['kodekelas'],
                    "koderuang" => $value['display'],
                    "namaruang" => $value['classroomname'],
                    "kapasitas" => $value['capacity'],
                    "tersedia" => $value['capacity'] - $value['terisi'],
                    "tersediapria" => "0",
                    "tersediawanita" => "0",
                    "tersediapriawanita" => $value['capacity'] - $value['terisi'],
                ];

                // return $bedInfo;
                $postdata = json_encode($body);

                unset($result);
                $headers = $this->AuthBridging('vclaim');
                // return json_encode($postdata);
                array_push($headers, "Content-length: " . strlen($postdata));
                // return $url;
                $result = $this->sendAplicares($url, $method, $postdata);
                if ($result == null)
                    $result = $this->sendAplicares($url, $method, $postdata);
                if ($result == null)
                    $result = $this->sendAplicares($url, $method, $postdata);
                if ($result == null)
                    $result = $this->sendAplicares($url, $method, $postdata);

                // $result = [];

                $data['body'] = $body;
                $data['result'] = $result;

                $return[] = $data;
            }
        }
        return $return;
    }
}
