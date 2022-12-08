import http from "./http";
import { getToken } from "./token";

export async function index() {
  return http.get("/boards");
}

export async function store(title, content, token) {
  return http.post("/board", {
    title: title,
    content: content,
    userid: 1,
    token: token,
  });
}

export async function show(id) {
  return http.get(`/board/${id}`);
}

export async function shows() {
  return http.post(`/boards`, {
    token: getToken(),
  });
}

export async function destroy(id) {
  return http.delete(`/board/${id}`, getToken());
}
