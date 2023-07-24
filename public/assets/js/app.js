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

        cardContainer.each(function() {
            if ($(this).data('category') == category) {
                console.log($(cardContainer).data('category'))
                $(this).show();
            }
        })

    }
}

document.addEventListener('DOMContentLoaded', app.init)
