{{-- Loading Skeleton Component --}}
<div class="skeleton-card bg-white dark:bg-gray-900 rounded-3xl overflow-hidden border border-gray-100 dark:border-gray-800">
    <div class="aspect-[4/3] overflow-hidden relative">
        <div class="absolute inset-0 bg-gradient-to-r from-gray-200 via-gray-100 to-gray-200 dark:from-gray-800 dark:via-gray-700 dark:to-gray-800 animate-shimmer"></div>
    </div>
    <div class="p-6 space-y-4">
        <div class="h-3 bg-gray-200 dark:bg-gray-800 rounded-full w-1/4 animate-pulse"></div>
        <div class="h-6 bg-gray-200 dark:bg-gray-800 rounded-full w-3/4 animate-pulse"></div>
        <div class="h-4 bg-gray-200 dark:bg-gray-800 rounded-full w-1/2 animate-pulse"></div>
        <div class="flex justify-between items-end">
            <div class="space-y-2">
                <div class="h-3 bg-gray-200 dark:bg-gray-800 rounded-full w-16 animate-pulse"></div>
                <div class="h-8 bg-gray-200 dark:bg-gray-800 rounded-full w-24 animate-pulse"></div>
            </div>
            <div class="h-10 bg-gray-200 dark:bg-gray-800 rounded-xl w-24 animate-pulse"></div>
        </div>
    </div>
</div>

<style>
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }

        100% {
            background-position: 1000px 0;
        }
    }

    .animate-shimmer {
        animation: shimmer 2s infinite linear;
        background-size: 1000px 100%;
    }
</style>