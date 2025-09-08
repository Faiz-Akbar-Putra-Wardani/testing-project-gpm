document.addEventListener("DOMContentLoaded", function () {
    // 1. Rumus Perhitungan
    const biayaRegistrasi = document.getElementById("biaya_registrasi");
    const biayaPaket = document.getElementById("biaya_paket_internet");
    const biayaMaintenance = document.getElementById("biaya_maintenance");
    const ppnNominal = document.getElementById("ppn_nominal");
    const totalBiaya = document.getElementById("total_biaya_per_bulan");

    // Elemen untuk menampilkan Rupiah
    const displayPPN = document.getElementById("display_ppn_nominal");
    const displayTotal = document.getElementById("display_total_biaya");

    function formatRupiah(value) {
        return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(value);
    }

    function hitungTotal() {
        const reg = parseFloat(biayaRegistrasi?.value) || 0;
        const paket = parseFloat(biayaPaket?.value) || 0;
        const maint = parseFloat(biayaMaintenance?.value) || 0;
        const ppn = (paket + maint) * 0.1;
        const total = reg + paket + maint + ppn;

        if (ppnNominal) ppnNominal.value = ppn.toFixed(0);
        if (totalBiaya) totalBiaya.value = total.toFixed(0);

        if (displayPPN) displayPPN.textContent = formatRupiah(ppn);
        if (displayTotal) displayTotal.textContent = formatRupiah(total);
    }

    [biayaRegistrasi, biayaPaket, biayaMaintenance].forEach(el => {
        if (el) el.addEventListener("input", hitungTotal);
    });

    hitungTotal();

    // 2. Konfirmasi Pembayaran
    const form = document.getElementById("transaksiForm");
    if (form) {
        form.addEventListener("submit", function (e) {
            e.preventDefault();

            const namaPelanggan = document.getElementById("nama_lengkap")?.value || "";
            const alamatPelanggan = document.getElementById("alamat_ktp")?.value || "";
            const paketSelect = document.getElementById("paket_internet_id");
            const paketInternet = paketSelect.value === "Lainnya"
                ? document.getElementById("paket_internet_custom")?.value
                : paketSelect.options[paketSelect.selectedIndex]?.text || "";

            const total = parseFloat(totalBiaya?.value) || 0;

            Swal.fire({
                title: "Ringkasan Transaksi",
                html: `
                    <p><strong>Nama Pembeli:</strong> ${namaPelanggan}</p>
                    <p><strong>Alamat:</strong> ${alamatPelanggan}</p>
                    <p><strong>Paket Internet:</strong> ${paketInternet}</p>
                    <p><strong>Total Bayar:</strong> ${formatRupiah(total)}</p>
                `,
                icon: "info",
                showCancelButton: true,
                confirmButtonText: "Konfirmasi & Kirim",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    }


});
