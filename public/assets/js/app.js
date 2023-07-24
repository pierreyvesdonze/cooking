var app = {

    init: () => {

        /**
        * *****************************
        * Materialize components init
        * *****************************
        */
        $(document).ready(function () {
            $('.sidenav').sidenav();
        });

        /**
        * *****************************
        * LISTENERS
        * *****************************
        */
        $('.category-tab').on('click', app.recipeTabFilter);
    },

    recipeTabFilter: (e) => {
        
        /* for css only */
        $('.tab').removeClass('tabActive');
        e.currentTarget.parentNode.classList.add('tabActive');

        const category = e.currentTarget.dataset.category;
        const cardContainer = $('.card-container');

        console.log(category)

        cardContainer.hide();

        // Filtering cards by category
        const filteredCards = cardContainer.filter(function() {
            return $(this).data('category') === category;
        });
    
        // Little animation, cards are showing one by one
        filteredCards.each(function(index) {
            $(this).delay(80 * index).show(0);
        });

    }
}

document.addEventListener('DOMContentLoaded', app.init)
