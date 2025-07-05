<?php if ($tindakan) : ?>
<div style="border: .5px solid #dee2e6;">
    <table class="table table-border mb-0">
        <colgroup>
            <col style="width: 24.9158%;">
            <col style="width: 11.0269%;">
            <col style="width: 2.44108%;">
            <col style="width: 26.6835%;">
            <col style="width: 7.32323%;">
            <col style="width: 2.27273%;">
            <col style="width: 25.3367%;">
        </colgroup>
        <tbody>
            <tr style="height: 58.5625px;">
                <td rowspan="4"
                    style="border-right: .5px solid #dee2e6 !important; border-top: none; vertical-align:middle;">
                    <strong>PERSETUJUAN &nbsp;/PENOLAKAN &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;TINDAKAN
                        KEDOKTERAN</strong>
                </td>
                <td style="border: none;">Nama</td>
                <td style="border: none;">:</td>
                <td colspan="4" style="border: none;"><?= @$visit['visit']['diantar_oleh']; ?></td>
            </tr>
            <tr style="height: 36.1719px;">
                <td style="border: none;">Tanggal lahir</td>
                <td style="border: none;">:</td>
                <td colspan="4" style="border: none;"><?= @$visit['visit']['tgl_lahir']; ?></td>
            </tr>
            <tr style="height: 36.1719px;">
                <td style="border: none;">Umur</td>
                <td style="border: none;">:</td>
                <td colspan="4" style="border: none;"><?= @$visit['visit']['age']; ?></td>
            </tr>
            <tr style="height: 36.1719px;">
                <td style="border: none;">No RM</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= @$visit['visit']['no_registration']; ?></td>
                <td style="border: none;">Ruang</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= @$visit['visit']['class_room_id']; ?></td>
            </tr>
            <tr style="height: 36.1719px; border-top: .5px solid #dee2e6 !important;">
                <td rowspan="3" style="border-right: .5px solid #dee2e6 !important; border-bottom: none;">&nbsp;</td>
                <td style="border: none;">Jenis kelamin</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= @$visit['visit']['gender'] === "2" ? "Perempuan": "Laki-Laki"?></td>
                <td style="border: none;">Kelas</td>
                <td style="border: none;">:</td>
                <td style="border: none;"><?= $visit['visit']['name_of_class']; ?></td>
            </tr>
            <tr style="height: 36.1719px;">
                <td style="border: none;">Tanggal masuk</td>
                <td style="border: none;">:</td>
                <td colspan="4" style="border: none;">
                    <?= isset($visit['visit']['visit_datetime']) && !empty($visit['visit']['visit_datetime']) ? $visit['visit']['visit_datetime'] : $visit['visit']['in_date']; ?>
                </td>
            </tr>
            <tr style="height: 36.1719px;">
                <td style="border: none;">DPJP</td>
                <td style="border: none;">:</td>
                <td colspan="4" style="border: none;"><?= $visit['visit']['fullname']; ?></td>
            </tr>
        </tbody>
    </table>

</div>
<?php endif ?>
<table class="table table-bordered mt-2">
    <tbody id="data-informasi-<?= $id; ?>">

    </tbody>
</table>
<table class="table table-bordered mb-0">
    <thead>
        <tr>
            <th valign="top" width="37">
                <p class="mb-1" align="center">NO</p>
            </th>
            <th colspan="2" valign="top" width="228">
                <p class="mb-1" align="center">JENIS INFORMASI</p>
            </th>
            <th valign="top" width="300">
                <p class="mb-1" align="center">ISI INFORMASI</p>
            </th>
            <th valign="top" width="162">
                <p class="mb-1" align="center">TANDA(&radic;)/PARAF <strong>Penerima</strong></p>
                <p class="mb-1" align="center"><strong>&nbsp;informasi</strong></p>
            </th>
        </tr>
    </thead>
    <tbody id="data-table-<?= $id; ?>">

    </tbody>
</table>
<table class="table table-bordered mb-0">
    <tbody id="data-table2-<?= $id; ?>">


    </tbody>
</table>
<p class="">&nbsp;</p>