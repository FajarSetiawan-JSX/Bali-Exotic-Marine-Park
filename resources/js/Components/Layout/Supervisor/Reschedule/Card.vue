<script setup>

</script>

<template>
    <div class="grid grid-cols-[70px_1fr_105px] gap-5 rounded-xl border border-gray-200 bg-white p-5 shadow-sm">
        <div class="flex flex-col items-center gap-3">
            <img src="/images/sarah.jpg" alt="Sarah Jenkins" class="h-11 w-11 rounded-full object-cover"/>
            <span class="rounded-full bg-blue-100 px-2 py-1 text-[10px] text-gray-600">
            Pending
            </span>
        </div>
        <div>
            <div class="mb-2 flex justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-800">
                    Sarah Jenkins
                    </h3>

                    <p class="text-xs text-gray-500">
                    Aquarist III • South Wing
                    </p>
                </div>

                <span class="text-[10px] text-gray-500">
                    2 hours ago
                </span>
            </div>
            <div class="flex items-center gap-5 rounded-lg border border-gray-200 bg-gray-50 p-2.5">
                <div class="flex-1">
                    <p class="text-[10px] text-gray-400">Current Shift</p>
                    <p class="text-xs font-semibold text-gray-700">
                    Oct 12 • 08:00 - 16:00
                    </p>
                </div>
                <span class="text-xl text-sky-600">→</span>
                <div class="flex-1">
                    <p class="text-[10px] text-gray-400">Requested Shift</p>
                    <p class="text-xs font-semibold text-sky-600">
                    Oct 14 • 12:00 - 20:00
                    </p>
                </div>
            </div>
            <div class="mt-3 border-l-4 border-sky-300 pl-2.5 text-xs italic leading-relaxed text-gray-500">
            “Need to swap shifts due to a sudden family commitment on Tuesday morning.
            I have checked with the team and coverage is manageable.”
            </div>
        </div>
        <div class="flex flex-col justify-center gap-2 border-l border-gray-200 pl-5">
            <button class="rounded-md bg-sky-600 px-3 py-2 text-[11px] font-medium text-white transition hover:bg-sky-700">
            ✓ Approve
            </button>
            <button class="rounded-md bg-gray-200 px-3 py-2 text-[11px] font-medium text-gray-600 transition hover:bg-gray-300">
            ⊗ Decline
            </button>
        </div>
    </div>
</template>