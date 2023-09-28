// Hour
// If Hour is between 6am to 12pm: Good Morning!
// If it's between 12pm to 6pm: Good Afternoon!
// Otherwise, it'll say "Good Evening!"


let hour = 19;


if(hour >= 1 && hour < 12)
    console.log('Good Morning');
else if (hour >= 12 && hour < 18)
    console.log('Good Afternoon');
else
    console.log('Good Evening');