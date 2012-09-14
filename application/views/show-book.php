<?php include 'header.php' ;?>
<style type="text/css">
    #show-books{
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
<div id="show-books">
    <?php if($books['title']){ ?>
    <table>
        <tr>
            <td>Book Name: </td>
            <td><?php echo $books['title']; ?></td>
        </tr>
        <tr>
             <td>Book Id  : </td>
             <td><?php echo $books['code']; ?></td>
        </tr>
        <tr>
            <td>Author   : </td>
            <td><?php echo $books['author']; ?></td>
        </tr>
        <tr>
            <td>Book Type: </td>
            <td><?php if($books['type']) echo 'Text Book'; else echo 'Reference Book'; ?></td>
        </tr>
        <tr>
            <td>Availability: </td><td><?php if($books['availability']) echo 'Book Available'; else echo 'Book Not Available'; ?></td>
        </tr>
    </table>
    <?php
        $i=1;
    }
    else{
        $i=0;
        echo "<b>".'There is no such book'."</b></br>";
    } ?>
<?php
   if($i==1 && $books['user_type']=='admin'){
            echo "<a href=http://localhost/CI/index.php/admin/updateBook/{$books['id']}>Update This Book<br/></a>";
            echo "<a href=http://localhost/CI/index.php/admin/deleteBook/{$books['id']}>Delete This Book<br/></a>";
            echo "<a href=http://localhost/CI/index.php/admin/panel>Back to admin-panel<br/></a>";
    }
    else if($books['user_type']=='admin')
        echo "<a href=http://localhost/CI/index.php/admin/panel>Back to Admin-Panel<br/></a>";
    else
        echo "<a href=http://localhost/CI/index.php/user/panel>Back to User-Panel<br/></a>"; ?>
    </div>
<?php include 'footer.php' ;?>