function liveSearch(keywords, containers, targetFile) {
  const keyword = document.getElementById(keywords);
  const tombolCari = document.getElementById("tombolCari");
  const container = document.querySelector(containers);

  keyword.addEventListener("keyup", (e) => {
    // Object ajax
    const xhr = new XMLHttpRequest();
    // Cek kesiapan ajax
    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
          if(keyword.value.length > 3 || keyword.value.length == 0){
                container.innerHTML = xhr.responseText;
                console.log(keyword)
          }
      }
    };

    // Eksekusi ajax
    xhr.open(
      "GET",
      "assets/ajax/"+targetFile+"?keyword=" + keyword.value,
      true
    );
    xhr.send();
  });
}
