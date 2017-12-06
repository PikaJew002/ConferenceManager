function setNumDaysStart() {
  var year = document.getElementById("start_year");
  var month = document.getElementById("start_month");
  var day = document.getElementById("start_day");
  var len = getNumDays(year.value, month.value);
  while (day.options.length) {
    day.remove(0);
  }
  for (var i = 1; i <= len; i++) {
    var option = document.createElement("option");
    option.setAttribute("value", i);
    option.innerHTML = i;
    day.appendChild(option);
  }
}
function setNumDaysEnd() {
  var year = document.getElementById("end_year");
  var month = document.getElementById("end_month");
  var day = document.getElementById("end_day");
  var len = getNumDays(year.value, month.value);
  while (day.options.length) {
    day.remove(0);
  }
  for (var i = 1; i <= len; i++) {
    var option = document.createElement("option");
    option.setAttribute("value", i);
    option.innerHTML = i;
    day.appendChild(option);
  }
}
function getNumDays(year, month) {
  if(month == 2) {
    if(((year % 4 == 0) && (year % 100 != 0)) || (year % 400 == 0)) {
      return 29;
    } else {
      return 28;
    }
  } else if(month == 4 || month == 6 || month == 9 || month == 11) {
    return 30;
  } else {
    return 31;
  }
}
