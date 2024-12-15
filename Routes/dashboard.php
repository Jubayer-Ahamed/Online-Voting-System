<?php
session_start();
if (!isset($_SESSION['userdata'])) {
    header("location:../");
}
$userdata = $_SESSION['userdata'];
$groupsdata = $_SESSION['groupdata'];
if($_SESSION['userdata']['status']==0)
{
    $status='<b style="color:red">Not voted</b>';
}
else 
{
    $status='<b style="color:green">voted</b>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/style.css">
    <title>Online Voting System</title>
</head>
<body>
    <div id="mainSection">
        <div class="startEnd" id="headerSection">
            <a href="../"><button class="left" id="backbtn">Back</button></a>
            <a href="logout.php"><button class="right" id="logoutbtn">Logout</button></a>
        </div>

        <h1>Online Voting System</h1>
        <hr>

        <div class=startEnd>
            <div class="left userdetils" id="profile">
                <center><img src="../uploads/<?php echo $userdata['photo']; ?>" alt="User Photo" id="userPhoto" height="100" width="100" ></center>
                <p>Name: <?php echo $userdata['name']; ?></p>
                <p>Mobile: <?php echo $userdata['mobile']; ?></p>
                <p>Address: <?php echo $userdata['address']; ?></p>
                <p>Status: <?php echo $status?></p>
            </div>
            <div class="right userdetils" id="group">
                <?php
                    if($_SESSION['userdata'])
                    {
                        for($i=0;$i<count($groupsdata);$i++)
                        {
                            ?>
                            <div>
                            <img style="float: right;" src="../uploads/<?php echo $groupsdata[$i]['photo']; ?>" alt="User Photo" id="userPhoto" height="100" width="100">
                                <b>Group Name: </b><?php echo $groupsdata[$i]['name']; ?><br>
                                <b>votes: </b><?php echo $groupsdata[$i]['votes']; ?>
                                <form action="../api/vote.php" method="POST">
                                    <input type="hidden" name="gvotes" value="<?php echo $groupsdata[$i]['votes']; ?>"><br>
                                    <input type="hidden" name="gid" value="<?php echo $groupsdata[$i]['id']; ?>"><br>
                                    <?php 
                                        if($_SESSION['userdata']['status']==0)
                                        {
                                            ?>
                                             <button type="submit" name="votebtn" value="vote" id="votebtn">Vote</button>
                                            <?php 
                                        }
                                        else {
                                            ?>
                                             <button disable type="button" name="votebtn" >Voted</button>
                                            <?php 
                                        }
                                    ?>
                                   
                                </form>
                            </div>
                            <hr>
                            <?php
                        }
                    }
                ?>
            </div>  
        </div>

    </div>
</body>
</html>
