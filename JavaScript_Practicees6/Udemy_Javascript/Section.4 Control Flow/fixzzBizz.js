
// Divisible by 3 => Fizz
// Divisible by 5 => Buzz
// Divisible by both 3 and 5 => FizzBuzz
// Not Divisible by 3 or 5 => input
// NOt a number => Not a number

const output = fizzBuzz(15);
console.log(output);

function fizzBuzz(input) {
    if (typeof input !== 'number') 
    return "Not a Number";

    if (input % 3 === 0)
    return 'Fizz';

    if (input % 5 === 0)
    return 'Buzz';

    if ((input % 3 === 0) && (input % 5 === 0))
    return 'FizzBuzz';

    return input;
}