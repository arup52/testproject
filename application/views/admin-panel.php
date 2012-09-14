<?php include 'header.php' ;?>
<style type="text/css">
    #panel{
        width:300px;
        margin: 0 auto;
        height:400px;
    }
    ul {
/*        list-style: none;*/
        border: 1px solid #b4b4b4;
        padding:15px;
    }
    .error{
        color:red;
    }
</style>
<div id="panel">

        <h1>ADMIN PANEL</h1>
        <div>
            <ul>
                <li>
                    <?php echo "<a href=addBook>Add Book<br/></a>"; ?>
                </li>
                <li>
                    <?php echo "<a href=allBooks>Book List<br/></a>"; ?>
                </li>
                <li>
                    <?php echo "<a href=searchBook>Search Book<br/></a>" ;?>
                </li>
                <li>
                    <?php echo "<a href=updateBorrower>Update Borrower Info<br/></a>" ;?>
                </li>
                <li>
                    <?php echo "<a href=preReissue>Reissue<br/></a>" ;?>
                </li>
                <li>
                    <?php echo "<a href=issue>Issue<br/></a>" ;?>
                </li>
            </ul>
        </div>
</div>
<?php include 'footer.php' ;?>