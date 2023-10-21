document
    .querySelectorAll('ul.add-day li')
    .forEach((tag) => {
        addWeeklyDeleteFormLink(tag)
    })

const addWeeklyDayLink = document.createElement('a')
addWeeklyDayLink.classList.add('btn')
addWeeklyDayLink.classList.add('add-day-btn')
addWeeklyDayLink.href = '#'
addWeeklyDayLink.innerText = 'Ajouter un jour'
addWeeklyDayLink.dataset.collectionHolderClass = 'add-day'

const newLinkLi = document.createElement('li').append(addWeeklyDayLink)

const collectionHolder = document.querySelector('ul.add-day')
collectionHolder.appendChild(addWeeklyDayLink)

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

    addWeeklyDeleteFormLink(item);
}

const addWeeklyDeleteFormLink = (item) => {
    const removeFormButton = document.createElement('button');
    removeFormButton.innerText = 'Supprimer ce jour';
    removeFormButton.classList.add('btn');

    item.append(removeFormButton);

    removeFormButton.addEventListener('click', (e) => {
        e.preventDefault();
        // remove the li for the tag form
        item.remove();
    });
}

addWeeklyDayLink.addEventListener("click", addFormToCollection)
