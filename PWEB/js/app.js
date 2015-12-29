angular.module('VgsApp', ['ngRoute']).
config(['$routeProvider', function($routeProvider) {
  $routeProvider.
      when('/', {templateUrl: 'paginas/menugeral.html'}).
	  when('/listjogo', {templateUrl: 'paginas/listjogo.html', controller: ListJogoCtrl}).
      when('/addjogo', {templateUrl: 'paginas/novojogo.html', controller: AddJogoCtrl}).
      when('/editjogo/:id', {templateUrl: 'paginas/editjogo.html', controller: EditJogoCtrl}).
	  when('/listconsole', {templateUrl: 'paginas/listconsole.html', controller: ListConsoleCtrl}).
      when('/addconsole', {templateUrl: 'paginas/novoconsole.html',controller: AddConsoleCtrl}).
      when('/editconsole/:id', {templateUrl: 'paginas/editconsole.html', controller: EditConsoleCtrl}).
	  when('/listjogando',{templateUrl: 'paginas/listjogando.html',controller: ListJogandoCtrl}).
	  when('/listjogado',{templateUrl: 'paginas/listjogado.html',controller: ListJogadoCtrl}).
	  when('/listajogar',{templateUrl: 'paginas/listajogar.html',controller: ListAjogarCtrl}).
      otherwise({redirectTo: '/'});
}]);
//=======================================================================
//==============================Jogos====================================
//=======================================================================
function ListJogoCtrl($scope, $http) {
  $http.get('api/index.php/Jogos').success(function(data) {
    $scope.jogos = data;});
}

function AddJogoCtrl($scope, $http, $location) {
  $scope.master = {};
  $scope.activePath = null;

  $scope.add_jogo = function(jogo, AddNewForm) {

    $http.post('api/index.php/Add_Jogos', jogo).success(function(){
      $scope.reset();
      $scope.activePath = $location.path('/listjogo');
	  alert("Jogo Adicionado com Sucesso!");
    });

    $scope.reset = function() {
      $scope.jogo = angular.copy($scope.master);
    };

    $scope.reset();

  };
}

function EditJogoCtrl($scope, $http, $location, $routeParams) {
  var id = $routeParams.id;
  $scope.activePath = null;

  $http.get('api/index.php/Jogos/'+id).success(function(data) {
    $scope.jogos = data;
  });

  $scope.update_jogo = function(jogo){
    $http.put('api/index.php/Jogos/'+id, jogo).success(function(data) {
      $scope.jogos = data;
      $scope.activePath = $location.path('/listjogo');
	  alert("Jogo Editado com Sucesso!");
    });
  };

  $scope.delete_jogo = function(jogo) {
    console.log(jogo);

    var deleteJogo = confirm('Você quer mesmo deletar?');
    if (deleteJogo) {
      $http.delete('api/index.php/Jogos/'+jogo.id);
      $scope.activePath = $location.path('/listjogo');
	  alert("Jogo Excluido com Sucesso!");
    }
  };
}
function ListJogandoCtrl($scope, $http) {
  $http.get('api/index.php/Jogando').success(function(data) {
    $scope.jogando = data;});
}
function ListJogadoCtrl($scope, $http) {
  $http.get('api/index.php/Jogados').success(function(data) {
    $scope.jogado = data;});
}
function ListAjogarCtrl($scope, $http) {
  $http.get('api/index.php/aJogar').success(function(data) {
    $scope.ajogar = data;});
}
//=======================================================================
//========================Console========================================
//=======================================================================
function ListConsoleCtrl($scope, $http) {
  $http.get('api/index.php/Consoles').success(function(data) {
    $scope.consoles = data;
  });
}

function AddConsoleCtrl($scope, $http, $location) {
  $scope.master = {};
  $scope.activePath = null;

  $scope.add_console = function(cons, AddNewForm) {

    $http.post('api/index.php/Add_Consoles', cons).success(function(){
      $scope.reset();
      $scope.activePath = $location.path('/listconsole');
	  alert("Console Adicionado com Sucesso!");
    });

    $scope.reset = function() {
      $scope.cons = angular.copy($scope.master);
    };

    $scope.reset();

  };
}

function EditConsoleCtrl($scope, $http, $location, $routeParams) {
  var id = $routeParams.id;
  $scope.activePath = null;

  $http.get('api/index.php/Consoles/'+id).success(function(data) {
    $scope.consoles = data;
  });

  $scope.update_console = function(cons){
    $http.put('api/index.php/Consoles/'+id, cons).success(function(data) {
      $scope.consoles = data;
      $scope.activePath = $location.path('/listconsole');
	  alert("Console Editado com Sucesso!");
    });
  };

  $scope.delete_console = function(cons) {
    console.log(cons);

    var deleteConsole = confirm('Você quer mesmo deletar?');
    if (deleteConsole) {
      $http.delete('api/index.php/Consoles/'+cons.id);
      $scope.activePath = $location.path('/listconsole');
	  alert("Console Excluido com Sucesso!");
    }
  };
}
//===================THE END=============================================
