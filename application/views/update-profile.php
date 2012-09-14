<?php include 'header.php' ;?>
<style type="text/css">
    #update-profile{
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
<div id="update-profile">

        <form  action="" method="post">
            <ul>
                <li>
                    <label for="username">User Name</label>
                    <div>
                        <input name="username" type="text" size="32" value="" />
                        <?php echo form_error('username'); ?>
                    </div>
                </li>
                <li>
                    <label for="first_name">First Name</label>
                    <div>
                        <input name="first_name" type="text" size="32" value="" />
                        <?php echo form_error('first_name'); ?>
                    </div>
                </li>
                <li>
                    <label for="last_name">Last Name</label>
                    <div>
                        <input name="last_name" type="text" size="32" value="" />
                        <?php echo form_error('last_name'); ?>
                    </div>
                </li>
                <li>
                    <label for="password">Password</label>
                    <div>
                        <input name="password" type="text" size="26" value="" />
                        <?php echo form_error('password'); ?>
                    </div>
                </li>
                <li>
                    <label for="submit"></label>
                    <div>
                       <input type="submit" value="Update" />
                       <input type="reset" size="26" value="Reset" />
                    </div>
                </li>
            </ul>
        </form>
        <?php echo "<a href=panel>back to User-Panel<br/></a>"; ?>
</div>

<?php include 'footer.php' ;?>