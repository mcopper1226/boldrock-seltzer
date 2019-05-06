
export default function nav() {
  (function($) {
    function moveNavigation(){
  var about = $('.parent-about .sub-menu'),
      visit = $('.parent-visit .sub-menu');
    about.detach();
    about.appendTo('.about_wrapper');
    visit.detach();
    visit.appendTo('.visit_wrapper');

}
moveNavigation();

  function revealDropdown( element ) {
    this.element = element;
    this.mainNavigation = this.element.find('#menu-main-menu');
    this.mainNavigationItems = this.element.find('#menu-main-menu > li > a');
    this.dropdownWrapper = this.element.find('.sub-nav-wrapper');
      this.dropdownBg = this.element.find('.dropdown-bg');
    this.mq = this.checkMq();
    console.log("MQ=" + this.mq);
    this.bindEvents();
  }


  revealDropdown.prototype.checkMq = function() {
    var self = this;
    return window.getComputedStyle(self.element.get(0), '::before').getPropertyValue('content').replace(/'/g, "").replace(/"/g, "").split(', ');
  }

  revealDropdown.prototype.bindEvents = function() {
    var self = this;
    this.mainNavigationItems.mouseenter(function(event) {
      event.preventDefault();
      self.showDropdown($(this));
    }).mouseleave(function() {
      setTimeout(function() {
        //If not hovering over a menu item or dropdown item, hide the dropdown
        if( self.mainNavigation.find('li:hover').length == 0 && self.element.find('.sub-nav-wrapper:hover').length == 0) self.hideDropdown();
      }, 50);
    });

    this.dropdownWrapper.mouseleave(function() {
      setTimeout(function() {
        (self.mainNavigation.find('li:hover').length == 0 && self.element.find('.sub-nav-wrapper:hover').length == 0) && self.hideDropdown();
      }, 50);
    });


  }

  revealDropdown.prototype.showDropdown = function(item) {
    this.mq = this.checkMq();
    if(this.mq == 'desktop') {
      var self = this;
      var selectedDropdownWrapper = this.dropdownWrapper.find('#'+item.data('content'));
      var selectedDropdown = selectedDropdownWrapper.find('.dropdown-content');
      var selectedInnerWidth = selectedDropdown.innerWidth();
      var selectedInnerHeight = selectedDropdown.innerHeight(); 
      var selectedMenuPos = item.offset().left;
      var selectedMenuWidth = item.innerWidth()/2;
      var selectedDropdownWidth = selectedInnerWidth/2;
      var selectedItemPos = selectedMenuPos + selectedMenuWidth - selectedDropdownWidth;

      //update dropdown position and size
      this.updateDropdown(selectedDropdown, parseInt(selectedInnerHeight), selectedInnerWidth, parseInt(selectedItemPos));
      this.element.find('.is-active').removeClass('is-active');

      selectedDropdown.addClass('is-active').removeClass('go-left').removeClass('go-right').prevAll().addClass('go-left').end().nextAll().addClass('go-right');
      //add is-selected clas to hovered menu item
      item.addClass('is-active');
      //show dropdown wrapper if not visible yet
      if( !this.element.hasClass('is-dropdown-visible') ) {
        setTimeout(function() {
          self.element.addClass('is-dropdown-visible');
        }, 10);
      }
    }
  };
  revealDropdown.prototype.updateDropdown = function(dropdownItem, height, width, left) {
    var pixelwidth = document.documentElement.clientWidth;
    var ciderWidth = pixelwidth/380;
    this.newBGwidth = width/380;
    this.newBGheight = height/500;
    if (dropdownItem.hasClass('cider_wrapper')) {
      this.dropdownWrapper.css({
        'transform': 'translateX(0px)',
        'width': '100vw',
        'height': height+'px'
      });
        this.dropdownBg.css({
          'transform': 'translateX(0px) scaleX(' + ciderWidth + ') scaleY(' + this.newBGheight + ')'
        });
    } else {
      this.dropdownWrapper.css({
        'transform': 'translateX(' + left + 'px)',
        'width': width+'px',
        'height': height+'px'
      });
      this.dropdownBg.css({
        'transform': 'translateX(' + left + 'px) scaleX(' + this.newBGwidth + ') scaleY(' + this.newBGheight + ')'
      });
    }


  };

  revealDropdown.prototype.hideDropdown = function() {
    this.mq = this.checkMq();
    if( this.mq == 'desktop') {
      this.element.removeClass('is-dropdown-visible').find('.is-active').removeClass('is-active').end().find('.go-left').removeClass('go-left').end().find('.go-right').removeClass('go-right');
    }
  };

  var navDropdowns = [];
  navDropdowns.push(new revealDropdown($('#masthead')));

  $('.mobile_trigger').on('click', function(){
		$(this).toggleClass('mmenu-is-open');
		//we need to remove the transitionEnd event handler (we add it when scolling up with the menu open)
		$('.mobile_outer_wrap').off('webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend').toggleClass('mmenu-is-visible');

  });

  $(window).on('load resize', function mobileViewUpdate() {
    var viewportWidth = $(window).width();
    if(viewportWidth < 900) {
      console.log("I am Mobile");
      $('#masthead').removeClass('is-dropdown-visible').find('.is-active').removeClass('is-active').end().find('.go-left').removeClass('go-left').end().find('.go-right').removeClass('go-right');
    } else {
      console.log("I am Desktop");
      $('.mobile_trigger').removeClass('mmenu-is-open');
      $('.mobile_outer_wrap').removeClass('mmenu-is-visible');
    }
});


})(jQuery);

}
