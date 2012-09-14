<?php include 'header.php' ;?>
<style type="text/css">
    #search-user{
        width:500px;
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
<div id="search-user">

        <h1>Search User By UserName</h1>
        <div>
            <?php if(isset ($loginError)) echo $loginError;
            ?>
        </div>
        <form  action="" method="post">
            <ul>
                <li>
                    <label for="username">User Name</label>
                    <div>
                        <input name="username" type="text" size="26" value="<?php echo set_value('title'); ?>" />
                        <?php echo form_error('username'); ?>
                    </div>
                </li>
                <li>
                    <label for="username"></label>
                    <div>
                       <input type="submit" value="Search" />
                       <input type="reset" size="26" value="Reset" />
                    </div>
                </li>
            </ul>
        </form>
        <?php echo "<a href=panel>Back to Admin-Panel<br/></a>"; ?>
</div>
<?php include 'footer.php' ;?>