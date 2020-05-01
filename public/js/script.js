    
document.addEventListener('DOMContentLoaded', (event) => {
    const hamburger = document.getElementById('hamburger');
    const main = document.getElementById('main');
    const sidebar = document.querySelector('.nav-sidebar');
    const profile = document.querySelector('.header-nav-item');
    const ndropdown = document.querySelector('.nav-dropdown');

    hamburger.addEventListener('click', () =>{
        sidebar.classList.toggle('nav-sidebar-open');
    });

    profile.addEventListener('click', () => {
        ndropdown.classList.toggle('active');
    });
    main.addEventListener('click', () =>{
        // if(sidebar.classList.contains('nav-sidebar-open')){
            sidebar.classList.remove('nav-sidebar-open');
        
    });
});