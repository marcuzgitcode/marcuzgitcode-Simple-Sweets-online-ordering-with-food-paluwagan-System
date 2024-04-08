
$(document).ready(function () {
    // Fade out the flash message after 3 seconds
    setTimeout(function () {
        $('#flash-message').fadeOut('slow');
    }, 4000);
});

$(document).ready(function () {
    // Fade out the flash message after 3 seconds
    setTimeout(function () {
        $('#flash-message1').fadeOut('slow');
    }, 4000);
});

document.addEventListener("DOMContentLoaded", function() {
    var openModalBtn = document.getElementById('openModalBtn');
    var modal = document.getElementById('myModal');
    var closeBtn = document.getElementsByClassName('close')[0];

    openModalBtn.addEventListener('click', function() {
        modal.style.display = 'block';
    });

    closeBtn.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    });
});
