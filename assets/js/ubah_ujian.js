console.log(soalUjians)
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
                console.log(jawabanById)
                jawabanById.checked = true
            }
        }
    no++
}
//TODO BACKEND JAWABAN