// 1. toggle input
document.addEventListener("DOMContentLoaded", function () {

    // === Next & Back Button ===
    document.querySelectorAll(".nextBtn").forEach(btn => {
        btn.addEventListener("click", function() {
            let target = this.getAttribute("data-next");
            let tab = document.querySelector(`[data-bs-target="${target}"]`);
            new bootstrap.Tab(tab).show();
        });
    });

    document.querySelectorAll(".prevBtn").forEach(btn => {
        btn.addEventListener("click", function() {
            let target = this.getAttribute("data-prev");
            let tab = document.querySelector(`[data-bs-target="${target}"]`);
            new bootstrap.Tab(tab).show();
        });
    });

    // === Toggle Input ===
    function toggleInput(selectId, inputIds) {
        const select = document.getElementById(selectId);
        if (!select) return;

        const inputs = Array.isArray(inputIds)
            ? inputIds.map(id => document.getElementById(id)).filter(Boolean)
            : [document.getElementById(inputIds)].filter(Boolean);

        function update() {
            if (select.value === "Lainnya") {
                inputs.forEach(input => {
                    input.style.display = "block";
                    input.removeAttribute("disabled");
                });
            } else {
                inputs.forEach(input => {
                    input.style.display = "none";
                    input.setAttribute("disabled", "disabled");
                });
            }
        }

        update();
        select.addEventListener("change", update);
    }

    toggleInput("pekerjaan", "pekerjaan_lainnya");
    toggleInput("jenis_tempat_tinggal", "tempat_tinggal_lainnya");
    toggleInput("paket_internet_id", ["nama_paket", "harga_bulanan"]);
    toggleInput("bandwidth_id", "nilai");

    // === Auto-fill Promosi ===
    const promosiSelect = document.getElementById("promosi_id");
    const promosiFields = document.getElementById("promosi_fields");

    if (promosiSelect) {
        promosiSelect.addEventListener("change", function () {
            const selected = promosiSelect.options[promosiSelect.selectedIndex];

            if (promosiSelect.value) {
                promosiFields.style.display = "block";
                document.getElementById("kode_promosi").value = selected.dataset.kode || "";
                document.getElementById("periode_mulai").value = selected.dataset.mulai || "";
                document.getElementById("periode_selesai").value = selected.dataset.selesai || "";
                document.getElementById("note").value = selected.dataset.note || "";
            } else {
                promosiFields.style.display = "none";
                document.getElementById("kode_promosi").value = "";
                document.getElementById("periode_mulai").value = "";
                document.getElementById("periode_selesai").value = "";
                document.getElementById("note").value = "";
            }
        });

        promosiSelect.dispatchEvent(new Event("change"));
    }

    // === Button Submit (tampil di tab pembayaran) ===
    const formActions = document.getElementById("formActions");
    const transaksiTab = document.getElementById("transaksiTab");

    if (transaksiTab) {
        transaksiTab.addEventListener("shown.bs.tab", function (event) {
            if (event.target.id === "pembayaran-tab") {
                formActions.style.display = "block";
            } else {
                formActions.style.display = "none";
            }
        });
    }

});
