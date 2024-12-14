<?php

use App\Controllers\Admin\Patient;
use App\Controllers\BaseController;

$basecontroller = new Patient();
$basecontroller->checkMenuActive('register');
?>
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>
                <li class="<?= $basecontroller->checkMenuActive('dashboard'); ?>">
                    <a href="<?php echo base_url(); ?>" class="waves-effect">
                        <i class="mdi mdi-view-dashboard"></i>
                        <!-- <span class="badge rounded-pill bg-primary float-end">2</span> -->
                        <span>Dashboard</span>
                    </a>
                </li>
                <?php if (user()->checkRoles(['superuser'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('users'); ?>">
                        <a href="<?php echo base_url() ?>admin/patient/users">
                            <i class="fas fa-users-cog"></i> <span><?php echo "User Permissions"; ?></span>
                        </a>
                    </li>
                <?php } ?>

                <?php if (user()->checkRoles(['superuser', 'admin', 'billingpasien'])) { ?>
                    <!-- <li class=" <?= $basecontroller->checkMenuActive('bill'); ?>">
                        <a href="<?php echo site_url('admin/patient/bill'); ?>" class=" waves-effect">
                            <i class="fas fa-file-invoice"></i> <span> <?php echo lang('Word.billing'); ?></span>
                        </a>
                    </li> -->
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'operatorugd', 'dokter', 'perawat', 'casemanager'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('unitgawatdarurat'); ?>">
                        <a href="<?php echo base_url(); ?>admin/patient/unitgawatdarurat">
                            <i class="fas fa-ambulance"></i>
                            <span> <?php echo "Unit Gawat Darurat"; ?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'operatorpendaftaran'])) { ?>
                    <li class=" <?= $basecontroller->checkMenuActive('search'); ?>">
                        <a href="<?php echo base_url(); ?>admin/patient/search">
                            <i class="mdi mdi-calendar-check"></i> <span><?php echo "Pendaftaran"; ?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'dokter', 'perawat', 'casemanager'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('rajal'); ?>">
                        <a href="<?php echo base_url(); ?>admin/patient/rajal">
                            <i class="mdi mdi-stethoscope"></i> <span> Rawat Jalan</span>
                        </a>
                    </li>
                <?php } ?>
                <li class="<?= $basecontroller->checkMenuActive('ranap'); ?> ">
                    <a href="<?php echo base_url() ?>admin/patient/ranap">
                        <i class="mdi mdi-bed" aria-hidden="true"></i> <span> <?php echo lang('Word.ipd_in_patient'); ?></span>
                    </a>
                </li>
                <?php if (user()->checkRoles(['superuser', 'admin', 'customerservices', 'perawat', 'operatorbangsal', 'bangsal', 'dokter'])) { ?>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'vk'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('vk'); ?>">
                        <a href="<?php echo base_url(); ?>admin/patient/bidan">
                            <i class="mdi mdi-baby-face-outline"></i> <span> Kebidanan</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'ibs'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('ibs'); ?>">
                        <a href="<?php echo base_url(); ?>admin/patient/kamaroperasi">
                            <i class="mdi mdi-knife"></i> <span> Kamar Operasi</span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'operatorgizi'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('gizi'); ?>">
                        <a href="<?php echo base_url() ?>admin/patient/gizi" target="_blank">
                            <i class="fas fa-utensils"></i> <span><?php echo "Gizi"; ?></span>
                        </a>
                    </li>

                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'operatorpelayananobat'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('farmasi'); ?>">
                        <a href="<?php echo base_url(); ?>admin/patient/farmasi">
                            <i class="mdi mdi-pharmacy"></i> <span> <?php echo lang('Word.pharmacy'); ?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'dokterlab', 'adminlab'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('laboratorium'); ?>">
                        <a href="<?php echo base_url(); ?>admin/patient/laboratorium">
                            <i class="fas fa-flask"></i> <span><?php echo "Laboratorium"; ?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'dokterradiologi', 'adminrad'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('radiologi'); ?>">
                        <a href="<?php echo base_url() ?>admin/patient/radiologi">
                            <i class="fas fa-microscope"></i> <span><?php echo lang('Word.radiology'); ?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'billingpasien'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('hemodialisa'); ?>">
                        <a href="<?php echo base_url() ?>admin/patient/hemodialisa">
                            <i class="fas fa-tint"></i> <span><?php echo "Haemodialisa"; ?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                    <!-- <li class="<?= $basecontroller->checkMenuActive('kamaroperasi'); ?>">
                        <a href="<?php echo base_url(); ?>admin/patient/kamaroperasi">
                            <i class="fas fa-dungeon"></i> <span><?php echo "Kamar Operasi"; ?></span>
                        </a>
                    </li> -->
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'perawat'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive(menuname: 'pmkp'); ?>">
                        <a href="<?php echo base_url() ?>admin/patient/pmkp" target="_blank">
                            <i class="fas fa-medkit"></i> <span><?php echo "PMKP"; ?></span>
                        </a>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('admin'); ?>">
                        <a href="#" class="has-arrow waves-effect">
                            <!-- <i class="fas fa-file"></i> -->
                            <img src="<?php echo base_url(); ?>\assets\images\small\satusehat2.png" alt="" style="width: 30px; height: 30px">
                            <span>Satu Sehat</span>
                        </a>
                        <ul class="-menu">
                            <li class="<?= $basecontroller->checkMenuActive('viewPasienId'); ?>"><a href="<?php echo base_url(); ?>satusehat/viewPasienId" target="_blank"><i class="mdi mdi-chevron-right"></i>Generate Pasien ID Hari Ini</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('viewOrganization'); ?>"><a href="<?php echo base_url(); ?>satusehat/viewOrganization" target="_blank"><i class="mdi mdi-chevron-right"></i>Parameter Klinik Organisasi</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('viewLocation'); ?>"><a href="<?php echo base_url(); ?>satusehat/viewLocation" target="_blank"><i class="mdi mdi-chevron-right"></i>Parameter Lokasi Klinik</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('viewLocation'); ?>"><a href="<?php echo base_url(); ?>satusehat/viewLocationInap" target="_blank"><i class="mdi mdi-chevron-right"></i>Parameter Lokasi Bed</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('viewPractitioner'); ?>"><a href="<?php echo base_url(); ?>satusehat/viewPractitioner" target="_blank"><i class="mdi mdi-chevron-right"></i>Parameter Kode Dokter</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('viewEncounterCondition'); ?>"><a href="<?php echo base_url(); ?>satusehat/viewEncounterCondition" target="_blank"><i class="mdi mdi-chevron-right"></i>Bundle Encounter & Condition</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('viewEncounterConditionInap'); ?>"><a href="<?php echo base_url(); ?>satusehat/viewEncounterConditionInap" target="_blank"><i class="mdi mdi-chevron-right"></i>Bundle Encounter & Condition Inap</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('viewMedication'); ?>"><a href="<?php echo base_url(); ?>satusehat/viewMedication" target="_blank"><i class="mdi mdi-chevron-right"></i>Bundle Medication</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('fo'); ?>">
                        <a href="#" class="has-arrow waves-effect">
                            <i class="fas fa-file" style="color: rgba(100, 150, 200, 0.8);"></i><span>Front Office</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="<?= $basecontroller->checkMenuActive('foantrol'); ?>"><a href="<?php echo base_url(); ?>admin/report/foantrol"><i class="mdi mdi-chevron-right"></i>Antrian Online</a></li>
                            <!-- <li class="<?= $basecontroller->checkMenuActive('registermasuk'); ?>"><a href="<?php echo base_url(); ?>admin/report/registermasuk"><i class="mdi mdi-chevron-right"></i> Register Masuk Ranap</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('registerkeluar'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerkeluar"><i class="mdi mdi-chevron-right"></i> Register Keluar Ranap</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('registerpindah'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerpindah"><i class="mdi mdi-chevron-right"></i> Register Pindah Ranap</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('registermelahirkan'); ?>"><a href="<?php echo base_url(); ?>admin/report/registermelahirkan"><i class="mdi mdi-chevron-right"></i> Register Pasien Melahirkan</a></li> -->
                        </ul>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('register'); ?>">
                        <a href="#" class="has-arrow waves-effect">
                            <i class="fas fa-file" style="color: #b0e57c"></i><span>Register</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="<?= $basecontroller->checkMenuActive('registerpoli'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerpoli"><i class="mdi mdi-chevron-right"></i>Rawat Jalan</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('registermasuk'); ?>"><a href="<?php echo base_url(); ?>admin/report/registermasuk"><i class="mdi mdi-chevron-right"></i> Masuk Ranap</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('registerkeluar'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerkeluar"><i class="mdi mdi-chevron-right"></i> Keluar Ranap</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('registerpindah'); ?>"><a href="<?php echo base_url(); ?>admin/report/registerpindah"><i class="mdi mdi-chevron-right"></i> Pindah Ranap</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('registermelahirkan'); ?>"><a href="<?php echo base_url(); ?>admin/report/registermelahirkan"><i class="mdi mdi-chevron-right"></i> Pasien Melahirkan</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin'])) { ?>
                    <li class=" <?= $basecontroller->checkMenuActive('rm'); ?>">
                        <a href="#" class="has-arrow waves-effect">
                            <i class="fas fa-file" style="color: #c4c3d0"></i><span>Rekam Medis</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="<?= $basecontroller->checkMenuActive('rmkunjungan'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjungan"><i class="mdi mdi-chevron-right"></i>Kunjungan Rumah Sakit</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('rmkunjunganranap'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganranap"><i class="mdi mdi-chevron-right"></i> Kunjungan Rawat Inap</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('rmkunjunganranapstatus'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganranapstatus"><i class="mdi mdi-chevron-right"></i> Kunjungan Rawat Inap <p>Per Jenis Pelayanan</p></a></li>
                            <li class="<?= $basecontroller->checkMenuActive('rmkunjunganklinik'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganklinik"><i class="mdi mdi-chevron-right"></i> Kunjungan Rawat Jalan <br>Per Klinik</li>
                            <li class="<?= $basecontroller->checkMenuActive('rmkunjunganstatus'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganstatus"><i class="mdi mdi-chevron-right"></i> Kunjungan Rawat Jalan <br>Per Status</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('rmkunjunganugd'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmkunjunganugd"><i class="mdi mdi-chevron-right"></i> Kunjungan Rawat Jalan <br>IGD</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('rmtopxrajal'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmtopxrajal"><i class="mdi mdi-chevron-right"></i> Top X Diagnosa <br>Rawat Jalan</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('rmtopxranap'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmtopxranap"><i class="mdi mdi-chevron-right"></i> Top X Diagnosa <br>Rawat Inap</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('rmtopxugd'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmtopxugd"><i class="mdi mdi-chevron-right"></i> Top X Diagnosa <br>Unit Gawat Darurat</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('rmindexrajal'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmindexrajal"><i class="mdi mdi-chevron-right"></i> Kartu Index Penyakit Rajal</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('rmindexranap'); ?>"><a href="<?php echo base_url(); ?>admin/report/rmindexranap"><i class="mdi mdi-chevron-right"></i> Kartu Index Penyakit Ranap</a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('fin'); ?>">
                        <a href="#" class="has-arrow waves-effect">
                            <i class="fas fa-file" style="color: #d5a6bd"></i><span>Keuangan</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="<?= $basecontroller->checkMenuActive('finharian'); ?>"><a href="<?php echo base_url(); ?>admin/report/finharian"><i class="mdi mdi-chevron-right"></i>Keuangan Harian</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finbulanan'); ?>"><a href="<?php echo base_url(); ?>admin/report/finbulanan"><i class="mdi mdi-chevron-right"></i> Keuangan Bulanan</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('fintglpoli'); ?>"><a href="<?php echo base_url(); ?>admin/report/fintglpoli"><i class="mdi mdi-chevron-right"></i> Keuangan Tanggal Poli</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finpolitgl'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpolitgl"><i class="mdi mdi-chevron-right"></i> Keuangan Poli Tanggal</li>
                            <li class="<?= $basecontroller->checkMenuActive('finrajalstatus'); ?>"><a href="<?php echo base_url(); ?>admin/report/finrajalstatus"><i class="mdi mdi-chevron-right"></i> Kunjungan Rawat Jalan <br>Per Status</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finpoli'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpoli"><i class="mdi mdi-chevron-right"></i> Keuangan Poli Rinci</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finjenis'); ?>"><a href="<?php echo base_url(); ?>admin/report/finjenis"><i class="mdi mdi-chevron-right"></i> Keuangan Per Jenis</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finjenistgl'); ?>"><a href="<?php echo base_url(); ?>admin/report/finjenistgl"><i class="mdi mdi-chevron-right"></i> Keuangan Jenis Tanggal</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finjenisrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finjenisrinci"><i class="mdi mdi-chevron-right"></i> Transaksi Keuangan Jenis Rinci</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finpembayarantgl'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayarantgl"><i class="mdi mdi-chevron-right"></i> Transaksi Pembayaran/Tanggal</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finpembayarantrx'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayarantrx"><i class="mdi mdi-chevron-right"></i> Transaksi Pembayaran/TRX</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finpembayaranrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayaranrinci"><i class="mdi mdi-chevron-right"></i> Transaksi Pembayaran Rinci</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finsetor'); ?>"><a href="<?php echo base_url(); ?>admin/report/finsetor"><i class="mdi mdi-chevron-right"></i> Rekap Penerimaan dan <p>Setoran Kasir</p></a></li>
                            <li class="<?= $basecontroller->checkMenuActive('finsetorrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finsetorrinci"><i class="mdi mdi-chevron-right"></i> Penerimaan dan <p>Setoran Kasir Rinci</p></a></li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', 'operatorpelayananobat'])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('apt'); ?>">
                        <a href="#" class="has-arrow waves-effect">
                            <i class="fas fa-file" style="color: #91c9c0"></i><span>Apotek</span>
                        </a>
                        <ul class="sub-menu">
                            <li class="<?= $basecontroller->checkMenuActive('aptrekapnota'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptrekapnota"><i class="mdi mdi-chevron-right"></i>Rekap Nota Obat</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('aptrekapobat'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptrekapobat"><i class="mdi mdi-chevron-right"></i> Rekap Pemakaian Obat</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('aptrekappelayanan'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptrekappelayanan"><i class="mdi mdi-chevron-right"></i> Rekap Pelayanan</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('aptobatalkes'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptobatalkes"><i class="mdi mdi-chevron-right"></i> Pemakaian Obat / Alkes</li>
                            <li class="<?= $basecontroller->checkMenuActive('aptpsikotropika'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptpsikotropika"><i class="mdi mdi-chevron-right"></i> Laporan Psikotropika</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('aptrekappsikotropika'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptrekappsikotropika"><i class="mdi mdi-chevron-right"></i> Rekap Psikotropika</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('aptpembelian'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptpembelian"><i class="mdi mdi-chevron-right"></i> Pembelian per Tanggal</a></li>
                            <li class="<?= $basecontroller->checkMenuActive('aptkartubarang'); ?>"><a href="<?php echo base_url(); ?>admin/report/aptkartubarang"><i class="mdi mdi-chevron-right"></i> Kartu Barang</a></li>
                            <!-- <li class="<?= $basecontroller->checkMenuActive('finjenisrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finjenisrinci"><i class="mdi mdi-chevron-right"></i> Transaksi Keuangan Jenis Rinci</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpembayarantgl'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayarantgl"><i class="mdi mdi-chevron-right"></i> Transaksi Pembayaran/Tanggal</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpembayarantrx'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayarantrx"><i class="mdi mdi-chevron-right"></i> Transaksi Pembayaran/TRX</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finpembayaranrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finpembayaranrinci"><i class="mdi mdi-chevron-right"></i> Transaksi Pembayaran Rinci</a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finsetor'); ?>"><a href="<?php echo base_url(); ?>admin/report/finsetor"><i class="mdi mdi-chevron-right"></i> Rekap Penerimaan dan <p>Setoran Kasir</p></a></li>
                                <li class="<?= $basecontroller->checkMenuActive('finsetorrinci'); ?>"><a href="<?php echo base_url(); ?>admin/report/finsetorrinci"><i class="mdi mdi-chevron-right"></i> Penerimaan dan <p>Setoran Kasir Rinci</p></a></li> -->
                        </ul>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('admin'); ?>">
                        <a href="#" class="has-arrow waves-effect">
                            <i class="fas fa-file" style="color: #9a9fa1"></i><span>Log</span>
                        </a>
                        <ul class="-menu">
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?>"><a href="<?php echo base_url(); ?>admin/report/adminlog"><i class="mdi mdi-chevron-right"></i>Log User</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>
                <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('get_send'); ?>">
                        <a href="<?php echo base_url(); ?>admin/Antrian/get_send">
                            <i class="fas fa-tasks"></i> <span><?php echo "Manajement Antrian"; ?></span>
                        </a>
                    </li>

                <?php } ?>

                <?php if (user()->checkRoles(['superuser', 'admin', ''])) { ?>
                    <li class="<?= $basecontroller->checkMenuActive('rl'); ?>">
                        <a href="#" class="has-arrow waves-effect">
                            <i class="fas fa-dot-circle"></i><span>Report RL</span>
                        </a>
                        <ul class="-menu">
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_1_1"><i
                                        class="mdi mdi-chevron-right"></i>RL 1.1 Data Dasar Rumah Sakit</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_1_3"><i
                                        class="mdi mdi-chevron-right"></i>RL 1.3 Tempat Tidur</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_2"><i
                                        class="mdi mdi-chevron-right"></i>RL 2 Ketenagaan</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_1"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.1 KEGIATAN PELAYANAN RAWAT INAP</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_3"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.3 PELAYANAN GIGI MULUT</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_6"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.6 KEGIATAN PEMBEDAHAN</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_7"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.7 KEGIATAN RADIOLOGI</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_8"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.8 KEGIATAN LABORATORIUM</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_9"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.9 REHABILITASI MEDIK</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_10"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.8 KEGIATAN PELAYANAN KHUSUS</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_11"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.11 KESEHATAN JIWA</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_13"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.13 PENGADAAN OBAT</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_14"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.14 KEGIATAN RUJUKAN</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_3_15"><i
                                        class="mdi mdi-chevron-right"></i>RL 3.15 CARA BAYAR</a>
                            </li>

                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_4_A"><i
                                        class="mdi mdi-chevron-right"></i>RL 4-A DATA KEADAAN MORBIDITAS PASIEN RAWAT INAP
                                    RUMAH SAKIT</a>
                            </li>
                            <li class="<?= $basecontroller->checkMenuActive('adminlog'); ?> text-wrap"><a
                                    href="<?php echo base_url(); ?>admin/report/rl_4_B"><i
                                        class="mdi mdi-chevron-right"></i>RL 4-B DATA KEADAAN MORBIDITAS PASIEN RAWAT JALAN
                                    RUMAH SAKIT</a>
                            </li>
                        </ul>
                    </li>
                <?php } ?>


                <li style="height: 300px"></li>
                <!-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-email-outline"></i>
                        <span>Email</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox.html">Inbox</a></li>
                        <li><a href="email-read.html">Email Read</a></li>
                        <li><a href="email-compose.html">Email Compose</a></li>
                    </ul>
                </li>

                <li>
                    <a href="chat.html" class=" waves-effect">
                        <i class="mdi mdi-chat-processing-outline"></i>
                        <span class="badge rounded-pill bg-danger float-end">Hot</span>
                        <span>Chat</span>
                    </a>
                </li>

                <li>
                    <a href="kanbanboard.html" class=" waves-effect">
                        <i class="mdi mdi-billboard"></i>
                        <span class="badge rounded-pill bg-success float-end">New</span>
                        <span>Kanban Board</span>
                    </a>
                </li>

                <li class="menu-title">Components</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-buffer"></i>
                        <span>UI Elements</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-alerts.html">Alerts</a></li>
                        <li><a href="ui-buttons.html">Buttons</a></li>
                        <li><a href="ui-badge.html">Badge</a></li>
                        <li><a href="ui-cards.html">Cards</a></li>
                        <li><a href="ui-carousel.html">Carousel</a></li>
                        <li><a href="ui-dropdowns.html">Dropdowns</a></li>
                        <li><a href="ui-utilities.html">Utilities<span class="badge rounded-pill bg-success float-end">New</span></a></li>
                        <li><a href="ui-grid.html">Grid</a></li>
                        <li><a href="ui-images.html">Images</a></li>
                        <li><a href="ui-lightbox.html">Lightbox</a></li>
                        <li><a href="ui-modals.html">Modals</a></li>
                        <li><a href="ui-colors.html">Colors<span class="badge rounded-pill bg-warning float-end">New</span></a></li>
                        <li><a href="ui-offcanvas.html">Offcanvas</a></li>
                        <li><a href="ui-pagination.html">Pagination</a></li>
                        <li><a href="ui-popover-tooltips.html">Popover &amp; Tooltips</a></li>
                        <li><a href="ui-rangeslider.html">Range Slider</a></li>
                        <li><a href="ui-session-timeout.html">Session Timeout</a></li>
                        <li><a href="ui-progressbars.html">Progress Bars</a></li>
                        <li><a href="ui-sweet-alert.html">Sweet-Alert</a></li>
                        <li><a href="ui-tabs-accordions.html">Tabs &amp; Accordions</a></li>
                        <li><a href="ui-typography.html">Typography</a></li>
                        <li><a href="ui-video.html">Video</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <i class="mdi mdi-clipboard-outline"></i>
                        <span class="badge rounded-pill bg-success float-end">6</span>
                        <span>Forms</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="form-elements.html">Form Elements</a></li>
                        <li><a href="form-validation.html">Form Validation</a></li>
                        <li><a href="form-advanced.html">Form Advanced</a></li>
                        <li><a href="form-editors.html">Form Editors</a></li>
                        <li><a href="form-uploads.html">Form File Upload</a></li>
                        <li><a href="form-xeditable.html">Form Xeditable</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-chart-line"></i>
                        <span>Charts</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="charts-morris.html">Morris Chart</a></li>
                        <li><a href="charts-chartist.html">Chartist Chart</a></li>
                        <li><a href="charts-chartjs.html">Chartjs Chart</a></li>
                        <li><a href="charts-flot.html">Flot Chart</a></li>
                        <li><a href="charts-c3.html">C3 Chart</a></li>
                        <li><a href="charts-other.html">Jquery Knob Chart</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-format-list-bulleted-type"></i>
                        <span>Tables</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="tables-basic.html">Basic Tables</a></li>
                        <li><a href="tables-datatable.html">Data Table</a></li>
                        <li><a href="tables-responsive.html">Responsive Table</a></li>
                        <li><a href="tables-editable.html">Editable Table</a></li>
                    </ul>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-album"></i>
                        <span>Icons</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="icons-material.html">Material Design</a></li>
                        <li><a href="icons-ion.html">Ion Icons</a></li>
                        <li><a href="icons-fontawesome.html">Font Awesome</a></li>
                        <li><a href="icons-themify.html">Themify Icons</a></li>
                        <li><a href="icons-dripicons.html">Dripicons</a></li>
                        <li><a href="icons-typicons.html">Typicons Icons</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="waves-effect">
                        <span class="badge rounded-pill bg-danger float-end">2</span>
                        <i class="mdi mdi-google-maps"></i>
                        <span>Maps</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="maps-google.html"> Google Map</a></li>
                        <li><a href="maps-vector.html"> Vector Map</a></li>
                    </ul>
                </li>

                <li class="menu-title">Extras</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-responsive"></i>
                        <span> Layouts </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Vertical</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-light-sidebar.html">Light Sidebar</a></li>
                                <li><a href="layouts-compact-sidebar.html">Compact Sidebar</a></li>
                                <li><a href="layouts-icon-sidebar.html">Icon Sidebar</a></li>
                                <li><a href="layouts-boxed.html">Boxed Layout</a></li>
                                <li><a href="layouts-preloader.html">Preloader</a></li>
                                <li><a href="layouts-colored-sidebar.html">Colored Sidebar</a></li>
                            </ul>
                        </li>

                        <li>
                            <a href="javascript: void(0);" class="has-arrow">Horizontal</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="layouts-horizontal.html">Horizontal</a></li>
                                <li><a href="layouts-hori-topbar-dark.html">Topbar Dark</a></li>
                                <li><a href="layouts-hori-preloader.html">Preloader</a></li>
                                <li><a href="layouts-hori-boxed-width.html">Boxed Layout</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-account-box"></i>
                        <span> Authentication </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-login.html">Login</a></li>
                        <li><a href="pages-register.html">Register</a></li>
                        <li><a href="pages-recoverpw.html">Recover Password</a></li>
                        <li><a href="pages-lock-screen.html">Lock Screen</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-text-box-multiple-outline"></i>
                        <span> Extra Pages </span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="pages-timeline.html">Timeline</a></li>
                        <li><a href="pages-invoice.html">Invoice</a></li>
                        <li><a href="pages-directory.html">Directory</a></li>
                        <li><a href="pages-blank.html">Blank Page</a></li>
                        <li><a href="pages-404.html">Error 404</a></li>
                        <li><a href="pages-500.html">Error 500</a></li>
                    </ul>
                </li>



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="mdi mdi-share-variant"></i>
                        <span>Multi Level</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="true">
                        <li><a href="javascript: void(0);">Level 1.1</a></li>
                        <li><a href="javascript: void(0);" class="has-arrow">Level 1.2</a>
                            <ul class="sub-menu" aria-expanded="true">
                                <li><a href="javascript: void(0);">Level 2.1</a></li>
                                <li><a href="javascript: void(0);">Level 2.2</a></li>
                            </ul>
                        </li>
                    </ul>
                </li> -->

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->