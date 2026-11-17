document.addEventListener("DOMContentLoaded", function () {

    console.log("Direktori Karyawan berhasil dijalankan.");

    // Konfirmasi penghapusan data
    const deleteButtons = document.querySelectorAll(".btn-delete");

    deleteButtons.forEach(function (button) {

        button.addEventListener("click", function (event) {

            const confirmation = confirm(
                "Apakah kamu yakin ingin menghapus data ini?"
            );

            if (!confirmation) {
                event.preventDefault();
            }

        });

    });

});