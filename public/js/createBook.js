/** @type {HTMLTextAreaElement} */
const textArea = document.querySelector("#description");

textArea.addEventListener("input", () => {
  textArea.style.height = textArea.scrollHeight + "px";
});
