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
const prevBtn2 = document.getElementById("prevBtn2");
const nextBtn2 = document.getElementById("nextBtn2");

prevBtn2.addEventListener("click", () => {
  x = x + 45;
  rotate2();
});

nextBtn2.addEventListener("click", () => {
  x = x - 45;
  rotate2();
});
function rotate2() {
  imageContainer2.style.transform = `perspective(1000px) rotateY(${x}deg)`;
}