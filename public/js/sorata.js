// Sorata Pacha frontend interactions (pure JS)
(function(){
  'use strict';

  // Helpers
  const on = (el, ev, fn) => el && el.addEventListener(ev, fn);
  const qs = s => document.querySelector(s);
  const qsa = s => Array.from(document.querySelectorAll(s));

  document.addEventListener('DOMContentLoaded', function(){
    // 1) Navbar sticky background toggle on scroll
    const nav = document.querySelector('.header__nav');
    const heroMain = document.querySelector('main');
    const checkNav = () => {
      if(window.scrollY > 20) nav && nav.classList.add('scrolled'); else nav && nav.classList.remove('scrolled');
    };
    checkNav();
    window.addEventListener('scroll', checkNav);

    // 2) If we're on homepage root, mark main as hero and set background image if body has a first .container img or via inline fallback
    if(location.pathname === '/' || location.pathname === ''){
      const main = document.querySelector('main');
      if(main) main.classList.add('sorata-hero');
      // Hero background handled by CSS (uses provided image in /css/fondo/imagen_fondo.jpeg)
      // animate hero text
      setTimeout(()=>{
        qsa('main.sorata-hero .container h1').forEach(el=>el.style.opacity=1);
        qsa('main.sorata-hero .container p.lead').forEach(el=>el.style.opacity=1);
      },300);
    }

    // 3) Intersection Observer for scroll animations (repeat on scroll up/down)
    const animated = new Set();
    const io = new IntersectionObserver((entries)=>{
      entries.forEach(entry=>{
        const el = entry.target;
        if(entry.isIntersecting){
          el.classList.add('in-view');
          // handle typewriter if indicated
          if(el.dataset && el.dataset.animate === 'typewriter') runTypewriter(el);
        } else {
          // remove so animations replay when scrolling back
          el.classList.remove('in-view');
          // reset typewriter text so it can replay
          if(el.dataset && el.dataset.animate === 'typewriter'){
            if(el.dataset.original) el.textContent = el.dataset.original;
            // remove cursor if any
            el.classList.remove('typewriter','animate');
          }
        }
      });
    },{threshold:0.12});

    // Add animate-on-scroll to likely elements (without modifying source files)
    const pick = [ '.container h1', '.container p', '.container ul li', '.container table tbody tr', '.centered-form', '.card' ];
    pick.forEach(sel=>qsa(sel).forEach(el=>{ el.classList.add('animate-on-scroll'); io.observe(el); }));

    // 4) Parallax effect for backgrounds (soft)
    window.addEventListener('scroll', ()=>{
      const ypos = window.scrollY;
      qsa('[data-parallax]').forEach(el=>{
        const speed = parseFloat(el.getAttribute('data-parallax')) || 0.3;
        el.style.transform = `translateY(${Math.round(ypos * speed)}px)`;
      });
    });

    // 5) Button ripple effect and hover elevation
    qsa('button, .btn, a.button-like').forEach(btn=>{
      btn.style.position = btn.style.position || 'relative';
      btn.style.overflow = 'hidden';
      on(btn,'click', function(e){
        const rect = btn.getBoundingClientRect();
        const ripple = document.createElement('span');
        const size = Math.max(rect.width, rect.height)*1.2;
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = (e.clientX - rect.left - size/2) + 'px';
        ripple.style.top = (e.clientY - rect.top - size/2) + 'px';
        ripple.style.position = 'absolute';
        ripple.style.borderRadius = '50%';
        ripple.style.background = 'rgba(255,255,255,0.45)';
        ripple.style.transform = 'scale(0)';
        ripple.style.transition = 'transform .6s cubic-bezier(.2,.9,.3,1), opacity .9s ease';
        ripple.style.pointerEvents = 'none';
        btn.appendChild(ripple);
        requestAnimationFrame(()=>{ ripple.style.transform='scale(1)'; ripple.style.opacity='0'; });
        setTimeout(()=>{ ripple.remove(); },900);
      });
      on(btn,'mouseover', ()=>{ btn.style.boxShadow='0 10px 25px rgba(0,0,0,0.12)'; btn.style.transform='scale(1.03)'; });
      on(btn,'mouseout', ()=>{ btn.style.boxShadow=''; btn.style.transform=''; });
    });

    // Typewriter helper
    function runTypewriter(el){
      if(el._typing) return; // already running
      const original = el.textContent.trim();
      el.dataset.original = original;
      el.textContent = '';
      el.classList.add('typewriter','animate');
      el._typing = true;
      let i = 0;
      const speed = Math.max(18, Math.floor(1500 / Math.max(1, original.length)));
      const timer = setInterval(()=>{
        if(i < original.length){
          el.textContent += original.charAt(i);
          i++;
        } else {
          clearInterval(timer);
          el._typing = false;
        }
      }, speed);
    }

    // 6) Intercept clicks on comunidad/experiencia links to open modal with fetched content
    function shouldIntercept(href){
      try{
        const url = new URL(href, location.origin);
        const parts = url.pathname.split('/').filter(Boolean);
        if(parts.length >= 2 && (parts[0]==='comunidades' || parts[0]==='experiencias')){
          // avoid intercepting edit/create/desactivar routes
          if(parts.includes('edit') || parts.includes('create') || parts.includes('desactivar') || parts.includes('desactivar')) return false;
          // if it's just listing or index, don't intercept
          return true;
        }
      }catch(e){return false}
      return false;
    }

    const modalContainer = document.createElement('div');
    modalContainer.id = 'sorata-modal-root';
    document.body.appendChild(modalContainer);

    function openModal(html){
      // clear
      modalContainer.innerHTML = '';
      const overlay = document.createElement('div'); overlay.className='sorata-modal-overlay';
      const modal = document.createElement('div'); modal.className='sorata-modal';
      modal.innerHTML = html;
      const closeBtn = document.createElement('button'); closeBtn.className='modal-close sorata-close'; closeBtn.innerHTML='✕';
      closeBtn.onclick = ()=>{ overlay.remove(); };
      modal.appendChild(closeBtn);
      overlay.appendChild(modal);
      document.body.appendChild(overlay);
      // close on overlay click
      overlay.addEventListener('click', (ev)=>{ if(ev.target===overlay) overlay.remove(); });
    }

    document.body.addEventListener('click', function(e){
      const a = e.target.closest('a');
      if(!a) return;
      const href = a.getAttribute('href');
      if(!href) return;
      if(shouldIntercept(href)){
        e.preventDefault();
        fetch(href, {headers:{'X-Requested-With':'XMLHttpRequest'}})
          .then(r=>r.text())
          .then(html=>{
            // try to extract main content or .container
            const tmp = document.createElement('div'); tmp.innerHTML = html;
            const main = tmp.querySelector('main') || tmp.querySelector('.container') || tmp;
            if(main) openModal(main.innerHTML);
            else openModal(html);
          }).catch(err=>{
            console.error('Error fetching modal content',err);
            openModal('<div><h3>Error</h3><p>No se pudo cargar el contenido.</p></div>');
          });
      }
    });

    // 7) Mobile hamburger menu behavior
    const hamburger = document.querySelector('.hamburger');
    const mobilePanel = document.getElementById('mobile-nav');
    const mobileBackdrop = document.getElementById('mobile-backdrop');
    function closeMobile(){
      if(!mobilePanel) return;
      mobilePanel.classList.remove('open');
      mobileBackdrop && mobileBackdrop.classList.remove('open');
      hamburger && hamburger.setAttribute('aria-expanded','false');
      mobilePanel && mobilePanel.setAttribute('aria-hidden','true');
      document.body.classList.remove('no-scroll');
    }
    function openMobile(){
      if(!mobilePanel) return;
      mobilePanel.classList.add('open');
      mobileBackdrop && mobileBackdrop.classList.add('open');
      hamburger && hamburger.setAttribute('aria-expanded','true');
      mobilePanel && mobilePanel.setAttribute('aria-hidden','false');
      document.body.classList.add('no-scroll');
    }
    if(hamburger && mobilePanel){
      hamburger.addEventListener('click', function(){
        const expanded = hamburger.getAttribute('aria-expanded') === 'true';
        if(expanded) closeMobile(); else openMobile();
      });
      // close when clicking backdrop
      mobileBackdrop && mobileBackdrop.addEventListener('click', closeMobile);
      // close when clicking any link inside panel
      mobilePanel.addEventListener('click', function(ev){
        const a = ev.target.closest('a');
        if(a) closeMobile();
      });
      // close when resizing above breakpoint
      window.addEventListener('resize', function(){ if(window.innerWidth > 900) closeMobile(); });
    }

  });
})();
