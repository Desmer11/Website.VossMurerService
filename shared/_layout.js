const loadContent = (url, targetId, callback) => {
    const targetElement = document.getElementById(targetId);

    if (targetElement) {
        fetch(url)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Failed to load: ${url}, status: ${response.status}`);
                }
                return response.text();
            })
            .then(data => {
                targetElement.innerHTML = data;
                console.log(`Content loaded into: ${targetId}`);
                if (callback) callback(); // Call the callback after content is loaded
            })
            .catch(error => {
                console.error('Error loading content:', error);
            });
    } else {
        console.warn(`Target element with ID "${targetId}" not found.`);
    }
};

// Load shared header and footer, then initialize toggle
loadContent('../../shared/header.html', 'header-container', () => {
    const toggleButton = document.querySelector(".dropdown-toggle");
    const navBar = document.querySelector(".nav-bar");

    if (toggleButton && navBar) {
        toggleButton.addEventListener("click", function () {
            navBar.classList.toggle("active");
            toggleButton.classList.toggle("active"); // Add/remove "active" class for animation
        });
    } else {
        console.error("Dropdown toggle button or navigation bar not found.");
    }
});

loadContent('../../shared/footer.html', 'footer-container');


var myCarousel1 = new bootstrap.Carousel(document.getElementById('carouselExampleAutoplaying'), {
    interval: 2000,
    ride: 'carousel',
    wrap: true // Ensures continuous looping
});

var myCarousel2 = new bootstrap.Carousel(document.getElementById('carouselExampleAutoplaying-section-5'), {
    interval: 2000,
    ride: 'carousel',
    wrap: true // Ensures continuous looping
});