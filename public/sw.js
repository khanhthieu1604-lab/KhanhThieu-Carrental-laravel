const CACHE_NAME = 'thiuu-rental-v1';
const RUNTIME = 'runtime';

// Assets to cache on install
const PRECACHE_URLS = [
    '/',
    '/home',
    '/about',
    '/services',
    '/css/app.css',
    '/js/app.js',
    '/manifest.json',
];

// Install event - cache essential assets
self.addEventListener('install', event => {
    console.log('[SW] Installing service worker...');
    event.waitUntil(
        caches.open(CACHE_NAME)
            .then(cache => {
                console.log('[SW] Caching app shell');
                return cache.addAll(PRECACHE_URLS);
            })
    then(() => self.skipWaiting())
    );
});

// Activate event - clean up old caches
self.addEventListener('activate', event => {
    console.log('[SW] Activating service worker...');
    event.waitUntil(
        caches.keys()
            .then(cacheNames => {
                return Promise.all(
                    cacheNames
                        .filter(cacheName => cacheName !== CACHE_NAME && cacheName !== RUNTIME)
                        .map(cacheName => caches.delete(cacheName))
                );
            })
            .then(() => self.clients.claim())
    );
});

// Fetch event - serve from cache, fallback to network
self.addEventListener('fetch', event => {
    // Skip cross-origin requests and non-GET requests
    if (!event.request.url.startsWith(self.location.origin) || event.request.method !== 'GET') {
        return;
    }

    event.respondWith(
        caches.match(event.request)
            .then(cachedResponse => {
                if (cachedResponse) {
                    return cachedResponse;
                }

                return caches.open(RUNTIME)
                    .then(cache => {
                        return fetch(event.request)
                            .then(response => {
                                // Cache successful responses
                                if (response.status === 200) {
                                    cache.put(event.request, response.clone());
                                }
                                return response;
                            });
                    });
            })
            .catch(() => {
                // Return offline page for navigation requests
                if (event.request.mode === 'navigate') {
                    return caches.match('/offline.html');
                }
            })
    );
});

// Background sync for bookings (future enhancement)
self.addEventListener('sync', event => {
    if (event.tag === 'sync-bookings') {
        event.waitUntil(syncBookings());
    }
});

async function syncBookings() {
    // Get offline bookings from IndexedDB
    // Send to server when online
    console.log('[SW] Syncing offline bookings...');
}
