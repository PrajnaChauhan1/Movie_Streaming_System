window.onload = function () {
    var form = document.getElementsByTagName('form')[0];

    var movieName = document.getElementById('movieName');
    var releaseDate = document.getElementById('releaseDate');
    var casts = document.getElementById('casts');

    movieName.addEventListener('input', function () {
        var pattern = /^[a-zA-Z\s]*$/;
        if (!pattern.test(this.value)) {
            this.setCustomValidity('Movie name should only contain a to z and A to Z.');
        } else {
            this.setCustomValidity('');
        }
    });

    releaseDate.addEventListener('input', function () {
        var today = new Date();
        var inputDate = new Date(this.value);
        if (inputDate >= today) {
            this.setCustomValidity('Release date should be a past date.');
        } else {
            this.setCustomValidity('');
        }
    });

    casts.addEventListener('input', function () {
        var pattern = /^[a-zA-Z,\s]*$/;
        if (!pattern.test(this.value)) {
            this.setCustomValidity('Casts should only contain A to Z, a to z, and comma.');
        } else {
            this.setCustomValidity('');
        }
    });

    form.addEventListener('submit', function (event) {
        if (!this.checkValidity()) {
            event.preventDefault();
            alert('Please correct the errors in the form!');
        }
    });
}
document.querySelector('form').addEventListener('submit', function(event) {
    var thumbnailInput = document.getElementById('thumbnail');
    var movieInput = document.getElementById('movie');
    var thumbnailFile = thumbnailInput.value;
    var movieFile = movieInput.value;

    // Get the file extension
    var thumbnailExt = thumbnailFile.split('.').pop().toLowerCase();
    var movieExt = movieFile.split('.').pop().toLowerCase();

    // Check the file extension
    if(thumbnailExt !== 'png') {
        thumbnailInput.setCustomValidity('Only PNG files are allowed for thumbnail.');
        event.preventDefault(); // Prevent form from submitting
    } else {
        thumbnailInput.setCustomValidity('');
    }

    if(movieExt !== 'mp4') {
        movieInput.setCustomValidity('Only MP4 files are allowed for movie.');
        event.preventDefault(); // Prevent form from submitting
    } else {
        movieInput.setCustomValidity('');
    }
});
