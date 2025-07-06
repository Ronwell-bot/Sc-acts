function generatePass(length, includeUppercase, includeLowercase, includeNumbers, includeSymbols){
    const lowerCaseChars = "abcdefghijklmnopqrstuvwxz";
    const upperCaseChars = "ABCDEFGHIJKLMNOPQRSTUVWXZ";
    const symbolChars = "!@#$%^&*_+-=";
    const numberChars = "012345667689";

    let allowedChars = "";
    let password = "";

    allowedChars += includeLowercase ? lowerCaseChars : "";
    allowedChars += includeUppercase ? upperCaseChars : "";
    allowedChars += includeNumbers ? numberChars : "";
    allowedChars += includeSymbols ? symbolChars : "";

    if(length <= 0 ){
        return "(Password length must be at least 1)";
    }
    if(allowedChars.length === 0){
        return "(At least 1 symbol is needed)";
    }

    for(let i = 0; i < length; i++){
        const randomIndex = Math.floor(Math.random() * allowedChars.length);
        password += allowedChars[randomIndex];
    }

    return password; 
}    

const passwordLength = 8;
const includeLowercase = true;
const includeUppercase = true;
const includeNumbers = true;
const includeSymbols = false;

const password = generatePass(passwordLength, 
                              includeUppercase, 
                              includeLowercase, 
                              includeNumbers, 
                              includeSymbols);
console.log("Generated Passsword: "+ password)