<?php include 'header.php' ;?>
<style type="text/css">
    #list{
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
<div id="list">
<?php
$c=count($books);
$i=0; ?>
    <div>
        <ul>
            <h1>List of Books</h1>
    <?php    while($i<$c){ ?>
            <li>
                <?php //echo ($i+1).". ".$books[$i++]['title']."</br>";
                    echo "<a href=bookInfo/{$books[$i]['id']}>".($i+1).". {$books[$i++]['title']}</br></a>"; ?>
            </li>
    <?php }?>
        </ul>
    </div>
    <?php echo "<a href=panel>Back to panel<br/></a>"; ?>
</div>
<?php include 'footer.php' ;?>