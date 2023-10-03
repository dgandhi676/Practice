
const person = {
    firstName: 'Dev',
    lastName: 'Gandhi',
    get fullName(){
        if ( typeof value !== 'string')
        throw new Error('Value is not a String');

        const parts = value.split(' ');
        if (parts.length != 2)
        throw new Error ('Enter first and last name.');

        this.firstName = parts[0];
        this.lastName = parts[1];
    }
};

try {
    person.fullName = '';
}
catch(e){
    alert(e);
}

console.log(person);