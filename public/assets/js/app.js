const app = {
    init: function () {

        /**
         * STOP ANIMATION
         */
        //app.stopSpinnerAnim();


        /**
         * *****************************
         * Materialize components init
         * *****************************
         */
        const sidenav = document.querySelectorAll('.sidenav');
        M.Sidenav.init(sidenav);

        const dropdownTrigger = document.querySelectorAll('.dropdown-trigger');
        M.Dropdown.init(dropdownTrigger);

        const collapsible = document.querySelectorAll('.collapsible');
        M.Collapsible.init(collapsible);

        /**
         * *****************************
         * LISTENERS
         * *****************************
         */
        document.querySelector('.validate-btn').addEventListener('click', app.loadSpinnerAnim);

        const categoryTabs = document.querySelectorAll('.category-tab');
        categoryTabs.forEach(function (tab) {
            tab.addEventListener('click', app.recipeTabFilter);
        });
    },

    recipeTabFilter: function (e) {
        /* for css only */
        const tabContainers = document.querySelectorAll('.tab-container');
        tabContainers.forEach(function (container) {
            container.classList.remove('tabActive');
        });
        e.currentTarget.parentNode.classList.add('tabActive');

        const category = e.currentTarget.dataset.category;
        const cardContainers = document.querySelectorAll('.card-container');

        cardContainers.forEach(function (container) {
            container.style.display = 'none';
        });

        // Filtering cards by category
        const filteredCards = Array.prototype.filter.call(cardContainers, function (container) {
            return container.dataset.category === category;
        });

        // Little animation, cards are showing one by one
        filteredCards.forEach(function (card, index) {
            setTimeout(function () {
                card.style.display = 'block';
            }, 80 * index);
        });

        // Rename title of recipes index page depending on the category selected
        app.renameTitleRecipeCategory(e);
    },

    renameTitleRecipeCategory: function (e) {
        const mainTitle = document.querySelector('.recipe-category-title');
        const target = e.currentTarget;

        if (target.parentNode.classList.contains('tabActive')) {
            mainTitle.textContent = target.dataset.category;
        } else {
            mainTitle.textContent = 'Recettes';
        }
    },

    loadSpinnerAnim: function () {
        const animationLoadingContainer = document.querySelector('.animation-loading-container');
        animationLoadingContainer.style.display = 'block';
        animationLoadingContainer.style.opacity = '1';
    },

    stopSpinnerAnim: function () {
        const animationLoadingContainer = document.querySelector('.animation-loading-container');
        animationLoadingContainer.style.opacity = '0';
        setTimeout(() => {
            animationLoadingContainer.style.display = 'none';
        }, 2000);
    },
};

document.addEventListener('DOMContentLoaded', app.init);