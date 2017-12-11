function getPaperInfo(key) {
  var title = document.getElementById("paper_"+key).getAttribute("title");
  var abstract = document.getElementById("paper_abstract_"+key).innerHTML;
  document.getElementById("paper_pdf").setAttribute("src", title);
  document.getElementById("paper_ab").innerHTML = abstract;

  if(document.getElementById("content_view_panel").hasAttribute("hidden")) {
    document.getElementById("content_view_panel").removeAttribute("hidden");
  }
}
