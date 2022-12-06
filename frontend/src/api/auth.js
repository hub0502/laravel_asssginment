import http from "./http";

export async function login(userid, password) {
  return http.post("/login", {
    email: userid,
    password: password,
  });
}
