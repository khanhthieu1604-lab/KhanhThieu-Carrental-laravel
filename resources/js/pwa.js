// Dark Mode Persistence
document.addEventListener('DOMContentLoaded', function () {
    // Get saved preference from localStorage
    const savedDarkMode = localStorage.getItem('darkMode');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    // Apply dark mode based on saved preference or system preference
    if (savedDarkMode === 'true' || (savedDarkMode === null && prefersDark)) {
        document.documentElement.classList.add('dark');
        if (window.darkMode !== undefined) {
            window.darkMode = true;
        }
    }
});

// Override toggleDark function to save to localStorage
if (typeof window.toggleDark === 'function') {
    const originalToggleDark = window.toggleDark;
    window.toggleDark = function () {
        originalToggleDark();
        // Save preference
        const isDark = document.documentElement.classList.contains('dark');
        localStorage.setItem('darkMode', isDark);
    };
}

// PWA Installation Detection
let deferredPrompt;

window.addEventListener('beforeinstallprompt', (e) => {
    // Prevent the mini-infobar from appearing on mobile
    e.preventDefault();
    // Stash the event so it can be triggered later
    deferredPrompt = e;
    // Show install button (if you have one)
    const installBtn = document.querySelector('#installBtn');
    if (installBtn) {
        installBtn.style.display = 'block';
    }
});

// Service Worker Registration
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js')
            .then(registration => {
                console.log('[PWA] Service Worker registered:', registration);
            })
            .catch(err => {
                console.log('[PWA] Service Worker registration failed:', err);
            });
    });
}
