var code=document.getElementById("contcode");
var prive=document.getElementById("priv");

console.log(code , prive)
function checkPrivilege() {
    // Get the select element
    let selectElement = document.getElementById("priv");

    // Get the selected value
    let selectedValue = selectElement.value;

    // Perform checks or actions based on the selected value
    if (selectedValue === "Admin") {
        console.log("Admin selected");
        show(); // Call your show function
    } else if (selectedValue === "User") {
        console.log("User selected");
        hide(); // Hide admin options
    }
    
}

function show() {
    // Show admin options or perform admin-specific actions
    code.style.display = "block";
}

function hide() {
    // Hide admin options
    code.style.display = "none";
}

