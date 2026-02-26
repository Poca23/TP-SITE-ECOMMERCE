'use strict';

const STORAGE_KEY = 'unicorn_cart';
const cart = JSON.parse(localStorage.getItem(STORAGE_KEY) || '[]');

const save = () => localStorage.setItem(STORAGE_KEY, JSON.stringify(cart));

const updateCount = () => {
  const total = cart.reduce((sum, i) => sum + i.qty, 0);
  document.querySelectorAll('.cart-count').forEach(el => el.textContent = total);
};

const addToCart = ({ id, name, price }) => {
  const existing = cart.find(i => i.id === id);
  existing
    ? existing.qty++
    : cart.push({ id, name, price: parseFloat(price), qty: 1 });
  save();
  updateCount();
};

document.querySelectorAll('.btn-cart').forEach(btn => {
  btn.addEventListener('click', () => {
    addToCart(btn.dataset);
    btn.textContent = '✅ Ajouté !';
    setTimeout(() => (btn.textContent = '🛒 Ajouter'), 1200);
  });
});

updateCount();
