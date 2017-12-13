
      <div id="container">
        <div id="sub_container">
<?php
$query = "SELECT * FROM conferences";
if($result = $mysqli->query($query)) {
  while($row = $result->fetch_assoc()) {
    $startDate = explode("-", $row['date_start']);
    $endDate = explode("-", $row['date_end']);
?>
          <div class="sub_box">
            <div class="content">
              <h2><a href="conference.php?name=<?php echo $row['name']; ?>"><?php echo $row['name']; ?></a></h2>
              <p>
                Location: <br>
                <?php echo $row['location']; ?><br>
                Start Date: <br>
                <?php echo $startDate[1]."/".$startDate[2]."/".$startDate[0]; ?><br>
                End Date: <br>
                <?php echo $endDate[1]."/".$endDate[2]."/".$endDate[0]; ?><br>
              </p>
            </div>
          </div>
<?php
  }
}
?>
        </div>
      </div>
