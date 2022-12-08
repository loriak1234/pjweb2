"use strict";

window.addEventListener("load", function() {
  var orderForm = document.forms.orderForm;

  calcOrder();

  // Event handlers for the web form
  for (var i = 0; i < orderForm.elements.qty.length; i++) {
    orderForm.elements.qty[i].onchange = calcOrder;
  }

});

// Calc total
function calcOrder() {
  var orderForm = document.forms.orderForm;

  // Calculate the initial cost of the order
  var mIndex = new Array();
  for (var i = 0; i < orderForm.elements.modelPrice.length; i++) {
    mIndex[i] = orderForm.elements.modelPrice[i].value;
  }
  
  var quantity = new Array();
  for (var i = 0; i < orderForm.elements.qty.length; i++) {
    quantity[i] = orderForm.elements.qty[i].value;
  }
  // subTotalRow = model cost x quantity

  var subTotalRow = new Array();
  // Calculate the subTotalRow
  for (var i = 0; i < orderForm.elements.subTotalRow.length; i++) {
    console.log('hi');
    subTotalRow[i] = mIndex[i] * quantity[i];
    orderForm.elements.subTotalRow[i].value = formatUSCurrency(subTotalRow[i]);
  }
 
//   SubTotal
  var calSubTotalRow = 0;
  for (var i = 0; i < orderForm.elements.subTotalRow.length; i++) {
    calSubTotalRow += subTotalRow[i];
  }
  orderForm.elements.subTotal.value = formatNumber(formatUSCurrency(calSubTotalRow), 2);
  

  // Calculate Tax(10%)
  var calTax = 0.1 * (calSubTotalRow)
  orderForm.elements.Tax.value = formatNumber(formatUSCurrency(calTax), 2);

  // Calculate the cost of the total order
  var totalCost = calSubTotalRow + calTax;
  orderForm.elements.Total.value =formatNumber(formatUSCurrency(totalCost), 2);
}


function formatNumber(val, decimals) {
  return val.toLocaleString(undefined, {
    minimumFractionDigits: decimals,
    maximumFractionDigits: decimals
  });
}

function formatUSCurrency(val) {
  return val.toLocaleString('en-US', {
    style: "currency",
    currency: "USD"
  });
}