"use strict";

const CART_KEY = "unicorn_cart";

function getCart() {
  return JSON.parse(localStorage.getItem(CART_KEY) || "[]");
}

function saveCart(cart) {
  localStorage.setItem(CART_KEY, JSON.stringify(cart));
}

function updateBadge() {
  const total = getCart().reduce((s, i) => s + i.qty, 0);
  document
    .querySelectorAll(".cart-count")
    .forEach((el) => (el.textContent = total));
}

// Sync badge au chargement
updateBadge();
