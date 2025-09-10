import $ from "jquery";
import "datatables.net-bs5";
import "datatables.net-responsive-bs5";

document.addEventListener("DOMContentLoaded", function () {
    let transaksiTable;

    if ($("#transaksi-table").length) {
        let url = $("#transaksi-table").data("url");

        if ($.fn.DataTable.isDataTable("#transaksi-table")) {
            $("#transaksi-table").DataTable().clear().destroy();
        }

        transaksiTable = $("#transaksi-table").DataTable({
            destroy: true,
            processing: true,
            serverSide: true,
            ajax: url,
            columns: [
                { data: "DT_RowIndex", name: "DT_RowIndex", orderable: false, searchable: false },
                { data: "no_ktp", name: "pelanggan.no_ktp" },
                { data: "nama_lengkap", name: "pelanggan.nama_lengkap" },
                { data: "alamat_instalasi", name: "pelanggan.alamat_instalasi" },
                { data: "paket_internet", name: "paket.paket_internet" },
                { data: "actions", name: "actions", orderable: false, searchable: false },
            ],
            responsive: false,
        });
    }

    // Handler action
    $(document).on("change", ".action-select", function () {
        let action = $(this).val();
        let editUrl = $(this).data("edit");
        let pdfUrl = $(this).data("pdf");
        let deleteUrl = $(this).data("delete");

        if (action === "edit") {
            window.location.href = editUrl;
        } else if (action === "pdf") {
            window.open(pdfUrl, "_blank");
        } else if (action === "delete") {
            Swal.fire({
                title: "Hapus Transaksi?",
                text: "Data transaksi akan dihapus permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: deleteUrl,
                        type: "POST",
                        data: {
                            _method: "DELETE",
                            _token: $('meta[name="csrf-token"]').attr("content"),
                        },
                        success: function () {
                            Swal.fire("Terhapus!", "Transaksi berhasil dihapus.", "success");
                            if (transaksiTable) transaksiTable.ajax.reload(null, false);
                        },
                        error: function (xhr) {
                            Swal.fire("Gagal!", "Terjadi kesalahan saat menghapus.", "error");
                            console.error(xhr.responseText);
                        },
                    });
                }
            });
        }

        $(this).val("");
    });
});
