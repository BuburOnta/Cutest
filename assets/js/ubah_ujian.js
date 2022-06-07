// console.log(soalUjians)
let no = 1;
for (let i = 0; i < soalUjians.length; i++) {
    const jawabanByIds = document.querySelectorAll(".jawaban"+no)
    const soalUjian = soalUjians[i]
    // console.log(soalUjian)

        // console.log(jawabanByIds)
        for (let z = 0; z < jawabanByIds.length; z++) {
            const jawabanById = jawabanByIds[z];
            // console.log(jawabanById)
            if(soalUjian.jawaban == jawabanById.value) {
                // console.log(jawabanById)
                jawabanById.checked = true
            }
        }
    no++
}
//TODO BACKEND JAWABAN

//! Checkbox Effect
function toggle(source) {
  var checkboxes = document.querySelectorAll('#kelas');
  for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i] != source)
          checkboxes[i].checked = source.checked;
  }
}


//! Close Peringatan
const closePeringatan = document.querySelector(".peringatan-close")
console.log(closePeringatan.parentElement.parentElement)
closePeringatan.addEventListener("click", () => {
    closePeringatan.parentElement.parentElement.classList.add("animate-close-peringatan")
})