
// Function Decalarations
function walk() {
    console.log('walk');   
}

// Anonymonus Function Expression
const run = function() {
    console.log('run');
}
let move = run;
run();
move();