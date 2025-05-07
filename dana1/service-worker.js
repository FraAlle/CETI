const CACHE_NAME = "pueblos-unidos-cache-v1";
const urlsToCache = [
  "/CETI/dana1/index.php",
  "/CETI/dana1/css/style.css",
  "/CETI/dana1/css/Foto1.jpg",
  "/CETI/dana1/login.php",
  "/CETI/dana1/registro.php"
];

self.addEventListener("install", (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(urlsToCache);
    })
  );
});

self.addEventListener("fetch", (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request);
    })
  );
});