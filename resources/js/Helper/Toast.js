import Swal from 'sweetalert2';

export function succes(respon, message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        customClass: {
            container: 'swal-container'
        },
        timer: 3000,
        timerProgressBar: true,
        html: `
            <div style="display:flex;align-items:center;gap:12px">
                <img
                    src="/assets/succes.jpg"
                    style="width:40px;height:40px;border-radius:8px"
                />
                <div style="text-align:left">
                    <div style="font-weight:600">
                        ${respon}
                    </div>
                    <div style="font-size:12px;color:#6b7280">
                        ${message}
                    </div>
                </div>
            </div>
        `
    })
}

export function eror(status, message) {
    Swal.fire({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        customClass: {
            container: 'swal-container'
        },
        timer: 3000,
        timerProgressBar: true,
        html: `
            <div style="display:flex;align-items:center;gap:12px">
                <img
                    src="/assets/error.jpg"
                    style="width:40px;height:40px;border-radius:8px"
                />
                <div style="text-align:left">
                    <div style="font-weight:600;color:red;"">
                        ${status}
                    </div>
                    <div style="font-size:12px;color:#6b7280">
                        ${message}
                    </div>
                </div>
            </div>
        `
    })
}