document.querySelectorAll('.nav-item').forEach(link =>{
    if(link.href === window.location.href){
      link.setAttribute('aria-current', 'page')
    }
  })