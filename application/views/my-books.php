<?php include 'header.php' ;?>
<style type="text/css">
    #my-books{
        width:300px;
        margin: 0 auto;
        height: 400px;
    }
    ul {
        list-style: none;
        border: 1px solid #b4b4b4;
        padding:15px;
    }
    .error{
        color:red;
    }
</style>
<div id="my-books">
<?php
$c=count($books);
if($c==0) echo 'You have No issued Books'."<br>";
else{
$i=0; ?>
    <div>
        <ul>
            <h1>List of Books</h1>
    <?php    while($i<$c){ ?>
            <li>
                <?php echo ($i+1).". ".$books[$i]['title']."  Status: ".$books[$i++]['status']."</br>"; ?>
            </li>
    <?php }?>
            <li>
                Fine: <?php echo $books[0]['fine']."<br>"; }?>
            </li>
        </ul>
    </div>
    <?php echo "<a href=panel>Back to User-Panel<br/></a>"; ?>
</div>
<?php include 'footer.php' ;?>