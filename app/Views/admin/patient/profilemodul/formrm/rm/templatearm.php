<div class="container-fluid">
    <form action="/admin/rekammedis/rmj2_4/ <?= base64_encode(json_encode($visit)); ?>" method="post" autocomplete="off">
        <div style="display: none;">
            <button id="btnSimpan" class="btn btn-primary" type="button">Simpan</button>
            <button id="btnEdit" class="btn btn-secondary" type="button">Edit</button>
            <button id="btnDelete" class="btn btn-warning" type="button">Delete</button>
        </div>

        <input type="hidden" name="body_id" id="body_id">
        <input type="hidden" name="org_unit_code" id="org_unit_code">
        <input type="hidden" name="pasien_diagnosa_id" id="pasien_diagnosa_id">
        <input type="hidden" name="diagnosa_id" id="diagnosa_id">
        <input type="hidden" name="visit_id" id="visit_id">
        <input type="hidden" name="bill_id" id="bill_id">
        <input type="hidden" name="class_room_id" id="class_room_id">
        <input type="hidden" name="in_date" id="in_date">
        <input type="hidden" name="exit_date" id="exit_date">
        <input type="hidden" name="keluar_id" id="keluar_id">
        <!-- <input type="hidden" name="examination_date" id="examination_date"> -->
        <input type="hidden" name="employee_id" id="employee_id">
        <input type="hidden" name="description" id="description">
        <input type="hidden" name="modified_date" id="modified_date">
        <input type="hidden" name="modified_by" id="modified_by">
        <input type="hidden" name="modified_from" id="modified_from">
        <input type="hidden" name="status_pasien_id" id="status_pasien_id">
        <input type="hidden" name="ageyear" id="ageyear">
        <input type="hidden" name="agemonth" id="agemonth">
        <input type="hidden" name="ageday" id="ageday">
        <input type="hidden" name="theid" id="theid">
        <input type="hidden" name="isrj" id="isrj">
        <input type="hidden" name="gender" id="gender">
        <input type="hidden" name="kal_id" id="kal_id">
        <input type="hidden" name="petugas_id" id="petugas_id">
        <input type="hidden" name="petugas" id="petugas">
        <input type="hidden" name="account_id" id="account_id">
        <?php csrf_field(); ?>
        <div class="row">
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/logo.png') ?>" width="90px">
            </div>
            <div class="col mt-2" align="center">
                <h3>RS PKU Muhammadiyah Sampangan</h3>
                <h3>Surakarta</h3>
                <p>Semanggi RT 002 / RW 020 Pasar Kliwon, 0271-633894, Fax : 0271-630229, Surakarta<br>SK No.449/0238/P-02/IORS/II/2018</p>
            </div>
            <div class="col-auto" align="center">
                <img class="mt-2" src="<?= base_url('assets/img/paripurna.png') ?>" width="90px">
            </div>
        </div>
        <div class="row">
            <h4 class="text-center"><?= $title; ?></h4>
        </div>
        <div class="row">
            <h5 class="text-start">Informasi Pasien</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Nomor RM</b>
                        <div id="no_registration" name="no_registration" class="h6"></div>
                    </td>
                    <td>
                        <b>Nama Pasien</b>
                        <div id="thename" name="thename" class="h6"></div>
                    </td>
                    <td>
                        <b>Jenis Kelamin</b>
                        <select name="gender" id="gender" class="form-control">
                            <option value="1">Laki-Laki</option>
                            <option value="2">Perempuan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Tanggal Lahir (Usia)</b>
                        <div id="patient_age" name="patient_age" class="h6"></div>
                    </td>
                    <td colspan="2">
                        <b>Alamat Pasien</b>
                        <div id="theaddress" name="theaddress" class="h6"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>DPJP</b>
                        <div id="doctor" name="doctor" class="h6"></div>
                    </td>
                    <td>
                        <b>Department</b>
                        <div id="clinic_id" name="clinic_id" class="h6"></div>
                    </td>
                    <td>
                        <b>Tanggal Masuk</b>
                        <div id="examination_date" name="examination_date" class="h6"></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Subjektif (S)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <div class="row mb-1">
                            <div class="col">
                                <b>Keluhan Utama (Autoanamnesis)</b>
                                <div id="anamnesis" name="anamnesis" class="h6"><?= $val['anamnesis']; ?></div>
                            </div>
                        </div>
                        <div class="row mb-1">
                            <div class="col">
                                <b>Keluhan Utama (Alloanamnesis)</b>
                                <div id="alloanamnesis" name="alloanamnesis" class="h6"><?= $val['alloanamnase']; ?></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <b>Riwayat Penyakit Sekarang</b>
                        <div id="riwayat_penyakit_sekarang" name="riwayat_penyakit_sekarang" class="h6"><?= $val['riwayat_penyakit_sekarang']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Penyakit Dahulu</b>
                        <div id="riwayat_penyakit_dahulu" name="riwayat_penyakit_dahulu" class="h6"><?= $val['riwayat_penyakit_dahulu']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Riwayat Penyakit Keluarga</b>
                        <div id="riwayat_penyakit_keluarga" name="riwayat_penyakit_keluarga" class="h6"><?= $val['riwayat_penyakit_keluarga']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Alergi (Non Obat)</b>
                        <div id="riwayat_alergi_nonobat" name="riwayat_alergi_nonobat" class="h6"><?= $val['riwayat_alergi_nonobat']; ?></div>
                        <b>Riwayat Alergi (Obat)</b>
                        <div id="riwayat_alergi_obat" name="riwayat_alergi_obat" class="h6"><?= $val['riwayat_alergi_obat']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Obat Yang Dikonsumsi</b>
                        <div id="riwayat_obat_dikonsumsi" name="riwayat_obat_dikonsumsi" class="h6"><?= $val['riwayat_obat_dikonsumsi']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Riwayat Kehamilan dan Persalinan</b>
                        <div id="riwayat_kehamilan" name="riwayat_kehamilan" class="h6"><?= $val['riwayat_kehamilan']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Diet</b>
                        <div id="riwayat_diet" name="riwayat_diet" class="h6"><?= $val['riwayat_diet']; ?></div>
                    </td>
                    <td>
                        <b>Riwayat Imunisasi</b>
                        <div id="riwayat_imunisasi" name="riwayat_imunisasi" class="h6"><?= $val['riwayat_imunisasi']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <b>Riwayat Kebiasaan (Negatif)</b>
                        <div id="riwayat_alkohol" name="riwayat_alkohol" class="h6"><?= $val['riwayat_alkohol']; ?>, <?= $val['riwayat_merokok']; ?></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Obyektif (O)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td colspan="4"><b>Vital Sign</b></td>
                </tr>
                <tr>
                    <td>
                        <b>Tekanan Darah</b>
                        <div class="input-group">
                            <div id="tensi_atas" name="tensi_atas" class="h6"><?= $val['tensi_atas']; ?> / <?= $val['tensi_bawah']; ?></div>
                            <span class="" id="basic-addon2">mmHg</span>
                        </div>
                    </td>
                    <td>
                        <b>Denyut Nadi</b>
                        <div class="input-group">
                            <div id="nadi" name="nadi" class="h6"><?= $val['nadi']; ?></div>
                            <span class="" id="basic-addon2">x/m</span>
                        </div>
                    </td>
                    <td>
                        <b>Suhu Tubuh</b>
                        <div class="input-group">
                            <div id="suhu" name="suhu" class="h6"><?= $val['suhu']; ?></div>
                            <span class="" id="basic-addon2">℃</span>
                        </div>
                    </td>
                    <td>
                        <b>Respiration Rate</b>
                        <div class="input-group">
                            <div id="respiration" name="respiration" class="h6"><?= $val['respiration']; ?></div>
                            <span class="" id="basic-addon2">x/m</span>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Berat Badan</b>
                        <div class="input-group">
                            <div id="berat" name="berat" class="h6"><?= $val['berat']; ?></div>
                            <span class="" id="basic-addon2">kg</span>
                        </div>
                    </td>
                    <td>
                        <b>Tinggi Badan</b>
                        <div class="input-group">
                            <div id="tinggi" name="tinggi" class="h6"><?= $val['tinggi']; ?></div>
                            <span class="" id="basic-addon2">cm</span>
                        </div>
                    </td>
                    <td>
                        <b>SpO2</b>
                        <div class="input-group">
                            <div id="spo2" name="spo2" class="h6"><?= $val['spo2']; ?></div>
                        </div>
                    </td>
                    <td>
                        <b>BMI</b>
                        <div class="input-group">
                            <div id="imt" name="imt" class="h6"><?= $val['imt']; ?></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>LK</b>
                        <div class="input-group">
                            <div id="no_registration" name="no_registration" class="h6"></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Pemeriksaan Fisik Tambahan</b>
                        <div class="input-group">
                            <div id="no_registration" name="no_registration" class="h6"><?= $val['pemeriksaan_fisik']; ?></div>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Assessment (A)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Diagnosis (ICD-10)</b>
                        <div id="icd10" name="icd10" class="h6"><?= $val['icd10']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Permasalahan Medis</b>
                        <div id="masalah_medis" name="masalah_medis" class="h6"><?= $val['masalah_medis']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Penyebab Cidera / Keracunan</b>
                        <div id="penyebab_cidera" name="penyebab_cidera" class="h6"><?= $val['penyebab_cidera']; ?></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h4 class="text-start">Planning (P)</h4>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Target / Sasaran Terapi</b>
                        <div id="sasaran" name="sasaran" class="h6"><?= $val['sasaran']; ?></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Pemeriksaan Diagnostik Penunjang</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Laboratorium</b>
                        <div type="text" class="h6" id="laboratorium" name="laboratorium"><?= $val['laboratorium']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Radiologi</b>
                        <div type="text" class="h6" id="radiologi" name="radiologi"><?= $val['radiologi']; ?></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Rencana Asuhan dan Terapi</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Farmakoterapi</b>
                        <div type="text" class="h6" id="farmakologia" name="farmakologia"><?= $val['farmakologia']; ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Procedure</b>
                        <div type="text" class="h6" id="prosedur" name="prosedur"><?= $val['prosedur']; ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Catatan Procedure</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Standing Order</b>
                        <div type="text" class="h6" id="standing_order" name="standing_order"><?= $val['standing_order']; ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Rencana Tindak Lanjut</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Rencana Tindak Lanjut</b>
                        <div type="text" class="h6" id="rencana_tl" name="rencana_tl"><?= $val['rencana_tl']; ?></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Kontrol</b>
                        <div type="text" class="h6" id="kontrol" name="kontrol"><?= $val['kontrol']; ?></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <h5 class="text-start">Edukasi Pasien</h5>
        </div>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td>
                        <b>Edukasi Awal, disampaikan tentang diagnosis, Rencana dan Tujuan Terapai kepada:</b>
                        <div id="" name="" class="h6"></div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <b>Materi Edukasi:</b>
                        <div id="" name="" class="h6"></div>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="row">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Penerima Penjelasan</div>
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- <script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: '<?= $val['dpjp']; ?>',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: '<?= $val['nama']; ?>',
        width: 150,
        height: 150,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script> -->
<script>
    $(document).ready(function() {
        $("#org_unit_code").val("<?= $visit['org_unit_code']; ?>")
        $("#no_registration").html("<?= $visit['no_registration']; ?>")
        $("#visit_id").val("<?= $visit['visit_id']; ?>")
        $("#clinic_id").val("<?= $visit['clinic_id']; ?>")
        $("#class_room_id").val("<?= $visit['class_room_id']; ?>")
        $("#in_date").val("<?= $visit['in_date']; ?>")
        $("#exit_date").val("<?= $visit['exit_date']; ?>")
        $("#keluar_id").val("<?= $visit['keluar_id']; ?>")
        <?php $dt = new DateTime("now", new DateTimeZone('Asia/Bangkok'));
        ?>
        $("#examination_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
        $("#employee_id").val("<?= $visit['employee_id']; ?>")
        $("#description").val("<?= $visit['description']; ?>")
        $("#modified_date").val("<?= $dt->format('Y-m-d H:i:s'); ?>")
        $("#modified_by").val("<?= user()->username; ?>")
        $("#modified_from").val("<?= $visit['clinic_id']; ?>")
        $("#status_pasien_id").val("<?= $visit['status_pasien_id']; ?>")
        $("#ageyear").val("<?= $visit['ageyear']; ?>")
        $("#agemonth").val("<?= $visit['agemonth']; ?>")
        $("#ageday").val("<?= $visit['ageday']; ?>")
        $("#thename").val("<?= $visit['diantar_oleh']; ?>")
        $("#theaddress").val("<?= $visit['visitor_address']; ?>")
        $("#theid").val("<?= $visit['pasien_id']; ?>")
        $("#isrj").val("<?= $visit['isrj']; ?>")
        $("#gender").val("<?= $visit['gender']; ?>")
        $("#doctor").val("<?= $visit['employee_id']; ?>")
        $("#kal_id").val("<?= $visit['kal_id']; ?>")
        $("#petugas_id").val("<?= user()->username; ?>")
        $("#petugas").val("<?= user()->fullname; ?>")
        $("#account_id").val("<?= $visit['account_id']; ?>")
    })
    $("#btnSimpan").on("click", function() {
        saveSignatureData()
        saveSignatureData1()
        console.log($("#TTD").val())
        $("#form").submit()
    })
    $("#btnEdit").on("click", function() {
        $("input").prop("disabled", false);
        $("textarea").prop("disabled", false);

    })
</script>
<style>
    @media print {
        @page {
            margin: 0;
            scale: 80;
        }

        .container {
            width: 210mm;
            /* Sesuaikan dengan lebar kertas A4 */
        }
    }
</style>