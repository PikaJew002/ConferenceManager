    <div id="container">
      <div id="content_panel">
        <form enctype="multipart/form-data" action="index.php" method="post"<?php echo (isset($uploaded) ? " hidden" : ""); ?>>
          Paper Title: <br>
          <input type="title" name="title" maxlength="200" size="100"><br>
          Abstract: <br>
          <textarea name="abstract"></textarea><br>
          File: <br>
          <input type="file" name="paper"><br>
          <input type="submit" name="upload_paper" value="Upload Paper"><br>
        </form>
        <?php echo $msg; ?>
      </div>
    </div>
