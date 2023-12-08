require(["../common"], function(common) {
  require(["main-function", "../app/app-harga"], function(func, application) {
    App = $.extend(application, func);
    App.init();
  });
});
