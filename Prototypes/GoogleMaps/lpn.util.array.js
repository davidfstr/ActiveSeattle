// =======================================================================================
// Basic Array Methods

function each(a, fn, opt_scope) {
  for (var i=0, j=a.length; i < j; ++i) {
    fn.call(opt_scope || window, a[i], i, a);
  }
}

function filter(a, fn, opt_scope) {
  var scope = opt_scope || window;
  var b = [];
  for (var i=0, j=a.length; i < j; ++i) {
    if (fn.call(scope, a[i], i, a)) {
      b.push(a[i]);
    }
  }
  return b;
};

function map(a, fn, opt_scope) {
  var scope = opt_scope || window;
  var b = [];
  for (var i=0, j=a.length; i < j; ++i) {
    b.push(fn.call(scope, a[i], i, a));
  }
  return b;
};
