/**
 * Family Tree card - shows on load and stays visible
 */
document.addEventListener("DOMContentLoaded", () => {
  const card = document.getElementById("familyTreeCard");
  if (!card) return;
  setTimeout(() => card.classList.add("show"), 1500);
});
