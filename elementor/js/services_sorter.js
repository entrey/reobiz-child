'use strict';

document.addEventListener('DOMContentLoaded', entreyServicesSorter);

function entreyServicesSorter() {
  if (undefined === window.entreyIsotopeInstances) {
    window.entreyIsotopeInstances = {};
  }

  var widgetSelector = '.sorter__contents-container';
  var elem = document.body.querySelectorAll(widgetSelector);

  if (!elem) {
    // Bailout
    return;
  }

  elem.forEach((currentElem) => {
    var containerID = currentElem.closest('[data-element_type="widget"]').dataset.id;

    if (undefined !== window.entreyIsotopeInstances[containerID]) {
      window.entreyIsotopeInstances[containerID].arrange();
    } else {
      var iso = new Isotope(currentElem, {
        itemSelector: '.sorter__content',
        layoutMode: 'fitRows',
        percentPosition: true,
      });

      entreyTagsHandler(currentElem.previousElementSibling, iso);

      window.entreyIsotopeInstances[containerID] = iso;
    }
  });
}

function entreyTagsHandler(tagsContainer, iso) {
  var tags = tagsContainer.querySelectorAll('.tag__title');

  tags.forEach((tag) => {
    tag.addEventListener('click', function (e) {
      for (let sibling of e.target.parentNode.children) {
        sibling.classList.remove('active');
      }
      e.target.classList.add('active');

      var dataTag = e.target.textContent.replace(' ', '-');
      iso.arrange({ filter: `[data-tags*="${dataTag}"` });
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
      'frontend/element_ready/entrey-services-sorter.default',
      function ($scope) {
        setTimeout(entreyServicesSorter, 1700);
      }
    );
  });
})(jQuery);
