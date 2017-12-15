<?php
if($_GET['email']) {
  $email = $_GET['email'];
} else if($_POST['email']) {
  $email = $_POST['email'];
}
$reviewer = new Reviewer($mysqli, $email);
$reviewer->getReviewer();
?>
    <div id="content_view_panel">
      <div id="abstract_container" style="float: left; padding: 10px; padding-right: 0px; width: 350px;">
        <h3>Reviewer</h3>
        <p>
          Name: <br>
          <em><?php echo $reviewer->getLastName().", ".$reviewer->getFirstName(); ?></em><br>
          Email: <br>
          <em><?php echo $reviewer->getEmail(); ?></em><br>
<?php if(!empty($reviewer->getPhone())) { ?>
          Phone: <br>
          <em><?php echo $reviewer->getPhone(); ?></em><br>
<?php } ?>
<?php if($reviewer->getIsAuth() == 0) { ?>
          <form action="conference.php" method="post">
            <input type="hidden" name="name" value="<?php echo $conf->getName(); ?>">
            <input type="hidden" name="page" value="reviewer">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="submit" name="authenticate_reviewer" value="Authenticate">
          </form>
<?php } ?>
          <form action="conference.php" method="post">
            <input type="hidden" name="name" value="<?php echo $conf->getName(); ?>">
            <input type="hidden" name="page" value="reviewers">
            <input type="submit" name="go_back" value="Go back">
          </form>
          <?php echo $msg; ?>
        </p>
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
