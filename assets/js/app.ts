import 'bootstrap';
import 'summernote/dist/summernote-bs4';
import "angular";

$(document).ready(function() {
    $('.summernote').summernote();
    $("img").addClass("img-fluid");
});

angular.module('ngRepeat', []).controller('usersController', function($scope) {
    $scope.users = users;

    $scope.hello = function () {
        alert('hello');
    }
});