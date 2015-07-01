var app = angular.module('app', ['ngRoute']);

app.config(function ($routeProvider, $locationProvider) {

    // remove o # da url
    $locationProvider.html5Mode({
        enabled: true,
        requireBase: false
    });

    $routeProvider
        .when('http://localhost/csfidelis/app/', {
            templateUrl: 'views/login.html',
            controller: 'LoginController',
        })
        .when('/about', {
            templateUrl: 'views/about.html',
            controller: 'AboutController',
        })

        // caso não seja nenhum desses, redirecione para a rota '/'
        .otherwise({
            redirectTo: '/'
        });
});
