/*
    Variável de conmfiguração
*/
var cacheName = 'cache-name-123456';
var host = 'http://127.0.0.1/BlackCoffeePHP/';



var filesToCache = [
    host + 'dist/libs/js/code.js',
    host + 'dist/img/bcphplogo.png',
    host + 'index.html'
];

self.addEventListener('install', function (e) {
    e.waitUntil(
        caches
            .open(cacheName)
            .then(function (cache) {
                return cache.addAll(filesToCache)
            })
            .then(function () {
                return self.skipWaiting()
            })
    );
}),

self.addEventListener('activate', function (e) {
    e.waitUntil(
        caches.keys().then(function (keyList) {
            return Promise.all(keyList.map(function(key){
                if ( key !== cacheName ) return caches.delete(key)
            }))
        })
    )
    // forçar escuta de eventos de fetch
    // assim que a service worker foi instalada
    return self.clients.claim()
}),

self.addEventListener('fetch', function (e) {
    e.respondWith(
        caches.match(e.request)
            .then(function(response) {
                return response || fetch(e.request)
            }
        )
    );
})