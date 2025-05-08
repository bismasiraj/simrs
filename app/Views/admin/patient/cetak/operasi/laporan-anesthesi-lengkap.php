<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title><?= $title; ?></title>

    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">
    <link href="<?= base_url('css/jquery.signature.css') ?>" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="<?= base_url('js/jquery.signature.js') ?>"></script>
    <script src="<?= base_url('/assets/js/default.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.4.4/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .form-control:disabled,
        .form-control[readonly] {
            background-color: #FFF;
            opacity: 1;
        }

        .form-control,
        .input-group-text {
            background-color: #fff;
            border: 1px solid #fff;
            font-size: 12px;
        }

        @page {
            size: A4;
        }

        body {
            width: 29.7cm;
            height: 21cm;
            margin: 0;
            font-size: 12px;
        }

        .h1,
        .h2,
        .h3,
        .h4,
        .h5,
        .h6,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            margin-top: 0;
            margin-bottom: .3rem;
            font-weight: 500;
            line-height: 1.2;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row align-items-center mb-3">
            <div class="col-2 px-0 d-flex">
                <img class="mt-2 mx-auto" src="<?= base_url('assets/img/logo.png') ?>" style="width: 100px; height: 100px;">
            </div>
            <div class="col-6 px-0 text-center">
                <h1 class="px-1">CATATAN KAMAR PEMULIHAN</h1>
            </div>
            <div class="col-4 px-0">
                <div class="border border-1" style="height: auto; min-height:100px;">
                    <table class="table table-borderless">
                        <tr class="mb-0">
                            <td width="30%">Nama</td>
                            <td width="1%">:</td>
                            <td><?= $visit['diantar_oleh']; ?></td>
                        </tr>
                        <tr class="mb-0">
                            <td width="30%">Umur</td>
                            <td width="1%">:</td>
                            <td><?= $visit['age']; ?></td>
                        </tr>
                        <tr class="mb-0">
                            <td width="30%">Alamat</td>
                            <td width="1%">:</td>
                            <td><?= $visit['contact_address']; ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between gap-3">
            <div class="col-7">
                <h5 class="text-center">MONITORING DURANTEE OPERASI</h5>
                <div class="row">
                    <div id="cairanMasuk" class="table tablecustom-responsive">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <canvas id="myChartMonitoringRecoveryRoom" width="auto" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="monitoringRecoveryRoom-1" class="table tablecustom-responsive">
                        <table class="table">
                            <thead class="table">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">TD(S)</th>
                                    <th scope="col">TD(D)</th>
                                    <th scope="col">NADI</th>
                                    <th scope="col">SUHU</th>
                                    <th scope="col">RR</th>
                                    <th scope="col">SPO2</th>
                                    <th scope="col">CATATAN</th>
                                    <th scope="col">STAFF NAME</th>
                                </tr>
                            </thead>
                            <tbody id="bodyDatamyChartMonitoringRecoveryRoom" class="table-group-divider">
                                <tr>
                                    <td colspan="10" class="text-center">Data Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Tindakan</th>
                                <th scope="col">Tandatangan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="col-8"><span id="nama-tindakan"></span></td>
                                <td class="col-4"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-4">
                <h5 class="text-center">KRITERIA KELUAR KAMAR PULIH</h5>
                <table class="table table-bordered">
                    <?php foreach ($steward_score as $key => $steward) : ?>
                        <tr>
                            <th colspan="2" class="text-center">steward Score</th>
                        </tr>
                        <?php $total_steward = 0; ?>
                        <tr class="text-center">
                            <th>Kriteria</th>
                            <th width="1%">Score</th>
                        </tr>
                        <?php foreach ($steward as $strd) : ?>
                            <tr>
                                <td><?= $strd['value_desc']; ?></td>
                                <td class="text-center"><?= $strd['value_score']; ?></td>
                            </tr>
                            <?php $total_steward += $strd['value_score']; ?>
                        <?php endforeach; ?>
                        <tr class="bg-secondary text-white">
                            <td><?= $total_steward >= 5 ? 'Pindah Ruangan / Pulang' : 'Tidak Pindah'; ?></td>
                            <td class="text-center"><?= $total_steward; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <table class="table table-bordered">
                    <?php foreach ($aldrete_score as $key => $aldrete) : ?>
                        <tr>
                            <th colspan="2" class="text-center">Aldrete Score</th>
                        </tr>
                        <?php $total_aldrete = 0; ?>
                        <tr class="text-center">
                            <th>Kriteria</th>
                            <th width="1%">Score</th>
                        </tr>
                        <?php foreach ($aldrete as $aldr) : ?>
                            <tr>
                                <td><?= $aldr['value_desc']; ?></td>
                                <td class="text-center"><?= $aldr['value_score']; ?></td>
                            </tr>
                            <?php $total_aldrete += $aldr['value_score']; ?>
                        <?php endforeach; ?>
                        <tr class="bg-secondary text-white">
                            <td><?= $total_aldrete >= 8 ? 'Pindah Ruangan / Pulang' : 'Tidak Pindah'; ?></td>
                            <td class="text-center"><?= $total_aldrete; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
                <?php if (!empty($bromage_score)) : ?>
                    <table class="table table-bordered">
                        <tr>
                            <th colspan="2" class="text-center">Bromage Score</th>
                        </tr>
                        <tr class="text-center">
                            <th>Kriteria</th>
                            <th width="1%">Score</th>
                        </tr>
                        <?php foreach ($bromage_score as $key => $bromage) : ?>
                            <tr>
                                <td><?= $bromage['value_desc']; ?></td>
                                <td class="text-center"><?= $bromage['value_score']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>
        </div>
        <div style="break-after:page"></div>
        <div class="d-flex gap-2">
            <div class="col-3">
                <?php foreach ($infusion as $key => $infus) : ?>
                    <b><?= $key; ?></b>
                    <div class="d-flex flex-wrap mb-1 col-12">
                        <?php foreach ($infus as $index => $valInfus) : ?>
                            <?php if ($valInfus['entry_type'] == '3' || $valInfus['entry_type'] == '7') : ?>
                                <div class="col-6 p-0">
                                    <input type="checkbox" onclick="return false;" <?= $valInfus['checked'] == 1 ? 'checked' : ''; ?>>
                                    <label for=""><small><?= $valInfus['value_desc']; ?></small></label>
                                </div>
                            <?php elseif ($valInfus['entry_type'] == '2') : ?>
                                <input type="checkbox" onclick="return false;" <?= $valInfus['value_id'] == 1 ? 'checked' : ''; ?>>
                                <label for=""><?= $valInfus['value_desc']; ?></label>
                            <?php else : ?>
                                <small class="mb-0"><?= $valInfus['value_id']; ?></small>
                                <label for=""><?= $valInfus['value_desc']; ?></label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach ?>

                <b>1. General Anestesia</b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($general_entry_type['entries'] as $key => $entry) : ?>
                        <div class="col-6 p-0">
                            <?php if ($entry['entry_type'] == '2') : ?>
                                <input type="checkbox" onclick="return false;" <?= $entry['value_id'] == 1 ? 'checked' : ''; ?>>
                                <label for=""><small><?= $entry['parameter_desc']; ?></small></label>
                            <?php else : ?>
                                <small><?= $entry['parameter_desc']; ?> : </small>
                                <small><?= $entry['value_id']; ?></small>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php foreach ($general as $key => $gen) : ?>
                    <?php if (!in_array($key, $general_entry_type['keys'])) : ?>
                        <b><?= $key; ?></b>
                        <div class="d-flex flex-wrap mb-1 col-12">
                            <?php foreach ($gen as $index => $valGen) : ?>
                                <?php if ($valGen['entry_type'] == '3' || $valGen['entry_type'] == '7') : ?>
                                    <div class="col-6 p-0">
                                        <?php if ($valGen['entry_type'] == '3' || $valGen['entry_type'] == '7') : ?>
                                            <input type="checkbox" onclick="return false;" <?= $valGen['checked'] == 1 ? 'checked' : ''; ?>>
                                            <label for=""><small><?= $valGen['value_desc']; ?></small></label>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>
                <b>Ventilasi</b>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($ventilasi_entry_type['entries'] as $key => $entry_ven) : ?>
                        <div class="col-6 p-0">
                            <?php if ($entry_ven['entry_type'] == '2') : ?>
                                <input type="checkbox" onclick="return false;" <?= $entry_ven['value_id'] == 1 ? 'checked' : ''; ?>>
                                <label for=""><small><?= $entry_ven['parameter_desc']; ?></small></label>
                            <?php else : ?>
                                <small><?= $entry_ven['parameter_desc']; ?> : </small>
                                <small><?= $entry_ven['value_id']; ?></small>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php foreach ($ventilasi as $key => $ven) : ?>
                    <?php if (!in_array($key, $ventilasi_entry_type['keys'])) : ?>
                        <b><?= $key; ?></b>
                        <div class="d-flex flex-wrap mb-1 col-12">
                            <?php foreach ($ven as $index => $valVen) : ?>
                                <div class="col-6 p-0">
                                    <?php if ($valVen['entry_type'] == '3' || $valVen['entry_type'] == '7') : ?>
                                        <input type="checkbox" onclick="return false;" <?= $valVen['checked'] == 1 ? 'checked' : ''; ?>>
                                        <label for=""><small><?= $valVen['value_desc']; ?></small></label>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>
                <b>Jalan Napas</b><br>
                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($jalan_napas_entry_type['entries'] as $key => $entry_jalan_napas) : ?>
                        <div class="col-6 p-0">
                            <?php if ($entry_jalan_napas['entry_type'] == '2') : ?>
                                <input type="checkbox" onclick="return false;" <?= $entry_jalan_napas['value_id'] == 1 ? 'checked' : ''; ?>>
                                <label for=""><small><?= $entry_jalan_napas['parameter_desc']; ?></small></label>
                            <?php else : ?>
                                <small><?= $entry_jalan_napas['parameter_desc']; ?> : </small>
                                <small><?= $entry_jalan_napas['value_id']; ?></small>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <?php foreach ($jalan_napas as $key => $napas) : ?>
                    <?php if (!in_array($key, $jalan_napas_entry_type['keys'])) : ?>
                        <b><?= $key; ?></b>
                        <div class="d-flex flex-wrap mb-1 col-12">
                            <?php foreach ($napas as $index => $valJalan) : ?>
                                <div class="col-6 p-0">
                                    <?php if ($valJalan['entry_type'] == '3' || $valJalan['entry_type'] == '7') : ?>
                                        <input type="checkbox" onclick="return false;" <?= $valJalan['checked'] == 1 ? 'checked' : ''; ?>>
                                        <label for=""><small><?= $valJalan['value_desc']; ?></small></label>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>


                <b>2. Regional Anestesia</b>

                <?php foreach ($regional as $key => $reg) : ?>
                    <?php if (!in_array($key, $regional_entry_type['keys'])) : ?>
                        <b><?= $key; ?></b>
                        <div class="d-flex flex-wrap mb-1 col-12">
                            <?php foreach ($reg as $index => $valReg) : ?>
                                <div class="col-6 p-0">
                                    <?php if ($valReg['entry_type'] == '3' || $valReg['entry_type'] == '7') : ?>
                                        <input type="checkbox" onclick="return false;" <?= $valReg['checked'] == 1 ? 'checked' : ''; ?>>
                                        <label for=""><small><?= $valReg['value_desc']; ?></small></label>
                                    <?php else : ?>
                                        <small><?= $valReg['value_id']; ?></small>
                                        <label for=""><?= $valReg['value_desc']; ?></label>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach ?>

                <div class="d-flex flex-wrap mb-1 col-12">
                    <?php foreach ($regional_entry_type['entries'] as $key => $entry_regional) : ?>
                        <div class="col-6 p-0">
                            <?php if ($entry_regional['entry_type'] == '2') : ?>
                                <input type="checkbox" onclick="return false;" <?= $entry_regional['value_id'] == 1 ? 'checked' : ''; ?>>
                                <label for=""><small><?= $entry_regional['parameter_desc']; ?></small></label>
                            <?php else : ?>
                                <small><?= $entry_regional['parameter_desc']; ?> : </small>
                                <small><?= $entry_regional['value_id']; ?></small>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-6">
                <h5 class="text-center">MONITORING DURANTEE OPERASI</h5>
                <div class="row">
                    <div id="cairanMasuk-1" class="table tablecustom-responsive">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="box box-info">
                                    <div class="box-body">
                                        <canvas id="myChartMonitoringDurante" width="auto" height="200"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="monitoringDurante-1" class="table tablecustom-responsive">
                        <table class="table">
                            <thead class="table">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">TD(S)</th>
                                    <th scope="col">TD(D)</th>
                                    <th scope="col">NADI</th>
                                    <th scope="col">SUHU</th>
                                    <th scope="col">RR</th>
                                    <th scope="col">SPO2</th>
                                    <th scope="col">CATATAN</th>
                                    <th scope="col">STAFF NAME</th>
                                </tr>
                            </thead>
                            <tbody id="bodyDatamyChartMonitoringDurante" class="table-group-divider">
                                <tr>
                                    <td colspan="10" class="text-center">Data Kosong</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="col-6">
                        Cairan Masuk
                        <table class="table borderless">
                            <?php foreach ($cairan_masuk as $key => $cm) : ?>
                                <tr>
                                    <td><small><?= date_format(date_create($cm['date']), 'd-m-Y'); ?></small></td>
                                    <td><small><?= $cm['name']; ?></small></td>
                                    <td><small><?= $cm['quantity']; ?> cc</small></td>
                                </tr>

                            <?php endforeach; ?>
                            <?php
                            $array_cairan_masuk = array_filter($cairan, fn ($item) => $item['cairan_masuk'] === 1);

                            foreach ($array_cairan_masuk as $key => $c) : ?>
                                <tr>
                                    <td><small><?= date_format(date_create($c['examination_date']), 'd-m-Y'); ?></small></td>
                                    <td><small><?= $c['value_desc']; ?></small></td>
                                    <td><small><?= $c['fluid_amount']; ?> cc</small></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                    <div class="col-6">
                        Cairan Keluar
                        <table class="table table-borderless">
                            <?php
                            $array_cairan_keluar = array_filter($cairan, fn ($item) => $item['cairan_masuk'] === 0);

                            foreach ($array_cairan_keluar as $key => $ck) : ?>
                                <tr>
                                    <td><small><?= date_format(date_create($ck['examination_date']), 'd-m-Y'); ?></small></td>
                                    <td><small><?= $ck['value_desc']; ?></small></td>
                                    <td><small><?= $ck['fluid_amount']; ?> cc</small></td>
                                </tr>
                            <?php endforeach; ?>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <h5 class="text-center">INSTRUKSI PASCA ANESTESI DAN SEDASI</h5>
                <table class="table table-borderless">
                    <tr>
                        <td width="30%">Posisi</td>
                        <td width="1%">:</td>
                        <td><?= @$instruksi_post['position']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Analgesia</td>
                        <td width="1%">:</td>
                        <td><?= @$instruksi_post['analgesik']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Anti Muntah</td>
                        <td width="1%">:</td>
                        <td><?= @$instruksi_post['antiemetik']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Antibiotika</td>
                        <td width="1%">:</td>
                        <td><?= @$instruksi_post['antibiotik']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Obat-obatan lain</td>
                        <td width="1%">:</td>
                        <td><?= @$instruksi_post['other_drugs']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Infus/transfusi</td>
                        <td width="1%">:</td>
                        <td><?= @$instruksi_post['infusion']; ?></td>
                    </tr>
                    <tr>
                        <td width="30%">Makan/minum</td>
                        <td width="1%">:</td>
                        <td>
                            <?=
                            trim(
                                (!empty($instruksi_post['eat']) ? 'Makan' : '') .
                                    (!empty($instruksi_post['drink_little']) ? ', Minum sedikit' : '') .
                                    (!empty($instruksi_post['free_drink']) ? ', Minum bebas' : ''),
                                ','
                            );
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td width="30%">Pemantauan tensi,nadi,napas tiap menit selama</td>
                        <td width="1%">:</td>
                        <td></td>
                    </tr>
                </table>
                <div class="row justify-content-center">
                    <div class="col-auto" align="center">
                        <div>Dokter</div>
                        <div class="mb-1">
                            <div id="qrcode"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div style="break-after:page"></div>

        <div class="container-fluid mt-5">
            <div class="row mb-5">
                <div class="col-2 d-flex">
                    <img class="mt-2 mx-auto" src="<?= base_url('assets/img/logo.png') ?>" style="width: 100px; height: 100px;">
                </div>
                <div class="col-6 text-center">
                    <h1>CATATAN ANESTESI DAN SEDASI</h1>
                </div>
                <div class="col-4">
                    <div class="border border-1" style="height: auto; min-height:100px;">
                        <table class="table table-borderless">
                            <tr class="mb-0">
                                <td width="30%">Nama</td>
                                <td width="1%">:</td>
                                <td><?= $visit['diantar_oleh']; ?></td>
                            </tr>
                            <tr class="mb-0">
                                <td width="30%">Umur</td>
                                <td width="1%">:</td>
                                <td><?= $visit['age']; ?></td>
                            </tr>
                            <tr class="mb-0">
                                <td width="30%">Alamat</td>
                                <td width="1%">:</td>
                                <td><?= $visit['contact_address']; ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="DiagnosisPreTb" class="table tablecustom-responsive">
                    <span>Diagnosis Preoperatif</span>
                    <table class="table">
                        <thead class="table">
                            <tr>
                                <th scope="col">Diagnosis</th>
                                <th scope="col">Jenis Kasus</th>
                                <th scope="col">Kategori Diagnosis</th>

                            </tr>
                        </thead>

                        <tbody id="tabelsRenderdiagPreoperatif" class="table-group-divider">
                            <tr>
                                <td colspan="10" class="text-center">Data Kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div id="DiagnosisPostTb" class="table tablecustom-responsive">
                    <span>Diagnosis Postoperatif</span>
                    <table class="table">
                        <thead class="table">
                            <tr>
                                <th scope="col">Diagnosis</th>
                                <th scope="col">Jenis Kasus</th>
                                <th scope="col">Kategori Diagnosis</th>

                            </tr>
                        </thead>

                        <tbody id="tabelsRenderdiagPostoperatif" class="table-group-divider">
                            <tr>
                                <td colspan="10" class="text-center">Data Kosong</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="waktu_prosedur" class="fw-bold">Macam Prosedur</label>
                        <span type="text" class="form-control" id="macam-prosedur-treat-name" placeholder="Waktu Prosedur">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="jenis_bedah">Team</label>
                        <div class="row" id="bodyTimOperasiAnesthesiLengkap-cetak">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="tanggal_operasi" class="fw-bold">Tanggal Operasi:</label>
                            <span><?= tanggal_indo(date_format(date_create(@$val['start_operation']), 'Y-m-d'));  ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="tanda_vital">Keadaan Prainduksi:</label>
                            <div class="row">

                                <div id="CAnestesiandsedasi-1" class="table tablecustom-responsive">
                                    <table class="table">
                                        <thead class="table">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">TD(S)</th>
                                                <th scope="col">TD(D)</th>
                                                <th scope="col">NADI</th>
                                                <th scope="col">SUHU</th>
                                                <th scope="col">RR</th>
                                                <th scope="col">SPO2</th>
                                                <th scope="col">CATATAN</th>
                                                <th scope="col">STAFF NAME</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bodyDataCAnestesiandsedasi" class="table-group-divider">
                                            <tr>
                                                <td colspan="10" class="text-center">Data Kosong</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="Pemeriksaan_fisik" class="fw-bold">Pemeriksaan fisik</label>
                            <div class="row" id="Pemeriksaan_fisikck"></div>
                            <label for="Pemeriksaan_fisik" class="fw-bold">Mallampati</label>
                            <div class="row" id="Pemeriksaan_fisikck-malapati"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="anastesi" class="fw-bold">Anamnesis</label>
                            <div class="row" id="ckAnamnesis">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="auto">
                                        <label class="form-check-label" for="auto">
                                            Auto
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="regional">
                                        <label class="form-check-label" for="regional">
                                            Regional
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="lainnya">
                                        <label class="form-check-label" for="lainnya">
                                            Lainnya
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="status_psa" class="fw-bold">STATUS FISIK ASA</label>
                            <div class="row" id="asa-canestesi-sedasi">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="checklist_operasi" class="fw-bold">Checklist Operasi</label>
                            <div class="row" id="checklist_operasi-canestesi-sedasi">
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_area_prosedur">
                                        <label class="form-check-label" for="cek_area_prosedur">
                                            Cek area prosedur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_persiapan_alat">
                                        <label class="form-check-label" for="cek_persiapan_alat">
                                            Persiapan alat-alat
                                        </label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_identitas_pasien">
                                        <label class="form-check-label" for="cek_identitas_pasien">
                                            Identitas pasien
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="teknik_resusitasi" class="fw-bold">Teknik Anestesi</label>
                            <div class="row" id='teknik-anestesi-canestesi-sedasi'>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_oral">
                                        <label class="form-check-label" for="cek_oral">
                                            Oral
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_nasal">
                                        <label class="form-check-label" for="cek_nasal">
                                            Nasal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_intubasi">
                                        <label class="form-check-label" for="cek_intubasi">
                                            Intubasi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_tracheal">
                                        <label class="form-check-label" for="cek_tracheal">
                                            Tracheal
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_bib_sagital">
                                        <label class="form-check-label" for="cek_bib_sagital">
                                            Bib sagital
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <label for="monitoring" class="fw-bold">Monitoring</label>
                            <div class="row" id="monitoring-cas">
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_nadi">
                                        <label class="form-check-label" for="cek_nadi">
                                            Nadi
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_ecg">
                                        <label class="form-check-label" for="cek_ecg">
                                            ECG
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_nip_saturator">
                                        <label class="form-check-label" for="cek_nip_saturator">
                                            NIP Saturator
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_temperatur">
                                        <label class="form-check-label" for="cek_temperatur">
                                            Temperatur
                                        </label>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="cek_dic">
                                        <label class="form-check-label" for="cek_dic">
                                            DIC
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="col-auto" align="center">
                <div>Dokter</div>
                <div class="mb-1">
                    <div id="qrcode"></div>
                </div>
            </div>
            <div class="col"></div>
            <div class="col-auto" align="center">
                <div>Pasien</div>
                <div class="mb-1">
                    <div id="qrcode1"></div>
                </div>
            </div>
        </div>
    </div>
</body>


<script>
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: `<?= $visit['fullname']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>
<script>
    var qrcode = new QRCode(document.getElementById("qrcode1"), {
        text: `<?= $visit['diantar_oleh']; ?>`,
        width: 70,
        height: 70,
        colorDark: "#000000",
        colorLight: "#ffffff",
        correctLevel: QRCode.CorrectLevel.H // High error correction
    });
</script>

<style>
    @media print {
        @page {
            margin: none;
            size: landscape;
        }

        .container {
            width: 210mm;
            /* Sesuaikan dengan lebar kertas A4 */
        }
    }
</style>
<script type="text/javascript">
    $(document).ready(function() {
        let val = <?= json_encode($val); ?>;
        let aParamVal = <?= json_encode($a_paramVal); ?>;
        let aParam = <?= json_encode($a_param); ?>;
        getRequestVtRangeAnesthesia({
            vactination_id: <?= json_encode(@$val['document_id']); ?>,
            filters: ["13", "all", "11"],
            body_requestCharts: ["myChartMonitoringDurante", "myChartMonitoringRecoveryRoom", null],
            body_requestTables: ["bodyDatamyChartMonitoringDurante",
                "bodyDatamyChartMonitoringRecoveryRoom",
                "bodyDataCAnestesiandsedasi"
            ]
        });

        renderAlldata({
            aParamVal: aParamVal,
            val: val,
            aParam: aParam
        })

        getDataTreatment(val)





    })



    const ChartMonitoringDurante = (props) => {
        let rawData = props?.data || [];
        let dataRendersTables = '';

        let groupedData = {};

        rawData?.forEach(item => {
            let dateTime = item?.examination_date ? moment(item?.examination_date).format(
                'DD MMM YYYY HH:mm') : null;
            if (dateTime && !groupedData[dateTime]) {
                groupedData[dateTime] = {
                    nadi: [],
                    temperature: [],
                    saturasi: [],
                    tension_upper: [],
                    tension_below: []
                };
            }
            if (dateTime) {
                groupedData[dateTime].nadi.push(parseInt(item?.nadi ?? 0));
                groupedData[dateTime].temperature.push(parseInt(item?.temperature ?? 0));
                groupedData[dateTime].saturasi.push(parseInt(item?.saturasi ?? 10));
                groupedData[dateTime].tension_upper.push(parseInt(item?.tension_upper ?? 0));
                groupedData[dateTime].tension_below.push(parseInt(item?.tension_below ?? 0));
            }
        });


        let allDates = Object.keys(groupedData);
        let dates = Array.from(new Set(allDates.map(dt => moment(dt, 'DD MMM YYYY HH:mm').format(
            'DD MMM YYYY'))));
        let times = allDates.map(dt => moment(dt, 'DD MMM YYYY HH:mm').format('HH:mm'));

        let labels = dates.flatMap(date => times.filter((_, index) => allDates[index].startsWith(date)));


        if (props?.body_requestChart) {
            let datasets = [{
                    label: 'Nadi',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (groupedData[
                            key]?.nadi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(235, 125, 52, 0.2)',
                    borderColor: '#eb7d34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yNadi'
                },
                {
                    label: 'Suhu',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.temperature.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.temperature.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(52, 101, 235, 0.2)',
                    borderColor: '#3465eb',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTemperature'
                },
                {
                    label: 'SPO2',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.saturasi.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.saturasi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(18, 41, 105, 0.2)',
                    borderColor: '#122969',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'ySaturasi'
                },
                {
                    label: 'Sistole',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.tension_upper.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.tension_upper.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(61, 235, 52, 0.2)',
                    borderColor: '#3deb34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTension'
                },
                {
                    label: 'Diastole',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.tension_below.reduce((a, b) => a + b, 0) / (
                            groupedData[key]?.tension_below.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(61, 235, 52, 0.2)',
                    borderColor: '#3deb34',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yTension'
                },
                {
                    label: 'Respirasi',
                    data: labels.map(dateTime => {
                        let key = allDates.find(dt => dt.includes(dateTime));
                        return key ? groupedData[key]?.nadi.reduce((a, b) => a + b, 0) / (groupedData[
                            key]?.nadi.length || 1) : null;
                    }),
                    backgroundColor: 'rgba(230, 242, 5, 0.2)',
                    borderColor: '#e6f205',
                    fill: true,
                    tension: 0.2,
                    yAxisID: 'yRespirasi'
                }
            ];

            const ctxChart = document?.getElementById(`${props?.body_requestChart}`)?.getContext('2d');
            new Chart(ctxChart, {
                type: 'line',
                data: {
                    labels: labels,
                    datasets: datasets
                },
                options: {
                    plugins: {
                        datalabels: false
                    },
                    scales: {
                        yNadi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Nadi'
                            }
                        },
                        yTemperature: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Suhu'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        ySaturasi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'SPO2'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        yTension: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Tekanan Darah'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        },
                        yRespirasi: {
                            type: 'linear',
                            position: 'left',
                            title: {
                                display: true,
                                text: 'Respirasi'
                            },
                            grid: {
                                drawOnChartArea: false
                            }
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    }
                }
            });
        }


        const tableBody = $(`#${props?.body_requestTabels}`);
        if (tableBody.length) {
            dataRendersTables = rawData.map(item => `
                                        <tr>
                                            <td>${moment(item?.examination_date).format('DD MMM YYYY HH:mm')}</td>
                                            <td>${item?.tension_upper ?? 0}</td>
                                            <td>${item?.tension_below?? 0}</td>
                                            <td>${item?.nadi?? 0}</td>
                                            <td>${item?.temperature?? 0}</td>
                                            <td>${item?.nafas?? 0}</td>
                                            <td>${item?.saturasi?? 0}</td>
                                            <td>${item?.pemeriksaan ?? "-"}</td>
                                            <td>${item?.petugas ?? "-"}</td>
                                        </tr>
                                    `).join('');

            tableBody.html(dataRendersTables);
        } else {
            console.log("Table body element not found.");
        }
    };

    const getRequestVtRangeAnesthesia = (props) => {
        let {
            vactination_id,
            filters,
            body_requestCharts,
            body_requestTables
        } = props;




        filters.forEach((filter, index) => {
            postData({
                document_id: vactination_id ?? "",
                filter: filter ?? ""
            }, 'admin/PatientOperationRequest/getDataVitailSignRangeAnesthesia', (res) => {

                if (res.respon && res.data.examination_info.length > 0) {
                    ChartMonitoringDurante({
                        data: res.data.examination_info,
                        body_requestChart: body_requestCharts[
                            index],
                        body_requestTabels: body_requestTables[index]
                    });
                } else {
                    $(`#${body_requestTables[index]}`).closest('.box.box-info').hide();
                    if (body_requestCharts[index]) {
                        $(`#${body_requestCharts[index]}`).closest('.box.box-info').hide();
                    }
                }
            });
        });
    };


    const getDataDiagnosaPreoperatif = (props) => {
        let result = ''
        const sufferTypes = {
            "0": "BELUM DIIDENTIFIKASI",
            "1": "KASUS BARU",
            "2": "KASUS LAMA",
            "11": "KASUS BEDAH",
            "12": "KASUS NON BEDAH",
            "13": "KASUS KEBIDANAN",
            "14": "KASUS PSKIATRIK",
            "15": "KASUS ANAK"
        };
        const diagCategories = {
            "1": "DIAGNOSA UTAMA",
            "2": "DIAGNOSA PENUNJANG /SEKUNDER",
            "3": "DIAGNOSA MASUK",
            "4": "DIAGNOSA HARIAN/ KERJA",
            "5": "DIAGNOSA KECELAKAAN",
            "6": "DIAGNOSA KEMATIAN",
            "7": "DIAGNOSA BANDING",
            "8": "DIAGNOSA UTAMA EKLAIM",
            "9": "DIAGNOSA SEKUNDER EKLAIM",
            "10": "DIAGNOSA AKTUAL (KEPERAWATAN)",
            "11": "DIAGNOSA RESIKO(KEPERAWATAN)",
            "12": "DIAGNOSA PROMOSI KESEHATAN (KEPERAWATAN)",
            "13": "DIAGNOSA PRA OPERASI",
            "14": "DIAGNOSA PASCA OPERASI",
            "15": "DIAGNOSA OPERASI"
        };
        if (props?.data) {
            props?.data?.diagnosa?.map(item => {
                const sufferTypeText = sufferTypes[item?.suffer_type] || "Unknown";
                const diagCatText = diagCategories[item?.diag_cat] || "Unknown";
                result += `<tr>
                                <td>${item?.diagnosa_desc}</td>
                                <td>${sufferTypeText}</td>
                                <td>${diagCatText}</td>
                            </tr>`
            })

            $("#tabelsRenderdiagPreoperatif").html(result)

        }

    }

    const renderDataTeamInPembedahanAnesthesiLengkap = (result) => {
        const labels = result?.labels || [];
        const data = result?.data || [];

        const groupedData = data.reduce((acc, item) => {
            const label = labels.find(lbl => lbl.task_id === item?.task_id);
            const taskName = label ? label.task : item?.task_id;

            const category = taskName.split(' ')[0];

            if (!acc[category]) {
                acc[category] = [];
            }
            acc[category].push({
                ...item,
                taskName
            });
            return acc;
        }, {});

        const categories = Object.entries(groupedData);
        const half = Math.ceil(categories.length / 2);
        const leftCategories = categories.slice(0, half);
        const rightCategories = categories.slice(half);

        let hasil = `
                        <div class="d-flex justify-content-between">
                            <div class="flex-fill me-2">
                                ${leftCategories.map(([category, tasks]) => `
                                    <div class="form-group mb-3">
                                        <h5 class="fw-bold">${category}</h5>
                                        ${tasks.map(item => `
                                            <div class="d-flex align-items-center mb-2 ms-4">
                                                <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                                <span class="w-75">${item?.doctor}</span>
                                            </div>
                                        `).join('')}
                                        <hr />
                                    </div>
                                `).join('')}
                            </div>
                            <div class="flex-fill ms-2">
                                ${rightCategories.map(([category, tasks]) => `
                                    <div class="form-group mb-3">
                                        <h5 class="fw-bold">${category}</h5>
                                        ${tasks.map(item => `
                                            <div class="d-flex align-items-center mb-2 ms-4">
                                                <label class="fw-bold me-3 w-25">${item.taskName}</label>
                                                <span class="w-75">${item?.doctor}</span>
                                            </div>
                                        `).join('')}
                                        <hr />
                                    </div>
                                `).join('')}
                            </div>
                        </div>
                    `;

        $(`#bodyTimOperasiAnesthesiLengkap-cetak`).html(hasil);
    }

    const templateOprasiPembedahanAnesthesiLengkap = (props) => {
        let data = props?.data
        renderDataTeamInPembedahanAnesthesiLengkap({
            data: data?.operation_team,
            labels: data?.operation_task
        });

    }


    const renderAlldata = (props) => {
        quillInstances = {};
        dataDrain = [];
        globalBodyId = '';

        postData({
            id: <?= json_encode(@$val['document_id']); ?>,
            visit_id: <?= json_encode(@$val['visit_id']); ?>
        }, 'admin/PatientOperationRequest/getAllArcodions', (res) => {

            if (res.respon) {
                let result = res?.data
                getDataDiagnosaPreoperatif({
                    data: {
                        diagnosa: result?.diagnosas
                    }
                })

                getDataDiagnosaPostoperatif({
                    pasien_diagnosa_id: result?.assessment_anesthesia?.body_id,
                    vactination_id: result?.assessment_anesthesia?.document_id
                });

                templateOprasiPembedahanAnesthesiLengkap({
                    data: {
                        operation_team: result?.operation_team,
                        operation_task: result?.operation_task

                    }
                })

                getDataAsaRender({
                    aParamVal: props?.aParamVal,
                    val: props?.val
                })

                getDatateknikAnesRender({
                    aParamVal: props?.aParam,
                    val: props?.val
                })


            }
        })
    }


    const getDataDiagnosaPostoperatif = (props) => {
        const sufferTypes = {
            "0": "BELUM DIIDENTIFIKASI",
            "1": "KASUS BARU",
            "2": "KASUS LAMA",
            "11": "KASUS BEDAH",
            "12": "KASUS NON BEDAH",
            "13": "KASUS KEBIDANAN",
            "14": "KASUS PSKIATRIK",
            "15": "KASUS ANAK"
        };
        const diagCategories = {
            "1": "DIAGNOSA UTAMA",
            "2": "DIAGNOSA PENUNJANG /SEKUNDER",
            "3": "DIAGNOSA MASUK",
            "4": "DIAGNOSA HARIAN/ KERJA",
            "5": "DIAGNOSA KECELAKAAN",
            "6": "DIAGNOSA KEMATIAN",
            "7": "DIAGNOSA BANDING",
            "8": "DIAGNOSA UTAMA EKLAIM",
            "9": "DIAGNOSA SEKUNDER EKLAIM",
            "10": "DIAGNOSA AKTUAL (KEPERAWATAN)",
            "11": "DIAGNOSA RESIKO(KEPERAWATAN)",
            "12": "DIAGNOSA PROMOSI KESEHATAN (KEPERAWATAN)",
            "13": "DIAGNOSA PRA OPERASI",
            "14": "DIAGNOSA PASCA OPERASI",
            "15": "DIAGNOSA OPERASI"
        };
        postData({
            pasien_diagnosa_id: props?.pasien_diagnosa_id
        }, 'admin/PatientOperationRequest/getDiagnosassDockterData', (res) => {
            if (res.respon && Array.isArray(res.data)) {
                let result = "";
                res?.data?.map(item => {
                    const sufferTypeText = sufferTypes[item?.suffer_type] || "Unknown";
                    const diagCatText = diagCategories[item?.diag_cat] || "Unknown";
                    result += `<tr>
                                <td>${item?.diagnosa_desc}</td>
                                <td>${sufferTypeText}</td>
                                <td>${diagCatText}</td>
                            </tr>`
                })
                $("#tabelsRenderdiagPostoperatif").html(result)

            }
        });
    };



    const getDataTreatment = (data) => {
        getDataList(
            'admin/PatientOperationRequest/getTreatment',
            (res) => {
                let macam_procedure = res?.find(item => item?.tarif_id === data?.tarif_id)
                $("#macam-prosedur-treat-name").html(macam_procedure?.tarif_name)
                $("#nama-tindakan").html(macam_procedure?.tarif_name)

                // res.
            },
            () => {
                // console.log('Before send callback');
            }
        );
    };

    const getDataAsaRender = (props) => {
        let htmlContent = '';
        let htmlContentckAnamnesis = '';
        let htmlContentckfisik = '';


        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS006' && item.parameter_id === "22") {
                const isChecked = item?.value_id === props?.val?.asa_class ? 'checked' : '';

                htmlContent += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${isChecked} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.value_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && item.parameter_id === "20") {
                const isChecked = item?.value_id === props?.val?.auto_anamnesis ? 'checked' : '';

                htmlContentckAnamnesis += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${isChecked} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.value_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS006' && item.parameter_id === "21") {
                const isChecked = item?.value_id === props?.val?.mallampati ? 'checked' : '';

                htmlContentckfisik += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${isChecked} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.value_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });


        $("#Pemeriksaan_fisikck-malapati").html(htmlContentckfisik);
        $("#asa-canestesi-sedasi").html(htmlContent);
        $("#ckAnamnesis").html(htmlContentckAnamnesis);
    };

    const getDatateknikAnesRender = (props) => {
        let htmlContent = '';
        let htmlContentChecklist = '';
        let htmlContentPemeriksaan_fisik = '';
        let htmlContentmonitoring = '';

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS006' && parseInt(item.parameter_id) >= 26 && parseInt(item.parameter_id) <=
                32) {
                htmlContent += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.parameter_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        $("#teknik-anestesi-canestesi-sedasi").html(htmlContent);

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && parseInt(item.parameter_id) >= 22 && parseInt(item.parameter_id) <=
                25) {


                htmlContentChecklist += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.parameter_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        $("#checklist_operasi-canestesi-sedasi").html(htmlContentChecklist);

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && parseInt(item.parameter_id) >= 16 && parseInt(item.parameter_id) <=
                19) {


                htmlContentPemeriksaan_fisik += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.parameter_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        $("#Pemeriksaan_fisikck").html(htmlContentPemeriksaan_fisik);

        props?.aParamVal?.forEach((item, index) => {
            if (item.p_type === 'OPRS011' && parseInt(item.parameter_id) >= 4 && parseInt(item.parameter_id) <=
                11) {


                htmlContentmonitoring += `
                <div class="col-3">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="checkbox_${index + 1}" ${props?.val?.[item?.column_name?.toLowerCase()] ?? "" === '1' ? 'checked' : ''} onclick="return false;">
                        <label class="form-check-label" for="checkbox_${index + 1}">
                            ${item?.parameter_desc}
                        </label>
                    </div>
                </div>
            `;
            }
        });

        $("#monitoring-cas").html(htmlContentmonitoring);


    };
</script>

</html>