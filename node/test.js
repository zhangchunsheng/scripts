width = 320;
width <<= 1;
console.log(width);

function A() {
	this.buffs = [];
}

var a = new A();
var b = new A();
var c = new A();

a.buffs = [{
	buffId: 1
}];

console.log(a);
console.log(b);
console.log(c);