const recipeFilter = {
    init: function () {

        $('#search').on('keyup', recipeFilter.searchBar);
        $('#search-mobile').on('keyup', recipeFilter.searchBar);
        $('.close-filter-btn').on('click', recipeFilter.resetSearchInput);
    },

    searchBar: function () {
        /* Disable active tab-container item */
        $('.tab-container').removeClass('tabActive');

        /* Normalize, lowercase, remove accents */
        const input = this.value.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
        const items = document.querySelectorAll('.card-container');

        items.forEach(item => {
            /* Normalize, lowercase, remove accents */
            const title = item.dataset.title.toLowerCase().normalize("NFD").replace(/[\u0300-\u036f]/g, "");
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