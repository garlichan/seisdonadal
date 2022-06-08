const date = new Date();
const clickardia = (dia, mes) => {

    const months = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
    ];
    let elem = document.getElementById("fecha_reserva_aula");
    elem.value = dia + " de " + months[mes];
    let diasselect= document.querySelectorAll(".clickday");
    for (let index = 0; index < diasselect.length; index++) {
        diasselect[index].classList.remove("clickday");
    }
    
    document.getElementById(`dia-${dia}-${mes}`).classList.add("clickday");
}
const renderCalendar = () => {
    date.setDate(1);
    //array días
    const monthDays = document.querySelector(".days");

    //ultimo dia del mes actual
    const lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

    //ultimo dia del mes anterior
    const prevLastDay = new Date(date.getFullYear(), date.getMonth(), 0).getDate();

    //variable primer día del mes (que dia de la semana)
    const firstDayIndex = date.getDay() - 1;
    //ultimo dia siguiente mes
    const lastDayIndex = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDay();
    //
    const nextDays = 7 - lastDayIndex;
    //array meses
    const months = [
        "Enero",
        "Febrero",
        "Marzo",
        "Abril",
        "Mayo",
        "Junio",
        "Julio",
        "Agosto",
        "Septiembre",
        "Octubre",
        "Noviembre",
        "Diciembre",
    ];
    //cambio el valor del h1 al mes donde estamos
    document.querySelector('.date h1').innerHTML = months[date.getMonth()];

    var days = "";
    //bucle para que el mes empiece el dia correcto de la semana

    for (let x = firstDayIndex; x > 0; x--) {
        days += `<div class="prev-date">${prevLastDay - x +1}</div>`;
    }
    //bucle para coger dias del 1 al 30 o 31 (variable lastDay) y marcar el dia actual
    for (var i = 1; i <= lastDay; i++) {
        if (
            i === new Date().getDate() &&
            date.getMonth() === new Date().getMonth()
        ) {
            days += `<div class="today">${i}</div>`;
            let elem = document.getElementById("fecha_reserva_aula");
            elem.value = i + " de " + months[date.getMonth()];
        } else {
            days += `<div id="dia-${i}-${date.getMonth()}" onclick="clickardia(${i},${date.getMonth()})">${i}</div>`;
        }
    }
    //

    //
    for (var j = 1; j <= nextDays; j++) {
        days += `<div class="next-date">${j}</div>`;
        monthDays.innerHTML = days;
    }

};
//mes anterior
document.querySelector(".prevCalendar").addEventListener("click", () => {
    date.setMonth(date.getMonth() - 1);
    renderCalendar();
});
//mes siguiente
document.querySelector(".nextCalendar").addEventListener("click", () => {
    date.setMonth(date.getMonth() + 1);
    renderCalendar();
});

renderCalendar();