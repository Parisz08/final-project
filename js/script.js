// Tunggu sampai dokumen selesai dimuat
document.addEventListener('DOMContentLoaded', () => {
    // Ambil semua tombol delete
    const deleteButtons = document.querySelectorAll('.btn-delete');

    // Tambahkan event listener untuk setiap tombol delete
    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            // Mencegah form submit langsung
            event.preventDefault();

            // Konfirmasi penghapusan
            const confirmation = confirm("Are you sure you want to remove this item from your cart?");
            if (confirmation) {
                // Jika user konfirmasi, submit form
                this.closest('form').submit();
            }
        });
    });
});
