app.controller('LoginController', function ($rootScope, $location, $http) {
    $rootScope.usuario = {};

    $rootScope.login = function () {

        var request = $http({
            method: "post",
            url: window.location.href + "login.php",
            data: {
                email: $scope.email,
                pass: $scope.password
            },
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            }
        });
        if ($rootScope.usuario.email === "mclexr@gmail.com") {
            alert("Email certo!");
        }
    };

});
