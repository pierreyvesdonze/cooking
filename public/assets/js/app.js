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
    },
}

document.addEventListener('DOMContentLoaded', app.init)
