!!function ($) {

  /**
   * Foundation Grid Balancer module.
   * @module foundation.balancer
   * @requires foundation.util.mediaQuery
   *
   */

  var Balancer = function () {
    /**
     * Creates a new instance of balancer.
     * @class
     * @fires Balancer#init
     * @param {jQuery} element - jQuery object add trigger to
     * @param {Object} options - Overrides to the default plugin settings.
     */

    function Balancer(element, options) {
      _classCallCheck(this, Balancer);

      this.$element = $(element);
      this.options = $.extend({}, Balancer.defaults, this.$element.data(), options);

      this._init();
      this._events();

      Foundation.registerPlugin(this, 'Balancer');
    }

    /**
     * Initializes Balancer by finding the target element to balance
     * @function
     * @private
     */


    _createClass(Balancer, [{
      key: '_init',
      value: function _init() {

		var _this = this.$element;
		this.options.rtl = Foundation.rtl() ? 'margin-right' : 'margin-left';
		this.options.blocks = _this.children('.column').length;
		this.options.grid = { small:1, medium:1, large:1, xlarge:1, xxlarge:1 };

		for (var i in Foundation.MediaQuery.queries) {
			if (_this.attr("class").match(Foundation.MediaQuery.queries[i].name)) {
				var mq = _this.attr("class").match(Foundation.MediaQuery.queries[i].name);
				this.options.grid[mq[0]] = parseInt(mq.input.charAt(mq.index+mq[0].length+4));

				if (mq[0] === 'medium') {
					this.options.grid.large = parseInt(mq.input.charAt(mq.index+mq[0].length+4));
					this.options.grid.xlarge = parseInt(mq.input.charAt(mq.index+mq[0].length+4));
					this.options.grid.xxlarge = parseInt(mq.input.charAt(mq.index+mq[0].length+4));
				}

				if (mq[0] === 'large') {
					this.options.grid.xlarge = parseInt(mq.input.charAt(mq.index+mq[0].length+4));
					this.options.grid.xxlarge = parseInt(mq.input.charAt(mq.index+mq[0].length+4));
				}
			}
		}

        this._balance();
      }

      /**
       * Adds necessary event handlers for balancer to work.
       * @function
       * @private
       */

    }, {
      key: '_events',
      value: function _events() {
        var _this = this;

        this._balanceMqHandler = this._balance.bind(this);
        $(window).on('changed.zf.mediaquery', this._balanceMqHandler);

      }

      /**
       * Takes the current media query and user grid and balances odd ball blocks.
       * @function
       * @private
       */

    }, {
      key: '_balance',
      value: function _balance() {
		 //balance the blocks
		 var grid = this.options.grid[Foundation.MediaQuery._getCurrentSize()];
		 this.$element.children('.column').css("width", (100 / grid)+"%");
		 this.$element.children('.column').css(this.options.rtl,0);

		 var offset = this.options.blocks % grid;

		 for (var b = 0; b <= this.options.blocks % grid; b++) {
			if (this.options.respectSiblingWidth === false) {
				this.$element.children('.column').eq(this.options.blocks-b).css("width",(100 / offset)+"%");
			} else {
				if (b === offset) {
					this.$element.children('.column').eq(this.options.blocks-b).css(this.options.rtl, (((grid - offset) * 0.5) * (100 / grid))+"%");
				}
			}
		 }
      }


    }, {
      key: 'destroy',
      value: function destroy() {
        this.$element.off('.zf.balancer');
        this.$toggler.off('.zf.balancer');

        $(window).off('changed.zf.mediaquery', this._balanceMqHandler);

        Foundation.unregisterPlugin(this);
      }
    }]);

    return Balancer;
  }();

  Balancer.defaults = {
    /**
     * Should we respect the the width of siblings, or span whole width
     * @option
     * @example true
     */
    respectSiblingWidth : true
  };

  // Window exports
  Foundation.plugin(Balancer, 'Balancer');
}(jQuery);
'use strict';

var _createClass = function () { function defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } } return function (Constructor, protoProps, staticProps) { if (protoProps) defineProperties(Constructor.prototype, protoProps); if (staticProps) defineProperties(Constructor, staticProps); return Constructor; }; }();

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }