"use strict";

function setupDeleteForms() {
    let deleteForms = document.querySelectorAll('form.deletion-form');

    for (let form of deleteForms) {
        form.addEventListener('submit', function (event) {
            event.preventDefault();

            if (window.confirm('Are you sure you want to delete this object?')) {
                form.submit();
            } else {
                return false;
            }
        });
    }
}

document.addEventListener("DOMContentLoaded", function () {
    setupDeleteForms();
});
