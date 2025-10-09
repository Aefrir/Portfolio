const form = document.getElementById("element-form");
const elementSelect = document.getElementById("elementSelector");
const text = document.getElementById("text");
const fontFamily = document.getElementById("fontSelector");
const bgColor = document.getElementById("input-bg-color");
const textColor = document.getElementById("input-text-color");
const fontSize = document.getElementById("input-font-size");
const submit = document.getElementById("submit");
// const deleteEl = document.getElementById("delete");

form.addEventListener("submit", (event) => {event.preventDefault();})
fontFamily.addEventListener("input", change);
bgColor.addEventListener("input", change);
textColor.addEventListener("input", change);
fontSize.addEventListener("input", change);
submit.addEventListener("click", addElement);
// deleteEl.addEventListener("click", deleteElement)

function addElement(){
  const element = document.createElement(elementSelect.value);
  const textNode = document.createTextNode(text.value);
  element.appendChild(textNode);

  element.addEventListener("click", function() {
    if (confirm("Are you sure you want to delete this element?")) {
      element.parentNode.removeChild(element);
    }
  });
  element.style.cursor = "pointer";
  document.querySelector("#container").appendChild(element);
}

// function deleteElement(){
//   const child = document.querySelector(elementSelect.value); 
//   if (child && child.parentNode) { // Verifies if the child and the parentNode actually exists
//     child.parentNode.removeChild(child);
//   } 
//   else {
//     alert("Element not found.");
//   }
// }

function change() {
  const elements = document.querySelector("#container"); // For the elements
  const body = document.querySelector("body"); // For the background
  elements.style.color = textColor.value;
  elements.style.fontFamily = fontFamily.value;
  elements.style.fontSize = fontSize.value + "px";
  body.style.backgroundColor = bgColor.value;
}