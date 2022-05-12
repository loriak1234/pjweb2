function preview_image(event) {
    var reader = new FileReader();
    reader.onload = function () {
        var output = document.getElementById('output_image');
        output.src = reader.result;
        // output.width = 80;
        // output.height = 100;
    }
    reader.readAsDataURL(event.target.files[0]);
}

function change_text() {
    var x = document.getElementById("inputCover");
    var output = document.getElementById("change_div");
    output.innerHTML = x.files[0].name;
}


function call_change(){
    preview_image(event);
    change_text(event);
}

function test(){
    var count = 0;
    const x = document.getElementById("inputDetail").files;
    var output = document.getElementById("change_text2");
    for(var i = 0; i < x.length ; i++){
        count++;
    }
    change_text2.innerHTML = count + " Files";
}
