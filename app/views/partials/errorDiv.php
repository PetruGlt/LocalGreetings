<div id="error-container" style="position: fixed; top: 10px; right: 10px; z-index: 10000;"></div>

<?php if (!empty($errorMessage)): ?>
<script>
    function showError(message) {
        const container = document.getElementById('error-container');
        if (!container) return;

        const notif = document.createElement('div');
        notif.className = 'error-notification';
        notif.textContent = message;

        container.appendChild(notif);

        setTimeout(() => {
            notif.style.opacity = '0';
            setTimeout(() => container.removeChild(notif), 300);
        }, 5000);
    }
    
    document.addEventListener('DOMContentLoaded', function() {
        showError(<?= json_encode($errorMessage); ?>);
    });
</script>
<?php endif; ?>
