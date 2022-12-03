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
          placeholder="Username"
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
          placeholder="************"
        />
        <p class="text-red-500 text-xs italic hidden">
          Please choose a password.
        </p>
      </div>
      <div class="flex items-center justify-between">
        <button
          class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline m-auto"
          type="button"
          @click="sendPost()"
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
    sendPost() {
      console.log(`http://${window.location.hostname}:8000/api/register`);
      this.axios
        .post(`http://${window.location.hostname}:8000/api/register`, {
          name: this.name,
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          if (res.status == 200) {
            alert("회원가입에 성공하셨습니다.");
            document.cookie = `logged=${res.data.authorisation.token}`;
            this.sendToken(res.data.authorisation.token);
            // window.location.href = `/login`;
          } else {
            console.log("failed");
            console.log(res);
          }
        });
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
  },
};
</script>

<style></style>
