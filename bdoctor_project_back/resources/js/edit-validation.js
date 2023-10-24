const specializations = document.querySelectorAll(".specialization");
const phoneNumber = document.querySelector(".phone-number");
const numberErrorField = document.querySelector(".number-error-field");
const labSpecializations = document.querySelectorAll(".label-specialization");
const errorAlertSpecialization = document.querySelector(
    ".error-alert-specialization"
);
const form = document.getElementById("doc-edit-form");
const avaiblebNumbers = /^[0-9]*$/;

specializations.forEach((specialization) => {
    specialization.addEventListener("change", (e) => {
        specialization.classList.remove("border-danger");
        // if (specialization.checked) {
        //     specialization.classList.remove("bg-white");
        //     specialization.classList.add("bg-success");
        // } else {
        //     specialization.classList.remove("bg-success");
        //     specialization.classList.add("bg-white");
        // }

        labSpecializations.forEach((labSpecialization) => {
            if (labSpecialization.id === specialization.value)
                labSpecialization.classList.remove("text-danger");
        });
    });
});
phoneNumber.addEventListener("keyup", (e) => {
    if (!phoneNumber.value.match(avaiblebNumbers)) {
        phoneNumber.classList.add("text-danger");
        numberErrorField.innerHTML = `<span class="text-danger">puoi inserire solo numeri</span>`;
    } else {
        phoneNumber.classList.remove("text-danger");
    }
});

form.addEventListener("submit", (e) => {
    e.preventDefault();
    specializations.forEach((specialization) => {
        if (
            specialization.checked &&
            phoneNumber.value.match(avaiblebNumbers)
        ) {
            form.submit();
            endForeach();
        }
    });
    labSpecializations.forEach((labSpecialization) => {
        labSpecialization.classList.add("text-danger");
    });
    specializations.forEach((specialization) => {
        specialization.classList.add("border-danger");
    });
    errorAlertSpecialization.innerHTML =
        "Devi inserire almeno una specializzazzione";
});
