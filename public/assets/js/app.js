const app = {
    init: function() {
      /**
       * *****************************
       * Materialize components init
       * *****************************
       */
      const sidenav = document.querySelectorAll('.sidenav');
      M.Sidenav.init(sidenav);
      
      const dropdownTrigger = document.querySelectorAll('.dropdown-trigger');
      M.Dropdown.init(dropdownTrigger);
  
      /**
       * *****************************
       * LISTENERS
       * *****************************
       */
      const categoryTabs = document.querySelectorAll('.category-tab');
      categoryTabs.forEach(function(tab) {
        tab.addEventListener('click', app.recipeTabFilter);
      });
    },
  
    recipeTabFilter: function(e) {
      /* for css only */
      const tabContainers = document.querySelectorAll('.tab-container');
      tabContainers.forEach(function(container) {
        container.classList.remove('tabActive');
      });
      e.currentTarget.parentNode.classList.add('tabActive');
  
      const category = e.currentTarget.dataset.category;
      const cardContainers = document.querySelectorAll('.card-container');
  
      cardContainers.forEach(function(container) {
        container.style.display = 'none';
      });
  
      // Filtering cards by category
      const filteredCards = Array.prototype.filter.call(cardContainers, function(container) {
        return container.dataset.category === category;
      });
  
      // Little animation, cards are showing one by one
      filteredCards.forEach(function(card, index) {
        setTimeout(function() {
          card.style.display = 'block';
        }, 80 * index);
      });
  
      // Rename title of recipes index page depending on the category selected
      app.renameTitleRecipeCategory(e);
    },
  
    renameTitleRecipeCategory: function(e) {
      const mainTitle = document.querySelector('.recipe-category-title');
      const target = e.currentTarget;
  
      if (target.parentNode.classList.contains('tabActive')) {
        mainTitle.textContent = target.dataset.category;
      } else {
        mainTitle.textContent = 'Recettes';
      }
    }
  };
  
  document.addEventListener('DOMContentLoaded', app.init);