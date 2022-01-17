<template>
  <div class="about">
    <h2>
      {{ user.name }}
    </h2>

    <h4>
      {{ user.email }}
    </h4>

    <Form :userId="userId" @onSave="onSave" />

    <div v-for="todo in user.todos" :key="todo.id" class="card mb-3">
      <div class="card-body">

        <div class="d-flex justify-content-between">
          <div>
            <p>
              {{ todo.title }}
            </p>

            <small class="text-muted">
              {{ todo.description }}
            </small>
          </div>

          <div>
            <span style="cursor: pointer;" @click="toggleDone(todo)">
              <i v-if="todo.is_done" class="fa fa-check-square"></i>
              <i v-else class="fa fa-square"></i>
            </span>
          </div>
        </div>

      </div>
    </div>
  </div>
</template>

<script>
import Form from '../components/Form.vue';

export default {
  name: "UserTodo",
  components: {
    Form
  },
  data() {
    return {
      user: [],
    };
  },
  computed: {
    userId() {
      return this.$route.params.id;
    }
  },
  methods: {
    async getTodos() {
      const userId = this.$route.params.id;

      const req = await fetch(`http://localhost:8000/api/users/${userId}`);

      const res = await req.json();

      this.user = res.data;
    },
    onSave(data) {
      this.user.todos.unshift(data);
    },
    async toggleDone(todo) {
      const url = todo.is_done ? 'undone' : 'done';

      const req = await fetch(`http://localhost:8000/api/todos/${todo.id}/${url}`, {
        method: 'PUT'
      });

      const res = await req.json();

      todo.is_done = res.data.is_done;
    }
  },
  mounted() {
    this.getTodos();
  }
}
</script>