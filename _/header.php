<div class="row"> 
  <header class="nologout">
    <div class="col-1">
      <div id="headleft">
        <?php
          if(isset($_SESSION['homeownerid'])) {
            echo '<h1><a href="home.php">Do-It-Yourself Helpers</a></h1>';
          }
          else {
            echo '<h1><a href="index.php">Do-It-Yourself Helpers</a></h1>';
          }
        ?>
      </div>
      <span id="sub">The semi-exotic oxymoronic blending of DIY and helping out will not only thrive in your community, it will thrive in your damn heart.</span>
    </div> <!-- end column --> 
  </header>
</div> <!-- end row -->