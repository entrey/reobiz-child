'use strict';

document.addEventListener('DOMContentLoaded', entreyTabs);

function entreyTabs() {
  jQuery('.entrey-tabs').each(function () {
    var $this = jQuery(this);
    var tab = $this.find('.tabs__headings-container .tab__heading');
    var data = $this.find('.tabs__contents-container .tab__content');

    tab.filter(':first').addClass('active');

    data.filter(':not(:first)').hide();

    tab.each(function () {
      var currentTab = jQuery(this);

      currentTab.on('click tap', function () {
        var id = currentTab.data('tab-id');
        var currentTabContent = jQuery(
          '.entrey-tabs .tab__content[data-tab-id=' + id + ']'
        );

        currentTab.addClass('active').siblings().removeClass('active');
        currentTabContent.slideDown().siblings().slideUp();
      });
    });
  });
}

(function ($) {
  jQuery(window).on('elementor/frontend/init', function () {
    if (!window.elementorFrontend.isEditMode()) {
      // Bailout.
      return;
    }

    window.elementorFrontend.hooks.addAction(
      'frontend/element_ready/entrey-tabs.default',
      function ($scope) {
        entreyTabs();
      }
    );
  });
})(jQuery);
