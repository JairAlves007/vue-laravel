<template>
  <div class="my-5">
    <form @submit="submitTodo">
      <div class="form-group mb-2">
        <label for="title">Título</label>
        <input id="title" v-model="title" class="form-control" type="text" />
      </div>

      <div class="form-group">
        <label for="description"> Descrição </label>

        <textarea id="description" v-model="description" class="form-control" type="text"></textarea>
      </div>

      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="due_date">Data de Encerramento</label>
            <input id="due_date" v-model="due_date" class="form-control" type="date" />
          </div>
        </div>
        <div class="col">
          <div class="form-check">
            <input
              class="form-check-input"
              type="checkbox"
              value=""
              v-model="is_done"
              id="flexCheckDefault"
            />
            <label class="form-check-label" for="flexCheckDefault">
              Completa
            </label>
          </div>
        </div>
      </div>

      <div class="mt-5">
        <button class="btn btn-primary" type="submit">
          Criar
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "Form",
  data() {
    return{
      title: null,
      description: null,
      due_date: null,
      is_done: true
    }
  },
  props: {
    userId: {
      type: String,
      default: null
    }
  },
  methods: {
    async submitTodo(e) {
      e.preventDefault();
      
      const data = {
        title: this.title,
        description: this.description,
        due_date: this.due_date,
        is_done: this.is_done
      };

      const dataJson = JSON.stringify(data);

      const req = await fetch(`http://localhost:8000/api/users/${this.userId}/todos/`, {
        method: 'POST',
        headers: { 
          'Content-Type' : 'application/json',
          'Accept': 'application/json'
        },
        body: dataJson
      });

      const res = await req.json();

      this.title = "";
      this.description = "";
      this.due_date = "";
      this.is_done = true;

      this.$emit('onSave', res.data);
    }
  }
};
</script>