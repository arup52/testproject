<?php include 'header.php' ;?>
<style type="text/css">
    #unsuccess{
        width:300px;
        margin: 0 auto;
        height: 400px;
    }
    .error{
        color:red;
    }
 </style>
 <div id="unsuccess">
<center><b>The book you requested for is not available.</b></center>
<?php
    echo "<a href=http://localhost/CI/index.php/admin/panel>Back to Admin-Panel<br/></a>";
 ?>
</div>
<?php include 'footer.php' ;?>