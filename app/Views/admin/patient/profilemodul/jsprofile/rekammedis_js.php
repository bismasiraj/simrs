<script type='text/javascript'>
    var mrJson;
    var tagihan = 0.0;
    var subsidi = 0.0;
    var potongan = 0.0;
    var pembulatan = 0.0;
    var pembayaran = 0.0;
    var retur = 0.0;
    var total = 0.0;
    var lastOrder = 0;
    $(document).ready(function(e) {
        var nomor = '<?= $visit['no_registration']; ?>';
        var ke = '%'
        var mulai = '2023-08-01' //tidak terpakai
        var akhir = '2023-08-31' //tidak terpakai
        var lunas = '%'
        // var klinik = '<?= $visit['clinic_id']; ?>'
        var klinik = '%'
        var rj = '%'
        var status = '%'
        var nota = '%'
        var trans = '<?= $visit['trans_id']; ?>'
        var visit = '<?= $visit['visit_id']; ?>'
    })
</script>
<script type="text/javascript">
    var historyJson = new Array();
    var pasienDiagnosa = new Array();
    var pasienDiagnosa = <?= json_encode($pasienDiagnosa); ?>;
    var currentIndex;
    var indexLength;
    $(document).ready(function(e) {
        getDiagnosas()
        getProcedures()
        modalAddRm()
    })

    function modalAddRm() {
        enableRM()
        $("#arorg_unit_code").val("<?= $visit['org_unit_code']; ?>")
        $("#arvisit_id").val("<?= $visit['visit_id']; ?>")
        $("#ardate_of_diagnosa").val(get_date())
        $("#arreport_date").val(get_date())

        $("#artheid").val("<?= $visit['pasien_id']; ?>")
        $("#artheaddress").val("<?= $visit['visitor_address']; ?>")
        $("#arisrj").val("<?= $visit['isrj']; ?>")
        $("#arkal_id").val("<?= $visit['kal_id']; ?>")
        $("#arclinic_id").val("<?= $visit['clinic_id']; ?>")

        $("#aremployee_id").val("<?= $visit['employee_id']; ?>")
        $("#ardoctor").val("<?= $visit['fullname']; ?>")
        $("#arclass_room_id").val("<?= $visit['class_room_id']; ?>")
        $("#arbed_id").val("<?= $visit['bed_id']; ?>")


        $("#arin_date").val("<?= $visit['in_date']; ?>")
        $("#arexit_date").val("<?= $visit['exit_date']; ?>")
        $("#armodified_date").val(get_date())
        $("#armodified_by").val("<?= user_id(); ?>")
        $("#arnokartu").val("<?= $visit['pasien_id']; ?>")
        $("#arvisit_id").val("<?= $visit['visit_id']; ?>")
        $("#arno_registration").val("<?= $visit['no_registration']; ?>")







        $("#arthename").val(pasienDiagnosa.thename)
        $("#arstatus_pasien_id").val(pasienDiagnosa.status_pasien_id)
        $("#argender").val(pasienDiagnosa.gender)
        $("#arageyear").val(pasienDiagnosa.ageyear)
        $("#aragemonth").val(pasienDiagnosa.agemonth)
        $("#arageday").val(pasienDiagnosa.ageday)
        $("#arspesialistik").val(pasienDiagnosa.spesialistik)
        $("#arresult_id").val(pasienDiagnosa.result_id)
        $("#arkeluar_id").val(pasienDiagnosa.keluar_id)
        $("#arnosep").val(pasienDiagnosa.nosep)
        $("#artglsep").val(pasienDiagnosa.tglsep)
        $("#arpasien_diagnosa_id").val(pasienDiagnosa.pasien_diagnosa_id)




        $("#ardescription").val(pasienDiagnosa.description)
        $("#ardiagnosa_desc_05").val(pasienDiagnosa.diagnosa_desc_05)
        $("#ardiagnosa_desc_06").val(pasienDiagnosa.diagnosa_desc_06)
        $("#aranamnase").val(pasienDiagnosa.anamnase)
        $("#arpemeriksaan").val(pasienDiagnosa.pemeriksaan)
        $("#arpemeriksaan_02").val(pasienDiagnosa.pemeriksaan_02)
        $("#arpemeriksaan_03").val(pasienDiagnosa.pemeriksaan_03)
        $("#arpemeriksaan_05").val(pasienDiagnosa.pemeriksaan_05)
        $("#arteraphy_desc").val(pasienDiagnosa.teraphy_desc)
        $("#arinstruction").val(pasienDiagnosa.instruction)
        $("#armorfologi_neoplasma").val(pasienDiagnosa.morfologi_neoplasma)
        $("#ardisability").val(pasienDiagnosa.disability)
        $("#arrencanatl").val(pasienDiagnosa.rencanatl)
        var option = new Option(pasienDiagnosa.dirujukke, pasienDiagnosa.dirujukke, true, true);
        $("#ardirujukke").append(option).trigger('change');
        $("#artgl_kontrol").val(pasienDiagnosa.tglkontrol)
        $("#arkdpoli_kontrol").val(pasienDiagnosa.clinic_id)
        $("#arprocedure_05").val(pasienDiagnosa.procedure_05)
        $("#arsuffer_type").val(pasienDiagnosa.suffer_type)










        // holdModal('addRmModal')
        // getDataFillRekamMedis()

        <?php if (isset($pasienDiagnosaAll[0])) { ?>
            getHistoryRekamMedis()
        <?php } ?>

        tindakLanjut()

    }
</script>