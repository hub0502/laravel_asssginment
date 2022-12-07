export function getToken() {
  let result = "";
  let dataInResult = false;
  let cookie = document.cookie.split(";");
  cookie.forEach((data) => {
    if (data.split("=")[0].replaceAll(" ", "") === "logged") {
      result = data.split("=")[1];
      dataInResult = true;
    }
  });
  if (dataInResult) {
    return result;
  }
  return false;
}

// 궁금증 저 forEach 함수에 들어가면 return 값이 먹지 않는ㄷk
