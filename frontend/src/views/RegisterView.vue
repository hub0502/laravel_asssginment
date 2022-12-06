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
import * as authApi from "@/api/auth";
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
        this.createUser();
      } else {
        alert(status);
      }
    },

    createUser() {
      authApi
        .register(this.name, this.email, this.password)
        .then((res) => {
          if (res.data.status == "failed") {
            alert(res.data.msg);
            this.email = "";
          } else {
            alert("create regist successful");
            window.location.href = `/login`;
          }
        })
        .catch((err) => {
          alert("Email format incorrect");
          this.email = "";
          console.log(err);
        });
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
