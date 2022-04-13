const selected = document.querySelector(".selected");
const optionsContainer = document.querySelector(".options-container");

const optionsList = document.querySelectorAll(".option");

const next = document.querySelector(".submit");

selected.addEventListener("click", () => {
  optionsContainer.classList.toggle("active");
});

optionsList.forEach(o => {
  o.addEventListener("click", () => {
    // console.log(o);
    selected.innerHTML = o.querySelector("label").innerHTML;
    optionsContainer.classList.remove("active");
    window.test = o.querySelector(".radio").value;
    // console.log(o.querySelector(".radio").value);
    // document.location.href = "?page=input_jawaban&id="+o.querySelector(".radio").value;
  });
});
function direct(){
  // console.log("ajg");
  // window.ppp = "PPP";
  // optionsList.forEach(o => {
  //   o.addEventListener("click", () => {
  //     console.log(window.test);
  //     // document.location.href = "?page=input_jawaban&id="+o.querySelector(".radio").value;
  //   });
  // });
}
direct();
// console.log(window.ppp);
