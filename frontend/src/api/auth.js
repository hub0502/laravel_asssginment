import http from "./http";

export async function login(userEmail, password) {
  return http.post("/login", {
    email: userEmail,
    password: password,
  });
}

export async function register(userName, userEmail, userPassword) {
  return http.post("/register", {
    name: userName,
    email: userEmail,
    password: userPassword,
  });
}
