
// Logical AND (&&)
// Returns  TRUE if both operands are TRUE
// console.log(false && true);

// Logical AND (&&)
// let highIncome = true;
// let goodCreditScore = true;
// let eligibleForLoan = highIncome && goodCreditScore;

// console.log(eligibleForLoan);

// Logical OR (||)
// It returns TRUE if one of the operands is TRUE
// let highIncome = false;
// let goodCreditScore = true;
// let eligibleForLoan = highIncome || goodCreditScore;

// console.log(eligibleForLoan);


let highincome = false;
let goodcreditscore = false;
let eligibleforloan = highincome && goodcreditscore;
console.log('Eligible ->', eligibleforloan);

// NOT (!)
let applicationRefused = !eligibleforloan;
console.log('Application Refused ->', applicationRefused);
