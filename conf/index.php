<?php
$startDate = explode("-", $conf['date_start']);
$endDate = explode("-", $conf['date_end']);
?>
    <div id="container">
      <div id="content_panel">
        <h1>About the Conference</h1>
        <p style="font-size: 14px;">
          The conference will be held at <?php echo $conf['location']; ?>
          and will feature some of the top researchers in the field presenting
          their research at sessions thoughout the weekend
          (<?php echo $startDate[1]."/".$startDate[2]."/".$startDate[0]; ?> to
          <?php echo $endDate[1]."/".$endDate[2]."/".$endDate[0]; ?>)
        </p>
      </div>
    </div>
