<style type="text/css">
    #login{
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
    #l-header{
        width: 300px;
        margin: 0 auto;
    }
</style>
<div id="l-header">
        <h1><font color="red"><center>Library Management System</center></font></h1>
</div>
<div id="login">
        <div>
            <?php if(isset ($loginError)) echo $loginError;
            ?>
        </div>
        <form  action="" method="post">
            <ul>
                <li>
                    <label for="user_name">Username</label>
                    <div>
                        <input name="user_name" type="text" size="26" value="<?php echo set_value('user_name'); ?>" />
                        <?php echo form_error('user_name'); ?>
                    </div>
                </li>
                <li>
                    <label for="password">Password</label>
                    <div>
                        <input name="password" type="password" size="26" value="<?php echo set_value('password'); ?>" />
                        <?php echo form_error('password'); ?>
                    </div>
                </li>
                <li>
                    <label for="user_name"></label>
                    <div>
                       <input type="submit" value="Login" />
                       <input type="reset" size="26" value="Reset" />
                    </div>
                </li>
            </ul>
        </form>
        <div>
            <a href="http://localhost/CI/index.php/user/userRegistration">Registration Page</a>
        </div>
</div>
<?php include 'footer.php' ;?>