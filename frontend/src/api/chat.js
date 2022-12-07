import http from "./http";

export function index() {
  http.get("/chats");
}

export function store() {}
