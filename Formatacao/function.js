window.addEventListener("load",() => {CreateObserverForShowContentRight();CreateObserverForShowContentLeft();},false);

function CreateObserverForShowContentRight(){    

    const Options = {
        root: null,
        rootMargin:'0px',
        threshold: .75
    }
    const callback = function(entries) {
        entries.forEach(entry => { 
            if(entry.isIntersecting){                                 
                entry.target.classList.add("is-visible");
                observer.unobserve(entry.target);                
            }                       
        });
    };
        
    const observer = new IntersectionObserver(callback,Options);   

    const targets = document.querySelectorAll(".show-on-scroll-right");
    
    targets.forEach(function(target) {
        observer.observe(target);
    });    
}

function CreateObserverForShowContentLeft(){
    const Options = {
        root: null,
        rootMargin:'0px',
        threshold:.75
    }

    const callback = function(entries){
        entries.forEach(entry => {
            if(entry.isIntersecting){                 
                entry.target.classList.add('is-visible');
                observer.unobserve(entry.target);
            }
        });
    }

    const observer = new IntersectionObserver(callback,Options);

    const targets = document.querySelectorAll('.show-on-scroll-left');

    targets.forEach(target => {
        observer.observe(target);    
    });
}

