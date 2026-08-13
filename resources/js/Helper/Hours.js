export function diffHours(start, end) {
    if (!start || !end) return 0

    const [startHour, startMinute] = start.split(':').map(Number)
    const [endHour, endMinute] = end.split(':').map(Number)

    const startTotal = startHour * 60 + startMinute
    const endTotal = endHour * 60 + endMinute

    return (endTotal - startTotal) / 60
}