const recipeFilter = {
    init: function () {

        $('#search').on('keyup', recipeFilter.searchBar);
        $('#search-mobile').on('keyup', recipeFilter.searchBar);
        $('.close-filter-btn').on('click', recipeFilter.resetSearchInput);
    },

    searchBar: function () {
        /* Disable activ tab-container item */
        $('.tab-container').removeClass('tabActive');

        const input = this.value.toLowerCase();
        const items = document.querySelectorAll('.card-container');

        items.forEach(item => {
            const title = item.dataset.title.toLowerCase();
            const display = title.includes(input) ? 'block' : 'none';
            item.style.display = display;
        });
    },

    resetSearchInput: function () {
        $('#search').val('').trigger($.Event('keyup', { keyCode: 13 }));
        $('#search-mobile').val('').trigger($.Event('keyup', { keyCode: 13 }));
    }
};

document.addEventListener('DOMContentLoaded', recipeFilter.init);