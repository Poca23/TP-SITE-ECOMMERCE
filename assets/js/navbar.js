"use strict";

const burger = document.querySelector(".nav-burger");
const links = document.querySelector(".navbar__links");

if (burger && links) {
  burger.addEventListener("click", () => {
    links.classList.toggle("navbar__links--open");
  });
}
