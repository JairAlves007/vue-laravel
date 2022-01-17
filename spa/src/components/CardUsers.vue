<template>
  <div class="container pt-5">
    <div v-for="user in users" :key="user.id" class="card mb-3">
      <router-link :to="{ name: 'user-todos', params: { id: user.id } }">
        <div class="card-body">
          {{ user.name }}
        </div>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "CardUsers",
  data() {
    return {
      users: [],
    };
  },
  methods: {
    async getUsers() {
      const req = await fetch("http://localhost:8000/api/users/");

      const res = await req.json();

      this.users = res.data;
    },
  },
  mounted() {
    this.getUsers();
  },
};
</script>