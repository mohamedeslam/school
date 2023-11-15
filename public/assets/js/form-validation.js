// // start display Div
// function showDivAndHide(val, id) {



//   if (val == 0) {
//     document.getElementById(id).style.display = 'none';
//   }
//   if (val == 1) {
//     document.getElementById(id).style.display = 'block';
//   }

// }
// function showDivAndHide(radioId, idForItem) {
//   var radio = document.getElementById(radioId);
//   var item = document.getElementById(idForItem);

//   if (radio.checked == true) {
//     item.style.display = 'block';
//   } else {
//     item.style.display = 'none';
//   }
// }
// end display Div

// const form = document.getElementById('form');
// const logo = document.getElementById('logo');
// const schoolName = document.getElementById('shoolName');
// const numTeacher = document.getElementById('numTeacher');
// const numStd = document.getElementById('numStd');
// const phone = document.getElementById('phone');
// const email = document.getElementById('email');
// const addressCity = document.getElementById('city');
// const addressTown = document.getElementById('town');
// const addressStreet = document.getElementById('street');
// const typeOne = document.getElementById('typeOne');
// const typetow = document.getElementById('typetow');
// const numOfDepart = document.getElementById('numOfDepart');
// const creditDb1 = document.getElementById('creditDb1');
// const creditDb2 = document.getElementById('creditDb2');
// const creditDb3 = document.getElementById('creditDb3');
// const creditDb4 = document.getElementById('creditDb4');
// const subscription = document.getElementById('subscription');
// const userName = document.getElementById('userName');
// const passwordOne = document.getElementById('passwordOne');
// const passwordTow = document.getElementById('passwordTow');

// form.addEventListener('submit', Event => {

//   if (!checkinputs()) {

//     Event.preventDefault();
//     Event.stopPropagation();
//   }
// }, false);

// function checkinputs() {
//   // Input Not Requerd
//   setSuccessFor(logo);
//   setSuccessFor(numTeacher);
//   setSuccessFor(numStd);
//   setSuccessFor(numStd);
//   setSuccessFor(subscription);
//   setSuccessCheckBoxFor(typeOne);
//   setSuccessCheckBoxFor(typetow);
//   setSuccessCheckBoxFor(creditDb1);
//   setSuccessCheckBoxFor(creditDb2);
//   setSuccessCheckBoxFor(creditDb3);
//   setSuccessCheckBoxFor(creditDb4);

//   // get the value from the inputs
//   var sendData = 1;
//   const schoolNameValue = schoolName.value;
//   const numTeacherValue = numTeacher.value;
//   const phoneValue = phone.value;
//   const emailValue = email.value;
//   const addressCityValue = addressCity.value;
//   const addressTownValue = addressTown.value;
//   const addressStreetValue = addressStreet.value;
//   const numOfDepartValue = numOfDepart.value;
//   const userNameValue = userName.value;
//   const passwordOneValue = passwordOne.value;
//   const passwordTowValue = passwordTow.value;

//   if (schoolNameValue === '') {
//     setErrorFor(schoolName, 'feedbackMessage1', '*');
//     sendData = 0;
//   } else if (!isNaN(schoolNameValue)) {
//     setErrorFor(schoolName, 'feedbackMessage1', 'عذراً اسم المدرسة غير صالح');
//     sendData = 0;
//   } else if (schoolNameValue.length <= 1) {
//     setErrorFor(schoolName, 'feedbackMessage1', 'اسم المدرسة قصير جداً');
//     sendData = 0;
//   } else if (schoolNameValue.length >= 50) {
//     setErrorFor(schoolName, 'feedbackMessage1', 'اسم المدرسة طويل جداً');
//     sendData = 0;
//   } else {
//     setSuccessFor(schoolName);
//     sendData = 1;
//   }

//   if (!isNum(phoneValue)) {
//     setErrorFor(phone, 'feedbackMessage2', '*');
//     sendData = 0;
//   } else {
//     setSuccessFor(phone);
//     sendData = 1;
//   }

//   if (emailValue === "") {
//     setErrorFor(email, 'feedbackMessage3', '*');
//     sendData = 0;
//   } else if (!isEmail(emailValue)) {
//     setErrorFor(email, 'feedbackMessage3', 'البريد الإلكتروني مطلوب ، الرجاء كتابة البريد الإلكتروني بطريقة صحيحة');
//     sendData = 0;
//   } else {
//     setSuccessFor(email);
//     sendData = 1;
//   }

//   if (addressCityValue === "") {
//     setErrorFor(addressCity, 'feedbackMessage4', '*');
//     sendData = 0;
//   } else {
//     setSuccessFor(addressCity);
//     sendData = 1;
//   }

//   if (addressTownValue === "") {
//     setErrorFor(addressTown, 'feedbackMessage5', '*');
//     sendData = 0;
//   } else {
//     setSuccessFor(addressTown);
//     sendData = 1;
//   }

//   if (addressStreetValue === "") {
//     setErrorFor(addressStreet, 'feedbackMessage6', '*');
//     sendData = 0;
//   } else {
//     setSuccessFor(addressStreet);
//     sendData = 1;
//   }

//   if (validateInput = 1) {
//     if (numOfDepartValue <= 0) {
//       setErrorFor(numOfDepart, 'feedbackMessage7', '*');
//       sendData = 0;
//     } else {
//       setSuccessFor(numOfDepart);
//       sendData = 1;
//     }
//   }

//   if (userNameValue === "") {
//     setErrorFor(userName, 'feedbackMessage8', '*');
//     sendData = 0;
//   }
//   else if (!isCharOnly(userNameValue)) {
//     setErrorFor(userName, 'feedbackMessage8', 'اسم المسخدم غير صالح (حروف و ارقام فقط)');
//     sendData = 0;
//   } else if (!isNaN(userNameValue)) {
//     setErrorFor(userName, 'feedbackMessage8', 'اسم المسخدم غير صالح (حروف و ارقام فقط)');
//     sendData = 0;
//   } else if (userNameValue.length <= 3) {
//     setErrorFor(userName, 'feedbackMessage8', 'اسم المستخدم قصير جداً');
//     sendData = 0;
//   } else if (userNameValue.length >= 17) {
//     setErrorFor(userName, 'feedbackMessage8', 'اسم المستخدم طويل جداً');
//     sendData = 0;
//   } else {
//     setSuccessFor(userName);
//     sendData = 1;
//   }

//   if (passwordOneValue === "") {
//     setErrorFor(passwordOne, 'feedbackMessage9', '*');
//     sendData = 0;
//   } else if (passwordOneValue.length <= 7) {
//     setErrorFor(passwordOne, 'feedbackMessage9', '(خانات 8) كلمة المرور قصير جداً');
//     sendData = 0;
//   } else if (passwordOneValue.length >= 31) {
//     setErrorFor(passwordOne, 'feedbackMessage9', 'كلمة المرور طويلة');
//     sendData = 0;
//   } else {
//     setSuccessFor(passwordOne);
//     sendData = 1;
//   }

//   if (passwordTowValue === "") {
//     setErrorFor(passwordTow, 'feedbackMessage10', '*');
//     sendData = 0;
//   } else if (passwordOneValue !== passwordTowValue) {
//     setErrorFor(passwordTow, 'feedbackMessage10', 'كلمة المرور غير متطابقة');
//     sendData = 0;
//   } else {
//     setSuccessFor(passwordTow);
//     sendData = 1;
//   }


//   if (sendData == 1)
//     return true;
// }

// function setErrorFor(input, id, message) {

//   input.className = "form-control is-invalid";
//   const feedbackMessage = document.getElementById(id);
//   feedbackMessage.innerText = message;
// }

// function setSuccessFor(input) {
//   input.className = "form-control is-valid";
// }

// function setSuccessCheckBoxFor(input) {
//   const x = input.className = "form-check-input is-valid";
// }

// // reqular expression function
// function isWhiteSpace(elementValue) {
//   const re = /^\S*$/;
//   return re.test(elementValue);
// }

// function isNum(elementValue) {
//   const re = /^[0-9]+$/;
//   return re.test(elementValue);
// }

// function isEmail(elementValue) {
//   const re = /^([a-zA-Z0-9_\-?\.?]){3,}@([a-zA-Z]){3,}\.([a-zA-Z]){2,5}$/;
//   return re.test(elementValue);
// }

// function isCharOnly(elementValue) {
//   const re = /^[a-zA-Z0-9]+$/;
//   return re.test(elementValue);
// }