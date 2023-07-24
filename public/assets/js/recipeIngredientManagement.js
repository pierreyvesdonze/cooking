document.addEventListener('DOMContentLoaded', function () {

    // ADD STEP
    const addIngredientFormToCollection = (e) => {
        const ingredientCollectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

        const ingredientItem = document.createElement('li');
        
        ingredientItem.innerHTML = ingredientCollectionHolder
            .dataset
            .prototype
            .replace(
                /__name__/g,
                ingredientCollectionHolder.dataset.index
            );

            ingredientCollectionHolder.appendChild(ingredientItem);

            ingredientCollectionHolder.dataset.index++;
        
        // Remove step button
        addIngredientDeleteLink(ingredientItem);
    }

    document
        .querySelectorAll('.add-recipe-ingredient')
        .forEach(btn => {
            btn.addEventListener("click", addIngredientFormToCollection)
        });

})

// REMOVE STEP FROM FORM
document
    .querySelectorAll('ul.ingredients li')
    .forEach((step) => {
        addIngredientDeleteLink(step)
    })

const addIngredientDeleteLink = (ingredientItem) => {
    const removeFormButton = document.createElement('button');
    removeFormButton.classList.add('custom-btn', 'delete-btn');
    removeFormButton.innerText = 'Supprimer cet ingrédient';

    ingredientItem.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        ingredientItem.remove();
    });
}