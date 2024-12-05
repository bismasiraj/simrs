<div class="modal modal-xl fade" id="skriningsuspect" tabindex="-1" aria-labelledby="skriningsuspectLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="skriningsuspectLabel">SKRINING SUSPECT TBC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Tambahkan form dengan id 'form-assTbc' -->
                <form id="form-assTbc">
                    <input type="hidden" class="form-control" id="org_unit_code-assTbc" name="org_unit_code">
                    <input type="hidden" class="form-control" id="visit_id-assTbc" name="visit_id">
                    <input type="hidden" class="form-control" id="trans_id-assTbc" name="trans_id">
                    <input type="hidden" class="form-control" id="body_id-assTbc" name="body_id">
                    <input type="hidden" class="form-control" id="document_id-assTbc" name="document_id">
                    <input type="hidden" class="form-control" id="no_registration-assTbc" name="no_registration">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col fw-bold" class="text-center">YA</th>
                                <th scope="col fw-bold" class="text-center">TIDAK</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="padding: 5px; width: 2000px;"><span class="fw-bold">1. Batuk</span></td>
                                <td class="text-center">
                                    <input type="checkbox" name="cough" id="batuk-ya" value="1" onclick="handleCheckboxskrining(this, 'batuk-tidak')">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="cough" id="batuk-tidak" value="0" onclick="handleCheckboxskrining(this, 'batuk-ya')">
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">2. Batuk darah</span></td>
                                <td class="text-center">
                                    <input type="checkbox" name="hemoptisis" id="batuk_darah-ya" value="1" onclick="handleCheckboxskrining(this, 'batuk_darah-tidak')">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="hemoptisis" id="batuk_darah-tidak" value="0" onclick="handleCheckboxskrining(this, 'batuk_darah-ya')">
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">3. Penurunan BB/Nafsu makan</span></td>
                                <td class="text-center">
                                    <input type="checkbox" name="weight_loss" id="penurunan_bb-ya" value="1" onclick="handleCheckboxskrining(this, 'penurunan_bb-tidak')">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="weight_loss" id="penurunan_bb-tidak" value="0" onclick="handleCheckboxskrining(this, 'penurunan_bb-ya')">
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">4. Keringat malam</span></td>
                                <td class="text-center">
                                    <input type="checkbox" name="hiperhidrosis" id="keringat_malam-ya" value="1" onclick="handleCheckboxskrining(this, 'keringat_malam-tidak')">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="hiperhidrosis" id="keringat_malam-tidak" value="0" onclick="handleCheckboxskrining(this, 'keringat_malam-ya')">
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">5. Sesak nafas</span></td>
                                <td class="text-center">
                                    <input type="checkbox" name="dispnea" id="sesak_nafas-ya" value="1" onclick="handleCheckboxskrining(this, 'sesak_nafas-tidak')">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="dispnea" id="sesak_nafas-tidak" value="0" onclick="handleCheckboxskrining(this, 'sesak_nafas-ya')">
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">6. Kontak erat dengan pasien TBC</span></td>
                                <td class="text-center">
                                    <input type="checkbox" name="close_contact" id="kontak_erat-ya" value="1" onclick="handleCheckboxskrining(this, 'kontak_erat-tidak')">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="close_contact" id="kontak_erat-tidak" value="0" onclick="handleCheckboxskrining(this, 'kontak_erat-ya')">
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">7. Ada hasil rontgen pneumonia/mendukung TBC</span></td>
                                <td class="text-center">
                                    <input type="checkbox" name="pneumonia" id="hasil_rontgen-ya" value="1" onclick="handleCheckboxskrining(this, 'hasil_rontgen-tidak')">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="pneumonia" id="hasil_rontgen-tidak" value="0" onclick="handleCheckboxskrining(this, 'hasil_rontgen-ya')">
                                </td>
                            </tr>
                            <tr>
                                <td><span class="fw-bold">8. Riwayat penyakit :</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <ul>
                                        <li>DM</li>
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="diabetes" id="riwayat_penyakit_dm-ya" value="1" onclick="handleCheckboxskrining(this, 'riwayat_penyakit_dm-tidak')">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="diabetes" id="riwayat_penyakit_dm-tidak" value="0" onclick="handleCheckboxskrining(this, 'riwayat_penyakit_dm-ya')">
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <ul>
                                        <li>HIV</li>
                                    </ul>
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="hiv" id="riwayat_penyakit_hiv-ya" value="1" onclick="handleCheckboxskrining(this, 'riwayat_penyakit_hiv-tidak')">
                                </td>
                                <td class="text-center">
                                    <input type="checkbox" name="hiv" id="riwayat_penyakit_hiv-tidak" value="0" onclick="handleCheckboxskrining(this, 'riwayat_penyakit_hiv-ya')">
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center">
                                    <input type="hidden" name="suspect" class="form-control" id="conclusion-val" value="0">
                                    <strong>Kesimpulan :</strong> <span id="conclusion">BUKAN TERDUGA TBC</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!-- Tombol Save ditambahkan di dalam form -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button id="button-submit-assTbc" type="button" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>