// Redirect to "pages/home/index.html" if this script is loaded from the root index.html
if (window.location.pathname === '/index.html' || window.location.pathname === '/') {
    window.location.replace('pages/home/index.html');
}

