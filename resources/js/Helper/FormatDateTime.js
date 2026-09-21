export function formatDateTime(date) {
    if (!date) return '';

    const value = new Date(date);

    return value.toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric',
    }) + ', ' + value.toLocaleTimeString('id-ID', {
        hour: '2-digit',
        minute: '2-digit',
        hour12: false,
    });
}