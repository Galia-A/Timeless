<?php
require_once("handleData.php");  
require_once("inputData.php");  

//ctrl alt f
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>

    <title>Timeless</title>
</head>

<body>
    <div class="wrapper">
        <div class="myContainer">

            <!-- Header -->
            <header id="top">
                <h1>אז מה עשיתי היום..? </h1>
            </header>

            <form action="" method="post">
                <div class="form-row">

                    <div class="form-group col-md-2">
                        <label for="userName">מי אני?</label>
                        <select class="form-control" id="userName" name="userName" placeholder="רכזים">
                            <option value="">-----</option>
                            <?php
foreach ($userNamesArray as $key => $value) {
    echo "<option value=" .$key ." >" .$value ."</option>";
}
?>

                        </select>
                    </div>
                    <!--column-->
                </div>
                <!--row-->

                <div class="form-row">
                    <!--DATE-->
                    <div class="form-group col-md-2">
                        <label for="date">תאריך</label><br>
                        <input type="date" id="date" name="date" value="2019-03-01" min="2018-01-01" max="2022-12-31"
                            pattern="[0-9]{2}-[0-9]{2}-[0-9]{4}">
                    </div>

                    <!-- PROJECT -->
                    <div class="form-group col-md-2">
                        <label for="project">פרויקט*</label>
                        <select required class="form-control" id="project" name="project" placeholder="פרויקט">
                            <option value="">---- </option>
                            <?php
foreach ($projectsArray as $key => $value) {
    echo "<option  value=" .$key .">" .$value ."</option>";
}

?>
                        </select>
                    </div>

                    <!-- SUB-PROJECT -->
                    <div class="form-group col-md-2">
                        <label for="subProject">תת-פרויקט</label>
                        <select class="form-control" id="subProject" name="subProject" placeholder="תת-פרויקט">
                            <option value=""> </option>
                            <?php
foreach ($subProjectsArray as $key => $value) {
    echo "<option value=" .$key .">" .$value ."</option>";
}
?>
                        </select>
                    </div>

                    <!-- Instructor on phone -->
                    <div class="form-group col-md-2">
                        <label for="instructorName">יחד עם</label>
                        <input list="instructorList" type="input" class="form-control" id="instructorName"
                            name="instructorName" placeholder="עם מי?">
                        <datalist id="instructorList">
                            <option value="">

                                <script>
                                $('#userName').on('change', function() {
                                    let selected = $(this).val();
                                    let instructorsArray = <?php echo json_encode($instructorList);?>[selected];

                                    for (var i = 0; i < instructorsArray.length; i++) {
                                        var option = document.createElement("option");
                                        option.value = instructorsArray[i];
                                        option.text = instructorsArray[i];
                                        document.querySelector("#instructorList").appendChild(option);
                                    }
                                });
                                </script>
                        </datalist>
                    </div>
                    <!-- Time -->
                    <div class="form-group col-md-2">
                        <label for="time">סה"כ זמן שלקח*</label>
                        <input required type="input" class="form-control" id="time" name="time" placeholder="1:30">
                    </div>


                </div>
                <!--row-->


                <div class="form-row">

                    <!-- Reason for talking -->
                    <div class="form-group col-md-2">
                        <label for="reason">סיבת הפנייה</label>
                        <textarea placeholder="סיבת הפניה" class="form-control" id="reason" name="reason"
                            rows="2"></textarea>
                    </div>
                    <!-- was scheduled?  -->
                    <div class="form-group col-md-2">
                        <label for="scheduled">האם השיחה נקבעה מראש?</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="scheduled" value="scheduled" id="scheduledYes"
                                class="custom-control-input">
                            <label class="custom-control-label" for="scheduledYes">כן</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" name="scheduled" value="not scheduled" id="scheduledNo"
                                class="custom-control-input">
                            <label class="custom-control-label" for="scheduledNo">לא</label>
                        </div>
                    </div>
                    <!-- subjects  -->
                    <div class="form-group col-md-2">
                        <label for="subjects">נושאי השיחה</label><br>
                        1. <select class="form-control" id="subjects" name="subjects">
                            <option value="">-----</option>
                            <?php
foreach ($subjectsArray as $key => $value) {
    echo "<option value=" .$key ." >" .$value ."</option>";
}
?>

                        </select>

                    </div>


                    <button type="submit" class="btn btn-primary">תשמרי לי בבקשה</button>

                </div>
                <!--column-->
        </div>
        <!--row-->
        </form>
    </div>
    <!--container-->
    </div>
    <!--wrapper-->
</body>

</html>