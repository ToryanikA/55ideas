require('./bootstrap');

require('alpinejs');

import Inputmask from "inputmask";
let selectorPhone = document.getElementById("phone");
if (selectorPhone) {
    Inputmask({"mask": "+7 (999) 999-9999"}).mask(selectorPhone);
}
