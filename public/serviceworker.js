var staticCacheName = "pwa-v" + new Date().getTime();
var filesToCache = [
    "/offline",
    "/css/app.css",
    "/js/app.js",
    "/frontend/assets/css/bootstrap.min.css",
    "/frontend/assets/css/style.css",
    "/frontend/assets/js/script.js",
    "/images/icons/72x72.png",
    "/images/icons/96x96.png",
    "/images/icons/128x128.png",
    "/images/icons/144x144.png",
    "/images/icons/152x152.png",
    "/images/icons/192x192.png",
    "/images/icons/384x384.png",
    "/images/icons/512x512.png"
];

// Cache on install
self.addEventListener("install", event => {
    this.skipWaiting();
    event.waitUntil(
        caches.open(staticCacheName)
        .then(cache => {
            return cache.addAll(filesToCache);
        })
    )
});

// Clear cache on activate
self.addEventListener('activate', event => {
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames
                .filter(cacheName => (cacheName.startsWith("pwa-")))
                .filter(cacheName => (cacheName !== staticCacheName))
                .map(cacheName => caches.delete(cacheName))
            );
        })
    );
});

// Serve from Cache
self.addEventListener("fetch", event => {
    event.respondWith(
        caches.match(event.request)
        .then(response => {
            return response || fetch(event.request);
        })
        .catch(() => {
            return caches.match('offline');
        })
    )
});

self.addEventListener("push", function(event) {
    console.log("[Service Worker] Push Received.");
    console.log(`[Service Worker] Push had this data: "${event.data.text()}"`);

    const title = "Pemberitahuan";
    const options = {
        body: "Yay it works.",
        icon: "images/icons/128x128.png",
        badge: "images/icons/128x128.png"
    };
    event.waitUntil(self.registration.showNotification(title, options));
});

self.addEventListener("notificationclick", function(event) {
    console.log("[Service Worker] Notification click Received.");

    event.notification.close();

    event.waitUntil(clients.openWindow("https://developers.google.com/web/"));
});

self.addEventListener('load', function() {
    self.history.pushState({ noBackExitsApp: true }, '')
})

self.addEventListener('popstate', function(event) {
    if (event.state && event.state.noBackExitsApp) {
        self.history.pushState({ noBackExitsApp: true }, '')
    }
})