let profileImageCont = document.querySelector('.profile-img');
console.log(profileImageCont);

let uploadBtn = document.querySelector('.profile-image');
uploadBtn.addEventListener('click', e => {
    document.querySelector('#profile-img-input').click();
})


let profileImg = document.querySelector('#profile-img-input');
profileImg.addEventListener('change', e => {
    let filePath = profileImg.value;
    let extensions = /(\.jpg|\.jpeg|\.png)$/i;

    if (!extensions.exec(filePath)) {
        profileImg.classList.add('is-invalid');
    } else {
        profileImg.classList.remove('is-invalid');
        const reader = new FileReader();
        reader.addEventListener('load', (event) => {
            const img = new Image();
            img.src = event.target.result;
            document.querySelector('.profile-image').src = img.src;
        });
        reader.readAsDataURL(profileImg.files[0]);
    }
}, false);

//change divs when 'next'/'back' btn is clicked
let registerForm = document.querySelector('.register-form');
let interest = document.querySelector('.interest');
let gender = document.querySelector('.gender');
let firstNext = document.querySelector('.firstNext');
let secondNext = document.querySelector('.secondNext');
let firstBack = document.querySelector('.firstBack');
let secondBack = document.querySelector('.secondBack');


firstNext.addEventListener('click', e => {
    registerForm.style.display = 'none';
    gender.style.display = 'block';
})

// secondNext.addEventListener('click', e => {
//     interest.style.display = 'none';
//     gender.style.display = 'block';
// })

// firstBack.addEventListener('click', e => {
//     interest.style.display = 'none';
//     registerForm.style.display = 'block';
// })

secondBack.addEventListener('click', e => {
    gender.style.display = 'none';
    registerForm.style.display = 'block';
})


// form validation
let fname = document.querySelector('#fname');
let lname = document.querySelector('#lname');
let age = document.querySelector('#age');
let username = document.querySelector('#username');
let genderInput = document.querySelector('#genderInput');
let occupation = document.querySelector('#occupation');
let email = document.querySelector('#email');
let password = document.querySelector('#password');

let pwordIcon = document.querySelector(".pword-icon");

pwordIcon.addEventListener("click", function () {
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    this.classList.toggle("fa-eye-slash");
});


fname.addEventListener('change', e => {
    if (fname.value.length < 1) {
        fname.classList.add('is-invalid');
    } else {
        fname.classList.remove('is-invalid');
        fname.classList.add('is-valid');
    }
})

lname.addEventListener('change', e => {
    if (fname.value.length < 1) {
        lname.classList.add('is-invalid');
    } else {
        lname.classList.remove('is-invalid');
        lname.classList.add('is-valid');
    }
})

username.addEventListener('change', e => {
    if (username.value.length < 6) {
        username.classList.add('is-invalid');
    } else {
        username.classList.remove('is-invalid');
        username.classList.add('is-valid');
    }
})

genderInput.addEventListener('change', e => {
    if (genderInput.value == '') {
        genderInput.classList.add('is-invalid');
    } else {
        genderInput.classList.remove('is-invalid');
        genderInput.classList.add('is-valid');
    }
})

password.addEventListener('change', e => {
    if (password.value.length < 8) {
        password.classList.add('is-invalid');
    } else {
        password.classList.remove('is-invalid');
        password.classList.add('is-valid');
    }
})

email.addEventListener('change', e => {
    if (email.value != '') {
        const regex = /^[\w\-\.\+]+\@[a-zA-Z0-9\. \-]+\.[a-zA-z0-9]{2,4}$/;
        if (!(regex.test(email.value))) {
            email.classList.add('is-invalid');
        } else {
            email.classList.remove('is-invalid');
            email.classList.add('is-valid');
        }

    }
})


//validate interests checkbox

//form validation when first next button is pressed
firstNext.addEventListener('click', e => {
    let errors = 0;
    if (fname.value.length < 1) {
        fname.classList.add('is-invalid');
        errors++;
    } else {
        fname.classList.remove('is-invalid');
        fname.classList.add('is-valid');
    }

    if (lname.value.length < 1) {
        lname.classList.add('is-invalid');
        errors++;
    } else {
        lname.classList.remove('is-invalid');
        lname.classList.add('is-valid');
    }

    if (username.value.length < 6) {
        username.classList.add('is-invalid');
        errors++;
    } else {
        username.classList.remove('is-invalid');
        username.classList.add('is-valid');
    }

    if (age.value == '') {
        age.classList.add('is-invalid');
        errors++;
    } else {
        age.classList.remove('is-invalid');
        age.classList.add('is-valid');
    }


    if (age.value != '') {
        let today = new Date();
        let birthDate = new Date(age.value);
        let realAge = today.getFullYear() - birthDate.getFullYear();
        let month = today.getMonth() - birthDate.getMonth();
        var day = today.getDate() - birthDate.getDate();
        if (month < 0 || (month == 0 && today.getDate() < birthDate.getDate())) {
            realAge--;
        }
        if (month < 0) {
            month += 12;
        }
        if (day < 0) {
            day += 30;
        }

        if (realAge < 18) {
            age.classList.add('is-invalid');
            errors++;
        } else {
            age.classList.remove('is-invalid');
            age.classList.add('is-valid');
        }
    }

    if (genderInput.value == '') {
        genderInput.classList.add('is-invalid');
        errors++;
    } else {
        genderInput.classList.remove('is-invalid');
        genderInput.classList.add('is-valid');
    }

    if (occupation.value == '') {
        occupation.classList.add('is-invalid');
        errors++;
    } else {
        occupation.classList.remove('is-invalid');
        occupation.classList.add('is-valid');
    }

    if (password.value.length < 8) {
        password.classList.add('is-invalid');
        pwordIcon.classList.add('d-none');
        errors++;
    } else {
        password.classList.remove('is-invalid');
        password.classList.add('is-valid');
    }


    if (email.value == '') {
        email.classList.add('is-invalid');
        errors++;
    } else {
        email.classList.remove('is-invalid');
        email.classList.add('is-valid');
    }

    if (email.value != '') {
        const regex = /^[\w\-\.\+]+\@[a-zA-Z0-9\. \-]+\.[a-zA-z0-9]{2,4}$/;
        if (!(regex.test(email.value))) {
            email.classList.add('is-invalid');
            errors++;
        } else {
            email.classList.remove('is-invalid');
            email.classList.add('is-valid');
        }

    }

    if (errors == 0) {
        registerForm.style.display = 'none';
        interest.style.display = 'block';
    }

})

$('.interest').scroll(function () {
    $('.interest-counter').removeClass('d-none')

});

let $interestCounter;
$(':checkbox').change(function () {
    $interestCounter = $('input:checkbox:checked').length;

    $('.interest-counter').removeClass('d-none')
    $(".interest-counter > h6 > span").text($interestCounter);

    if ($interestCounter > 10) {
        $("input:checkbox:not(:checked)").prop('disabled', true);
        $(".interest-counter > h6 >span").css('color', 'red').text($interestCounter - 1 + '/10');
    }

    if ($interestCounter < 10) {
        $(':checkbox').prop('disabled', false);
    }

    if ($interestCounter >= 10) {
        $("input:checkbox:not(:checked)").prop('disabled', true);
        $(".interest-counter > h5").text("You've selected more than 10").css('color', 'red')
    }

})