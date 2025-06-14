<div id="error-container" style="position: fixed; top: 10px; right: 10px; z-index: 10000;"></div>

<?php if (!empty($errorMessage)): ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        showError(<?php echo json_encode($errorMessage); ?>);
    });
</script>
<?php endif; ?>
