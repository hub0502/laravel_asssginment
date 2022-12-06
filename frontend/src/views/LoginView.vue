<template>
  <div class="w-full max-w-xs m-auto">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="username"
        >
          Email
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="username"
          type="text"
          placeholder="Email"
          v-model="email"
        />
      </div>
      <div class="mb-6">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="password"
        >
          Password
        </label>
        <input
          class="shadow appearance-none border border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
          id="password"
          type="password"
          placeholder="**********"
          v-model="password"
        />
        <p class="text-red-500 text-xs italic hidden">
          Please choose a password.
        </p>
      </div>
      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
          type="button"
          @click="login()"
        >
          Sign In
        </button>
        <a
          class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800"
          href="#"
        >
          Forgot Password?
        </a>
      </div>
    </form>
    <p class="text-center text-gray-500 text-xs">
      &copy;2020 Acme Corp. All rights reserved.
    </p>
    {{ cookies }}
  </div>
</template>

<script>
export default {
  data() {
    return {
      email: "",
      password: "",
      cookies: {},
    };
  },
  mounted() {
    let cookies = document.cookie.split(";");

    cookies.forEach((data) => {
      this.cookies[data.split("=")[0].replaceAll(" ", "")] = data
        .split("=")[1]
        .replaceAll(" ", "");
    });
  },
  methods: {
    login(email, password) {
      console.log(this.dateCheck(this.cookies["logged_avaliableTime"]));
      if (email == "") {
        alert("email empty");
      } else if (password == "") {
        alert("password empty");
      } else {
        this.axios
          .post(`http://${window.location.hostname}:8000/api/login`, {
            email: this.email,
            password: this.password,
          })
          .then((res) => {
            if (res.status == 200) {
              alert("login success");
              this.setCookie("logged", res.data.authorisation.token, 1);
              this.sendToken(res.data.authorisation.token);
              // window.location.href = "/";
            }
            console.log(res);
          });
        // .catch();
      }
    },
    dateCheck(date) {
      let now = new Date();
      console.log(now);
      console.log(date);
      if (now > date) {
        return false;
      }
      return true;
    },
    sendToken(token) {
      this.axios
        .post(`http://${window.location.hostname}:8000/api/get_user`, {
          token: token,
        })
        .then((res) => {
          console.log(res);
        });
    },
    setCookie: (cookie_name, value, minutes) => {
      const exdate = new Date();
      exdate.setMinutes(exdate.getMinutes() + minutes);
      const cookie_value =
        value + (minutes == null ? "" : "; expires=" + exdate.toGMTString());
      document.cookie = cookie_name + "=" + cookie_value;
      // document.cookie = cookie_name + "_avaliableTime" + "=" + `${exdate}`;
    },
  },
};
</script>

<style></style>
