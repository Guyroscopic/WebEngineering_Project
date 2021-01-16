<?php
    //Checking if Teacher is logged in or not
    session_start();

    if(isset($_SESSION['current_teacher_email']) && isset($_SESSION['current_teacher_username'])){

        $email    = $_SESSION["current_teacher_email"];
        $username = $_SESSION["current_teacher_username"];
            
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

        <!-- Output divs for an empty submissoin -->
        <?php if(@$_GET["empty"]){ ?>
            <div style="color: red">OOPS! Looks like you left a field empty</div>
        <?php } ?>

        <!-- Output div for error in video upload -->
        <?php if(@$_GET["error"]){ ?>
            <div style="color: red">
                OOPS! Looks like there was an error in your video uplaod<br>
                ERROR: <?php echo $_GET["error"] ?>
            </div>
        <?php } ?>

        <form>
        <div class="tut-bg" id="createTutorialForm" action="../Controllers/CreateTutorialController.php" 
              method="POST" enctype="multipart/form-data">

            <!-- Drop Down menu for Tutorial Categories 
            <label for="tutorialCategory">Select Category: </label>
            <select name="tutorialCategory">
                <?php
                    while($row = mysqli_fetch_assoc($queryResult)) {                
                        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                    }
                ?>
            </select>
            <br><br>
            -->

            <!-- Heading of Create Tutorial -->
            <div class="main-tut-header">
                <h1><span class="tut-header">Create Tutorial</span></h1>
            </div>
            <br>

                <label>Select a Category:</label>
                <div>
                    <select class="selectpicker show-tick" data-style="btn-info">
                        <option>Programming</option>
                        <option>Arts</option>
                        <option>Mathematics</option>
                        <option>Biology</option>
                    </select>     
                </div>
                <br>

            <div>
                <label>Title:</label>
                <input type="text" id="title" placeholder="Enter Title">
            </div>
            <br>

            <div>
                <label>Description:</label>
                <textarea id="title-desc" placeholder="Tutorial Description"></textarea>
            </div>
            <br>
            
            <div>
                <label>Video(optional):</label>
                <div class="input-group">
                    <label class="input-group-btn">
                        <span class="btn btn-info">
                            Browse...<input type="file" style="display: none;" multiple>
                        </span>
                    </label>
                    <input type="text" class="form-control" readonly>
                </div>
            </div>
            <br>

            <div>
                <label>Paragraph 1 Heading:</label>
                <input type="text" id="para-head" placeholder="Enter Heading">
            </div>
            <br>

            <div>
                <label>Content:</label>
                <textarea id="para-content" placeholder="Enter Paragraph Content"></textarea>
            </div>
            <br>

            <div>
                <input type="button" id="add-para-btn" onclick="addParagraph()" value="Add Another Paragraph"><br>
                <input id="numOfParagraphs" type="hidden" name="numOfParagraphs" value=1>
                <button id="create-btn" name="create">Create</button>   
            </div>

        </div>
        </form>

        

        
        <script>
        // JavaScript for adding another input field for paragraph 
        
        let clicked = 1;
        function addParagraph(){
            clicked     += 1;
            textarea_id = "textarea_" + clicked
            str         = "<br><br><label>Paragraph " + clicked + " Heading: </label>" +
                   "<input type='text' name='heading_" + clicked + "' placeholder='Enter Heading'" +
                   "required><br><br>" +
                   "<label>Content: </label>" +
                   "<textarea id=" + textarea_id + " name='content_" + clicked + "' placeholder='Enter Paragraph Content'" + 
                   "required></textarea>";  
                   
                   $("#numOfParagraphs").attr("value", clicked);
                    $("#textarea_"+(clicked-1)).after(str);
                    
        }

            // JS Event for Auto Resize textarea to fit content 
            textarea = document.querySelector("#title-desc"); 
            textarea.addEventListener('input', autoResize, false); 
              
            function autoResize() { 
                this.style.height = 'auto'; 
                this.style.height = this.scrollHeight + 'px'; 
            }
            textarea = document.querySelector("#para-content"); 
            textarea.addEventListener('input', autoResize, false); 
              
            function autoResize() { 
                this.style.height = 'auto'; 
                this.style.height = this.scrollHeight + 'px'; 
            }
             
            /* Using JQuery toupload file */
            $(function() {
                $(document).on('change', ':file', function() { // This code will attach `fileselect` event to all file inputs on the page
                    var input = $(this),
                    numFiles = input.get(0).files ? input.get(0).files.length : 1,
                    label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
                    input.trigger('fileselect', [numFiles, label]);
                });
                
                $(document).ready( function() {//below code executes on file input change and append name in text control
                    
                    $(':file').on('fileselect', function(event, numFiles, label) {
                        var input = $(this).parents('.input-group').find(':text'),
                        log = numFiles > 1 ? numFiles + ' files selected' : label;
                        if( input.length ) {
                            input.val(log);
                        } else {
                            if( log ) alert(log);
                        }
                    });
                });
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>   

    </body>
</html>