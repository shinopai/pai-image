'use strict';

const modalOpen = document.getElementsByClassName('modal-open');
const modalCloses = document.getElementsByClassName('modal-close');
const modal = document.getElementsByClassName('modal');

modalOpen[0].addEventListener('click', function() {
    modal[0].classList.toggle('hidden');
})

for (let i = 0; i < modalCloses.length; i++) {
    modalCloses[i].addEventListener('click', function() {
        modal[0].classList.add('hidden');
    })
}

// image preview 
const myImage = document.getElementsByClassName('my-image');
const preview = document.getElementsByClassName('preview');

if (modal[0].classList.contains('hidden')) {
    preview[0].removeAttribute('src')
}

myImage[0].addEventListener('change', function(e) {
    let reader = new FileReader();
    reader.onload = function(e) {
        preview[0].setAttribute('src', e.target.result);
    }
    reader.readAsDataURL(e.target.files[0]);
})
