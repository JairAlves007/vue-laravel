<template>
  <div class="home">
    <img alt="Vue logo" src="../assets/logo.png">
    <CardUsers />
  </div>
</template>

<script>
import CardUsers from '../components/CardUsers.vue';

export default {
  name: 'Home',
  components: {
    CardUsers
  }
}
</script>
