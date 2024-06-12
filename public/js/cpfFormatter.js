document.addEventListener("DOMContentLoaded", function () {
    var cpfInput = document.getElementById("cpf");

    cpfInput.addEventListener("keydown", function () {
        var cpf = cpfInput.value;
        cpf = cpf.replace(/\D/g, "");
        if (cpf.length > 3 && cpf.length < 7) {
            cpf = cpf.substring(0, 3) + "." + cpf.substring(3);
        } else if (cpf.length > 6 && cpf.length < 10) {
            cpf =
                cpf.substring(0, 3) +
                "." +
                cpf.substring(3, 6) +
                "." +
                cpf.substring(6);
        } else if (cpf.length >= 9) {
            cpf =
                cpf.substring(0, 3) +
                "." +
                cpf.substring(3, 6) +
                "." +
                cpf.substring(6, 9) +
                "-" +
                cpf.substring(9, 10);
        }
        cpfInput.value = cpf;
    });
});
