document.addEventListener('DOMContentLoaded', () => {
    // 1. Initialize Swup for Page Transitions
    if (typeof Swup !== 'undefined') {
        const swup = new Swup({
            containers: ['#swup'],
            animationSelector: '[class*="transition-"]'
        });
    }

    // 2. Audio Player Logic (Spotify Style)
    const audioEl = document.getElementById('radio-audio');
    const playPauseBtn = document.getElementById('play-pause-btn');
    const playIcon = '<i class="fa-solid fa-play ml-1"></i>';
    const pauseIcon = '<i class="fa-solid fa-pause"></i>';
    
    let isPlaying = false;

    if (playPauseBtn && audioEl) {
        playPauseBtn.addEventListener('click', () => {
            if (isPlaying) {
                audioEl.pause();
                playPauseBtn.innerHTML = playIcon;
                isPlaying = false;
            } else {
                audioEl.play().then(() => {
                    playPauseBtn.innerHTML = pauseIcon;
                    isPlaying = true;
                }).catch(e => {
                    console.error("Playback failed:", e);
                    // Usually due to browser autoplay policies, though click should bypass
                });
            }
        });
        
        // Handle external pause events (e.g., from browser controls)
        audioEl.addEventListener('pause', () => {
            playPauseBtn.innerHTML = playIcon;
            isPlaying = false;
        });

        audioEl.addEventListener('play', () => {
            playPauseBtn.innerHTML = pauseIcon;
            isPlaying = true;
        });
    }

    // 3. Header & Off-Canvas Menu Logic
    const openMenuBtn = document.getElementById('open-menu-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const offcanvasMenu = document.getElementById('offcanvas-menu');
    const menuOverlay = document.getElementById('menu-overlay');
    const mobileSearchBtn = document.getElementById('mobile-search-btn');
    const mobileSearchContainer = document.getElementById('mobile-search-container');

    function openMenu() {
        if (!offcanvasMenu) return;
        offcanvasMenu.classList.remove('-translate-x-full');
        menuOverlay.classList.remove('hidden');
        // Small delay to allow display:block to apply before changing opacity for transition
        setTimeout(() => {
            menuOverlay.classList.remove('opacity-0');
            menuOverlay.classList.add('opacity-100');
        }, 10);
        openMenuBtn.setAttribute('aria-expanded', 'true');
        offcanvasMenu.setAttribute('aria-hidden', 'false');
        document.body.classList.add('overflow-hidden'); // Prevent background scrolling
    }

    function closeMenu() {
        if (!offcanvasMenu) return;
        offcanvasMenu.classList.add('-translate-x-full');
        menuOverlay.classList.remove('opacity-100');
        menuOverlay.classList.add('opacity-0');
        setTimeout(() => {
            menuOverlay.classList.add('hidden');
        }, 300); // match transition duration
        openMenuBtn.setAttribute('aria-expanded', 'false');
        offcanvasMenu.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');
    }

    if (openMenuBtn) openMenuBtn.addEventListener('click', openMenu);
    if (closeMenuBtn) closeMenuBtn.addEventListener('click', closeMenu);
    if (menuOverlay) menuOverlay.addEventListener('click', closeMenu);

    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && offcanvasMenu && !offcanvasMenu.classList.contains('-translate-x-full')) {
            closeMenu();
        }
    });

    // Accordion Logic
    const accordionBtns = document.querySelectorAll('.accordion-btn');
    accordionBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('.fa-chevron-down');
            
            if (content.classList.contains('hidden')) {
                content.classList.remove('hidden');
                icon.classList.add('rotate-180');
            } else {
                content.classList.add('hidden');
                icon.classList.remove('rotate-180');
            }
        });
    });

    // Mobile Search Toggle
    if (mobileSearchBtn && mobileSearchContainer) {
        mobileSearchBtn.addEventListener('click', () => {
            mobileSearchContainer.classList.toggle('hidden');
        });
    }
});
