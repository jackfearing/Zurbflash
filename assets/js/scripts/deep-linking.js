// https://24ways.org/2015/how-tabs-should-work/

/*global $*/

// a temp value to cache *what* we're about to show
var target = null;

// collect all the tabs
var tabs = $('.tab').on('click', function () {
  console.log('click');
  target = $(this.hash).removeAttr('id');
  if (location.hash === this.hash) {
    setTimeout(update);
  }
}).attr('tabindex', '0');

// get an array of the panel ids (from the anchor hash)
var targets = tabs.map(function () {
  return this.hash;
}).get();

// use those ids to get a jQuery collection of panels
var panels = $(targets.join(',')).each(function () {
  // keep a copy of what the original el.id was
  $(this).data('old-id', this.id);
});

function update() {
  console.log('update');
  if (target) {
    target.attr('id', target.data('old-id'));
    target = null;
  }

  var hash = window.location.hash;
  if (targets.indexOf(hash) !== -1) {
    return show(hash);
  }

  // NOTE: this was added after the article was written
  // to fix going "back" on the browser nav to an empty state
  if (!hash) {
    show();
  }
}

function show(id) {
  // if no value was given, let's take the first panel
  // default id target 0 = 1st tab
  // change id target 1 = 2nd tab
  // change id target 2 = 3rd tab
  if (!id) {
    id = targets[0];
  }
  // remove the selected class from the tabs,
  // and add it back to the one the user selected
  tabs.removeClass('is-active').attr('aria-selected', 'false').filter(function () {
    return (this.hash === id);
  }).addClass('is-active').attr('aria-selected', 'true');

  // now hide all the panels, then filter to
  // the one we're interested in, and show it
  panels.hide().attr('aria-hidden', 'true').filter(id).show().attr('aria-hidden', 'false');
}

window.addEventListener('hashchange', update);

// initialise
if (targets.indexOf(window.location.hash) !== -1) {
  update();
} else {
  show();
}