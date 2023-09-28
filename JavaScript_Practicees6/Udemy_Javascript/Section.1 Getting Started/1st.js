// function thenotebook(){
//     let movie = "The Notebook";
//     return movie;
// }

// console.log(thenotebook());


// let movie = 'Good Will Hunting';

// function theNotebook () {
//     // let movie = 'The Notebook';
//     return movie;
// }

// console.log (movie);
// console.log(theNotebook ());
// console.log(movie);




// let cirleArea = (r) => {
//     PI = 3.14;
//     return PI*r;
// }

// console.log(cirleArea(7));


// odds  = evens.map(v => v + 1);
// pairs = evens.map(v => ({ even: v, odd: v + 1 }));
// nums  = evens.map((v, i) => v + i);

// console.log(v(7));


// "𠮷".length === 2
// "𠮷".match(/./u)[0].length === 2
// "𠮷" === "\uD842\uDFB7"
// "𠮷" === "\u{20BB7}"
// "𠮷".codePointAt(0) == 0x20BB7
// for (let codepoint of "𠮷") uc
// console.log(codepoint)




// let parser = (input, match) => {
//     for (let pos = 0, lastPos = input.length; pos < lastPos; ) {
//         for (let i = 0; i < match.length; i++) {
//             match[i].pattern.lastIndex = pos
//             let found
//             if ((found = match[i].pattern.exec(input)) !== null) {
//                 match[i].action(found)
//                 pos = match[i].pattern.lastIndex
//                 break
//             }
//         }
//     }
// }

// let report = (match) => {
//     console.log(JSON.stringify(match))
// }
// parser("Foo 1 Bar 7 Baz 42", [
//     { pattern: /Foo\s+(\d+)/y, action: (match) => report(match) },
//     { pattern: /Bar\s+(\d+)/y, action: (match) => report(match) },
//     { pattern: /Baz\s+(\d+)/y, action: (match) => report(match) },
//     { pattern: /\s*/y,         action: (match) => {}            }
// ])




// var parser1 = function (input, match) {
//     for (var i, found, inputTmp = input; inputTmp !== ""; ) {
//         for (i = 0; i < match.length; i++) {
//             if ((found = match[i].pattern.exec(inputTmp)) !== null) {
//                 match[i].action(found);
//                 inputTmp = inputTmp.substr(found[0].length);
//                 break;
//             }
//         }
//     }
// }

// var report1 = function (match) {
//     console.log(JSON.stringify(match));
// };
// parser1(" Foo 1 Bar 7 Baz 42", [
//     { pattern: /^Foo\s+(\d+)/, action: function (match) { report1(match); } },
//     { pattern: /^Bar\s+(\d+)/, action: function (match) { report1(match); } },
//     { pattern: /^Baz\s+(\d+)/, action: function (match) { report1(match); } },
//     { pattern: /^\s*/,         action: function (match) {}                 }
// ]);



//  lib/math.js
// export function sum (x, y) { return x + y }
// export var pi = 3.141593

//  someApp.js
// import * as math from "lib/math"
// console.log("2π = " + math.sum(math.pi, math.pi))

//  otherApp.js
// import { sum, pi } from "lib/math"
// console.log("2π = " + sum(pi, pi))




// let m = new Map()
// let s = Symbol()
// m.set("Hello",42)
// m.set(s, 34)
// m.set(s) === 34
// m.size === 2
// for (let [ key,val ] of m.entries())
// console.log(key + "=" + val)



// let m = new Map()
// let s = Symbol()
// m.set("hello", 42)
// m.set(s, 34)
// m.get(s) === 34
// m.size === 2
// for (let [ key, val ] of m.entries())
//     console.log(key+" = "+val)




// let m = new Map()
// let s = Symbol()
// m.set("hello", 42)
// m.set(s, 34)
// m.get(s) === 34
// m.size === 2
// for (let [ key, val ] of m.entries())
//     console.log(key + " = " + val)


class Example {
    constructor (buffer = new ArrayBuffer(24)) {
        this.buffer = buffer
    }
    set buffer (buffer) {
        this._buffer    = buffer
        this._id        = new Uint32Array (this._buffer,  0,  1)
        this._username  = new Uint8Array  (this._buffer,  4, 16)
        this._amountDue = new Float32Array(this._buffer, 20,  1)
    }
    get buffer ()     { return this._buffer       }
    set id (v)        { this._id[0] = v           }
    get id ()         { return this._id[0]        }
    set username (v)  { this._username[0] = v     }
    get username ()   { return this._username[0]  }
    set amountDue (v) { this._amountDue[0] = v    }
    get amountDue ()  { return this._amountDue[0] }
}
let example = new Example()
example.id = 7
example.username = "John Doe"
example.amountDue = 42.0

console.log(example)