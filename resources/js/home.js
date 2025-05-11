const slider = document.getElementById('slider');
const searchInput = document.getElementById('search');
const categoryButtons = document.querySelectorAll('.category-buttons button');
const slides = Array.from(document.querySelectorAll('.slide'));

let scrollAmount = 0;
const scrollStep = 220;

// Auto-scroll slider
setInterval(() => {
  if (scrollAmount >= slider.scrollWidth - slider.clientWidth) {
    scrollAmount = 0;
  } else {
    scrollAmount += scrollStep;
  }
  slider.scrollTo({
    left: scrollAmount,
    behavior: 'smooth'
  });
}, 4000);

// Search filter
searchInput.addEventListener('input', () => {
  const query = searchInput.value.toLowerCase();
  slides.forEach(slide => {
    const itemName = slide.querySelector('p').innerText.toLowerCase();
    slide.style.display = itemName.includes(query) ? 'block' : 'none';
  });
});

// Category filter
categoryButtons.forEach(button => {
  button.addEventListener('click', () => {
    const category = button.innerText.toLowerCase();
    slides.forEach(slide => {
      const tags = slide.getAttribute('data-category');
      slide.style.display = tags && tags.includes(category) ? 'block' : 'none';
    });
  });
});

// Click item
slides.forEach(slide => {
  slide.addEventListener('click', () => {
    const itemName = slide.querySelector('p').innerText;
    alert("Viewing details for: ${itemName");
  });
});