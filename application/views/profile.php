<?php include 'header.php' ;?>
<style type="text/css">
    #profile{
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
<div id="profile">
    <ul>
    <table>
        <tr>
            <td>Full Name:</td>
            <td><?php echo $user['first_name'] . ' ' .$user['last_name'] ?></td>
        </tr>
        <tr>
            <td>User Name:</td>
            <td><?php echo $user['username']?></td>
        </tr>

        <tr>
            <td>Privilege:</td>
            <td><?php echo $user['type']?></td>
        </tr>
    </table>
        </ul>
    <?php
    echo "<a href=panel>Back to User-Panel<br/></a>"; ?>
</div>
<?php include 'footer.php' ;?>