<div class="border border-1" style="font-size: 11px !important;" id="setuju-tindakan-<?= $id; ?>">
    <table style="border-collapse: collapse; width: 100%;" border="0">
        <tr class="text-center" style="border-bottom: .5px solid #dee2e6;">
            <th colspan="7" class="py-2">PERSETUJUAN TINDAKAN KEDOKTERAN</th>
        </tr>
    </table>
    <table class="table table-borderless">
        <colgroup>
            <col style="width: 13.8047%;">
            <col style="width: 1.93603%;">
            <col style="width: 35.8586%;">
            <col style="width: 5.55556%;">
            <col style="width: 14.8148%;">
            <col style="width: 11.3636%;">
            <col style="width: 16.5825%;">
        </colgroup>
        <tbody>
            <tr>
                <td class="p-0 px-2" colspan="7">
                    <p>Yang bertandatangan dibawah ini saya</p>
                </td>
            </tr>
            <tr>
                <td class="p-0 px-2">Nama</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" colspan="5" id="nama-tindakan-setuju-<?= $id; ?>">&nbsp;</td>
            </tr>
            <tr>
                <td class="p-0 px-2">Umur</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" id="umur-tindakan-setuju-<?= $id; ?>">&nbsp;</td>
                <td class="p-0 px-2">Tahun : </td>
                <td class="p-0 px-2" id="tahun-tindakan-setuju-<?= $id; ?>">&nbsp;</td>
                <td class="p-0 px-2">Jenis Kelamin : </td>
                <td class="p-0 px-2"><span id="kelamin-setuju<?= $id; ?>" class="kelamin-setuju<?= $id; ?>"></span></td>
            </tr>
            <tr>
                <td class="p-0 px-2">Alamat</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" colspan="5" id="alamat-tindakan-setuju-<?= $id; ?>">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-borderless">
        <colgroup>
            <col style="width: 13.8047%;">
            <col style="width: 1.93603%;">
            <col style="width: 35.8586%;">
            <col style="width: 5.55556%;">
            <col style="width: 14.8148%;">
            <col style="width: 11.3636%;">
            <col style="width: 16.5825%;">
        </colgroup>
        <tbody>
            <tr>
                <td class="p-0 px-2" colspan="5">
                    <p class="mb-1">Dengan ini menyatakan SETUJU untuk dilakukan Tindakan</p>
                    <p class="mb-1">Terhadap <span class="fw-bold" id="selaku-<?= $id; ?>"></span> : </p>
                </td>
            </tr>
            <tr>
                <td class="p-0 px-2">Nama</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" colspan="5" id="nama-tindakan-setuju-2-<?= $id; ?>">&nbsp;</td>
            </tr>
            <tr>
                <td class="p-0 px-2">Umur</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" id="umur-tindakan-setuju-2-<?= $id; ?>">&nbsp;</td>
                <td class="p-0 px-2">Tahun : </td>
                <td class="p-0 px-2">&nbsp;</td>
                <td class="p-0 px-2">Jenis Kelamin : </td>
                <td class="p-0 px-2" id="kelamin-tindakan-setuju-2-<?= $id; ?>"></td>
            </tr>
            <tr>
                <td class="p-0 px-2">Alamat</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" colspan="5" id="alamat-tindakan-setuju-2-<?= $id; ?>">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-borderless">
        <colgroup>
            <col style="width: 33.3053%;">
            <col style="width: 33.3053%;">
            <col style="width: 33.3053%;">
        </colgroup>
        <tbody>
            <tr class="mb-3">
                <td class="p-0 px-2" colspan="4">
                    <p class="mb-0">Saya memahami perlunya dan manfaat tindakan tersebut sebagaaimana telah dijelaskan
                        seperti diatas kepada saya,termasuk resiko dan komplikasi yang mungkin timbul. </p>
                    <p class="mb-0">Saya juga menyadari bahwa oleh karena ilmu kedokteran bukan ilmu pasti,maka
                        keberhasilan tindakan kedokteran bukanlah keniscayaan,melainkan sangat tergantung kepada izin
                        Tuhan Yang Maha Esa. </p>
                </td>
            </tr>
            <tr class="text-end mb-3">
                <td class="p-0 px-2 pe-5" colspan="4"><?= $kop['kota']; ?>, WIB</td>
            </tr>
            <tr>
                <td class="text-center p-0 px-2">Yang Menyatakan</td>
                <td class="text-center p-0 px-2">Saksi I</td>
                <td class="text-center p-0 px-2">Saksi II</td>
            </tr>
            <tr>
                <td class="text-center p-0 px-2">&nbsp;</td>
                <td class="text-center p-0 px-2">Keluarga</td>
                <td class="text-center p-0 px-2">Tenaga Medis</td>
            </tr>
            <tr style="height: 40px;">
                <td class="text-center p-0 px-2">
                    <p class="text-center" id="qrcode-tandatangan-pihak-menyatakan-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                    <p class="text-center" id="qrcode-tandatangan-pihak-menyatakan_name-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                </td>
                <td class="text-center p-0 px-2">
                    <p class="text-center" id="qrcode-tandatangan-pihak-keluarga-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                    <p class="text-center" id="qrcode-tandatangan-pihak-keluarga_name-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                </td>
                <td class="text-center p-0 px-2">
                    <p class="text-center" id="qrcode-tandatangan-pihak-medis-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                    <p class="text-center" id="qrcode-tandatangan-pihak-medis_name-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                </td>
            </tr>
            <tr>
                <!-- <td class="text-center p-0 px-2">(<span id="pihak-menyatakan-<?= $id; ?>"></span>)</td> -->
                <!-- <td class="text-center p-0 px-2">(.......................)</td>
                <td class="text-center p-0 px-2">(.......................)</td> -->
            </tr>
            <!-- <tr>
                <td class="text-center p-0 px-2"><small>Tandatangan &amp; nama terang</small></td>
                <td class="text-center p-0 px-2"><small>Tandatangan &amp; nama terang</small></td>
                <td class="text-center p-0 px-2"><small>Tandatangan &amp; nama terang</small></td>
            </tr> -->
        </tbody>
    </table>
</div>
<div class="border border-1" style="font-size: 11px !important;" id="menolak-tindakan-<?= $id; ?>">
    <table style="border-collapse: collapse; width: 100%;" border="0">
        <tr class="text-center" style="border-bottom: .5px solid #dee2e6;">
            <th colspan="7" class="py-2">PENOLAKAN TINDAKAN KEDOKTERAN</th>
        </tr>
    </table>
    <table class="table table-borderless">
        <colgroup>
            <col style="width: 13.8047%;">
            <col style="width: 1.93603%;">
            <col style="width: 35.8586%;">
            <col style="width: 5.55556%;">
            <col style="width: 14.8148%;">
            <col style="width: 11.3636%;">
            <col style="width: 16.5825%;">
        </colgroup>
        <tbody>
            <tr>
                <td class="p-0 px-2" colspan="7">
                    <p>Yang bertandatangan dibawah ini saya</p>
                </td>
            </tr>
            <tr>
                <td class="p-0 px-2">Nama</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" colspan="5" id="nama-tindakan-menolak-<?= $id; ?>">&nbsp;</td>
            </tr>
            <tr>
                <td class="p-0 px-2">Umur</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" id="umur-tindakan-menolak-<?= $id; ?>">&nbsp;</td>
                <td class="p-0 px-2">Tahun : </td>
                <td class="p-0 px-2" id="tahun-tindakan-menolak-<?= $id; ?>">&nbsp;</td>
                <td class="p-0 px-2">Jenis Kelamin : </td>
                <td class="p-0 px-2"><span id="kelamin-menolak<?= $id; ?>" class="kelamin-menolak<?= $id; ?>"></span>
                </td>
            </tr>
            <tr>
                <td class="p-0 px-2">Alamat</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" colspan="5" id="alamat-tindakan-menolak-<?= $id; ?>">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-borderless">
        <colgroup>
            <col style="width: 13.8047%;">
            <col style="width: 1.93603%;">
            <col style="width: 35.8586%;">
            <col style="width: 5.55556%;">
            <col style="width: 14.8148%;">
            <col style="width: 11.3636%;">
            <col style="width: 16.5825%;">
        </colgroup>
        <tbody>
            <tr>
                <td class="p-0 px-2" colspan="5">
                    <p class="mb-1">Dengan ini menyatakan PENOLAKAN untuk dilakukan Tindakan</p>
                    <p class="mb-1">Terhadap <span class="fw-bold" id="selaku-2-<?= $id; ?>"></span> : </p>
                </td>
            </tr>
            <tr>
                <td class="p-0 px-2">Nama</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" colspan="5" id="nama-tindakan-menolak-2-<?= $id; ?>">&nbsp;</td>
            </tr>
            <tr>
                <td class="p-0 px-2">Umur</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" id="umur-tindakan-menolak-2-<?= $id; ?>">&nbsp;</td>
                <td class="p-0 px-2">Tahun : </td>
                <td class="p-0 px-2">&nbsp;</td>
                <td class="p-0 px-2">Jenis Kelamin : </td>
                <td class="p-0 px-2" id="kelamin-tindakan-menolak-2-<?= $id; ?>"></td>
            </tr>
            <tr>
                <td class="p-0 px-2">Alamat</td>
                <td class="p-0 px-2">:</td>
                <td class="p-0 px-2" colspan="5" id="alamat-tindakan-menolak-2-<?= $id; ?>">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <table class="table table-borderless">
        <colgroup>
            <col style="width: 33.3053%;">
            <col style="width: 33.3053%;">
            <col style="width: 33.3053%;">
        </colgroup>
        <tbody>
            <tr class="mb-3">
                <td class="p-0 px-2" colspan="4">
                    <p class="mb-0">Saya memahami perlunya dan manfaat tindakan tersebut sebagaaimana telah dijelaskan
                        seperti diatas kepada saya,termasuk resiko dan komplikasi yang mungkin timbul. </p>
                    <p class="mb-0">Saya juga menyadari bahwa oleh karena ilmu kedokteran bukan ilmu pasti,maka
                        keberhasilan tindakan kedokteran bukanlah keniscayaan,melainkan sangat tergantung kepada izin
                        Tuhan Yang Maha Esa. </p>
                </td>
            </tr>
            <tr class="text-end mb-3">
                <td class="p-0 px-2 pe-5" colspan="4"><?= $kop['kota']; ?>, WIB</td>
            </tr>
            <tr>
                <td class="text-center p-0 px-2">Yang Menyatakan</td>
                <td class="text-center p-0 px-2">Saksi I</td>
                <td class="text-center p-0 px-2">Saksi II</td>
            </tr>
            <tr>
                <td class="text-center p-0 px-2">&nbsp;</td>
                <td class="text-center p-0 px-2">Keluarga</td>
                <td class="text-center p-0 px-2">Tenaga Medis</td>
            </tr>
            <tr style="height: 40px;">
                <td class="text-center p-0 px-2">
                    <p class="text-center" id="qrcode-tandatangan-pihak-menyatakan2-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                    <p class="text-center" id="qrcode-tandatangan-pihak-menyatakan2_name-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                </td>
                <td class="text-center p-0 px-2">
                    <p class="text-center" id="qrcode-tandatangan-pihak-keluarga2-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                    <p class="text-center" id="qrcode-tandatangan-pihak-keluarga2_name-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                </td>
                <td class="text-center p-0 px-2">
                    <p class="text-center" id="qrcode-tandatangan-pihak-medis2-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                    <p class="text-center" id="qrcode-tandatangan-pihak-medis2_name-<?= $id; ?>"
                        style="display: flex; align-items: center; justify-content: center;"></p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<small class="">* &nbsp;Coret yang tidak perlu</small>