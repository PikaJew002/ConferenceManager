function getPaperInfo() {
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
