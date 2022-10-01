const parentContainer =  document.querySelector('.container-cc');

parentContainer.addEventListener('click', event=>{

    const current = event.target;

    const isReadMoreBtn = current.className.includes('btn-cc');

    if(!isReadMoreBtn) return;

    const currentText = event.target.parentNode.querySelector('.more');

    currentText.classList.toggle('more--show');

    current.textContent = current.textContent.includes('Read more') ? "Read less" : "Read more";

});