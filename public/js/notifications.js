export function showError(message) {
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
