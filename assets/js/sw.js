const CACHE_NAME = 'matcha-kakigori-cache-v1';
const urlsToCache = [
  '/',
  '/assets/main.css',
  '/assets/js/main.js',
  '/assets/images/',
  'https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300;400&family=Noto+Serif+JP:wght@200;300;400&display=swap'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => {
        if (response) {
          return response;
        }
        return fetch(event.request)
          .then(response => {
            if (!response || response.status !== 200 || response.type !== 'basic') {
              return response;
            }
            const responseToCache = response.clone();
            caches.open(CACHE_NAME)
              .then(cache => {
                cache.put(event.request, responseToCache);
              });
            return response;
          });
      })
  );
}); 