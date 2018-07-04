var familyName = {
    contentB: ""
}
// GET VALUE FROM MODO-FORM
$('.fa-heart').on('click',function(){
    familyName.contentB = $('#familyNameModo').val();
    var familyString = JSON.stringify(familyName);  
$.ajax({  
    url: "index.php",
    data: {data:familyString, action:"changeFamilyName"},
    method: "POST",
        success: function(data){           
            // var changeName = $('<div>$data</div>')
            // $('#familyNameModo').append(changeName);


            location.href = "index.php";
        },
        error: function(e){
            console.log(e.message);
        }
    });
})
