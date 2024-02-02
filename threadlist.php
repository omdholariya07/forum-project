<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    #ques {
        min-height: 433px;
    }
    </style>
    <title> iDiscuss - Coding Forums</title>
</head>

<body>
    <?php include 'partials/_header.php';?>
    <?php include 'partials/_dbconnect.php';?>
    <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `categories` WHERE category_id=$id"; 
    $result = mysqli_query($conn,$sql);
    
    // use loop to iterate through category
    while ($row = mysqli_fetch_assoc($result)) {
         $catname = $row['category_name'];
         $catdesc = $row['category_description'];
    }
    ?>

    <?php
    $showAlert= false;
 $method = $_SERVER['REQUEST_METHOD'];
 echo $method; 
 if($method=='POST'){
    $th_title= $_POST['title'];
    $th_desc= $_POST['desc'];

    $sql = "INSERT INTO `threads` (`threads_title`, `threads_desc`, `threads_cat_id`, `threads_user_id`, `timestamp`) VALUES ('$th_title', '$th_desc', '$id', '0', current_timestamp())"; 
    $result = mysqli_query($conn,$sql);
    $showAlert="true";
    if($showAlert){
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success! </strong> Your thread has been added! please wait for community to response .
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    
 }
 ?>
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">welcome to <?php echo $catname;?> forums</h1>
            <p class="lead"> <?php echo $desc;?></p>
            <hr class="my-4">
            <p>This is a peer to peer forum. No Spam / Advertising / Self-promote in the forums is not allowed. Do not
                post copyright-infringing material. Do not post “offensive” posts, links or images. Do not cross post
                questions. Remain respectful of other members at all times.</p>
            <p>Posted by: om <em><?php echo $posted_by; ?></em></p> 
            <button type="btn" class="btn btn-success">Learn more</button>
        </div>
    </div>

    <!-- <div class="container my-4">
        <div class="jumbotron"> 
            <h1 class="display-4"> <?php echo $title; ?> forums</h1>
            <p class="lead"><?php echo $desc; ?></p>
            <hr class="my-4">
            <p>This is the peer to peer forum.
                Do not post “I agree,” or similar, statements. Expand by bringing in related examples, concepts, and
                experiences.
                Stay on the topic of the thread do not stray.
                Indicate the main thought of your post in the subject line.
                Do not just post a link to another document/source. Provide a synopsis/highlight of the linked
                reference.
            </p>
            <p><b>posted by: Om</b></p>
        </div>
    </div>-->

    <div class="container">
        <h1 class="py-2">Start a Discussion</h1>
        <form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Problem Title</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">Keep your title as short and crisp as possible</div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Ellaborate your concern</label>
                <textarea class="form-control" id="desc" name="desc" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-success">Submit</button>
        </form>
    </div>
    <div class="container" id="ques">
<h1 class="py-2">Browse Question</h1>
        <?php
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `threads` WHERE threads_cat_id=$id"; 
    $result = mysqli_query($conn,$sql);
    $noResult = true;
    // use loop to iterate through category
    while ($row = mysqli_fetch_assoc($result)) {
        $noResult = false;
        $id = $row['threads_id']; 
        $title = $row['threads_title'];
        $desc = $row['threads_desc'];
        $thread_time = $row['timestamp'];
    

       echo ' <div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="img/userdefault.jpg" width="54px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
            <p class="font-weight-bold my-0">'. $row2['user_email'] .'Anonymous User at '. $thread_time. '</p> '. $content . '
                <h5 class="mt-0"><a class="text-dark" href="thread.php">'. $title . ' </a></h5>
                '. $desc . '
            </div>
        </div>';
    }
    if($noResult){
        echo '<div class="jumbotron jumbotron-fluid">
        <div class="container">
        <p class="display-4">No Threads Found</p>
        <p class="lead">Be the first person to ask a question </p>
        </div>
        </div>';

    }
    ?>



        <!-- <div class="d-flex my-3">
            <div class="flex-shrink-0">
                <img src="img/userdefault.jpg" width="54px" alt="...">
            </div>
            <div class="flex-grow-1 ms-3">
                <h5 class="mt-0">unable to install pyaudio error in windows </h5>
                This is some content from a media component. You can replace this with any content and adjust it as
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aliquam iure debitis dolorum repellat
                temporibus optio fuga quibusdam
            </div>
        </div> -->


        <?php include 'partials/_footer.php';?>


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>

</html>