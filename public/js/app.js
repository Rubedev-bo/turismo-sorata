// Mobile nav toggle
document.addEventListener('DOMContentLoaded', function(){
    var toggle = document.getElementById('nav-toggle');
    var links = document.getElementById('nav-links');
    var header = document.getElementById('site-header');

    toggle?.addEventListener('click', function(){
        if (links.style.display === 'block') {
            links.style.display = '';
        } else {
            links.style.display = 'block';
        }
    });

    // Scroll shadow
    window.addEventListener('scroll', function(){
        if (window.scrollY > 20) header?.classList.add('scrolled'); else header?.classList.remove('scrolled');
    });

    // Login modal open/close
    var loginOpen = document.getElementById('login-open');
    var loginModal = document.getElementById('login-modal');
    var loginClose = document.getElementById('login-close');
    var loginBackdrop = document.getElementById('login-backdrop');

    function closeLoginModal(){
        if (!loginModal) return;
        loginModal.style.display = 'none';
        document.body.style.overflow = '';
        loginModal.setAttribute('aria-hidden','true');
    }

    function openLoginModal(){
        if (!loginModal) return;
        loginModal.style.display = 'flex';
        document.body.style.overflow = 'hidden';
        loginModal.setAttribute('aria-hidden','false');
    }

    loginOpen?.addEventListener('click', function(){ openLoginModal(); });
    loginClose?.addEventListener('click', function(){ closeLoginModal(); });
    loginBackdrop?.addEventListener('click', function(){ closeLoginModal(); });
    window.addEventListener('keydown', function(e){ if (e.key === 'Escape') closeLoginModal(); });
});
