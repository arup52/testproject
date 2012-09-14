<?php include 'header.php' ;?>
<style type="text/css">
    #show-user{
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
<div id="show-user">
    <table>
        <?php if($users['id']==false) echo "<b>"."No books to reissue"."</b>"."</br>"; else {?>
        <tr>
            <td>User Name: </td>
            <td><?php echo $users['username']; ?></td>
        </tr>
        <tr>
             <td>Full Name  : </td>
             <td><?php echo $users['first_name']." ".$users['last_name']; ?></td>
        </tr>
        <tr>
            <td>Fine   : </td>
            <td><?php echo $users['fine']; ?></td>
        </tr>
        <?php
            $i=0;$c=count($users['title']);
            while($i<$c){ ?>
        <tr>
            <td><?php echo ($i+1); ?>   : </td>
            <td><?php echo $users['title'][$i]; ?></td>
        </tr>
        <?php $i++;} ?>

    </table>
 <?php
        echo "<a href=http://localhost/CI/index.php/admin/reissue>Reissue<br/></a>"; } ?>
<?php
    echo "<a href=http://localhost/CI/index.php/admin/panel>Back to Admin-Panel<br/></a>";?>
</div>
    <?php include 'footer.php' ;?>