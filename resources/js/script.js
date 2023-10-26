function redirExcel() {
    var excelButton = document.getElementById("redirExcel");

    if (excelButton) {
        excelButton.addEventListener("click", function () {
            setTimeout(function () {
                window.location.href = "/views/testing.php";
            }, 2000);
        });
    }
}

function redirDVWA() {
    var dvwaButton = document.getElementById("redirDVWA");

    if (dvwaButton) {
        dvwaButton.addEventListener("click", function () {
            setTimeout(function () {
                window.location.href = "/views/testing.php";
            }, 2000);
        });
    }
}

// Panggil Fun nya di akhir
redirExcel();
redirDVWA();