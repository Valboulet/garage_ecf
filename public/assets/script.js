// Menu - navbar animation / mobile

const menuMobile = document.querySelector(".mobile-menu-icon")
const navLinks = document.querySelector(".nav-links")

menuMobile.addEventListener('click',()=>{
  navLinks.classList.toggle('mobile-menu')
})

//--------------------------------------------------------

// mileAge Filters animation

const rangeInput = document.querySelectorAll(".range-input input"),
gaugeInput = document.querySelectorAll(".gauge-input input"),
range = document.querySelector(".slider .progress");
let gaugeGap = 1000;

// Gauge setting
gaugeInput.forEach(input =>{
  input.addEventListener("input", e =>{
    // Getting two ranges of value and parsing them to number
    let minNumber = parseInt(gaugeInput[0].value),
    maxNumber = parseInt(gaugeInput[1].value);
    
    if((maxNumber - minNumber >= gaugeGap) && maxNumber <= rangeInput[1].max){
      if(e.target.className === "input-min"){ //If active, slider is min slider
        rangeInput[0].value = minNumber;
        range.style.left = ((minNumber / rangeInput[0].max) * 100) + "%";
      } else {
        rangeInput[1].value = maxNumber;
        range.style.right = 100 - (maxNumber / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

// Range setting
rangeInput.forEach(input =>{
  input.addEventListener("input", e =>{
    // Getting two ranges of value and parsing them to number
    let minVal = parseInt(rangeInput[0].value),
    maxVal = parseInt(rangeInput[1].value);

    if((maxVal - minVal) < gaugeGap){
      if(e.target.className === "range-min"){
          rangeInput[0].value = maxVal - gaugeGap
      } else {
          rangeInput[1].value = minVal + gaugeGap;
      }
    } else {
      gaugeInput[0].value = minVal;
      gaugeInput[1].value = maxVal;
      range.style.left = ((minVal / rangeInput[0].max) * 100) + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

// price Filters animation

const priceInput = document.querySelectorAll(".price-input input"),
amountInput = document.querySelectorAll(".price-gauge input"),
priceRange = document.querySelector(".slider-price .progress");
let amountGap = 1000;

// Gauge setting
amountInput.forEach(input =>{
  input.addEventListener("input", e =>{
    // Getting two ranges of value and parsing them to number
    let minNumber = parseInt(amountInput[0].value),
    maxNumber = parseInt(amountInput[1].value);
    
    if((maxNumber - minNumber >= amountGap) && maxNumber <= priceInput[1].max){
      if(e.target.className === "input-min"){ //If active, slider is min slider
        priceInput[0].value = minNumber;
        price.style.left = ((minNumber / priceInput[0].max) * 100) + "%";
      } else {
        priceInput[1].value = maxNumber;
        range.style.right = 100 - (maxNumber / priceInput[1].max) * 100 + "%";
      }
    }
  });
});

// Range setting
priceInput.forEach(input =>{
  input.addEventListener("input", e =>{
    // Getting two ranges of value and parsing them to number
    let minVal = parseInt(priceInput[0].value),
    maxVal = parseInt(priceInput[1].value);

    if((maxVal - minVal) < amountGap){
      if(e.target.className === "range-min"){
          priceInput[0].value = maxVal - amountGap
      } else {
          priceInput[1].value = minVal + amountGap;
      }
    } else {
      amountInput[0].value = minVal;
      amountInput[1].value = maxVal;
      range.style.left = ((minVal / priceInput[0].max) * 100) + "%";
      range.style.right = 100 - (maxVal / priceInput[1].max) * 100 + "%";
    }
  });
});

const cards = document.querySelectorAll('.card');
let brands = [];
for (let i = 0; i < cards.length; i++) {
  brands.push(cards[i].children[3].children[0].children[1].innerText);
}
let years = [];
for (let i = 0; i < cards.length; i++) {
  let date = cards[i].children[3].children[5].children[1].innerText;
  date = date.substring(10);
  years.push(date);
}

function filterElements (elementCards, elementSelected) {
  for (let i = 0; i < elementCards.length; i++) {
    if (elementCards[i] === elementSelected) {
      cards[i].style.display = "block";
    } else {
      cards[i].style.display = "none";
    }
  }
}

function selectDropDownList(dropFilter, elmtCards) {
  const optionMenu = document.querySelector(`.${dropFilter} .select-menu`),
    selectBtn = optionMenu.querySelector(`.${dropFilter} .select-btn`),
    options = optionMenu.querySelectorAll(`.${dropFilter} .option`),
    sBtn_text = optionMenu.querySelector(`.${dropFilter} .sBtn-text`);

  selectBtn.addEventListener("click", () => optionMenu.classList.toggle("active"));       

  options.forEach(option =>{
    option.addEventListener("click", ()=>{
      let selectedOption = option.querySelector(".option-text").innerText;
      sBtn_text.innerText = selectedOption;

      optionMenu.classList.remove("active");
      filterElements(elmtCards, sBtn_text.innerText);
    });
  });
}

// Brand select filter animation
selectDropDownList(`brand`, brands);
// Year select filter animation
selectDropDownList(`year`, years);