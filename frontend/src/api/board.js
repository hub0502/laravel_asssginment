import http from "./http";

export async function store(title, content) {
  return http.post("/store", {
    title: title,
    content: content,
  });
}
