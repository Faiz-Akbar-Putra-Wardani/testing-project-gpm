
import $ from 'jquery';
window.$ = window.jQuery = $;

import 'bootstrap';

import 'bootstrap-icons/font/bootstrap-icons.css';
import Swal from 'sweetalert2';
window.Swal = Swal;

import 'select2/dist/css/select2.min.css';
import 'select2-bootstrap-5-theme/dist/select2-bootstrap-5-theme.min.css';

import Select2 from 'select2/dist/js/select2.full.js';

Select2($);

$(function() {
    console.log('DOM siap. Mencoba inisialisasi Select2 setelah pemanggilan manual...');

    if ($.fn.select2) {
        console.log('BERHASIL! $.fn.select2 DITEMUKAN setelah pemanggilan manual.');
        $('.select2').select2({
            theme: 'bootstrap-5',
            width: '100%',
            placeholder: '-- Pilih --',
            allowClear: true,
            minimumResultsForSearch: 0,
        });
        console.log('Select2 berhasil diinisialisasi pada elemen .select2');
    } else {
        console.error('FATAL LEVEL 2: Pemanggilan manual Select2($) tidak berhasil menempelkan plugin.');
    }
});

import './alert.js';
import './transaksi-table.js';
import './provinsi.js';
import './transaksi.js';
import './transaksi-perhitungan.js';
