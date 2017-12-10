function getPaperInfo() {
  var title = document.getElementById("paper_a").getAttribute("title");
  var abstract = document.getElementById("paper_abstract").text;
  document.getElementById("paper_pdf").setAttribute("src", title);

  if(document.getElementById("content_view_panel").hasAttribute("hidden")) {
    document.getElementById("content_view_panel").removeAttribute("hidden");
  }
}
