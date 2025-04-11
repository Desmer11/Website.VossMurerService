// Dynamically load the header or any external content
const loadContent = (url, targetId) => {
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
            })
            .catch(error => {
                console.error('Error loading content:', error);
            });
    } else {
        console.warn(`Target element with ID "${targetId}" not found.`);
    }
};


// Load shared header and footer
loadContent('../shared/header.html', 'header');
loadContent('../shared/footer.html', 'footer');


document.addEventListener("DOMContentLoaded", function () {
    const toggleButton = document.querySelector(".dropdown-toggle");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    toggleButton.addEventListener("click", function () {
        dropdownMenu.classList.toggle("active");
    });
});