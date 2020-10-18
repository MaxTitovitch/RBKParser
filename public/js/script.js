let changeElements = function (button, buttonText, descriptionStyle){
    button.innerText = buttonText;
    button.parentNode.querySelectorAll('.show-novelty')[0].style.maxHeight = descriptionStyle;
    console.log(button.parentNode.querySelectorAll('.show-novelty')[0]);
}

document.querySelectorAll('.show-novelty-btn').forEach(function (button){
    button.onclick = function (event){
        event.preventDefault();
        if(this.innerText === 'Показать...') {
            changeElements(this, 'Скрыть...', 'none');
        } else {
            changeElements(this,'Показать...', '50px');
        }
    }
})
