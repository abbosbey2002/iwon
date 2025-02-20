document.addEventListener("DOMContentLoaded", function () {
    function formatPhoneInput(input) {
        input.addEventListener("input", function (event) {
            let value = input.value.replace(/\D/g, ""); // Faqat raqamlarni olish
            let formattedValue = "";

            if (value.length > 0) formattedValue += value.substring(0, 2);
            if (value.length > 2) formattedValue += " " + value.substring(2, 5);
            if (value.length > 5) formattedValue += " " + value.substring(5, 7);
            if (value.length > 7) formattedValue += " " + value.substring(7, 9);
            if (value.length > 9) formattedValue += " " + value.substring(9, 11);

            input.value = formattedValue;
        });
    }

    document.querySelectorAll('input[name="phone"]').forEach(formatPhoneInput);
});

// timer input 

let timerElement = document.getElementById("timer");
let timeLeft = Number(timerElement.textContent);
let voucher = document.getElementById("voucher");
let verifyBtn = document.getElementById("verifyBtn");
let resentcodeBtn = document.getElementById("resentcodeBtn");
let timecontent = document.getElementById("timecontent");
let getvoucher = document.getElementById("getVoucher");
getvoucher.addEventListener("click", () => {
    timecontent.classList.remove("hidden");
    getvoucher.classList.add("hidden");

    let countdown = setInterval(() => {
        timeLeft--;
        // timerElement.textContent = timeLeft;
        timerElement.textContent = String(timeLeft).padStart(2, '0');

        if (timeLeft <= 0) {
            clearInterval(countdown);
            timecontent.classList.add("hidden");
            getvoucher.classList.remove("hidden");
        }
    }, 1000);

    voucher.addEventListener("input", () => {
        verifyBtn.disabled = voucher.value.length === 0;
    });
});



