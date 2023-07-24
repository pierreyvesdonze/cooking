document.addEventListener('DOMContentLoaded', function () {

    // ADD STEP
    const addFormToCollection = (e) => {
        const collectionHolder = document.querySelector('.' + e.currentTarget.dataset.collectionHolderClass);

        const item = document.createElement('li');
        
        item.innerHTML = collectionHolder
            .dataset
            .prototype
            .replace(
                /__name__/g,
                collectionHolder.dataset.index
            );

        collectionHolder.appendChild(item);

        collectionHolder.dataset.index++;
        
        // Remove step button
        addStepFormDeleteLink(item);
    }

    document
        .querySelectorAll('.add-recipe-step')
        .forEach(btn => {
            btn.addEventListener("click", addFormToCollection)
        });

})

// REMOVE STEP FROM FORM
document
    .querySelectorAll('ul.steps li')
    .forEach((step) => {
        addStepFormDeleteLink(step)
    })

const addStepFormDeleteLink = (item) => {
    const removeFormButton = document.createElement('button');
    removeFormButton.classList.add('btn', 'btn-danger');
    removeFormButton.innerText = 'Supprimer cette étape';

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        item.remove();
    });
}