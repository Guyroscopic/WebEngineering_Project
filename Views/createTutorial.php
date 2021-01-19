<?php
    //Checking if Teacher is logged in or not
    session_start();

    if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

        $email    = $_SESSION["current_teacher_email"];
        $username = $_SESSION["current_teacher_username"];
            
    }
    elseif(isset($_SESSION['admin_email']) && isset($_SESSION['admin_username'])){
         header("location: adminPanel.php?invalidAccess=true");
    }
    elseif(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username']))
    {
        header("location: studentProfile.php?invalidAccess=true");
    }
    else{
        header("location: login.php?notloggedin=true");
    }

    //Adding the required Models
    require_once "../Models/TutorialCategoryModel.php";

    $queryResult = getAllCategoriesQueryResult();

    //Closing the connection
    global $database_connection;
    mysqli_close($database_connection);
?>

<!DOCTYPE html>
<html>
    <head>
        <!-- Required Meta Tags-->
        <meta charset="UTF-8">
        <title>Create New Tutorial</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--- CSS Link for Creat New Tutorials-->
        <link href="../assets/css/CreatTutorial.css" rel="stylesheet">
        <style type="text/css">        
            .flashMsg{
              color: #fff;          
              opacity: 0.7;
              background-color: #db5a5a;
              border-radius: 5px;
              text-align: center;
              margin-top: 30px;
              margin-bottom: 30px;
              font-size: 15px;
              padding: 5px 0 5px 0;
            }
        </style>

        <!-- CSS Link for Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <!-- Importing jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <!-- Bootstrap-->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" 
        integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    </head>

    <body>
        <!-- Left Fixed Sidebar-->
        <div class="sidenav">
            <img class="logo" src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png">
            <br><br>
            <a href="/webproject"><i class="fa fa-home"></i> Home</a>
            <br>
            <a href="about.php"><i class="fa fa-font"></i> About</a>
            <br>
            <a href="login.php"><i class="fa fa-hand-o-left"></i> Profile</a>
            <br>
            <a href="teacherLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
            <br>
        </div>
        
        <!-- Main Content-->

        <form id="createTutorialForm" action="../Controllers/CreateTutorialController.php" 
              method="POST" enctype="multipart/form-data">

        <div class="tut-bg">

            <!-- Output divs for an empty submissoin -->
            <?php if(@$_GET["empty"]){ ?>
                <div class="flashMsg">OOPS! Looks like you left a field empty</div>
            <?php } ?>

            <!-- Output div for error in video upload -->
            <?php if(@$_GET["error"]){ ?>
                <div class="flashMsg">
                    OOPS! Looks like there was an error in your video uplaod<br>
                    ERROR: <?php echo $_GET["error"] ?>
                </div>
            <?php } ?>

            <!-- Heading of Create Tutorial -->
            <div class="main-tut-header">
                <h1><span class="tut-header">Create Tutorial</span></h1>
            </div>
            <br>

            <!-- Drop Down menu for Tutorial Categories -->
            <label>Select a Category:</label>            
            <select name="tutorialCategory" class="selectpicker show-tick" data-style="btn-info">
            <?php
                while($row = mysqli_fetch_assoc($queryResult)) {                
                    echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                }
            ?>
            </select>           
            <br>

            <label>Title:</label>
            <input type="text" name='title' id="title" placeholder="Enter Title" required>         
            <br>

            <label>Description:</label>
            <textarea id="title-desc" name='description' placeholder="Tutorial Description" required></textarea>            
            <br>            
            
            <label>Video(optional):</label>    
            <input type="file" id="video" name="video" class='form-control-file'>           
            <br>

            
            <label>Paragraph 1 Heading:</label>
            <input type="text" id="para-head" name='heading_1' class='form-control' placeholder="Enter Heading" required>            
            <br>
           
            <label>Content:</label>                
            <textarea id='textarea_1' name='content_1' class='form-control'
                      placeholder='Enter Paragraph Content' required></textarea>            
            <br>
            
            <input type="button" id="add-para-btn" onclick="addParagraph()" value="Add Another Paragraph"><br>

            <input id="numOfParagraphs" type="hidden" name="numOfParagraphs" value=1>

            <button id="create-btn" name="create">Create</button>           

        </div>
        </form>

        
        <!-- Script for adding more input fields for additional paragraphs -->
        <script>
        let clicked = 1;

        function addParagraph(){

            clicked     += 1;
            textarea_id = "textarea_" + clicked
            str         = "<br><br><label>Paragraph " + clicked + " Heading: </label>" +
                           "<input type='text' name='heading_" + clicked + "' class='form-control' placeholder='Enter Heading'" +
                           "required><br><br>" +
                           "<label>Content: </label>" +
                           "<textarea id=" + textarea_id + " name='content_" + clicked + "' class='form-control' placeholder='Enter Paragraph Content'" + 
                           "required></textarea>";  

            $("#numOfParagraphs").attr("value", clicked);
            $("#textarea_"+(clicked-1)).after(str);

        }
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>   

    </body>
</html>