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
        <title>Create Tutorial</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--- CSS Link for Creat New Tutorials-->
        <link href="../assets/css/CreatTutorial.css" rel="stylesheet">

        <!-- CSS Link for Icons-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <!-- Importing jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
        <!-- Left Fixed Sidebar-->
        <div class="sidenav">
            <img class="logo" src="https://www.concordia.ca/content/dam/common/icons/303x242/graduate-students.png" alt="logo">
            <br><br>
            <a href="/webproject"><i class="fa fa-home"></i> Home</a><br>
            <a href="about.php"><i class="fa fa-font"></i> About</a><br>
            <a href="login.php"><i class="fa fa-hand-o-left"></i> Profile</a><br>
            <a href="teacherLogout.php"><i class="fa fa-arrow-circle-right"></i> Logout</a>
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

        <!-- Form for creating tutorial -->
        <form id="createTutorialForm" action="../Controllers/CreateTutorialController.php" 
              method="POST" enctype="multipart/form-data">


            <div class="tut-bg">
                <div class="main-tut-header">
                <h1 id="tut-header">Create Tutorial</h1>
            </div>
            <br><br>
            <div>
                <label>Select a Category:</label>
                <div class="category-select-wrapper">
                    <div class="category-select">
                        <div class="category-select__trigger"><span>Programming</span>
                            <div class="arrow"></div>
                        </div>
                        <div class="category-options">
                            <span class="category-option selected" data-value="programming">Programming</span>
                            <span class="category-option" data-value="arts">Arts</span>
                            <span class="category-option" data-value="maths">Maths</span>
                            <span class="category-option" data-value="biology">Biology</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Drop Down menu for Tutorial Categries -->
            <label for="tutorialCategory">Select Category: </label>
            <select name="tutorialCategory">
                <?php
                    while($row = mysqli_fetch_assoc($queryResult)) {                
                        echo "<option value='" . $row["id"] . "'>" . $row["name"] . "</option>";
                    }
                ?>
            </select>
            <br><br>

            <label>Title:</label>
            <input type="text" name="title" id="title" placeholder="Enter Title" required><br><br>

            <label>Description: </label>
            <textarea name='description' 
                      placeholder='Tutorial Description' required></textarea><br><br>

            <label>Video (optional):</label>
            <input type="file" name="video" id="video"><br><br>
            
            <label>Paragraph 1 Heading: </label>
            <input type='text' name='heading_1' placeholder='Enter Heading' class="form-control" required><br><br>

            <label>Content: </label>
            <textarea id='textarea_1' name='content_1' 
                      placeholder='Enter Paragraph Content' required></textarea><br><br>

            <input type="button" id="addButton" onclick="addParagraph()" value="Add Another Paragraph"><br><br>

            <input id="numOfParagraphs" type="hidden" name="numOfParagraphs" value=1>

            <button name="create">Create</button>
                <!--
                <label>Paragraph 1 Heading:</label>
                <input type="text" name="heading_1" id="para-head" placeholder="Enter Heading">
                <br><br>

                <label id="content">Content:</label>
                <textarea id="para-content" placeholder="Enter Paragraph Content"></textarea>      
                <br><br>
                

                <div>
                    <a id="add-para-btn" href="#">Add Another Paragraph</a><br>
                    <a id="create-btn" href="#">Create</a>
                </div>
            </div>
            -->
        </form>
        
        <!-- JavaScript for adding another input field for paragraph -->
        <script>
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
        </script>

        <!-- Javascript Code for DropDown Menu -->
        <script>
            /* Added Click function to the wrapper */
            document.querySelector('.category-select-wrapper').addEventListener('click', function() {
                this.querySelector('.category-select').classList.toggle('open');
            })
            
            /* Iterating over all options and adding click function */
            for (const option of document.querySelectorAll(".category-option")) {
                option.addEventListener('click', function() {
                    if (!this.classList.contains('selected')) {
                        this.parentNode.querySelector('.category-option.selected').classList.remove('selected');
                        this.classList.add('selected');
                        this.closest('.category-select').querySelector('.category-select__trigger span').textContent = this.textContent;
                    }
                })
            }
            
            /* closing the dropdown list */
            window.addEventListener('click', function(e) {
                const select = document.querySelector('.category-select')
                if (!select.contains(e.target)) {
                    select.classList.remove('open');
                }
            });
        </script>

    </body>
</html>