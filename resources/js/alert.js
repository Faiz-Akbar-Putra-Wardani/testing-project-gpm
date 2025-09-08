
import Swal from 'sweetalert2';

window.showSuccess = function(message) {
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: message,
        confirmButtonText: 'OK'
    });
}

window.showError = function(message) {
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: message,
        confirmButtonText: 'OK'
    });
}

window.showValidationErrors = function(errors) {
    Swal.fire({
        icon: 'error',
        title: 'Oops...',
        html: errors.join('<br>'),
        confirmButtonText: 'OK'
    });
}
