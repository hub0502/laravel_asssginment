<template>
  <div class="w-full max-w-xs m-auto">
    <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
      <div class="mb-4">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="username"
        >
          Username
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          v-model="name"
          type="text"
          placeholder="name"
        />
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
          Email
        </label>

        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          v-model="email"
          type="email"
          placeholder="Email"
        />
        <p class="text-red-500 text-xs italic">don't exists</p>
      </div>
      <div class="mb-6">
        <label
          class="block text-gray-700 text-sm font-bold mb-2"
          for="password"
        >
          Password
        </label>
        <input
          class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline"
          type="password"
          v-model="password"
          placeholder="min 6"
        />
        <p class="text-red-500 text-xs italic hidden">
          Please choose a password.
        </p>
      </div>
      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline m-auto"
          type="button"
          @click="btn_click()"
        >
          Sign Up
        </button>
      </div>
    </form>
    <p class="text-center text-gray-500 text-xs">
      &copy;2020 Acme Corp. All rights reserved.
    </p>
  </div>
</template>

<script>
export default {
  data() {
    return {
      name: "",
      email: "",
      password: "",
    };
  },
  methods: {
    btn_click() {
      let status = this.checkEmp();
      if (status == "true") {
        this.sendPost();
      } else {
        alert(status);
      }
    },

    sendPost() {
      this.axios
        .post(`http://${window.location.hostname}:8000/api/register`, {
          name: this.name,
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          if (res.data.status == "failed") {
            alert(res.data.msg);
            this.email = "";
          } else if (res.status == 200) {
            alert("회원가입에 성공하셨습니다.");
            this.setCookie("test", res.data.authorisation.token, 1);
            this.sendToken(res.data.authorisation.token);
            window.location.href = `/login`;
          }
        });
      // .catch((err) => {
      //   if (err.response.status == 422) {
      //     alert("email exists ");
      //     this.name = "";
      //     this.email = "";
      //     this.password = "";
      //   } else {
      //     console.log(err);
      //   }
      // });
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
    setCookie: (cookie_name, value, miuntes) => {
      const exdate = new Date();
      exdate.setMinutes(exdate.getMinutes() + miuntes);
      const cookie_value =
        value + (miuntes == null ? "" : "; expires=" + exdate);
      document.cookie = escape(cookie_name) + "=" + escape(cookie_value);
    },
    checkEmp() {
      let msg = "";
      if (this.name == "") {
        msg = "name empty";
      } else if (this.email == "") {
        msg = "email empty";
      } else if (this.password == "") {
        msg = "password empty";
      }
      if (msg == "") {
        return "true";
      }
      return msg;
    },
  },
};
</script>

<style></style>
