export function formatTime(time) {
    if (!time) return ''

    return time.split(':').slice(0, 2).join(':')
}