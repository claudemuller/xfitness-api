(function () {
  'use strict';

  var errorFunction = console.error;

  window.console = {
    log: function () {},
    info: function () {},
    warn: function () {},
    error: errorFunction
  };
})();
