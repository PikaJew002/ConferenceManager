<?php
$paperTitle = $_GET['title'];
$paper = new Paper($mysqli, $paperTitle);
$paper->getPaper();
$paper->getReviews();
$reviews = $paper->returnReviews();
$researcher = new Researcher($mysqli, $paper->getResearcherEmail());
$researcher->getResearcher();
?>
    <div id="content_view_panel">
      <div id="pdf_container" style="float: left; padding: 10px;">
        <embed id="paper_pdf" src="<?php echo "../papers/".md5($paperTitle).".pdf" ?>" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
      </div>
      <div id="abstract_container" style="float: left; padding: 10px;">
        Abstract: <br>
        <p style="padding-left: 10px;">
          <?php echo $paper->getAbstract(); ?>
        </p>
        Author info: <br>
        <p style="padding-left: 10px;">
          Name: <?php echo $researcher->getLastName().", ".$researcher->getFirstName(); ?><br>
          Email: <?php echo $researcher->getEmail(); ?><br>
        </p>
      </div>
      <div id="paper_reviews" style="float: left; padding: 10px;">
        <form action="index.php" method="post">
          <input type="hidden" name="title" value="<?php echo $paper->getTitle(); ?>">
        <?php if(count($reviews) < 3) { ?>
          <input type="submit" name="bid_paper" value="Bid"><br>
        <?php } else { echo "Bidding not available.<br>\n"; } ?>
          <input type="submit" name="go_back" value="Go Back">
        </form>
      </div>
    </div>
