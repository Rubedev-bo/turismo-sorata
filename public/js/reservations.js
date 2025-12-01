document.addEventListener('DOMContentLoaded', function(){
    const form = document.getElementById('reservationForm') || document.querySelector('form[action$="reservas.store"]');
    const adults = document.getElementById('adults') || document.querySelector('input[name="numero_adultos"]');
    const children = document.getElementById('children') || document.querySelector('input[name="numero_ninos"]');
    const totalPriceEl = document.getElementById('totalPrice') || document.querySelector('.total-price-display strong') || document.querySelector('.total-price');
    const summaryPriceEl = document.querySelector('.summary-price strong');

    function getPrice(){
        if(summaryPriceEl) return parseFloat((summaryPriceEl.textContent||'0').replace(/[^0-9\.]/g,''))||0;
        // Try to obtain price from selected option in reservas form
        var expSelect = document.getElementById('experiencia_select') || document.querySelector('select[name="experiencia_id"]');
        if (expSelect && expSelect.selectedOptions && expSelect.selectedOptions[0]){
            var p = expSelect.selectedOptions[0].dataset.precio || expSelect.selectedOptions[0].getAttribute('data-precio') || '';
            return parseFloat((p||'0').replace(/[^0-9\.]/g,''))||0;
        }
        return 0;
    }

    function calculateTotal(){
        const price = getPrice();
        const a = parseInt(adults?.value||0);
        const c = parseInt(children?.value||0);
        const total = (a * price) + (c * price * 0.5);
        if(totalPriceEl) totalPriceEl.textContent = total.toFixed(2) + ' Bs.';
    }

    if(adults) adults.addEventListener('change', calculateTotal);
    if(children) children.addEventListener('change', calculateTotal);
    calculateTotal();

    if(form){
        form.addEventListener('submit', function(e){
            const btn = form.querySelector('button[type="submit"]');
            const text = btn.querySelector('.btn-text');
            const loading = btn.querySelector('.btn-loading');
            if(text) text.style.display='none';
            if(loading) loading.style.display='inline-block';
            btn.disabled = true;
        });
    }
});
