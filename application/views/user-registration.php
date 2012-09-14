<?php include 'header.php' ;?>
<style type="text/css">
    #user-reg{
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
<div id="user-reg">
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
                        <input name="password" type="password" size="26" value="" />
                        <?php echo form_error('password'); ?>
                    </div>
                </li>
                <li>
                    <label for="type">Type</label>
                    <div>
                        <input name="type" type="radio" size="26" value="student" checked="yes"/>student<br>
<!--                        <input type="radio" name="type" value="admin" />admin<br />-->
<!--                        <input type="text" name="type" value="student" />-->
                        <?php echo form_error('type'); ?>
                    </div>
                </li>
                <li>
                    <label for="submit"></label>
                    <div>
                       <input type="submit" value="Register" />
                       <input type="reset" size="26" value="Reset" />
                    </div>
                </li>
            </ul>
        </form>
</div>

<?php include 'footer.php' ;?>