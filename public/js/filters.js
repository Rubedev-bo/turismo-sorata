document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const communityFilter = document.getElementById('communityFilter');
    const clearButton = document.getElementById('clearFilters');
    const experienceCards = document.querySelectorAll('.experience-card');
    const resultsCount = document.getElementById('resultsCount');
    if(!resultsCount) return;
    let activeType = 'all';
    let activeCommunity = 'all';
    filterButtons.forEach(btn => {
        btn.addEventListener('click', function(){
            filterButtons.forEach(b=>b.classList.remove('active'));
            this.classList.add('active');
            activeType = this.getAttribute('data-filter');
            applyFilters();
        });
    });
    communityFilter?.addEventListener('change', function(){ activeCommunity = this.value; applyFilters(); });
    clearButton?.addEventListener('click', function(){ activeType='all'; activeCommunity='all'; filterButtons.forEach(b=>b.classList.remove('active')); if(filterButtons[0]) filterButtons[0].classList.add('active'); if(communityFilter) communityFilter.value='all'; applyFilters(); });

    function applyFilters(){
        let visibleCount = 0;
        experienceCards.forEach(card=>{
            const cardType = card.getAttribute('data-type');
            const cardCommunity = card.getAttribute('data-community');
            const typeMatch = activeType === 'all' || cardType === activeType;
            const communityMatch = activeCommunity === 'all' || String(cardCommunity) === String(activeCommunity);
            if(typeMatch && communityMatch){ card.style.display='block'; visibleCount++; } else { card.style.display='none'; }
        });
        resultsCount.textContent = visibleCount;
        const grid = document.querySelector('.experiences-grid');
        let noResults = document.querySelector('.no-results');
        if(visibleCount === 0){ if(!noResults && grid){ noResults = document.createElement('div'); noResults.className='no-results'; noResults.innerHTML = `<p>😔 No se encontraron experiencias.</p><button class="btn btn-primary" onclick="document.getElementById('clearFilters').click()">Ver todas las experiencias</button>`; grid.appendChild(noResults); } }
        else { if(noResults) noResults.remove(); }
    }
});
