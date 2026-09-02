console.log('APP.JS LOADED');

function getSidebar() {
    return document.getElementById('app-sidebar');
}

function getBackdrop() {
    return document.getElementById('app-sidebar-backdrop');
}

function openSidebar() {
    const sidebar = getSidebar();
    const backdrop = getBackdrop();

    if (!sidebar || !backdrop) {
        return;
    }

    sidebar.classList.remove('-translate-x-full');
    backdrop.classList.remove('hidden');
    document.body.classList.add('overflow-hidden');
}

function closeSidebar() {
    const sidebar = getSidebar();
    const backdrop = getBackdrop();

    if (!sidebar || !backdrop) {
        return;
    }

    sidebar.classList.add('-translate-x-full');
    backdrop.classList.add('hidden');
    document.body.classList.remove('overflow-hidden');
}

document.addEventListener('click', (event) => {
    const openButton = event.target.closest('#app-sidebar-open');
    const closeButton = event.target.closest('#app-sidebar-close');
    const backdrop = event.target.closest('#app-sidebar-backdrop');

    if (openButton) {
        event.preventDefault();
        openSidebar();
        return;
    }

    if (closeButton) {
        event.preventDefault();
        closeSidebar();
        return;
    }

    if (backdrop) {
        event.preventDefault();
        closeSidebar();
    }
});

document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') {
        closeSidebar();
    }
});

const mediaQuery = window.matchMedia('(min-width: 1024px)');

mediaQuery.addEventListener('change', () => {
    if (window.innerWidth >= 1024) {
        closeSidebar();
    }
});

document.addEventListener('click', (event) => {
    document
        .querySelectorAll('header details[open]')
        .forEach((dropdown) => {
            if (!dropdown.contains(event.target)) {
                dropdown.removeAttribute('open');
            }
        });
});
