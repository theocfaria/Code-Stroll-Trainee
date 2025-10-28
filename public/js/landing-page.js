// Passando elementos HTML para variaveis JavaScript
const slider = document.querySelector(".slider");
const sliderContent = document.querySelector(".slider-conteudo");
const radioAuto = document.querySelector(".radio-auto");
const leftArrow = document.getElementById("seta-esquerda");
const rightArrow = document.getElementById("seta-direita");

// Declarar variaveis globais
let currentItemIndex = 0; // Mudamos de 'currentPage' para 'currentItemIndex'
let totalItems = 0;
let itemsInView = 0;
let totalScrollPositions = 0; 
let singleScrollWidth = 0; 
let autoSlideInterval;

// Criação/Organização do Carrossel
function updateCarrossel() {
  totalItems = sliderContent.children.length;
  if (totalItems === 0) return; 

  const sliderWidth = sliderContent.offsetWidth;
  const firstItem = sliderContent.children[0]; 

  const itemStyle = window.getComputedStyle(firstItem);
  const itemMargin =
    parseFloat(itemStyle.marginLeft) + parseFloat(itemStyle.marginRight);
  singleScrollWidth = firstItem.offsetWidth + itemMargin; 

  itemsInView = Math.round(sliderWidth / singleScrollWidth); 

  totalScrollPositions = totalItems - itemsInView + 1;

  createRadioLabel();
  updateRadioLabel();
}

// Radio label
function createRadioLabel() {
  radioAuto.innerHTML = "";
  for (let i = 0; i < totalScrollPositions; i++) {
    const label = document.createElement("div");
    label.classList.add("radio-label");
    if (i === 0) {
      label.classList.add("active");
    }
    label.addEventListener("click", () => {
      currentItemIndex = i;
      scrollToPage();
    });
    radioAuto.appendChild(label);
  }
}

function updateRadioLabel() {
  const labels = document.querySelectorAll(".radio-label");
  labels.forEach((l, i) => {
    l.classList.toggle("active", i === currentItemIndex);
  });
}

// Movimentação
function scrollToPage() {
  const newPosition = singleScrollWidth * currentItemIndex;
  sliderContent.scrollTo({ left: newPosition, behavior: "smooth" });
  updateRadioLabel();
  resetAutoSlide();
}

function moveleft() {
  currentItemIndex--;
  if (currentItemIndex < 0) {
    currentItemIndex = totalScrollPositions - 1;
  }
  scrollToPage();
  resetAutoSlide();
}

function moveRight() {
  currentItemIndex++;
  if (currentItemIndex >= totalScrollPositions) {
    currentItemIndex = 0;
  }
  scrollToPage();
  resetAutoSlide();
}

// Slide automático
function startAutoSlide() {
  autoSlideInterval = setInterval(() => {
    moveRight();
  }, 2200);
}

function resetAutoSlide() {
  clearInterval(autoSlideInterval);
  startAutoSlide();
}

// Eventos
leftArrow.addEventListener("click", moveleft);
rightArrow.addEventListener("click", moveRight);
window.addEventListener("resize", updateCarrossel);

// Chama início das funções
updateCarrossel();
startAutoSlide();
