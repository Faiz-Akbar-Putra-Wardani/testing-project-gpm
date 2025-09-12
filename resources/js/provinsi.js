import $ from "jquery";

$(function () {
    function ajaxGet(url, successCallback, target) {
        console.log("Request:", url);

        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function (data) {
                console.log("Response:", data);
                successCallback(data);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", status, error);
                console.error("Response Text:", xhr.responseText);
                $(target).html('<option value="">Error load data</option>');
                alert("Gagal memuat data dari " + url);
            },
        });
    }

    function setDisabled(selector, disabled) {
        $(selector).prop("disabled", disabled);
    }

    function loadKabupaten(provinsiId, target, selectedId, nextCallback) {
        if (!provinsiId) {
            $(target).html('<option value="">-- Pilih Kabupaten --</option>');
            setDisabled(target, true);
            return;
        }
        ajaxGet("/kabupaten/by-provinsi/" + provinsiId, function (data) {
            let kabupatenList = data.data || data;
            let options = '<option value="">-- Pilih Kabupaten --</option>';
            kabupatenList.forEach((k) => {
                let selected = selectedId && selectedId == k.id ? "selected" : "";
                options += `<option value="${k.id}" ${selected}>${k.name}</option>`;
            });
            $(target).html(options);
            setDisabled(target, false);

            if (selectedId) {
                $(target).val(selectedId).trigger("change");
                if (nextCallback) nextCallback(selectedId);
            }
        }, target);
    }

    function loadKecamatan(kabupatenId, target, selectedId, nextCallback) {
        if (!kabupatenId) {
            $(target).html('<option value="">-- Pilih Kecamatan --</option>');
            setDisabled(target, true);
            return;
        }
        ajaxGet("/kecamatan/by-kabupaten/" + kabupatenId, function (data) {
            let kecamatanList = data.data || data;
            let options = '<option value="">-- Pilih Kecamatan --</option>';
            kecamatanList.forEach((k) => {
                let selected = selectedId && selectedId == k.id ? "selected" : "";
                options += `<option value="${k.id}" ${selected}>${k.name}</option>`;
            });
            $(target).html(options);
            setDisabled(target, false);

            if (selectedId) {
                $(target).val(selectedId).trigger("change");
                if (nextCallback) nextCallback(selectedId);
            }
        }, target);
    }

    function loadKelurahan(kecamatanId, target, selectedId) {
        if (!kecamatanId) {
            $(target).html('<option value="">-- Pilih Kelurahan --</option>');
            setDisabled(target, true);
            return;
        }
        ajaxGet("/kelurahan/by-kecamatan/" + kecamatanId, function (data) {
            let kelurahanList = data.data || data;
            let options = '<option value="">-- Pilih Kelurahan --</option>';
            kelurahanList.forEach((k) => {
                let selected = selectedId && selectedId == k.id ? "selected" : "";
                options += `<option value="${k.id}" ${selected}>${k.name}</option>`;
            });
            $(target).html(options);
            setDisabled(target, false);

            if (selectedId) {
                $(target).val(selectedId).trigger("change");
            }
        }, target);
    }

    setDisabled("#kabupaten_ktp_id, #kecamatan_ktp_id, #kelurahan_ktp_id", true);

    $("#provinsi_ktp_id").change(function () {
        let provId = this.value;
        setDisabled("#kabupaten_ktp_id, #kecamatan_ktp_id, #kelurahan_ktp_id", true);
        if (provId) {
            loadKabupaten(provId, "#kabupaten_ktp_id");
        }
    });

    $("#kabupaten_ktp_id").change(function () {
        let kabId = this.value;
        setDisabled("#kecamatan_ktp_id, #kelurahan_ktp_id", true);
        if (kabId) {
            loadKecamatan(kabId, "#kecamatan_ktp_id");
        }
    });

    $("#kecamatan_ktp_id").change(function () {
        let kecId = this.value;
        setDisabled("#kelurahan_ktp_id", true);
        if (kecId) {
            loadKelurahan(kecId, "#kelurahan_ktp_id");
        }
    });

    setDisabled("#kabupaten_instalasi_id, #kecamatan_instalasi_id, #kelurahan_instalasi_id", true);

    $("#provinsi_instalasi_id").change(function () {
        let provId = this.value;
        setDisabled("#kabupaten_instalasi_id, #kecamatan_instalasi_id, #kelurahan_instalasi_id", true);
        if (provId) {
            loadKabupaten(provId, "#kabupaten_instalasi_id");
        }
    });

    $("#kabupaten_instalasi_id").change(function () {
        let kabId = this.value;
        setDisabled("#kecamatan_instalasi_id, #kelurahan_instalasi_id", true);
        if (kabId) {
            loadKecamatan(kabId, "#kecamatan_instalasi_id");
        }
    });

    $("#kecamatan_instalasi_id").change(function () {
        let kecId = this.value;
        setDisabled("#kelurahan_instalasi_id", true);
        if (kecId) {
            loadKelurahan(kecId, "#kelurahan_instalasi_id");
        }
    });

    if (window.oldKabKtp) {
        loadKabupaten($("#provinsi_ktp_id").val(), "#kabupaten_ktp_id", window.oldKabKtp, function () {
            if (window.oldKecKtp) {
                loadKecamatan(window.oldKabKtp, "#kecamatan_ktp_id", window.oldKecKtp, function () {
                    if (window.oldKelKtp) {
                        loadKelurahan(window.oldKecKtp, "#kelurahan_ktp_id", window.oldKelKtp);
                    }
                });
            }
        });
    }

    if (window.oldKabInst) {
        loadKabupaten($("#provinsi_instalasi_id").val(), "#kabupaten_instalasi_id", window.oldKabInst, function () {
            if (window.oldKecInst) {
                loadKecamatan(window.oldKabInst, "#kecamatan_instalasi_id", window.oldKecInst, function () {
                    if (window.oldKelInst) {
                        loadKelurahan(window.oldKecInst, "#kelurahan_instalasi_id", window.oldKelInst);
                    }
                });
            }
        });
    }

    // Tambahkan ini di dalam $(function() { ... }) setelah semua setDisabled dan event change selesai
$('#copy_ktp').click(function() {
    // Copy provinsi
    let provKtp = $('#provinsi_ktp_id').val();
    $('#provinsi_instalasi_id').val(provKtp).trigger('change');

    // Setelah provinsi ter-load kabupaten
    if(provKtp){
        loadKabupaten(provKtp, '#kabupaten_instalasi_id', $('#kabupaten_ktp_id').val(), function(kabId){
            if(kabId){
                loadKecamatan(kabId, '#kecamatan_instalasi_id', $('#kecamatan_ktp_id').val(), function(kecId){
                    if(kecId){
                        loadKelurahan(kecId, '#kelurahan_instalasi_id', $('#kelurahan_ktp_id').val());
                    }
                });
            }
        });
    }

    // Copy alamat detail
    $('#alamat_instalasi').val($('#alamat_ktp').val());

    // Copy kode pos
    $('#kodepos_instalasi').val($('#kodepos_ktp').val());
});


});
