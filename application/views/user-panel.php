<?php include 'header.php'; ?>
<style type="text/css">
    #panel{
        width:300px;
        margin: 0 auto;
        height: 400px;
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

        <h1>User PANEL</h1>
        <div>
            <ul>
                <li>
                    <?php echo "<a href=profile>My Profile<br/></a>"; ?>
                </li>
                <li>
                    <?php echo "<a href=userUpdateProfile>Update Profile<br/></a>"; ?>
                </li>
                <li>
                    <?php echo "<a href=myBooks>My books<br/></a>"; ?>
                </li>
                <li>
                    <?php echo "<a href=allBooks>All Books<br/></a>" ;?>
                </li>
                <li>
                    <?php echo "<a href=searchBook>Search Books<br/></a>"; ?>
                </li>
            </ul>
        </div>
</div>
<?php  include 'footer.php'; ?>