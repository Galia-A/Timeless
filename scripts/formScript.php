<script>

let subjectsArray = <?php echo json_encode($subjectsArray);?>;

// change instructor list accurding to user name
$('#userName').on('change', function() {
    let selected = $(this).val();
    let instructorsArray = <?php echo json_encode($instructorList);?>[selected];
    document.querySelector("#instructorList").innerHTML = "";

    for (let i = 0; i < instructorsArray.length; i++) {
        let option = document.createElement("option");
        option.value = instructorsArray[i];
        option.text = instructorsArray[i];
        document.querySelector("#instructorList").appendChild(option);
    }
});

//listen to changes in subject field
$('.subjectsFld').on('change', function() {
    if($(this).val() !== ""){
        if($(this).val() == subjectsArray.length - 1){
                createOtherFld()
        }
        creatNewSubjectsFld();
    }
});

//create new subject field
function creatNewSubjectsFld(){
    let selectFld = document.createElement("select");
    let selectId = "subjects" + ($(".subjectsFld").length + 1);
    
    selectFld.setAttribute("id", selectId);
    selectFld.setAttribute("name", selectId);
    selectFld.setAttribute("class", "form-control subjectsFld");
    document.querySelector("#subjectsNode").appendChild(selectFld);

    let option = document.createElement("option");
    option.value = "";
    option.text = "-----";
    document.querySelector("#"+selectId).appendChild(option);

    for (let i = 0; i < subjectsArray.length; i++) {
        let option = document.createElement("option");
        option.value = i;
        option.text = subjectsArray[i];
        document.querySelector("#"+selectId).appendChild(option);
    }

    //listen to changes in subject field
    $(selectFld).on('change', function() {
        if($(this).val() !== ""){
            if($(this).val() == subjectsArray.length - 1){
                createOtherFld()
            }
            creatNewSubjectsFld();
        }
    }); 
}

function createOtherFld(){
    let inputFld = document.createElement("input");
    inputFld.type = "text";
    inputFld.value = "";
    inputFld.class = "form-control otherFld";
    inputFld.id = "other" + subjectsArray.length - 1,
    inputFld.placeholder = "אחר";
    
    let selectId = "subjects" + ($(".subjectsFld").length);
    document.querySelector("#subjectsNode").appendChild(inputFld);

    $(inputFld).css("margin", "5px 0");
}
</script>
