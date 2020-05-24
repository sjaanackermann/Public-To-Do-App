<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google font link -->
    <link href="https://fonts.googleapis.com/css?family=Raleway&display=swap" rel="stylesheet">

    <!-- Font Awesome link -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

    <!-- Favicon link -->
    <link rel="shortcut icon" href="#">

    <!-- CSS link -->
    <link rel="stylesheet" href="styles/todo.css">

    <!-- jQuery link -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Vue JS link -->
    <script src="https://cdn.jsdelivr.net/npm/vue" defer></script>

    <!-- JS links -->
    <script src="../public/scripts/todo.js" defer></script>
    <script src="../public/scripts/datetime.js" defer></script>

    <title>To Do</title>
</head>

<body>
    <script>
        window.onload = function() {
            get_todolist();
        };
    </script>
    <main>
        <div class="app_container">
            <nav>
                <div class="db_status">
                    <?php
                    require_once('../private/connect.php');
                    $status = new Connect();
                    $status->getStatus();
                    $empty = new Connect();
                    $empty->checkEmpty();
                    ?>
                    <br>
                </div>

                
                <!-- ----------------------------NAVIGATION LIST ON SIDE---------------------------- -->


                <ul class="navigation">
                    <li id="calendar" class="active">
                        <div id="date">{{ message }}</div>
                    </li>
                    <li onclick="switchTodo()"><i class="fas fa-clipboard-list"></i></li>
                    <li onclick="switchPpl()"><i class="fas fa-cloud-sun-rain"></i></li>
                    <li><a href="../private/logout_user.php"><i class="fas fa-sign-out-alt"></i></a></li>
                </ul>
            </nav>


            <!-- ---------------------------TO DO LIST STARTS BELOW---------------------------- -->


            <section id="todo">
                <!-- <form action="../private/new_todo.php" method="post"> -->
                <form>
                    <input class="td_input" id="newnote" name="task_name" type="text" placeholder="add new item here" autocomplete="off" maxlength="60">
                    <input class="td_input" id="newdate" name="task_date" type="date" placeholder="Choose due date" autocomplete="off" maxlength="60">
                    <button type="submit" class="add" onclick="addNew()">Add</button>
                    <button type="submit" class="sort" onclick="sortList()">Sort</button>

                    <script>
                        function addNew() {
                            $.ajax({
                                type: 'post',
                                url: '../public/new_todo.php',
                                // data: $("#newnote").serialize(),
                                data: {"task_name": $("#newnote").val(),
                                            "task_date": $("#newdate").val()
                                },
                                success: function(data) {
                                    console.log("success " + data);
                                },
                                error: function(jqXHR, status, err) {
                                    alert("Local error callback." +err +jqXHR.responseText);
                                }
                            });
                            get_todolist();
                        }

                        
        // ----------------------------EDIT TO DO AJAX----------------------------


                        function edit_todoitem($event) {
                            console.log("editing");
                            $id= $event.id.toString().split('-')[1];
                            console.log($id);
                            $.ajax({
                            type: 'POST',
                            url: '../public/edit_todo.php',
                            data: {     "ident": $event.id.toString().split('-')[1],
                                        "editTask": $("#editTask-"+$id).val(),
                                        "editDate": $("#editDate-"+$id).val()
                            },
                            success : function(data) {
                                console.log("success " + data);
                            },
                            error: function(jqXHR, status, err) {
                                alert("Local error callback." +err +jqXHR.responseText);
                            }
                        });
                        get_todolist();
                    }
                    </script>
                </form>

                <div id="todo_container" style="width:100%">
                    <!-- <ul id="todo_list" class="todo_list">
              
                    </ul> -->
                </div>
            </section>

            <!-- ----------------------------WEATHER WIDGET---------------------------- -->


            <section id="people" class="inactive">
                <br><br><br><br><br><br><br><br>
             
                <a id="widget" class="weatherwidget-io" href="https://forecast7.com/en/n33d9218d42/cape-town/" data-label_1="CAPE TOWN" data-label_2="WEATHER" data-theme="original">CAPE TOWN WEATHER</a>
                <script defer>
                    ! function(d, s, id) {
                        var js, fjs = d.getElementsByTagName(s)[0];
                        if (!d.getElementById(id)) {
                            js = d.createElement(s);
                            js.id = id;
                            js.src = 'https://weatherwidget.io/js/widget.min.js';
                            fjs.parentNode.insertBefore(js, fjs);
                        }
                    }(document, 'script', 'weatherwidget-io-js');
                </script>
            </section>
        </div>
    </main>

    <script>



        // ----------------------------DISPLAY TO DO AJAX----------------------------



        function get_todolist() {
            var notes = new Array();
            console.log("get list");
            $.ajax({
                type: 'GET',
                url: '../public/connect.php',
                dataType: 'html',
                success: function(data) {
                    document.getElementById("todo_container").innerHTML = data;
                },
                error: function(jqXHR, status, err) {
                    alert("Failed to get List" + err);
                }
            });
            console.log(notes);
            event.preventDefault();
        }



        // ----------------------------DELETE TO DO AJAX----------------------------



        function delete_todoitem($event) {
            $.ajax({
                type: 'POST',
                url: '../public/delete_todo.php',
                data: {
                    "deleteid": $event.id
                },
                success: function(data) {
                    console.log("successful");
                    console.log("success" + data);
                },
                error: function(jqXHR, status, err) {
                    alert("Failed to delete" + err);
                }
            });
            get_todolist();
        }

        // ----------------------------SORT TO DO AJAX----------------------------

        function sortList() {
            var notes = new Array();
            console.log("get list");
            $.ajax({
                type: 'GET',
                url: '../public/connect.php',
                data: {"sort":"DESC"},
                dataType: 'html',
                success: function(data) {
                    document.getElementById("todo_container").innerHTML = data;
                },
                error: function(jqXHR, status, err) {
                    alert("Failed to get List" + err);
                }
            });
            console.log(notes);
            event.preventDefault();
        }




    </script>





</body>

</html>