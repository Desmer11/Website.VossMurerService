// ImageContainer
const imageContainer = document.querySelector(".gallery-items");
const prevBtn = document.getElementById("prevBtn");
const nextBtn = document.getElementById("nextBtn");

let x = 0;

prevBtn.addEventListener("click", () => {
  x = x + 45;
  rotate();
});

nextBtn.addEventListener("click", () => {
  x = x - 45;
  rotate();
});

function rotate() {
  imageContainer.style.transform = `perspective(1000px) rotateY(${x}deg)`;
}


// ImageContainer-2
const imageContainer2 = document.querySelector(".gallery-items2");
// const prevBtn2 = document.getElementById("prevBtn2");
// const nextBtn2 = document.getElementById("nextBtn2");

// prevBtn2.addEventListener("click", () => {
//   x = x + 45;
//   rotate2();
// });

// nextBtn2.addEventListener("click", () => {
//   x = x - 45;
//   rotate2();
// });

// function rotate2() {
//   imageContainer2.style.transform = `perspective(1000px) rotateY(${x}deg)`;
// }




const galleryItems = document.querySelectorAll('.gallery-items2 img');
const lightbox = document.getElementById('lightbox');
const lightboxImg = document.getElementById('lightboxImg');
const closeBtn = document.getElementById('closeBtn');

if (!galleryItems || !lightbox || !lightboxImg || !closeBtn) {
  console.error('One or more elements for the lightbox are missing!');
}

// Show lightbox on image click
galleryItems.forEach(img => {
    img.addEventListener('click', () => {
        lightbox.style.display = 'flex';
        lightboxImg.src = img.src; // Set the lightbox image to the clicked image
    });
});

// Close lightbox on close button click
closeBtn.addEventListener('click', () => {
    lightbox.style.display = 'none';
});

// Optional: Close lightbox on clicking outside the image
lightbox.addEventListener('click', (e) => {
    if (e.target === lightbox) {
        lightbox.style.display = 'none';
    }
});

console.log('Gallery Items:', galleryItems);
console.log('Lightbox:', lightbox);
console.log('Lightbox Image:', lightboxImg);
console.log('Close Button:', closeBtn);