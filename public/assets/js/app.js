$(document).ready(function () {

    /**
     * Materialize components init
     */
    $('.sidenav').sidenav();
    $('.dropdown-trigger').dropdown();
    $('.collapsible').collapsible();

    /**
     * LISTENERS
     */
    $('.validate-btn').on('click', app.loadSpinnerAnim);
    $('.category-tab').on('click', app.recipeTabFilter);

    // Fade out flash messages
    setTimeout(() => {
        $('.alert').fadeOut('fast')
    }, 3000);
});

const app = {
    recipeTabFilter: function (e) {
        $('.tab-container').removeClass('tabActive');
        $(e.currentTarget).parent().addClass('tabActive');

        const category = $(e.currentTarget).data('category');
        $('.card-container').hide();

        const filteredCards = $('.card-container').filter(function () {
            return $(this).data('category') === category;
        });

        filteredCards.each(function (index) {
            $(this).delay(80 * index).show(0);
        });

        app.renameTitleRecipeCategory(e);
    },

    renameTitleRecipeCategory: function (e) {
        const mainTitle = $('.recipe-category-title');
        const target = $(e.currentTarget);

        if (target.parent().hasClass('tabActive')) {
            mainTitle.text(target.data('category'));
        } else {
            mainTitle.text('Recettes');
        }
    },

    loadSpinnerAnim: function () {
        console.log('anim')
        $('.animation-loading-container').fadeIn().css('display', 'block');
    },

    stopSpinnerAnim: function () {
        const animationLoadingContainer = $('.animation-loading-container');
        animationLoadingContainer.fadeOut().css('display', 'none');
    },
};