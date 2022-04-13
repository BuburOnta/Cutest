// Checkbox Effect
function toggle(source) {
  var checkboxes = document.querySelectorAll('#kelas');
  for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] != source)
          checkboxes[i].checked = source.checked;
  }
}

// Input Files Effect
const fil = document.getElementById("files");
const teks = document.querySelector(".tambah");
const plus = document.getElementById("plus");
fil.addEventListener("change", function (e) {
  let newText = fil.value.replace("C:\\fakepath\\", "");
  teks.innerHTML = newText;
  teks.style.textDecoration = "underline";
  plus.style.display = 'none';
});
