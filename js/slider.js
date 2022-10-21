const tradeprice_slider = document.querySelector("#product_tradePrice");
const retailprice_slider = document.querySelector("#product_retailPrice");
const quantity_slider = document.querySelector("#product_quantity");

const tradeprice_display = document.querySelector("#tradePrice_display");
const retailprice_display = document.querySelector("#retailPrice_display");
const quantity_display = document.querySelector("#quantity_display");


// Display the default slider value
tradeprice_display.innerHTML = tradeprice_slider.value;
retailprice_display.innerHTML = retailprice_slider.value;
quantity_display.innerHTML = quantity_slider.value;


// Update the current slider value (each time you drag the slider handle)
tradeprice_slider.oninput = function() {
    tradeprice_display.innerHTML = this.value;
}

retailprice_slider.oninput = function() {
    retailprice_display.innerHTML = this.value;
}

quantity_slider.oninput = function() {
    quantity_display.innerHTML = this.value;
}