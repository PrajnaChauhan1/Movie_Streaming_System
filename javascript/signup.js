window.onload = function () {
    var form = document.getElementsByTagName('form')[0];

    var fullname = document.getElementById('full name');
    var phone = document.getElementById('phone');
    var age = document.getElementById('age');
    var password = document.getElementById('password');

    fullname.addEventListener('input', function () {
        var pattern = /^[a-zA-Z\s]*$/;
        if (!pattern.test(this.value)) {
            this.setCustomValidity('Full name should only contain a to z, A to Z and spaces.');
        } else {
            this.setCustomValidity('');
        }
    });

    phone.addEventListener('input', function () {
        var pattern = /^(98|97)\d{8}$/;
        if (!pattern.test(this.value)) {
            this.setCustomValidity('Phone number should start from 98 or 97 with a length of 10.');
        } else {
            this.setCustomValidity('');
        }
    });

    age.addEventListener('input', function () {
        if (this.value < 13 || this.value > 120) {
            this.setCustomValidity('Age should be from 13 to 120 without negative value.');
        } else {
            this.setCustomValidity('');
        }
    });

    password.addEventListener('input', function () {
        if (this.value.length < 8 || this.value.length > 15) {
            this.setCustomValidity('Password should be the length of 8 to 15.');
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
