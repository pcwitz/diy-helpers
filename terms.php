<?php
  session_start();
?><!DOCTYPE html>
<html lang=en>
  <head>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="diyhelpers.css">
    <title>About Do-It-Yourself Helpers</title>    
  </head>
  <body>
  <div class="page-wrap">

      <div class="row">   
        <div class="col-1">
          <nav>
          <?php
            if(isset($_SESSION['homeownerid']))
            {
              echo
               "<a id='left' href='about.php'>about</a>
              <a id='center' href='home.php'><span class='icon-home'></span><span class='alt-text'>home</span></a>
              <a id='right' href='resources.php'>resources</a>";
            }
            else
            {
              echo
               "<a id='left' href='about.php'>about</a>
              <a id='center' href='registration.php'>REGISTER</a>
              <a id='right' href='resources.php'>resources</a>";
            }
          ?>
          </nav> 
        </div>
      </div>

    <?php include('_/header.php'); ?>
    
    <h2>Terms and Conditions:</h2>
    
      <p>You shall not steal; you shall not rob; you shall not cheat your
      fellow (<i>Vayikra</i> 19:11-13).
      
      <p>The wicked one borrows but does not repay (<i>Tehillim</i> 37:21).</p>

      <p>When a person borrows an object, he is required to guard it
      conscientiously from loss, theft, or mishap, from the time he
      accepts responsibility for it. If he is negligent in protecting it,
      he is required to pay for any damage that ensues (<i>Choshen
      Mishpat</i> 291:1).</p>

      <p>Someone who borrows an object has no right to rent or lend it to
      others without the permission of the owner (ibid. 342:1).</p>

      <p>If an object is borrowed and it broke during normal usage, the
      borrower is free from liability (ibid. 340:1).</p>

      <p>A borrower's liability does not terminate unless he returns the
      borrowed object directly to its owner and not to the owner's wife or
      children, unless the owner's wife manages his fiscal affairs, or if
      the owner gives him specific permission to do so or to send the
      object back with some other person (ibid. 340:8, <i>Rema</i>).</p>

      <p>If an object is lent for a specific time period, the lender
      cannot insist on its return once the borrower takes the object into
      his possession until the specified time. If no time period was
      specified, the lender has the right to demand that the object be
      returned to him whenever he wishes (ibid. 341:1).</p>
      
      <p>If an object was lent for a specific time period, the borrower
      may no longer use the object after that period is over. However, he
      must still guard the object (ibid. 340:8).</p>

      <p>It is forbidden to deviate in any way from the owner's
      instructions concerning a borrowed object or to make any use of it
      except as the owner allows; anyone who does so is considered a
      thief. It is also forbidden to keep an object any longer than was
      originally agreed upon, unless the owner gives his express
      permission (<i>Ahavas Chesed</i> Part 2, Ch.22).</p>
      
      <p>If a borrower fails to return a loan [i.e., tool] on his own
      initiative and the lender must turn to <i>beis din</i> to recover
      his money [i.e., tool], the <i>beis din</i> has the power to
      confiscate all the borrower's possessions (except his work tools),
      leaving him only enough funds to buy food for thirty days, clothing
      for twelve months, and rent for a specific period. In addition, the
      lender has the right to seize all other property belonging to the
      borrower, including his house, furniture and <i>sefarim</i>.  The
      borrower may not even retain provisions for for his wife and
      children, since everything he owns is considered collateral on the
      unpaid debt [i.e., tools] (<i>Choshen Mishpat</i> 97:23-29).</p>
      
      <p>As long as a stolen object is still in its original form, a thief
      is obligated to return it to its owner rather than replace it or pay
      for it, as the <i>Torah</i> says (<i>Vayikra</i> 5:23): He shall return the
      theft which he stole. If, however, the stolen object has been
      transformed to the point that it cannot be restored to its original
      form, or if the object has been used in construction and cannot be
      recovered without tearing down the building, then the thief may pay
      the owner the value of the object at the time of the theft
      (<i>Choshen Mishpat</i> 358:1, 360:1).</p>

      <p>Any individual who damages another person's property is required
      to make full restitution, unless the circumstances of the damage are
      completely out of his control (ibid. 386:3, <i>Rema</i>).</p>

</div><!--end page-wrap-->

 
    <footer>
      <div class="row"> 
        <small>A Perry Abramowitz Production | &phone; 800-diy-help | All rights reserved | &copy;2014</small>
      </div>
        <div class="row">   
          <nav>
          <?php
            if(isset($_SESSION['homeownerid']))
            {
              echo
               "<a id='left' href='about.php'>about</a>
              <a id='center' href='home.php'><span class='icon-home'></span><span class='alt-text'>home</span></a>
              <a id='right' href='resources.php'>resources</a>";
            }
            else
            {
              echo
               "<a id='left' href='about.php'>about</a>
              <a id='center' href='registration.php'>REGISTER</a>
              <a id='right' href='resources.php'>resources</a>";
            }
          ?>
          </nav> 
        </div>
    </footer>
  </body>
</html>