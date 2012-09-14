<?php include 'header.php' ;?>
<style type="text/css">
    #add-book{
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
<div id="add-book">

        <form  action="" method="post">
            <ul>
                <li>
                    <label for="title">Title</label>
                    <div>
                        <input name="title" type="text" size="32" value="" />
                        <?php echo form_error('title'); ?>
                    </div>
                </li>
                <li>
                    <label for="code">Code</label>
                    <div>
                        <input name="code" type="text" size="32" value="" />
                        <?php echo form_error('code'); ?>
                    </div>
                </li>
                <li>
                    <label for="author">Author</label>
                    <div>
                        <input name="author" type="text" size="32" value="" />
                        <?php echo form_error('author'); ?>
                    </div>
                </li>
                <li>
                    <label for="type">Type</label>
                    <div>
                        <input name="type" type="text" size="26" value="" />
                        <?php echo form_error('type'); ?>
                    </div>
                </li>
                <li>
                    <label for="availability">Availability</label>
                    <div>
                        <input name="availability" type="" size="26" value="" />
                        <?php echo form_error('availability'); ?>
                    </div>
                </li>
                <li>
                    <label for="user_name"></label>
                    <div>
                       <input type="submit" value="Insert" />
                       <input type="reset" size="26" value="Reset" />
                    </div>
                </li>
            </ul>
        </form>
        <?php echo "<a href=panel>back to Admin-Panel<br/></a>"; ?>
</div>

<?php include 'footer.php' ;?>