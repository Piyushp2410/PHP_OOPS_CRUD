<?php
//includ model 
include 'model.php';

$obj = new model();

// insert data
if (isset($_POST['submit'])) {
    $obj->insetRecord($_POST);
} //if isset close

// update data
if (isset($_POST['update'])) {
    $obj->updateRecord($_POST);
} //if isset close

//delete data
if (isset($_GET['deleteid'])) {
    $deleteid = $_GET['deleteid'];
    $record = $obj->deleteRecordById($deleteid);
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/bootstrap5.0.1.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/datatables-1.10.25.min.css" />
    <title>CRUD Operation in PHP OOPS</title>
</head>

<body>
    <H2 class="text-center text-info">CRUD Operation in PHP using OOPS</H2><br>
    <div class="container">
        <!-- success message -->
        <?php
        if (isset($_GET['msg']) and $_GET['msg'] == 'ins') {
            echo '<div class="alert alert-primary" role="alert">
                Record Insert Successfuly...!!!
                </div>';
        }
        //edit message
        if (isset($_GET['msg']) and $_GET['msg'] == 'ups') {
            echo '<div class="alert alert-primary" role="alert">
                Record updated Successfuly...!!!
                </div>';
        }
        //delete message
        if (isset($_GET['msg']) and $_GET['msg'] == 'del') {
            echo '<div class="alert alert-danger" role="alert">
                Record Deleted Successfuly...!!!
                </div>';
        }
        //fetch record for update
        if (isset($_GET['editid'])) {
            $editid = $_GET['editid'];
            $record = $obj->displayRecordById($editid);

        ?>
            <!-- Update form -->
            <form action="index.php" method="post">
                <div class="form-group p-2">
                    <label>Name</label>
                    <input type="text" name="name" value="<?php echo $record['name']; ?>" placeholder="Enter Your Name Here" class="form-control" Required>
                </div>
                <div class="form-group p-2">
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $record['email']; ?>" placeholder="Enter Your Email" class="form-control" Required>
                </div>
                <div class="form-group p-2">
                    <input type="hidden" name="hid" value="<?php echo $record['id']; ?>">
                    <input type="submit" name="update" value="update" class="btn btn-info">
                </div>
            </form>

        <?php
        } else {
        ?>
            <!-- Register form -->
            <form action="index.php" method="post">
                <div class="form-group p-2">
                    <label>Name</label>
                    <input type="text" name="name" placeholder="Enter Your Name Here" class="form-control" Required>
                </div>
                <div class="form-group p-2">
                    <label>Email</label>
                    <input type="text" name="email" placeholder="Enter Your Email" class="form-control" Required>
                </div>
                <div class="form-group p-2">
                    <input type="submit" name="submit" value="submit" class="btn btn-info">
                </div>
            </form>
        <?php
        } //esle close
        ?><br>
        <h2 class="text-center text-info">Display Records</h2>
        <table class="table table-bordered">
            <tr class="bg-secondary text-center">
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
            <?php
            //display records
            $data = $obj->displayrecord();
            $sno = 1;
            foreach ($data as $value) {
            ?>
                <tr class="text-center">
                    <td><?php echo $sno++; ?></td>
                    <td><?php echo $value['name'] ?></td>
                    <td><?php echo $value['email'] ?></td>
                    <td>
                        <a href="index.php?editid=<?php echo $value['id']; ?>" class="btn btn-info">Edit</a>
                        <a href="index.php?deleteid=<?php echo $value['id']; ?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>

</html>