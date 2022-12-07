import http from "./http";

export async function index() {
  return http.get("/boards");
}

export async function store(title, content) {
  return http.post("/board", {
    title: title,
    content: content,
    userid: 1,
  });
}
