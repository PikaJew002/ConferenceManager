function getPaperInfo() {
  var title = document.getElementById("paper_a").getAttribute("title");
  alert(title);
  document.getElementById("paper_pdf").setAttribute("src", "title");
  document.getElementById("content_view_panel").removeAttribute("hidden");
}
