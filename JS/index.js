console.log("Welcome to learning Javascript!");

document.getElementById("h").textContent ="Hello and welcome!";
document.getElementById("p").textContent ="Ronwell is learning Javascript"; // Putting input into an element in HTML

// window.alert("This is an alert"); // = Window alert

//========Variables==========//
let age; // = Declare
age=20;  // = Assign
let y = "Carcer"; // = Declare + Assign   
let firstName = "Ronwell";
let online = true;
let student =true;

document.getElementById("p1").textContent = " This is "+ firstName +" "+ y +"'s Website in progress";
document.getElementById("p2").textContent = "He is "+age+ "  years old";
document.getElementById("p3").textContent = "Enrolled in college: "+student;

console.log(`firstName var is a type of `+ typeof firstName); //typeOf to show the varType
console.log(`Hello Ronwell ${y}`); 
console.log(`You are `+ firstName);
console.log("Bro is online: "+online); //Bool expression

//=========Arithmetic expressions==============//
let cars = 5;
cars = cars +2;
cars = cars-3;
cars= cars*2;
cars=cars/2;
cars= cars**2; // power of n
cars%=5;
cars++;

console.log(cars);
/* operator presedence  = PEMDAS

1.Parenthesis ()
2. Exponents
3.Multiplication & division/modulus
4. Add & Subtract */

//=============User input=================//
//1st
 let username;
// username= window.prompt("Username: " );
// console.log(username);

//2nd
document.getElementById("submit").onclick = function(){
    username = document.getElementById("myText").value;
    document.getElementById("name").textContent = "Hello "+ username;
}

//=======Type Conversion=========//
// let agee = window.prompt("How old are you? ")    //Accepts strings
//agee=Number(agee); // String to integer
//agee+=1;
//console.log(agee);

let x = "Dodge";
let z = "Dodge";
let t = "";

x = Number(x);
z = String(z);
t = Boolean(t);

//console.log(x, typeof x);
//console.log(z, typeof z);
//console.log(t, typeof t); // Checked if there is input, return false if none = Boolean checker

//=========Constants============//
const PI = 3.14159;
let radius;
let circumference;

// radius = window.prompt("Enter the radius of the circle: ");
// radius=Number(radius);
// circumference= 2 * PI * radius;

document.getElementById("submitRadius").onclick = function(){
    radius = document.getElementById("radius").value;
    radius = Number(radius);
    circumference = 2 * PI * radius;
    document.getElementById("h3").textContent = circumference+"cm";
}

//==========Math Object=======//
let o = 16;
let p = 3;
let u = 5;
let max;
max = Math.max(o, p ,u); // Floor = Round down, Ceil = Round up, Trunc = Eliminate decimals, Abs = Eliminate negative value,

//===========Random Number Generator======//
const min = 50;
const maxx = 100;
let randNum = Math.floor(Math.random()* 6) + 1; // Random num 1 to 6
let randNum1 = Math.floor(Math.random() * (maxx-min)) + min; // Random Number 50 - 100
console.log(randNum1);

//============Ternary Operator===============//

let moneyReq = 150;
let moneyLeft = 1050;
moneyCheck= moneyReq >=moneyLeft? "You don't have enouh money, top-up again?": "You have enough money? Continue?";
console.log(moneyCheck)

let cont = true;
let message = cont == true ? "Continuing" : "Exiting";
console.log(message);

//==========Switch=========//

let day =  2;
switch (day){
    case 1:
        console.log("It is Sunday");
        break;

    case 2:
        console.log("It is Monday");
        break;

    case 3:
        console.log("It is Tuesday");
        break;

    case 4:
        console.log("It is Wednesday");
        break;

    case 5:
        console.log("It is Thursday");
        break;

    case 6:
        console.log("It is Friday");
        break;
    
    case 7:
        console.log("It is Saturday");
        break;
        default:
            console.log(day +" is not a day.")
}

let streak = 19;
let streakRec;
switch (true){
    case streak >=20:
        streakRec = "20 days streak!";
        break;
    case streak >=15:
        streakRec = "15 days streak!";
        break;
    case streak >=12:
       streakRec = "12 days streak!";
       break;
    case streak >=9:
        streakRec = "8 days streak!";
        break;
    case streak >=5:
        streakRec = "5 days streak!";
        break;
    default:
        streakRec = "No streak for now";
}
console.log("Wow you have a " + streakRec);

//============String methods=========//
let ign = "Oppenheimer";
console.log(ign.charAt(3)); //.length= .indexOf = .lastIndexOf = .charAt //
console.log(ign.toUpperCase());

if (ign.includes("*")){
console.log("Your username can't include *");
}
else{
    console.log("Perfect ign bruh");
}

let phoneNum = "123-4567-56778";
phoneNum = phoneNum.replaceAll("-", "");
phoneNum = phoneNum.padStart(15, "63-"); // first dig = limiter to 15 char
console.log(phoneNum);

//=========String Slicing==========//

const fullname = "Ronwell Carcer";
    //let firstname = fullname.slice(0,7);
    let firstname = fullname.slice(0, fullname.indexOf(" ")); // Last index will be the space " "
    console.log(firstname);
    //let lastname = fullname.slice(8,15);
    let lastname = fullname.slice(fullname.indexOf(" ") + 1); // Start in the position of " " plus 1 space/index
    console.log(lastname);

    let firstChar = fullname.slice(0,1);
    console.log(firstChar);

    const email = "ronwell13@gmail.com";
    let usernameEmail = email.slice(0, email.indexOf("@")); // Get string before @
    let extension = email.slice(email.indexOf("@") + 1); // String after @
    console.log(usernameEmail);
    console.log(extension);


    //=================Method Chaining======================//

    //let usernamee = window.prompt("Enter you name: ");
    //usernamee = usernamee.trim().charAt(0).toUpperCase() + usernamee.trim().slice(1).toLowerCase();
    //console.log(usernamee);

    //============Logical Operators=============//

    const temp = 12;
    //OR = || = at least one should be true
    //NOT = ! = 

    if(temp > 0 && temp <=30){ // Both statements need to be true
        console.log("The weather is good");
    }
    
    else{
        console.log("The weather is bad")
    }


    //==========Strict equality==========//
    // === Compare data type and value (Strict equality)
    // != Inequality operator
    // !== Strict inequality

    if(PI == "3.14159"){ // == compare if values are equal(Not the datatype)
        console.log("That is PI!");
    }
    else{
        console.log("That is not PI");
    }

    //==========Array============//
    console.log("===ARRAYS===")

    let fruits = ["apple", "banana", "grapes"];

    fruits.push("orange");
    fruits.pop(); // remove the last index
    fruits.unshift("mango"); // put an element in index 0
    fruits.shift(); // remove element in index 0s
    fruits.sort(); // sort in Alphabetical

    for (let i = 0; i <fruits.length; i++){
        console.log(fruits[i]);
    }

    console.log(fruits.indexOf("banana"));

    //======Spread Operator========//
    console.log("==SPREAD Operator==");

    let numbers = [1, 2, 3, 4, 5];
    let symbols = ["&","*","%","^"];
    let maximum = Math.max(...numbers);
    let letters = [...fullname]; // String to char in an array using ".../Spread Operator"

    let addArr =[...numbers, ...symbols, "cars", "Foods"]; // adding Array and some elements

    console.log(addArr);

     //======Rest Parameter========//
     console.log("==REST PARAM==");

    function openFridge(...foods){
        console.log(...foods); // Array to String using "..."
    }

     const food = "Hamburger";
     const food1 = "Pizza";
     const food2 = "Chimken";
     const food3 = "Ramen";
     const food4 = "Tempura";

     openFridge(food, food1, food2, food3, food4);

    function sum(...nums){
        let result = 0;
        for(let number of nums){
            result +=nums;
        }
        return result;
     }
     const total = sum(1, 2, 3);
     console.log(total+"$")


    function combineStrings(...strings){
        return strings.join(" ");
     }

    const fullName = combineStrings("Mr.", "Peter","Parker");
    console.log(fullName);

    //========WHILE Loop========//

    let namee;
    do{
      //  namee = window.prompt("Enter your namee");
    }
    while (namee ==="" || namee=== null)

   // console.log("Hello "+namee);

    let loggedIn = false;
    let usern;
    let password;

    // while(!loggedIn){
    //     usern = window.prompt("Enter your Username");
    //     password = window.prompt("Enter your password");

    //     if(usern ==="user" && password === "pass"){
    //         loggedIn = true;
    //         console.log("You are logged in!");
    //     }
    //     else{
    //         console.log("Invalid password or username. Please try again");
    //     }
    // }

    //=========FOR Loop========//
    console.log("===FOR Loop===");

    for(let i = 1; i  <= 5; i++){

        if(i == 13){  
            continue; // Skip 13 from 1 to 20. Break = Titigil sa 12
        }
        else{
        console.log(i);
    }
    }

    //==========Functions=============//
    console.log("===Functions====");
    function happyWinner(winner, moneyWon){ // Parameters
        console.log("Winner winner!");
        console.log("Chicken dinner!");
        console.log("Chicken chicken!");
        console.log("Winner dinner by " + winner);
        console.log("You won "+ moneyWon + "! Congrats mah winner!")
    }
    happyWinner("Well", 2500); // Arguements
    
    function add(e, f){
        let sum = e + f;
        return sum; // return e + f;
    }
    function subtract(e, f){
        return e - f;
    }
    function mult(e, f){
        return e * f;
    }
  
    console.log(mult(2,3));

    function isEven(number){
        
         return number % 2 === 0 ? true : false;
        
    }
    console.log(isEven(13));

    function validEmail(email){
        return email.includes("@") ? true : false;
    }
    console.log(validEmail("carcer@gmail.com"))

    //=======Variable scope============//
    console.log("=VARIABLE SCOPE=");  
    let xx = 3;
    function func1(){ // Local variablr is a priority
        let xx=1;    
        console.log(xx);  
    }
    function func2(){
        let xx=2; 
        console.log(xx);   
    }
    func2();

//===========IF Statements ==========//
const myageBet = document.getElementById("myageBet");
const mySubmit = document.getElementById("submitBet");
const resultElement = document.getElementById("ageBet");
let ageBet;
let hasLicense = false;

mySubmit.onclick = function(){

    ageBet = myageBet.value;
    ageBet = Number(ageBet);

    if(ageBet>=18){
        console.log("You can enter your profile before betting.");
        resultElement.textContent = "You can enter your profile before betting.";
    }
    else{
        console.log("You are not allowed to bet in this website.");
        resultElement.textContent = "You are not allowed to bet in this website.";
    }
    
    if(ageBet >=16){
        console.log("You are old enough to get license");
        resultElement.textContent = "You are old enough to get license";
    
        if(hasLicense){
            console.log("Please upload your license.");
            resultElement.textContent = "Please upload your license.";
        }
        else{
            console.log("You can upload your license for extra credits!");
            resultElement.textContent = "U can Continue! You can upload your license for extra credits!";
        }
    }
    else if(ageBet<0){
            console.log("Because your age can't be below 0 dumbass");
            resultElement.textContent = "Your age can't be below 0 dumbass";
    }
    else{
        console.log("You are not old enough kid!");
        resultElement.textContent = "You are not old enough to bet kid!";
    }
}

//=======Checkbox=======//
 const rCheckbox = document.getElementById("rCheckbox");
 const bCheckbox = document.getElementById("bCheckbox");
 const fiveBtn = document.getElementById("5Btn");
 const eightBtn = document.getElementById("8Btn");
 const tenBtn = document.getElementById("10Btn"); 

 const subBet = document.getElementById("subBet");
 const subResult = document.getElementById("subResult");
 const paymentResult = document.getElementById("paymentResult");

 subBet.onclick = function(){
    if (rCheckbox.checked){
        subResult.textContent = ("You are betting on Red");
    }
    else if(bCheckbox.checked){
        subResult.textContent = ("You are betting on Black");
    }
    // else if (bCheckbox.checked&rCheckbox.checked){
    //     subResult.textContent = ("You are betting in Red and Black");
    // }
    else{
        subResult.textContent = ("No placement of bet at the moment");
    }

    if(fiveBtn.checked){
        paymentResult.textContent = ("5,000 is your current bet");
    }
    else if (eightBtn.checked){
        paymentResult.textContent = ("8,000 is your current bet");
    }
    else if (tenBtn.checked){
        paymentResult.textContent = ("10,000 is your current bet");
    }   
 }
