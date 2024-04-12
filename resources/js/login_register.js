//efect de carte
const right = document.getElementById("signUpOverlay");
const left = document.getElementById("signInOverlay");
const section = document.querySelector("section");
const urlParams = new URLSearchParams(window.location.search);
const page = urlParams.get('page');
if (page === 'register') {
  section.classList.add("flip");
}
let clicked = false;
right.addEventListener("click", (e) => {
  section.classList.toggle("flip");
  if (!clicked) {
    clicked = true;
  }
});
left.addEventListener("click", (e) => {
  section.classList.toggle("flip");
  if (!clicked) {
    clicked = true;
  }
});
// //login
// const submitSignIn = document.getElementById("signIn");
// submitSignIn.addEventListener("click", async (event) => {
//   event.preventDefault();

//   let username = document.forms["sign-in-form"]["username"].value;
//   let pass = document.forms["sign-in-form"]["pass"].value;
//   let data = { username,pass};
//   const response = await fetch("/api/login", {
//     method: "POST",
//     headers: {
//         "Content-Type": "application/json",
//       },
//     body: JSON.stringify(data),
//   })
//     .then(async (response) => {
//       if (response.ok) {
//         const { token } = await response.json();
//         localStorage.setItem("token", token);
//         window.location.href="/index";
//       } else {
//         const responseData = await response.json();
//         showNotification(JSON.stringify(responseData),true);
//       }
//     })
//     .catch((error) => {
//       console.error("Error:", error);
//     });
// });
// //register
// const submitSignUp = document.getElementById("signUp");
// submitSignUp.addEventListener("click", async (event) => {
//   event.preventDefault();

//   const form = document.getElementsByName("sign-up-form")[0];

// const formData = new FormData(form);
// const urlEncodedData = new URLSearchParams(formData).toString();
// console.log(urlEncodedData);

//   const response = await fetch("/api/register", {
//     method: "POST",
//     headers: {
//         'Content-Type': 'application/x-www-form-urlencoded',
//       },
//       body: urlEncodedData,
//   })
//     .then(async (response) => {
//       if (response.ok) {
//         console.log("Registration successful");
//         const responseData = await response.json();
//         showNotification(JSON.stringify(responseData));
//         setTimeout(() => {
//           window.location.reload();
//         }, 1000);
//       } else {
//         console.error("Registration failed");
//         const responseData = await response.json();
//         showNotification(JSON.stringify(responseData),true);
//       }
//     })
//     .catch((error) => {
//       console.error("Error:", error);
//     });
// });

// function showNotification(message, isError = false) {
//     const notification = document.createElement("div");
//     notification.className = isError ? "notification error" : "notification";
//     notification.textContent = message;
//     document.body.appendChild(notification);
//       setTimeout(() => {
//       notification.remove();
//     }, 1000);
//   }