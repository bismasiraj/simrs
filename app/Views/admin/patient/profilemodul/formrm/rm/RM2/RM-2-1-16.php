<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>2.1.16 ASESMEN KHUSUS PENYAKIT MENULAR _ IMMUNOSUPRESED</title>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="js/script.js"></script>

    <script>
        $(function() {
            fungsi1_disabled();
            $("#t_03_dokter, #t_03_perawat, #t_03_keluarga").click(fungsi1_disabled);
        });
        $(function() {
            fungsi1_enable();
            $("#t_03_lain").click(fungsi1_enable);
        });

        function fungsi1_disabled() {
            if (this.click) {
                $("#v_05").attr("disabled", true);
                $("#v_05").val("");
            } else {
                $("#v_05").removeAttr("disabled");
            }
        }

        function fungsi1_enable() {
            $("#v_05").attr("disabled", true);
            if (this.click) {
                $("#v_05").removeAttr("disabled");
                $("#v_05").focus();
            } else {
                $("#v_05").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi2_disabled();
            $("#t_09_tidak").click(fungsi2_disabled);
        });
        $(function() {
            fungsi2_enable();
            $("#t_09_ya").click(fungsi2_enable);
        });

        function fungsi2_disabled() {
            if (this.click) {
                $("#v_10").attr("disabled", true);
                $("#v_10").val("");
            } else {
                $("#v_10").removeAttr("disabled");
            }
        }

        function fungsi2_enable() {
            $("#v_10").attr("disabled", true);
            if (this.click) {
                $("#v_10").removeAttr("disabled");
                $("#v_10").focus();
            } else {
                $("#v_10").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi3_disabled();
            $("#t_01_baru").click(fungsi3_disabled);
        });
        $(function() {
            fungsi3_enable();
            $("#t_01_lama").click(fungsi3_enable);
        });

        function fungsi3_disabled() {
            if (this.click) {
                $("#v_04").attr("disabled", true);
                $("#v_04").val("");
            } else {
                $("#v_04").removeAttr("disabled");
            }
        }

        function fungsi3_enable() {
            $("#v_04").attr("disabled", true);
            if (this.click) {
                $("#v_04").removeAttr("disabled");
                $("#v_04").focus();
            } else {
                $("#v_04").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi4_disabled();
            $("#t_04_tidak").click(fungsi4_disabled);
        });
        $(function() {
            fungsi4_enable();
            $("#t_04_ya").click(fungsi4_enable);
        });

        function fungsi4_disabled() {
            if (this.click) {
                $("#v_06").attr("disabled", true);
                $("#v_06").val("");
            } else {
                $("#v_06").removeAttr("disabled");
            }
        }

        function fungsi4_enable() {
            $("#v_06").attr("disabled", true);
            if (this.click) {
                $("#v_06").removeAttr("disabled");
                $("#v_06").focus();
            } else {
                $("#v_06").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi5_disabled();
            $("#t_05_tidak").click(fungsi5_disabled);
        });
        $(function() {
            fungsi5_enable();
            $("#t_05_ya").click(fungsi5_enable);
        });

        function fungsi5_disabled() {
            if (this.click) {
                $("#v_07").attr("disabled", true);
                $("#v_07").val("");
            } else {
                $("#v_07").removeAttr("disabled");
            }
        }

        function fungsi5_enable() {
            $("#v_07").attr("disabled", true);
            if (this.click) {
                $("#v_07").removeAttr("disabled");
                $("#v_07").focus();
            } else {
                $("#v_07").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi6_disabled();
            $("#t_011_dokter, #t_011_perawat, #t_011_keluarga").click(fungsi6_disabled);
        });
        $(function() {
            fungsi6_enable();
            $("#t_011_lains").click(fungsi6_enable);
        });

        function fungsi6_disabled() {
            if (this.click) {
                $("#v_11").attr("disabled", true);
                $("#v_11").val("");
            } else {
                $("#v_11").removeAttr("disabled");
            }
        }

        function fungsi6_enable() {
            $("#v_11").attr("disabled", true);
            if (this.click) {
                $("#v_11").removeAttr("disabled");
                $("#v_11").focus();
            } else {
                $("#v_11").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi7_disabled();
            $("#t_012_tidak").click(fungsi7_disabled);
        });
        $(function() {
            fungsi7_enable();
            $("#t_012_ya").click(fungsi7_enable);
        });

        function fungsi7_disabled() {
            if (this.click) {
                $("#v_12").attr("disabled", true);
                $("#v_12").val("");
            } else {
                $("#v_12").removeAttr("disabled");
            }
        }

        function fungsi7_enable() {
            $("#v_12").attr("disabled", true);
            if (this.click) {
                $("#v_12").removeAttr("disabled");
                $("#v_12").focus();
            } else {
                $("#v_12").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi8_disabled();
            $("#t_013_tidak").click(fungsi8_disabled);
        });
        $(function() {
            fungsi8_enable();
            $("#t_013_ya").click(fungsi8_enable);
        });

        function fungsi8_disabled() {
            if (this.click) {
                $("#v_13").attr("disabled", true);
                $("#v_13").val("");
            } else {
                $("#v_13").removeAttr("disabled");
            }
        }

        function fungsi8_enable() {
            $("#v_13").attr("disabled", true);
            if (this.click) {
                $("#v_13").removeAttr("disabled");
                $("#v_13").focus();
            } else {
                $("#v_13").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi9_disabled();
            $("#t_014_tidak").click(fungsi9_disabled);
        });
        $(function() {
            fungsi9_enable();
            $("#t_014_ya").click(fungsi9_enable);
        });

        function fungsi9_disabled() {
            if (this.click) {
                $("#v_14").attr("disabled", true);
                $("#v_14").val("");
            } else {
                $("#v_14").removeAttr("disabled");
            }
        }

        function fungsi9_enable() {
            $("#v_14").attr("disabled", true);
            if (this.click) {
                $("#v_14").removeAttr("disabled");
                $("#v_14").focus();
            } else {
                $("#v_14").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi10_disabled();
            $("#t_015_tidak").click(fungsi10_disabled);
        });
        $(function() {
            fungsi10_enable();
            $("#t_015_ya").click(fungsi10_enable);
        });

        function fungsi10_disabled() {
            if (this.click) {
                $("#v_15").attr("disabled", true);
                $("#v_15").val("");
            } else {
                $("#v_15").removeAttr("disabled");
            }
        }

        function fungsi10_enable() {
            $("#v_15").attr("disabled", true);
            if (this.click) {
                $("#v_15").removeAttr("disabled");
                $("#v_15").focus();
            } else {
                $("#v_15").attr("disabled", true);
            }
        }
    </script>
    <script>
        $(function() {
            fungsi11_disabled();
            $("#t_016_tidak").click(fungsi11_disabled);
        });
        $(function() {
            fungsi11_enable();
            $("#t_016_ya").click(fungsi11_enable);
        });

        function fungsi11_disabled() {
            if (this.click) {
                $("#v_16").attr("disabled", true);
                $("#v_16").val("");
            } else {
                $("#v_16").removeAttr("disabled");
            }
        }

        function fungsi11_enable() {
            $("#v_16").attr("disabled", true);
            if (this.click) {
                $("#v_16").removeAttr("disabled");
                $("#v_16").focus();
            } else {
                $("#v_16").attr("disabled", true);
            }
        }
    </script>



</head>

<body>
    <form>
        <div class="container-fluid">


            <br>
            <h3 style="text-align: right;"><b>RM 2.1.16</b></h3>

            <h6 style="text-align: center;"><b>REKAM MEDIS RAWAT INAP</b></h6>


            <table class="table table-bordered mb-0" style="border: 1px solid black;">
                <tbody>
                    <tr>
                        <td style="text-align: center;">
                            <img src="<?= base_url('img/logo.png') ?>" alt="logo" width="100px">
                            <div>
                                <label>SEhat-aMANah <br>tanGGungjawab-Islami</label>
                            </div>
                        </td>
                        <td>
                            <h3><b>RS PKU MUHAMMADIYAH SAMPANGAN</b></h3>
                            <h5><b>Semanggi RT 002 / RW 020 Pasar Kliwon, Surakarta<br>Telp 0271-633894 Fax. : 0271-630229 <br>Jawa Tengah 57117</b></h5>
                        </td>
                        <td>
                            <div class="container" style="height: 150px; border: 1px solid black; border-radius: 3px">
                                <h5 style="text-align: center; margin-top: 60px">Label Identitas Pasien</h5>

                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: center;">
                            <h5><b>ASESMEN KHUSUS PENYAKIT MENULAR & IMMUNOSUPRESED</b></h5>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" style="text-align: center;"><b>Diisi oleh Dokter</b></td>
                    </tr>



                    <table class="table table-bordered mb-0" style="border: 1px solid black;">
                        <tbody>

                            <tr>
                                <td>
                                    <div class="row">
                                        <label class="col-sm-1 col-form-label">Tanggal :</label>
                                        <div class="col-sm-4">
                                            <input type="date" class="form-control" id="V_01" name="V_01" autofocus>
                                        </div>
                                        <div class="col-sm-1"></div>
                                        <label class="col-sm-1 col-form-label">Jam :</label>
                                        <div class="col-sm-4">
                                            <input type="time" class="form-control" id="v_02" name="v_02">
                                        </div>
                                    </div>
                                </td>
                            </tr>


                            <tr>
                                <td>
                                    <h5><b>A. PENYAKIT MENULAR</b></h5>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">• Diagnosis</label>
                                            : <input type="text" name="v_03" id="v_03" style="width: 400px" autocomplete="off">, ditegakan :
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_01" id="t_01_baru" value="0">
                                                <label class="form-check-label" for="t_01_baru">Baru</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_01" id="t_01_lama" value="1">
                                                <label class="form-check-label" for="t_01_lama">Lama, sejak :</label>
                                                <input type="text" name="v_04" id="v_04" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">• Pasien mengetahui penyakit saat ini</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_02" id="t_02_tahu" value="0">
                                                <label class="form-check-label" for="t_02_tahu">Tahu</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_02" id="t_02_tidak" value="1">
                                                <label class="form-check-label" for="t_02_tidak">Tidak</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div>
                                            <label class="col-3" for="">• Sumber informasi penyakit diperoleh dari</label>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_03" id="t_03_dokter" value="0">
                                                <label class="form-check-label" for="t_03_dokter">Dokter</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_03" id="t_03_perawat" value="0">
                                                <label class="form-check-label" for="t_03_perawat">Perawat</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_03" id="t_03_keluarga" value="0">
                                                <label class="form-check-label" for="t_03_keluarga">Keluarga</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="t_03" id="t_03_lain" value="1">
                                                <label class="form-check-label" for="t_03_lain">Lain-lain</label>
                                                <input type="text" name="v_05" id="v_05" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Menerima informasi jangka waktu pengobatan</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_ya" value="0">
                                            <label class="form-check-label" for="t_04_ya">Ya,</label>
                                            <input type="text" name="v_06" id="v_06" autocomplete="off"> , Minggu/bulan/tahun
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_04" id="t_04_tidak" value="0">
                                            <label class="form-check-label" for="t_04_tidak">Tidak</label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Melakukan pemeriksaaan rutin</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_05" id="t_05_tidak" value="0">
                                            <label class="form-check-label" for="t_05_tidak">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_05" id="t_05_ya" value="0">
                                            <label class="form-check-label" for="t_05_ya">Ya, di</label>
                                            <input type="text" name="v_07" id="v_07" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Cara penularan</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_06" id="t_06_air" value="0">
                                            <label class="form-check-label" for="t_06_air">Airbone </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_06" id="t_06_drop" value="0">
                                            <label class="form-check-label" for="t_06_drop">Droplet </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_06" id="t_06_kontak" value="0">
                                            <label class="form-check-label" for="t_06_kontak">Kontak langsung </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_06" id="t_06_cairan" value="0">
                                            <label class="form-check-label" for="t_06_cairan">Cairan tubuh</label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Dirawat diruang isolasi bertekanan negatif</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_07" id="t_07_ya" value="0">
                                            <label class="form-check-label" for="t_07_ya">Ya </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_07" id="t_07_tidak" value="0">
                                            <label class="form-check-label" for="t_07_tidak">Tidak </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_07" id="t_07_kor" value="0">
                                            <label class="form-check-label" for="t_07_kor">Kohorting</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_07" id="t_07_ruang" value="0">
                                            <label class="form-check-label" for="t_07_ruang">ruang tersendiri</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_07" id="t_07_lain" value="0">
                                            <label class="form-check-label" for="t_07_lain">Lain-lain</label>
                                            <input type="text" name="v_08" id="v_08" style="width: 100px" autocomplete="off">
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_07" id="t_07_jika" value="0">
                                            <label class="form-check-label" for="t_07_jika">jika penuh dirujuk ke</label>
                                            <input type="text" name="v_09" id="v_09" style="width: 100px" autocomplete="off">
                                        </div>
                                    </div>


                                    <div class="mb-2">
                                        <label class="col-3" for="">• Penggunaan alat pelindung dari</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_08" id="t_08_tidak" value="0">
                                            <label class="form-check-label" for="t_08_tidak">Tidak </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_08" id="t_08_ya" value="0">
                                            <label class="form-check-label" for="t_08_ya">Ya, </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_08" id="t_08_masker" value="0">
                                            <label class="form-check-label" for="t_08_masker">masker</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_08" id="t_08_sarung" value="0">
                                            <label class="form-check-label" for="t_08_sarung">sarung tangan</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_08" id="t_08_gown" value="0">
                                            <label class="form-check-label" for="t_08_gown">gown</label>
                                        </div>
                                    </div>

                                    <div class="mb-4">
                                        <label class="col-3" for="">• lainnya Penyakit Penyerta</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_09" id="t_09_tidak" value="0">
                                            <label class="form-check-label" for="t_09_tidak">Tidak </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_09" id="t_09_ya" value="0">
                                            <label class="form-check-label" for="t_09_ya">Ya, </label>
                                            <input type="text" name="v_10" id="v_10" autocomplete="off">
                                        </div>
                                    </div>



                                    <h5><b>B. PENYAKIT PENURUNAN DAYA TAHAN TUBUH (IMMUNOSUPPRESED)</b></h5>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Pasien mengetahui penyakit saat ini</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_010" id="t_010_tahu" value="0">
                                            <label class="form-check-label" for="t_010_tahu">Tahu </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_010" id="t_010_tidak" value="0">
                                            <label class="form-check-label" for="t_010_tidak">Tidak </label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Sumber informasi penyakit diperoleh dari</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_011" id="t_011_dokter" value="0">
                                            <label class="form-check-label" for="t_011_dokter">Dokter </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_011" id="t_011_perawat" value="0">
                                            <label class="form-check-label" for="t_011_perawat">Perawat </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_011" id="t_011_keluarga" value="0">
                                            <label class="form-check-label" for="t_011_keluarga">Keluarga</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_011" id="t_011_lains" value="0">
                                            <label class="form-check-label" for="t_011_lains">Lain-lain</label>
                                            <input type="" name="v_11" id="v_11" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Menerima informasi jangka waktu pengobatan</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_012" id="t_012_ya" value="0">
                                            <label class="form-check-label" for="t_012_ya">Ya,</label>
                                            <input type="text" name="v_12" id="v_12" autocomplete="off"> , Minggu/bulan/tahun
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_012" id="t_012_tidak" value="0">
                                            <label class="form-check-label" for="t_012_tidak">Tidak</label>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Melakukan pemeriksaaan rutin</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_013" id="t_013_tidak" value="0">
                                            <label class="form-check-label" for="t_013_tidak">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_013" id="t_013_ya" value="0">
                                            <label class="form-check-label" for="t_013_ya">Ya, di</label>
                                            <input type="text" name="v_13" id="v_13" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Dirawat terpisah/ sendiri</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_014" id="t_014_tidak" value="0">
                                            <label class="form-check-label" for="t_014_tidak">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_014" id="t_014_ya" value="0">
                                            <label class="form-check-label" for="t_014_ya">Ya, di</label>
                                            <input type="text" name="v_14" id="v_14" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• Penyakit Penyerta</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_015" id="t_015_tidak" value="0">
                                            <label class="form-check-label" for="t_015_tidak">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_015" id="t_015_ya" value="0">
                                            <label class="form-check-label" for="t_015_ya">Ya,</label>
                                            <input type="text" name="v_15" id="v_15" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <label class="col-3" for="">• lainnya Penyakit Penyerta</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_016" id="t_016_tidak" value="0">
                                            <label class="form-check-label" for="t_016_tidak">Tidak</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="t_016" id="t_016_ya" value="0">
                                            <label class="form-check-label" for="t_016_ya">Ya,</label>
                                            <input type="text" name="v_16" id="v_16" autocomplete="off">
                                        </div>
                                    </div>
                                    <label><b>• Analisa Masalah</b></label>
                                    <div class="mb-3">
                                        <div>
                                            <textarea class="form-control" id="v_17" name="v_17" rows="7" cols="7"></textarea>
                                        </div>
                                    </div>


                                    <label><b>• Tindakan</b></label>
                                    <div class="mb-3">
                                        <div>
                                            <textarea class="form-control" id="v_18" name="v_18" rows="7" cols="7"></textarea>
                                        </div>
                                    </div>


                                    <div style="text-align: right;">
                                        <div class="mb-3">
                                            <label>Dokter</label>
                                        </div>
                                        <div class="mb-1">
                                            <canvas id="canvas" width="200" height="150" style="border:1px solid #000;"></canvas>
                                            <input type="hidden" name="TTD" id="TTD">
                                        </div>
                                        <div>
                                            <input type="text" name="v_19" id="v_19" autocomplete="off">
                                            <br><label>TTD & Nama Terang</label>
                                        </div>
                                    </div>

                                </td>
                            </tr>

                        </tbody>
                    </table>



        </div>
    </form>
    <script>
        var canvas = document.getElementById('canvas');
        const canvasDataInput = document.getElementById('TTD');
        var context = canvas.getContext('2d');
        var drawing = false;

        canvas.addEventListener('mousedown', startDrawing);
        canvas.addEventListener('mousemove', draw);
        canvas.addEventListener('mouseup', stopDrawing);
        canvas.addEventListener('mouseout', stopDrawing);

        function startDrawing(e) {
            drawing = true;
            draw(e);
        }

        function draw(e) {
            if (!drawing) return;

            context.lineWidth = 2;
            context.lineCap = 'round';
            context.strokeStyle = '#000';

            context.lineTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
            context.stroke();
            context.beginPath();
            context.moveTo(e.clientX - canvas.getBoundingClientRect().left, e.clientY - canvas.getBoundingClientRect().top);
        }

        function stopDrawing() {
            drawing = false;
            context.beginPath();
        }

        function saveSignatureData() {
            const canvasData = canvas.toDataURL('image/png');

            canvasDataInput.value = canvasData;
        }
    </script>
</body>

</html>