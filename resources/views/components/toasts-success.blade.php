<div class="toast-container position-fixed bottom-0 end-0 p-3 ">
    <div id="liveToastSuccess" class="toast hide show text-bg-success" role="alert" aria-live="assertive"
        aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">

        <div class="toast-body">
            <div class="d-flex align-items-center justify-content-between">
                {{ $slot }}
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastEl = document.getElementById('liveToastSuccess');
        var toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
</script>
