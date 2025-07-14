<?php
$currency_symbol = "Rp. ";
$permission = user()->getPermissions();
?>

<style>
    table.table-fit {
        width: auto !important;
        table-layout: auto !important;
    }

    table.table-fit thead th,
    table.table-fit tfoot th {
        width: auto !important;
    }

    table.table-fit tbody td,
    table.table-fit tfoot td {
        width: auto !important;
    }
</style>
<div class="tab-pane" id="reportEKlaim" role="tabpanel">
    <div class="row">
        <div class="col-lg-2 col-md-12 col-sm-12 border-r">
            <?php echo view('admin/patient/profilemodul/profilebiodata', [
                'visit' => $visit,
                'pasienDiagnosaAll' => $pasienDiagnosaAll,
                'pasienDiagnosa' => $pasienDiagnosa
            ]); ?>
        </div>
        <!--./col-lg-6-->
        <div class="col-lg-10 col-md-12 col-xs-12">
            <div class="row mt-4">

            </div>
            <!-- <div class="accordion mt-4">
                <div class="panel-group" id="labBody">
                </div>
            </div> -->
            <div class="table-responsive">
                <div class="accordion" id="accodrionFormEklaim">
                    <?php if ($visit['clinic_id'] !== "P012" && $visit['isrj'] === "0" || $visit['isrj'] === 0) { ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="ranapFile_pendukung">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsemedis" aria-expanded="true" aria-controls="collapsemedis">
                                    <b>Rawat Inap File Pendukung</b>
                                </button>
                            </h2>
                            <div id="collapsemedis" class="accordion-collapse collapse" aria-labelledby="medis"
                                data-bs-parent="#accodrionFormEklaim">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul id="ranapFile_url" class="list-group list-group-flush">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if ($visit['clinic_id'] !== "P012" && $visit['isrj'] === "1" || $visit['isrj'] === 1) { ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="rajalFile_pendukung">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapsekeperawatan" aria-expanded="true"
                                    aria-controls="collapsekeperawatan">
                                    <b>Rawat Jalan File Pendukung Poli</b>
                                </button>
                            </h2>
                            <div id="collapsekeperawatan" class="accordion-collapse collapse" aria-labelledby="keperawatan"
                                data-bs-parent="#accodrionFormEklaim">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul id="rajalFile_url" class="list-group list-group-flush">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } else if ($visit['clinic_id'] === "P012") { ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="rajaFile_igd">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collapselainnya" aria-expanded="true" aria-controls="collapselainnya">
                                    <b>Rawat Jalan IGD</b>
                                </button>
                            </h2>
                            <div id="collapselainnya" class="accordion-collapse collapse" aria-labelledby="lainnya"
                                data-bs-parent="#accodrionFormEklaim">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul id="rajalFileIgd_url" class="list-group list-group-flush">
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php }
                    if ($visit['status_pasien_id'] === 18 || $visit['status_pasien_id'] === "18") { ?>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="rajaFile_igd">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#collkronisKlaim" aria-expanded="true" aria-controls="collkronisKlaim">
                                    <b>Kronis</b>
                                </button>
                            </h2>
                            <div id="collkronisKlaim" class="accordion-collapse collapse" aria-labelledby="lainnya"
                                data-bs-parent="#accodrionFormEklaim">
                                <div class="accordion-body text-muted">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul id="kronis_url" class="list-group list-group-flush">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

            </div>
        </div>
    </div>
    <!--./row-->
</div>
<!-- -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->

<script type="text/javascript">
    const renderArcodEklaim = (props) => {
        let dataVisitEklaim = {
            org_unit_code: visit?.org_unit_code,
            no_registration: visit?.no_registration,
            visit_id: visit?.visit_id,
            status_pasien_id: visit?.status_pasien_id,
            booked_date: visit?.booked_date,
            visit_date: visit?.visit_date,
            clinic_id: visit?.clinic_id,
            class_room_id: visit?.class_room_id,
            bed_id: visit?.bed_id,
            keluar_id: visit?.keluar_id,
            in_date: visit?.in_date,
            exit_date: visit?.exit_date,
            diantar_oleh: visit?.diantar_oleh,
            gender: visit?.gender,
            visitor_address: visit?.visitor_address,
            employee_id: visit?.employee_id,
            employee_id_from: visit?.employee_id_from,
            payor_id: visit?.payor_id,
            class_id: visit?.class_id,
            ageyear: visit?.ageyear,
            agemonth: visit?.agemonth,
            ageday: visit?.ageday,
            conclusion: visit?.conclusion,
            specimenno: visit?.specimenno,
            no_skpinap: visit?.no_skpinap,
            tanggal_rujukan: visit?.tanggal_rujukan,
            isrj: visit?.isrj,
            trans_id: visit?.trans_id,
            asalrujukan: visit?.asalrujukan,
            tgl_lahir: visit?.tgl_lahir,
            tujuankunj: visit?.tujuankunj,
            flagprocedure: visit?.flagprocedure,
            kdpenunjang: visit?.kdpenunjang,
            assesmentpel: visit?.assesmentpel,
            ssencounter_id: visit?.ssencounter_id,
            name_of_pasien: visit?.name_of_pasien,
            date_of_birth: visit?.date_of_birth,
            contact_address: visit?.contact_address,
            mobile: visit?.mobile,
            kalurahan: visit?.kalurahan,
            name_of_clinic: visit?.name_of_clinic,
            fullname: visit?.fullname,
            treat_date: visit?.treat_date,
            class_room: visit?.class_room,
            npk: visit?.npk,
            name_of_status_pasien: visit?.name_of_status_pasien,
            name_of_gender: visit?.name_of_gender,
            nama_agama: visit?.nama_agama,
            cara_keluar: visit?.cara_keluar,
            name_of_class: visit?.name_of_class,
            name_of_class_plafond: visit?.name_of_class_plafond,
            payor: visit?.payor,
            specialist_type_id: visit?.specialist_type_id,
            age: visit?.age,
            session_id: visit?.session_id,
            description: visit?.description,
            pasien_id: visit?.pasien_id,
            kal_id: visit?.kal_id,
            account_id: visit?.account_id,
            exit_date_tf: props?.newDate
        }




        const decodedVisit = btoa(unescape(encodeURIComponent(JSON.stringify(dataVisitEklaim))));

        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit + '/' + $("#armbody_id").val() + '?result=RIF&type=SEP' + '" target="_blank">SEP</a></li>')


        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=SRI' +
            '" target="_blank">Surat Rawat Inap</a></li>')
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=TRIASE' +
            '" target="_blank" >Asessmen Medis IGD</a></li>')
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=ResumeMedis' +
            '" target="_blank">Resume Pulang</a></li>')
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=Persalinan' +
            '" target="_blank">Laporan Persalinan</a></li>')
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=OPRS' + '" target="_blank">Laporan Operasi</a></li>')
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=Anestesi' +
            '" target="_blank">Laporan Anestesi</a></li>')
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=PNJG' +
            '" target="_blank">Hasil Penunjang dan Bacaan</a></li>')
        // ====================
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=FISIO1' +
            '" target="_blank">Formulir Klaim Rawat Jalan KFR</a></li>'
        )
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=FISIO2' +
            '" target="_blank">Permintaan Fisioterapi</a></li>'
        )
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=FISIO3' +
            '" target="_blank">Lembar Hasil Uji Fungsi KFR</a></li>'
        )
        // ====================
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=ANOTOMI' +
            '" target="_blank">Hasil Bacaan Patologi Anatomi</a></li>')
        $('#ranapFile_url').append(
            `<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/'
                                                    ?>/${ decodedVisit+$("#armbody_id").val()}?result=RIF&type=REK" target="_blank">Resep Obat</a></li>`
        )
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=TBC' + '" target="_blank">Skrining TBC</a></li>')
        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF&type=INV' + '" target="_blank">Nota Kasir</a></li>')

        $('#ranapFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RIF' + '" target="_blank" >All</a></li>')


        // ===============================================================================================================================
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=SEP' + '" target="_blank">SEP</a></li>')
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=SRK' + '" target="_blank">Surat Kontrol</a></li>')
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=TRIASE' + '" target="_blank">Asesmen Medis</a></li>')
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=CPPT' + '" target="_blank">CPPT</a></li>')
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=SKD' +
            '" target="_blank">Surat Keterangan Diagnosa</a></li>')
        //bisma
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=PNJG' +
            '" target="_blank">Asessmen Hasil Penunjang</a></li>'
        )
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=FISIO1' +
            '" target="_blank">Formulir Klaim Rawat Jalan KFR</a></li>'
        )
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=FISIO2' +
            '" target="_blank">Permintaan Fisioterapi</a></li>'
        )
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=FISIO3' +
            '" target="_blank">Lembar Hasil Uji Fungsi KFR</a></li>'
        )
        $('#rajalFile_url').append(
            `<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/'
                                                    ?>/${decodedVisit+$("#armbody_id").val()}?result=RJF&type=REK" target="_blank">Resep Obat</a></li>`
        )
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=TBC' + '" target="_blank">Skrining TBC</a></li>')
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF&type=INV' + '" target="_blank">Nota Kasir</a></li>')
        $('#rajalFile_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJF' + '" target="_blank">All</a></li>')


        // ===============================================================================================================================
        $('#rajalFileIgd_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJI&type=SEP' + '" target="_blank">SEP</a></li>')
        $('#rajalFileIgd_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJI&type=ATS' + '" target="_blank">Triase</a></li>')
        $('#rajalFileIgd_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJI&type=SKD' +
            '" target="_blank">Surat Keterangan Diagnosa</a></li>')
        $('#rajalFileIgd_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJI&type=TRIASE' + '" target="_blank" >Asessmen IGD</a></li>')
        $('#rajalFileIgd_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJI&type=PNJG' + '" target="_blank">Hasil Penunjang</a></li>')
        $('#rajalFileIgd_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJI&type=TBC' + '" target="_blank">Skrining TBC</a></li>')
        $('#rajalFileIgd_url').append(
            `<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/'
                                                    ?>/${ decodedVisit+$("#armbody_id").val()}?result=RJI&type=REK" target="_blank">Resep Obat</a></li>`
        )

        $('#rajalFileIgd_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJI&type=INV' + '" target="_blank">Nota Kasir</a></li>')
        $('#rajalFileIgd_url').append(
            '<li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>' +
            decodedVisit +
            '/' + $("#armbody_id").val() + '?result=RJI' + '" target="_blank" >All</a></li>')


        // ===============================================================================================================================
        // Tambahkan daftar link terlebih dahulu
        $('#kronis_url').append(`
                    <li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>${decodedVisit}/${$("#armbody_id").val()}?result=KRON&type=SEP" target="_blank">SEP</a></li>
                    <li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>${decodedVisit}/${$("#armbody_id").val()}?result=KRON&type=REK" target="_blank">Resep Kronis</a></li>

                    `);



        $('#kronis_url').append(`
                    <li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>${decodedVisit}/${$("#armbody_id").val()}?result=KRON&type=SRK" target="_blank">Surat Kontrol</a></li>
                `)

        $('#kronis_url').append(`
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingLabResult">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseLabResult"
                                aria-expanded="false" aria-controls="collapseLabResult">
                                Hasil Laboratorium
                            </button>
                        </h2>
                        <div id="collapseLabResult" class="accordion-collapse collapse"
                            aria-labelledby="headingLabResult" data-bs-parent="#nestedAccordionLab">
                            <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <label for="selectmultiLabKron" class="form-label">Hasil Lab</label>
                                        <select class="mySelect form-control" id="selectmultiLabKron">
                                        
                                        </select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button id="filterLabResults" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                                <ul id="labResult_url" class="list-group list-group-flush"></ul>
                            </div>
                        </div>
                    </div>
                `);


        setTimeout(() => {
            $("#selectmultiLabKron").select2({
                allowClear: true,
                multiple: true,
                width: "100%",
                placeholder: "Pilih Data",
                closeOnSelect: false, // Agar tetap terbuka saat memilih
                dropdownParent: $("#selectmultiLabKron").parent(), // Jika dalam modal
                language: {
                    noResults: function() {
                        return "Data tidak ditemukan";
                    }
                }
            });
        }, 1000);



        $('#filterLabResults').click(function() {
            let data = $('#selectmultiLabKron').val();
            let armbodyId = $("#armbody_id").val();


            let encodedData = btoa(JSON.stringify(data));
            let url =
                `<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>${decodedVisit}/${armbodyId}?result=KRON&type=HPL&data=${encodedData}`;

            window.open(url, '_blank');
        });



        $('#kronis_url').append(`
                    <li class="list-group-item"><a href="<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>${decodedVisit}/${$("#armbody_id").val()}?result=KRON&type=INV" target="_blank">Nota Kronis</a></li>

                `);

        $('#kronis_url').append(`
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingLabResult">
                            <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseResepResult"
                                aria-expanded="false" aria-controls="collapseResepResult">
                                Riwayat Resep Kronis
                            </button>
                        </h2>
                        <div id="collapseResepResult" class="accordion-collapse collapse"
                            aria-labelledby="headingLabResult" data-bs-parent="#nestedAccordionLab">
                            <div class="accordion-body">
                                <div class="row mb-2">
                                    <div class="col-md-5">
                                        <label for="endDateLabEklaim" class="form-label">Nama Obat</label>
                                        <select id="nama-obat-kronis-select" class="form-select"></select>
                                    </div>
                                    <div class="col-md-2 d-flex align-items-end">
                                        <button id="filterobatkronisResults" class="btn btn-primary">Filter</button>
                                    </div>
                                </div>
                                <ul id="labResult_url" class="list-group list-group-flush">
                                    <!-- Data hasil laboratorium akan ditambahkan di sini -->
                                </ul>
                            </div>
                        </div>
                    </div>
                `);


        $('#kronis_url').append(`
                    <li class="list-group-item pointer btn-link" id="allKronBtnEklaim"> All </li>
                `);


        $("#allKronBtnEklaim").off().on("click", (e) => {
            let data = $('#selectmultiLabKron').val();
            let armbodyId = $("#armbody_id").val();


            let encodedData = btoa(JSON.stringify(data));
            let url =
                `<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>${decodedVisit}/${armbodyId}?result=KRON&data=${encodedData}`;

            window.open(url, '_blank');
        });


        $('#filterobatkronisResults').click(function() {

            let obat = $('#nama-obat-kronis-select').val();
            let armbodyId = $("#armbody_id").val();

            let url =
                `<?= base_url() . 'admin/reklaim/CetakReklaim/cetakAllGrouping/' ?>${decodedVisit}/${armbodyId}?result=KRON&type=REK&obat=${obat}`;

            window.open(url, '_blank');
        });


    }



    $(document).ready(function() {
        // postData({
        //     visit_id: visit
        // }, 'admin/reklaim/Cetak/validateReport', (res) => {
        //     let result = res?.respon

        //     if (result === true) {
        //         $("#reportEKlaimTab").closest("li.nav-item").show();

        //     } else {
        //         $("#reportEKlaimTab").closest("li.nav-item").hide();
        //     }

        // })

    })

    $("#reportEKlaimTab").off("click").on("click", async function(e) {
        let newDate = ""
        postData({
            no_regis: visit?.no_registration,
            trans_id: visit?.trans_id
        }, 'admin/reklaim/CetakReklaim/getdateexit', (res) => {
            newDate = res?.status === true ? res?.value?.examination_date : "";

            $("#ranapFile_url").html("")
            $("#rajalFile_url").html("")
            $("#rajalFileIgd_url").html("")
            $("#kronis_url").html("")

            postData({
                no_regis: visit?.no_registration
            }, 'admin/reklaim/CetakReklaim/filterObat', (res) => {
                if (res?.value.length > 1) {
                    let result = `<option value="semua">Semua</option>`;
                    res?.value?.map((e) => {
                        result +=
                            `<option value="${e?.description}">${e?.description}</option>`
                    })
                    $("#nama-obat-kronis-select").html(result)

                }
            })

            postData({
                no_regis: visit?.no_registration,
                trans_id: visit?.trans_id
            }, 'admin/reklaim/CetakReklaim/labRequestHasilSelect', (res) => {
                if (res?.value.length > 0) {
                    let result =
                        `<option value="semua">Pilih Semua</option>`; // Opsi Pilih Semua
                    res?.value?.forEach((e) => {
                        result +=
                            `<option value="${e?.kode_kunjungan}">${e?.tarif_names}</option>`;
                    });

                    $("#selectmultiLabKron").html(result).trigger("change");

                    $("#selectmultiLabKron").off("select2:select select2:unselect").on(
                        "select2:select",
                        function(e) {
                            if (e.params.data.id === "semua") {
                                let allValues = $("#selectmultiLabKron option").map(
                                    function() {
                                        return $(this).val();
                                    }).get();
                                $("#selectmultiLabKron").val(allValues).trigger("change");
                            }
                        }).on("select2:unselect", function(e) {
                        if (e.params.data.id === "semua") {
                            $("#selectmultiLabKron").val(null).trigger("change");
                        }
                    });
                }
            });


            renderArcodEklaim({
                newDate: newDate
            })
        });

        // renderArcodEklaim()
    })
</script>