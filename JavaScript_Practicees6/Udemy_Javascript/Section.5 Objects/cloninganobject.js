
const circle = {
    radius: 1,
    draw() {
        console.log('draw');
    }
};

// const another = Object.assign({}, circle);
const another = { ...circle};

console.log(another);