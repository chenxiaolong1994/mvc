<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title></title>
    <link rel="stylesheet" href="public/css/bootstrap.min.css">

</head>
<body>

<table class="table">
    <tr>
        <th>编号</th>
        <th>标题</th>
        <th>作者</th>
        <th>内容</th>
    </tr>
    <?php foreach ($data as $v) { ?>
        <tr>
            <td> <?php echo $v['id'];  ?> </td>
            <td> <?php echo $v['title'];  ?> </td>
            <td> <?php echo $v['author'];  ?> </td>
            <td> <?php echo $v['content'];  ?> </td>
        </tr>
    <?php  } ?>
</table>


</body>
</html>