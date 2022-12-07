import http from "./http";

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
