import http from "./http";
import { getToken } from "./token";

export async function index() {
  return http.get("/chats");
}

export async function store(content, board_id, token) {
  return http.post("/chat", {
    chat_content: content,
    board_id: board_id,
    token: token,
  });
}

export async function show(board_id) {
  return http.get(`/chat/${board_id}`);
}

export async function destroy(id) {
  return http.post(`/chat/${id}`, {
    token: getToken(),
  });
}
