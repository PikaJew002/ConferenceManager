<?php
if($_GET['title']) {
    $paperTitle = $_GET['title'];
}
$paper = new Paper($mysqli, $paperTitle);
$paper->getPaper();
$paper->getReviews();
$reviews = $paper->returnReviews();
$researcher = new Researcher($mysqli, $paper->getResearcherEmail());
$researcher->getResearcher();
?>
    <div id="content_view_panel">
      <div id="paper_title" style="padding: 10px; width: 100%;">
        <h1><?php echo $paperTitle; ?></h1>
      </div>
      <div id="pdf_container" style="float: left; padding: 10px; width: 620px;">
        <h3>PDF</h3>
        <embed id="paper_pdf" src="<?php echo "../papers/".md5($paperTitle).".pdf" ?>" width="600" height="500" alt="pdf" pluginspage="http://www.adobe.com/products/acrobat/readstep2.html">
      </div>
      <div id="abstract_container" style="float: left; padding: 10px; width: 500px;">
        <h3>Details</h3>
        <u>Author info:</u><br>
        <p style="padding-left: 10px;">
          Name: <em><?php echo $researcher->getLastName().", ".$researcher->getFirstName(); ?></em><br>
          Email: <em><?php echo $researcher->getEmail(); ?></em><br>
        </p>
        <u>Abstract:</u><br>
        <p style="padding-left: 10px;">
          <?php echo $paper->getAbstract(); ?>
        </p>
      </div>
      <div id="paper_reviews" style="float: left; padding: 10px;">
        <h3>Review</h3>
        <table>
          <tr>
<?php
foreach ($reviews as $review) {
  $reviewer = new Reviewer($mysqli, $review['reviewer_email']);
  $reviewer->getReviewer();
?>
          <td>
            Reviewer: <?php  ?><br>
            Email: <?php  ?><br>
          </td>
<?php } ?>
          </tr>
        </table>
        <form action="index.php" method="post">
          <input type="hidden" name="title" value="<?php echo $paper->getTitle(); ?>">
          Accept: <input type="checkbox" name="is_accepted" value="1"><br>
          <input type="submit" name="bid_paper" value="Bid"><br>
          <input type="submit" name="go_back" value="Go back">
        </form>
      </div>
    </div>

<?php    /*
Amide bond formation is a fundamentally important reaction in organic synthesis, and is
typically mediated by one of a myriad of so-called coupling reagents. This critical review is
focussed on the most recently developed coupling reagents with particular attention paid to the
pros and cons of the plethora of ‘‘acronym’’ based reagents. It aims to demystify the process
allowing the chemist to make a sensible and educated choice when carrying out an amide
coupling reaction (179 references)
    */?>
