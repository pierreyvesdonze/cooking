const recipeFilter = {
    init: function () {

        document.querySelector('#search').addEventListener('keyup', recipeFilter.searchBar);
        document.querySelector('#search-mobile').addEventListener('keyup', recipeFilter.searchBar);
    },

    searchBar: function (e) {
        const input = this.value.toLowerCase();
        const items = document.querySelectorAll('.card-container');

        items.forEach(item => {
            const title = item.dataset.title.toLowerCase();
            const display = title.includes(input) ? 'block' : 'none';
            item.style.display = display;
        });
    },
};

document.addEventListener('DOMContentLoaded', recipeFilter.init);